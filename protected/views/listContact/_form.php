<?php
/* @var $this ListContactController */
/* @var $model ListContact */
/* @var $form CActiveForm */
?>
<script>
$(document).ready(function() {
    
document.getElementById("updateButton").disabled = true;
document.getElementById("tagUpdate").disabled = true;
document.getElementById("ListContact_list_id").disabled = true;
        $("button[name='add']").attr('disabled','disabled');
        
        $("button[name='addall']").attr('disabled','disabled');


});
</script>
<style type="text/css">
  .listexist .control-label{display:none;}  
  .listexist #ListContact_list_id{width:200px;}
  .listbuttons button{ width: 75%; margin: 0 auto;}  
  
</style>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/contactlist.js"></script>

<h1><?php echo  Yii::t('app','Search For Journalists');?></h1>
<div class="form">
    <?php
    $form = $this->beginWidget('booster.widgets.TbActiveForm', array(
        'id' => 'search-form',
        'htmlOptions' => array('class' => 'col-sm-5', 'class' => 'well'),
        'type' => 'horizontal',
        'enableClientValidation' => false,
        'clientOptions' => array(
            'validateOnSubmit' => true,
        ),
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
    ));
    ?>


    <div class="row"> 
  <h4><div class="col-md-10 col-md-offset-3"><i class="fa fa-tasks fa-lg"></i> <?php echo  Yii::t('app','Category');?> :&nbsp;&nbsp;<?php
        
        $data = CHtml::listData(BusinessCategory::model()->findAll(), 'cat_id', 'cat_title');
        
        if(isset($_POST['BusinessCategory'])){$cat = $_POST['BusinessCategory'];}else{$cat = '';}
        $this->widget(
    'booster.widgets.TbSelect2',
    array(
        'htmlOptions' => array(
            'multiple' => 'multiple',
        ),
        'name' => 'BusinessCategory[]',
        'data' => $data,
        'value' => $cat,
        'options' => array(
            'placeholder' => 'All categories',
            'width' => '40%',
        )
    )
);
        
        
        ?></div></h4>
</div>
       
      
       



<div class="row">
  <h4><div class="col-md-10 col-md-offset-3"><i class="fa fa-language fa-lg"></i> <?php echo  Yii::t('app','Language');?> :   <?php
        
        $data = CHtml::listData(IsoLanguage::model()->findAll(), 'lang_iso', 'language');
        
        if(isset($_POST['IsoLanguage'])){$lang = $_POST['IsoLanguage'];}else{$lang = '';}
        $this->widget(
    'booster.widgets.TbSelect2',
    array(
        'htmlOptions' => array(
            'multiple' => 'multiple',
        ),
        'name' => 'IsoLanguage[]',
        'data' => $data,
        'value' => $lang,
        'options' => array(
            'placeholder' => 'All Languages',
            'width' => '40%',
        )
    )
);
        
        ?></div></h4>

        
     
       
    </div>
    
    
   <div class="row">
  <h4>  <div class="col-md-10 col-md-offset-3 "><i class="fa fa-globe fa-lg"></i> <?php echo  Yii::t('app','Region');?>: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <?php
        
        $data = CHtml::listData(GeoRegion::model()->GeoRegionAfrica(), 'geo_region_id', 'region_name');
        
        if(isset($_POST['GeoRegion'])){$region = $_POST['GeoRegion'];}else{$region = '';}
        $this->widget(
    'booster.widgets.TbSelect2',
    array(
        'htmlOptions' => array(
            'multiple' => 'multiple',
        ),
        'name' => 'GeoRegion[]',
        'data' => $data,
        'value' => $region,
        'options' => array(
            'placeholder' => 'All regions',
            'width' => '40%',
        )
    )
);
        ?></div></h4>   
       
    </div>
    
    
    <div class="row">
  <h4>  <div class="col-md-10 col-md-offset-3 "><i class="fa fa-youtube-play fa-lg"></i>  Media : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <?php
        
        $data = CHtml::listData(Channel::model()->findAll(), 'channel_id', 'channel_title');
        
        if(isset($_POST['Channel'])){$channel = $_POST['Channel'];}else{$channel = '';}
        $this->widget(
    'booster.widgets.TbSelect2',
    array(
        'htmlOptions' => array(
            'multiple' => 'multiple',
        ),
        'name' => 'Channel[]',
        'data' => $data,
        'value' => $channel,
        'options' => array(
            'placeholder' => 'All channels',
            'width' => '40%',
        )
    )
);
        ?></div></h4>   
       
    </div>
    
    
    
    
        <div class="buttons pull-right">
            
            <?php
            $this->widget('booster.widgets.TbButton', array('buttonType' => 'submit', 'size' => 'large', 'context' => 'success', 'label' => Yii::t('app','Search'))
            );
            ?>
        </div>
    <div class="row"></div>
    </div> 
    <?php $this->endWidget(); ?>

</div><!-- form -->

<h1><?php echo  Yii::t('app','Create List Contact');?></h1>

<div class="form">

    <?php
    $form = $this->beginWidget('booster.widgets.TbActiveForm', array(
        'id' => 'id-list-contact',
        'htmlOptions' => array('class' => 'col-sm-5', 'class' => 'well', 'name' => 'contactlist','onSubmit'=>'return updatelist();'),
        'type' => 'horizontal',
//        'enableClientValidation' => false,
        'clientOptions' => array(
            'validateOnSubmit' => true,
        ),
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
    ));
    ?>

    <p class="note"><?php echo  Yii::t('app','Fields with');?><span class="required">*</span><?php echo  Yii::t('app','are required.');?> </p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php //echo $form->labelEx($model,'list_user'); ?>
        <?php echo $form->HiddenField($model, 'list_user', array('value' => Yii::app()->user->id)); ?>
        <?php echo $form->error($model, 'list_user'); ?>
    </div>

    <div class="col-xs-5">
        <input type="radio" name="action" value="create" id="create" checked="true" onchange="read()" style="float: left; margin-right: 10px;"/>
        <?php // echo $form->labelEx($model,'Create a list');  ?>
        <?php
        echo $form->textFieldGroup($model, 'list_name', array('size' => 20, 'maxlength' => 255, 'label' => Yii::t('app','Create a list'),
            'wrapperHtmlOptions' => array('class' => 'col-sm-6',),
        ));
        ?>

        <?php // echo $form->error($model,'list_name');   ?>
    </div>  


        <input type="radio" name="action" value="update" id="update" onchange="read()" style="float: left; margin-right: 10px;"/>

       <label style="float:left; margin-top: 5px;">   <?php echo  Yii::t('app','Update existing list');?></label>
       <div class="listexist">
           <div class="col-xs-3 ">  
               
               <?php
               $element = array();
              // $data =  CHtml::listData(ListContact::model()->findAll(), 'list_id', 'list_name');
              $data = ListContact::model()->findAll();
             
               $element[0] =  Yii::t('app','Choose a list');
              if(count($data)>0){
		 foreach($data as $value){
		

                   $element[$value->list_id] = $value->list_name;
}
             
		}
             // print_r($element);
               echo $form->dropDownListGroup(
			$model,
			'list_id',
			array(  
				'wrapperHtmlOptions' => array(
					'class' => 'col-sm-5',
                                        
				),
				'widgetOptions' => array(
					'data' => $element,
                                        
					'htmlOptions' => array('onChange'=>"selectlist(this.value,'".Yii::app()->request->baseUrl."/index.php/listContact/listupdate/namelist/','updatelist')","style="=>"width:200px;"),
				)
			)
		); 
               
               ?>
            </div>   
    </div>   

<?php if (!$model->list_id) { ?>
    <div class="row">
        <?php echo $form->HiddenField($model, 'list_added', array('value' => time())); ?>
        <?php echo $form->error($model, 'list_added'); ?>
    </div>
<?php } ?>
<?php if ($model->list_id) { ?>
    <div class="row">
        <?php echo $form->HiddenField($model, 'list_modified', array('value' => time())); ?>
        <?php echo $form->error($model, 'list_modified'); ?>
    </div>
<?php } ?>

<div class="row">


    <div class=" col-xs-4">
        
        <select size="15" multiple name="contact_id[]" onchange="add_addall()" class="form-control " id="tagCreate">
            <?php
            
            foreach ($contact as $value){
                
                $name = $value->contact_name_first.' '.$value->contact_name_last;
                echo ' <option  value ="' . $value->contact_id . '" >' . $name . '</option>';
                
                
            }
            ?>
        </select>
        
    </div>  

    <div class="col-xs-4 listbuttons"><br>
<button type="button" class="btn btn-success btn-lg btn-block" disabled id="add" onClick="AddToBlack();"  name="add" name="add"><i class="fa fa-plus-circle fa-lg"></i> <?php echo  Yii::t('app','Add selected item(s)');?> </button>
<button type="button" class="btn btn-success btn-lg btn-block" disabled id="addall" onClick="AddAllToBlack();" name="addall"><i class="fa fa-plus-circle fa-lg"></i> <?php echo  Yii::t('app','Add all');?> </button>        
<br><br>
<button type="button" class="btn btn-danger btn-lg btn-block" disabled name="Remove" onClick="RemoveFromBlack();" id="remove">  <i class="fa fa-times-circle fa-lg"></i> <?php echo  Yii::t('app','Remove selected item(s)');?></button>
<button type="button" class="btn btn-danger btn-lg btn-block" disabled id="Removeall" name="Removeall"  onClick="RemoveAllFromBlack();"><i class="fa fa-times-circle fa-lg"></i> <?php echo  Yii::t('app','Remove All');?> </button>
        
               

    </div>     



    <div class=" col-xs-4 ">
        <div id="updatelist">
        <select size="15" multiple name="contact_id_of_list[]" class="form-control" onchange="Remove_Removeall()" id="tagUpdate">
        </select>
        </div>
    </div>

</div>





<!--    
    /////////////////////////////
     <div class="row">
            <div id="testDiv">
            <table>
                <tr><td><input type="checkbox" id="selecctall" style="float:left; margin-right:10px;"/><b>Select all</b></td></tr>
                <tr>
                    <td>
<?php
//
//                    foreach($contact as  $value){
//                        echo '<div><input name="contact_id[]" class="checkbox1"  value="'.$value->contact_id.'" type="checkbox" style="float:left; margin-right:10px;" /><label>'.$value->contact_email.'</lable></div>';
//                    
//                   
//                    }
//                
?>
                    </td>
                </tr>
            </table>
        </div>
    ///////////////////////////-->
<div class="row">





<div class=" buttons pull-right">
    <?php
    $this->widget('booster.widgets.TbButton', array('buttonType' => 'submit','id'=>"updateButton", 'size' => 'large', 'context' => 'success', 'label' => Yii::t('app','Create / Update'))
    );
    ?>
</div>
    </div>
<div class="row"></div>
<?php $this->endWidget(); ?>

</div><!-- form -->
