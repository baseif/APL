
<?php
/* @var $this ListContactController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'List Contacts',
);
//
//$this->menu=array(
//	array('label'=>'Create ListContact', 'url'=>array('create')),
//	array('label'=>'Manage ListContact', 'url'=>array('admin')),
//);



?>



<h1><?php echo  Yii::t('app',' List Contacts ');?></h1>

<div class="table-responsive">
<div id="list-contact-grid" class="grid-view">
    
<table class="table table-hover">
    
    <tr>
    <th id="list-contact-grid_c0"><i class="fa fa-list-alt fa-lg"> </i> <?php echo  Yii::t('app','List name');?>  </th>
    <th id="list-contact-grid_c1"><i class="fa fa-users fa-lg"></i><?php echo  Yii::t('app','Nb contacts');?>  </th>
    <th id="list-contact-grid_c2"> <i class="fa fa-clock-o fa-lg "> </i><?php echo  Yii::t('app','List Added');?>  </th>
    <th id="list-contact-grid_c3"> <i class="fa fa-clock-o fa-lg "> </i><?php echo  Yii::t('app','List Modified');?>  </th>
    <th > <i class="icon-large icon-search"></i><?php echo  Yii::t('app','  Detail');?></th>
    <th><?php echo  Yii::t('app',' Delete ');?></th>
    
    </tr>
    
     <?php
if($list!=null){
foreach($list as  $value){
    
    echo '<tr><td> '.$value->list_name.'</td>';
    
    //$nb = ListContact::model()->nbcontacts();
    
    $contact = ListContact::model()->findByPk($value->list_id);
    $nb = count($contact->contacts);
    
    
    echo '<td>  '.$nb.'</td>';
      
    if($value->list_added>0){ echo' <td> '.date('d/m/Y h:i',$value->list_added).'</td>';}else{echo' <td></td>';}
    if($value->list_modified>0){ echo' <td>'.date('d/m/Y h:i',$value->list_modified).'</td>';}else{echo' <td></td>';}   
    echo'
   
 <td> <button type="button" class="btn btn-info">
 <i class="fa fa-file-text fa-lg"> </i> '.CHtml::link('Detail List',array('listContact/view/'.$value->list_id),array('style'=>'color:#fff')).'</button></td>
    

    <td> <button type="button" class="btn btn-danger">
    <i class="fa fa-trash-o fa-lg">  </i> '.CHtml::link('Delete List',array('listContact/deletelist/'.$value->list_id),array('onClick'=>'return confirm("Are you sure to delete this row ?")','style'=>'color:#fff')).'</button></td>
</tr>';    
}
     
}
     
 ?>
</table>
        </div>
    </div>
   <?php

//$this->widget('zii.widgets.grid.CGridView', array(
//	'id'=>'list-contact-grid',
//	'dataProvider'=>$dataProvider,
//	'columns'=>array(	
//		'list_name',
//            array(
//                'name'=>'contacs',
//                'value'=>  ListContact::model()->nbcontacts(1)),
//		array(
//			'class'=>'CButtonColumn',
//		),
//	),
//));



?>
