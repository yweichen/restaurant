<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'merchant-form',
    'enableAjaxValidation' => false,
    'enableClientValidation' => true,
    //'focus' => array($model, 'login_email'),
    'type' => 'horizontal',
    'htmlOptions' => array('class' => 'well'),
        ));
?>

<?php echo $form->errorSummary(array($model, $modelMA, $regForm)); ?>
<?php
$this->widget('bootstrap.widgets.TbAlert', array(
    'block' => true, // display a larger alert block?
    'fade' => true, // use transitions?
    'closeText' => '&times;', // close link text - if set to false, no close link is displayed
    'alerts' => array(// configurations per alert type
        'success' => array('block' => true, 'fade' => true, 'closeText' => '&times;'), // success, info, warning, error or danger
    ),
));
?>
<?php echo $form->textFieldRow($model, 'login_email', array('prepend' => '<i class="icon-envelope"></i>', 'class' => 'span3', 'maxlength' => 64)); ?>

<?php echo $form->passwordFieldRow($model, 'password', array('prepend' => '<i class="icon-lock"></i>', 'class' => 'span3', 'maxlength' => 64)); ?>

<?php echo $form->textFieldRow($modelMA, 'restaurant_name', array('class' => 'span4', 'maxlength' => 200)); ?>

<?php echo $form->textFieldRow($modelMA, 'first_name', array('class' => 'span4', 'maxlength' => 64)); ?>

<?php echo $form->textFieldRow($modelMA, 'last_name', array('class' => 'span4', 'maxlength' => 64)); ?>

<?php echo $form->dropDownListRow($modelMA, 'contact_number_country_id', $contactCountry, array('class' => 'span4', 'empty' => '', 'options' => array($defaultContactCountry => array('selected' => 'selected')))); ?>

<?php echo $form->textFieldRow($modelMA, 'contact_number', array('class' => 'span4', 'maxlength' => 16)); ?>

<?php echo $form->checkboxRow($regForm, 'agree'); ?>

<div class="form-actions"> 
    <?php
    $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType' => 'submit',
        'type' => 'primary',
        'label' => Yii::t('merchant', 'BUTTON_SIGNUP'),
        'size' => 'large',
        'icon' => 'user white',
    ));
    ?>
</div>
<p class="help-block">Fields with <span class="required">*</span> are required.</p> 
<?php $this->endWidget(); ?>