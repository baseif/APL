<?php
/* @var $this CompanyController */
/* @var $model Company */

$this->breadcrumbs=array(
	'Companies'=>array('index'),
	'Create',
);

?>

<h1>
<?php echo  Yii::t('app','Create Company ');?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>