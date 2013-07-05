<?php

class MerchantController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('update'),
                'users' => array('@'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('join', 'update'),
                'users' => array('?'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
                'users' => array('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionJoin() {
        $model = new Merchant;
        $modelMerchantAccount = new MerchantAccount;
        $regForm =new RegistrationForm;
        
        $criteria = new CDbCriteria();
        $criteria->with = array(
            'dialingCode' => array('select' => 'id, calling_code', 'alias' => 'dialingCode', 'joinType' => 'INNER JOIN')
        );
        $criteria->select = 't.name, t.code';
        $criteria->order = 'name ASC';

        $contactCountry = Country::model()->findAll($criteria);

        $dialingCodeArray = array();

        $selectedCountry = '';

        foreach ($contactCountry as $row) {
            foreach ($row->dialingCode as $countryInfoRow) {
                if ($row->code == Yii::app()->session['userCountryISO3']) {
                    $selectedCountry = $countryInfoRow->id;
                }
                $dialingCodeArray[] = array('id' => (int)$countryInfoRow->id, 'value' => $row->name . ' (+' . $countryInfoRow->calling_code . ')');
            }
        }

        $contactCountry = CHtml::listData($dialingCodeArray, 'id', 'value');

        // Uncomment the following line if AJAX validation is needed
        //$this->performAjaxValidation($model);
        
        if (isset($_POST['Merchant']) && isset($_POST['MerchantAccount'])) {
//            CVarDumper::dump($_POST['MerchantAccount'], 10, true); exit;
            // Populate input data
            $model->attributes = $_POST['Merchant'];
            $model->signup_ip = Yii::app()->geoip->getRemoteIpAddress();
            $model->password = crypt($model->password, UserIdentity::blowfishSalt());
            
            $modelMerchantAccount->attributes = $_POST['MerchantAccount'];
            
            $regForm->attributes = $_POST['RegistrationForm'];
            
            // validate BOTH $a and $b
            $valid = $model->validate();
            $valid = $modelMerchantAccount->validate() && $valid;
            $valid = $regForm->validate() && $valid;
            
            if ($valid) {
                $transaction = Yii::app()->db->beginTransaction();

                try {
                    $model->save(false);
                    $modelMerchantAccount->merchant_id = $model->merchant_id;
                    $modelMerchantAccount->save(false);
                    
                    $transaction->commit();
                    
                    $this->redirect(array('view', 'id' => $model->merchant_id));
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        $this->render('join', array(
            'model' => $model,
            'modelMA' => $modelMerchantAccount,
            'regForm' => $regForm,
            'contactCountry' => $contactCountry,
            'defaultContactCountry' => $selectedCountry,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($model);

        if (isset($_POST['Merchant'])) {
            $model->attributes = $_POST['Merchant'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->merchant_id));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Merchant');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Merchant('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Merchant']))
            $model->attributes = $_GET['Merchant'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = Merchant::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'merchant-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
