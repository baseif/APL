<?php
/* @var $this ChannelController */
/* @var $data Channel */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('channel_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->channel_id), array('view', 'id'=>$data->channel_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('channel_title')); ?>:</b>
	<?php echo CHtml::encode($data->channel_title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('channel_category')); ?>:</b>
	<?php echo CHtml::encode($data->channel_category); ?>
	<br />


</div>