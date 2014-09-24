<?php
/* @var $this ListContactController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Presses List',
);
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

<h3><?php echo  Yii::t('app','Drafts');?></h3>
<div id="list-contact-grid" class="grid-view">
    <div class="table-responsive">
<table class="items     table table-hover">
    
    <tr  class="active">
    <th id="list-contact-grid_c0"><i class="fa fa-clipboard  fa-2x"></i><?php echo  Yii::t('app','Type');?></th>
    <th id="list-contact-grid_c1"><i class="fa fa-comment-o  fa-2x "></i>  <?php echo  Yii::t('app','Subject');?></th>
    <th id="list-contact-grid_c1"><i class="fa fa-paper-plane-o  fa-2x"></i> <?php echo  Yii::t('app','Sender');?> </th>
    <th id="list-contact-grid_c2"><i class="fa fa-picture-o  fa-2x"></i>   <?php echo  Yii::t('app','Attachments');?>  </th>
        <!--<i class="fa fa-file-pdf-o fa-2x"></i> </th>-->
    <th id="list-contact-grid_c3"><i class="fa fa-list-alt  fa-2x"></i>  <?php echo  Yii::t('app','Contact List');?></th>
    <th id="list-contact-grid_c3"><i class="fa fa-calendar  fa-2x"></i> <?php echo  Yii::t('app','Date Created');?> </th>
     <th id="list-contact-grid_c3">  <?php echo  Yii::t('app','Delete Press');?></th>
          <th id="list-contact-grid_c3">  <?php echo  Yii::t('app','Modify Press');?></th>

    <th></th>
    </tr>
    
     <?php   
 foreach($presses as  $value){    
   echo '<tr><td>'.'DRAFT'.'</td>';
   echo '<td>'.$value->press_subject.'</td>';   
    echo '<td>'.$value->press_sender_name.'</td>';
    
    $file1='';
    if(!empty($value->press_file_1)){
        $file1 = '<a href="'.Yii::app()->request->baseUrl.'/protected/uploads/'.$value->press_file_1.'" target="_blank"><i class="fa fa-file-image-o fa-3x"></i></a>';
        
    }
    $file2='';
    if(!empty($value->press_file_2)){
         $file2 = '<a href="'.Yii::app()->request->baseUrl.'/protected/uploads/'.$value->press_file_2.'" target="_blank"><i class="fa fa-file-image-o fa-3x"></i></a>';
    }
    $file3='';
    if(!empty($value->press_file_3)){
         $file3 = '<a href="'.Yii::app()->request->baseUrl.'/protected/uploads/'.$value->press_file_3.'" target="_blank"><i class="fa fa-file-image-o fa-3x"></i></a>';
    }
    
    
        echo '<td>'.$file1.' '.$file2.' '.$file3.'</td>'; 
    echo '<td>'.$value->GetPressName().'</td>';   
    echo '<td>'.$value->press_date.'</td>';  
    echo '<td> <div type="button" class="btn btn-danger"><i class="fa fa-trash-o fa-lg">  </i>  '.CHtml::link(Yii::t('app','Delete Draft Press'),array('press/deletepress/'.$value->press_id),array('onClick'=>Yii::t('app','return confirm("Are you sure to delete this row ?")'),'style'=>'color:#fff'   )).'</div></td>';    
//      echo'
//   
// <td> <button type="button" class="btn btn-info">
// <i class="fa fa-cogs"></i>'.CHtml::link('Detail List',array('listContact/view/'.$value->list_id),array('style'=>'color:#fff')).'</button></td>
//    
//
//        <td> <button type="button" class="btn btn-danger">
//    <i class="fa fa-trash-o fa-lg">  </i> '.CHtml::link('Delete List',array('listContact/deletelist/'.$value->list_id),array('onClick'=>'return confirm("Are you sure to delete this row ?")','style'=>'color:#fff')).'</div></td>
//</tr>';  
    
    
    
    echo '<td><div type="button" class="btn btn-info">
<i class="fa fa-cogs"></i>'.CHtml::link(Yii::t('app','Modify Draft Press'),array('press/update/'.$value->press_id),array('style'=>'color:#fff'   )).'</button></td></tr>';    

   
//  
//     echo' <td>'.date('d/m/Y',$value->list_added).'</td>';
//    if($value->list_modified>0){   echo' <td>'.date('d/m/Y',$value->list_modified).'</td>';}else{echo' <td></td>';}   
//    echo'
//<td>'.CHtml::link('Detail List',array('listContact/view/'.$value->list_id)).'</td>
//</tr>';    
}    
   
 ?>
</table>
    </div>   </div>                        
  