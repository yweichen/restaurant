<?php
/* @var $this MerchantController */
/* @var $model Merchant */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'merchant_id'); ?>
		<?php echo $form->textField($model,'merchant_id',array('size'=>11,'maxlength'=>11)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'login_email'); ?>
		<?php echo $form->textField($model,'login_email',array('size'=>60,'maxlength'=>128)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'singup_date'); ?>
		<?php echo $form->textField($model,'singup_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'signup_ip'); ?>
		<?php echo $form->textField($model,'signup_ip',array('size'=>32,'maxlength'=>32)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->