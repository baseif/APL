<?php
/* @var $this PressController */
/* @var $model Press */

$this->breadcrumbs=array(
	'Presses'=>array('index'),
	'Update',
);


?>

<h1><?php echo  Yii::t('app','  Modify  Press-Release');?> </h1>

<?php $this->renderPartial('_form_1', array('model'=>$model)); ?>
