<?php
/* @var $this PressController */
/* @var $model Press */

//$this->breadcrumbs=array(
//	'Presses'=>array('index'),
//	'Create',
//);
//
//$this->menu=array(
//	array('label'=>'List Press', 'url'=>array('index')),
//	array('label'=>'Manage Press', 'url'=>array('admin')),
//);
?>

<h1><?php echo  Yii::t('app','Add new Press-Release');?></h1>

<?php $this->renderPartial('_form', array('model'=>$model, 'list' => $list)); ?>