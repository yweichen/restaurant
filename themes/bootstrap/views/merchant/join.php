<?php
//$this->breadcrumbs=array(
//    'Merchants'=>array('index'),
//    'Create',
//);
?>

<h1><?php echo Yii::t('merchant', 'FORM_TITLE_SIGNUP'); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'modelMA'=>$modelMA, 'regForm'=>$regForm, 'contactCountry' => $contactCountry, 'defaultContactCountry' => $defaultContactCountry)); ?>