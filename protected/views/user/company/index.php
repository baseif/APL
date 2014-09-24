<?php
/* @var $this CompanyController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Companies',
);

?>

<h1>
<?php echo  Yii::t('app',' Companies');?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
