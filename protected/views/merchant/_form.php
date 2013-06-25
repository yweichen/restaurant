<?php
/* @var $this MerchantController */
/* @var $model Merchant */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'merchant-form',
        'enableAjaxValidation' => false,
        'enableClientValidation' => true,
        'focus' => array($model, 'login_email')
    ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

        <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'login_email'); ?>
<?php echo $form->textField($model, 'login_email', array('size' => 60, 'maxlength' => 128)); ?>
<?php echo $form->error($model, 'login_email'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'password'); ?>
<?php echo $form->passwordField($model, 'password', array('size' => 60, 'maxlength' => 128)); ?>
<?php echo $form->error($model, 'password'); ?>
    </div>

    <div class="row buttons">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'label' => Yii::t('merchant', 'BUTTON_SIGNUP'))); ?>
    <?php //echo CHtml::submitButton($model->isNewRecord ? Yii::t('merchant', 'BUTTON_SIGNUP') : 'Save', array('class' => 'btn btn-large pull-right')); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->