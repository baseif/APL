<?php
/* @var $this ListContactController */
/* @var $model ListContact */
/* @var $form CActiveForm */
?>
<script>
$(document).ready(function() {
    
document.getElementById("updateButton").disabled = true;
document.getElementById("tagUpdate").disabled = true;

        $("button[name='add']").attr('disabled','disabled');
        
        $("button[name='addall']").attr('disabled','disabled');


});
</script>

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/main.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.slimscroll.js"></script>

<h1>Search For Journalists </h1>
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
        <?php
        
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
            'placeholder' => 'Choose a category',
            'width' => '40%',
        )
    )
);
        
        
        ?>
    </div>



    <div class="row">
        <?php
        
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
            'placeholder' => 'Choose a language',
            'width' => '40%',
        )
    )
);
        
        ?>
    </div>
    
    
    <div class="row">
        <?php
        
        $data = CHtml::listData(GeoRegion::model()->findAll(), 'geo_region_id', 'region_name');
        
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
            'placeholder' => 'Choose a region',
            'width' => '40%',
        )
    )
);
        ?>
    </div>
    
        <div class="buttons pull-right">
            
            <?php
            $this->widget('booster.widgets.TbButton', array('buttonType' => 'submit', 'size' => 'large', 'context' => 'success', 'label' => 'Search')
            );
            ?>
        </div>
    <div class="row"></div>
    </div> 
    <?php $this->endWidget(); ?>

</div><!-- form -->

<h1>Create ListContact</h1>

<div class="form">

    <?php
    $form = $this->beginWidget('booster.widgets.TbActiveForm', array(
        'id' => 'id-list-contact',
        'htmlOptions' => array('class' => 'col-sm-5', 'class' => 'well'),
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

    <p class="note">Fields with <span class="required">*</span> are required.</p>

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
        echo $form->textFieldGroup($model, 'list_name', array('size' => 20, 'maxlength' => 255, 'label' => 'Create a list',
            'wrapperHtmlOptions' => array('class' => 'col-sm-6',),
        ));
        ?>

        <?php // echo $form->error($model,'list_name');   ?>
    </div>  


        <input type="radio" name="action" value="update" id="update" onchange="read()" style="float: left; margin-right: 10px;"/>

       <label style="float:left; margin-top: 5px;">   Update existing list</label>
           <div class="col-xs-3 ">  <select class="form-control push-" 
            <?php                           
            echo CHtml::dropDownList('listexist', '0', CHtml::listData(ListContact::model()->findAll(), 'list_id', 'list_name'
                    ), array('empty' => '(Select a list)', 'disabled' => 'true', 'options' => array('class' => 'col-sm-4',"onchange"=>"sendData(id_list=)")));
            ?> 
        </select>
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

    <div class="col-xs-4"><br>
       <button type="button" class="btn btn-success btn-lg btn-block" disabled id="add" name="add"><i class="fa fa-plus-circle fa-lg"></i> Add selected item(s)  </button>
<button type="button" class="btn btn-success btn-lg btn-block" disabled id="addall" name="addall"><i class="fa fa-plus-circle fa-lg"></i>  Add all</button>
         
<br><br>
<button type="button" class="btn btn-danger btn-lg btn-block" disabled name="Remove">  <i class="fa fa-times-circle fa-lg"></i> Remove selected item(s) </button>
<button type="button" class="btn btn-danger btn-lg btn-block" disabled name="Removeall"><i class="fa fa-times-circle fa-lg"></i>  Remove all</button>
        
               

    </div>     



    <div class=" col-xs-4 ">
        <select size="15" multiple name="" class="form-control" onchange="Remove_Removeall()" id="tagUpdate">
            <?php
            //foreach ($contact as $value)
              //  echo ' <option  value ="' . $value->contact_id . '" >' . $value->contact_email . '</option>';
            ?>
        </select>
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
<div class="buttons col-md-3 col-md-offset-3">
    <?php
    $this->widget('booster.widgets.TbButton', array('buttonType' => 'submit', 'id'=>"createButton",'size' => 'large', 'context' => 'success', 'label' => 'Create')
    );
    ?>
</div>




<div class=" buttons col-md-3 col-md-offset-3">
    <?php
    $this->widget('booster.widgets.TbButton', array('buttonType' => 'submit','id'=>"updateButton", 'size' => 'large', 'context' => 'success', 'label' => 'Update')
    );
    ?>
</div>
    </div>
<div class="row"></div>
<?php $this->endWidget(); ?>

</div><!-- form -->