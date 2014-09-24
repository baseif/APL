<?php
/* @var $this ChannelController */
/* @var $model Channel */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'channel_id'); ?>
		<?php echo $form->textField($model,'channel_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'channel_title'); ?>
		<?php echo $form->textField($model,'channel_title',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'channel_category'); ?>
		<?php echo $form->textField($model,'channel_category',array('size'=>2,'maxlength'=>2)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->