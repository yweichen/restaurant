<?php

/**
 * This is the model class for table "merchant".
 *
 * The followings are the available columns in table 'merchant':
 * @property string $merchant_id
 * @property string $login_email
 * @property string $password
 * @property string $singup_date
 * @property string $signup_ip
 */
class Merchant extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Merchant the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'merchant';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
        array('login_email, password', 'required', 'message' => Yii::t('merchant', 'ERROR_EMPTY_INPUT')),
        array('login_email, password', 'length', 'max' => 128),
        array('login_email', 'email', 'message' => Yii::t('merchant', 'ERROR_EMAIL_MISSING')),
        array('password', 'length', 'min' => 6, 'tooShort' => Yii::t("merchant", "ERROR_SHORT_INPUT")),
        array('singup_date', 'default', 'value' => new CDbExpression('NOW()'), 'setOnEmpty' => false, 'on' => 'insert'),
        // The following rule is used by search().
        // Please remove those attributes that should not be searched.
        array('login_email, singup_date, signup_ip', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'merchant_id' => Yii::t('merchant', 'LABEL_MERCHANT'),
            'login_email' => Yii::t('merchant', 'LABEL_LOGIN_EMAIL'),
            'password' => Yii::t('merchant', 'LABEL_LOGIN_PASSWORD'),
            'singup_date' => Yii::t('merchant', 'LABEL_SIGNUP_DATE'),
            'signup_ip' => Yii::t('merchant', 'LABEL_SIGNUP_IP'),
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('merchant_id', $this->merchant_id, true);
        $criteria->compare('login_email', $this->login_email, true);
        $criteria->compare('password', $this->password, true);
        $criteria->compare('singup_date', $this->singup_date, true);
        $criteria->compare('signup_ip', $this->signup_ip, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}