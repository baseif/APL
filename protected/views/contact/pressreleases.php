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

<h3><?php echo  Yii::t('app','  Presses Releases');?></h3>
<div id="list-contact-grid" class="grid-view">
    <div class="table-responsive">
<table class="items     table table-hover">
    
    <tr  class="active">
    <th id="list-contact-grid_c3" width="17%"><i class="fa fa-calendar  fa-2x"></i>  <?php echo  Yii::t('app','Date Created');?></th>
    <th id="list-contact-grid_c1"><i class="fa fa-comment-o  fa-2x "></i> <?php echo  Yii::t('app','My Press');?> </th>
        <!--<i class="fa fa-file-pdf-o fa-2x"></i> </th>-->
   
    
 

    <th></th>
    </tr>
    
     <?php   
     
 foreach($presses as  $value){   
     
echo '<tr>';
    echo '<td >'.$value->press_date.'</td>';     
  echo '<td>'.CHtml::link($value->press_subject,array('/contact/pressview/'.$value->press_id)).'<br />'.$value->press_content.'<br />'.CHtml::link('Read more',array('/contact/pressview/'.$value->press_id)).'</td>';   
//    $file1='';
//    if(!empty($value->press_file_1)){
//        $file1= CHtml::link('<i class="fa fa-file-image-o fa-4x"></i>',array('../protected/uploads/'.$value->press_file_1),array('target'=>'_blank'));
//    }
//    $file2='';
//    if(!empty($value->press_file_2)){
//        $file2= CHtml::link('<i class="fa fa-file-image-o fa-4x"></i>',array('../protected/uploads/'.$value->press_file_2),array('target'=>'_blank'));
//    }
//    $file3='';
//    if(!empty($value->press_file_3)){
//        $file3= CHtml::link('<i class="fa fa-file-image-o fa-4x"></i>',array('../protected/uploads/'.$value->press_file_3),array('target'=>'_blank'));
//    }
//        echo '<td>'.$file1.' '.$file2.' '.$file3.'</td>'; 
//    echo '<td>'.$value->GetPressName().'</td>';   
//  
//      echo'
//   
// <td> <button type="button" class="btn btn-info">
// <i class="fa fa-cogs"></i>'.CHtml::link('Detail List',array('listContact/view/'.$value->list_id),array('style'=>'color:#fff')).'</button></td>
//    
//
//        <td> <button type="button" class="btn btn-danger">
//    <i class="fa fa-trash-o fa-lg">  </i> '.CHtml::link('Delete List',array('listContact/deletelist/'.$value->list_id),array('onClick'=>'return confirm("Are you sure to delete this row ?")','style'=>'color:#fff')).'</button></td>
//</tr>';  
//    
  
  //  echo' <td>'.date('d/m/Y',$value->list_added).'</td>';
//    if($value->list_modified>0){   echo' <td>'.date('d/m/Y',$value->list_modified).'</td>';}else{echo' <td></td>';}   
//    echo'
//<td>'.CHtml::link('Detail List',array('listContact/view/'.$value->list_id)).'</td>
echo '</tr>';    
}    
   
 ?>
</table>
    </div>   </div>                        
  
