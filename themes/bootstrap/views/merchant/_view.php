<?php
/* @var $this MerchantController */
/* @var $data Merchant */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('merchant_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->merchant_id), array('view', 'id'=>$data->merchant_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('login_email')); ?>:</b>
	<?php echo CHtml::encode($data->login_email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('password')); ?>:</b>
	<?php echo CHtml::encode($data->password); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('singup_date')); ?>:</b>
	<?php echo CHtml::encode($data->singup_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('signup_ip')); ?>:</b>
	<?php echo CHtml::encode($data->signup_ip); ?>
	<br />


</div>