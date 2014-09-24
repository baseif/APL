<?php
/* @var $this ListContactController */
/* @var $dataProvider CActiveDataProvider */

//
//$this->menu=array(
//	array('label'=>'Create ListContact', 'url'=>array('create')),
//	array('label'=>'Manage ListContact', 'url'=>array('admin')),
//);
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#press-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<h3> <?php echo Yii::t('app', 'Press-Releases sent'); ?></h3>
<div id="list-contact-grid" class="grid-view">
    <div class="table-responsive">
        <table class="items table table-hover">
            <tr  class="active">
                <th id="list-contact-grid_c3"><i class="fa fa-calendar  fa-2x"></i> <?php echo Yii::t('app', 'Press Release sent'); ?> </th>
                <th id="list-contact-grid_c3"><i class="fa fa-list-alt  fa-2x"></i> <?php echo Yii::t('app', 'Contact List'); ?> </th>     
                <th id="list-contact-grid_c2"><i class="fa fa fa-money  fa-2x"></i>  <?php echo Yii::t('app', 'Credits'); ?>   </th>

                <th></th>
            </tr>
            <?php
            foreach ($credit_historys as $value) {
                echo '<tr><td>' . $value->ch_date . '</td>';
                echo '<td>' . $value->listcontact->list_name.'</td>';
                echo '<td>' . $value->ch_amount. '</td></tr>';   
            }
            ?>
        </table>
    </div>   </div>
