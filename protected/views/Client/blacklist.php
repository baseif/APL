<?php
/* @var $this ListContactController */
/* @var $model ListContact */
/* @var $form CActiveForm */
?>
<script>
$(document).ready(function() {
   


        //$("a[name='add']").attr('disabled','disabled');
        
        //$("a[name='addall']").attr('disabled','disabled');


});
</script>

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/main.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/blacklist.js"></script>

<h1> <?php echo  Yii::t('app','Black List') ?></h1>

<div class="form">

    <?php
    $form = $this->beginWidget('booster.widgets.TbActiveForm', array(
        'id' => 'id-list-contact',
        
        'htmlOptions' => array('class' => 'col-sm-5', 'class' => 'well', 'name' => 'blacklistform',),
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
  

    

<div class="row">


    <div class=" col-xs-4">
        <div id="source">
        <select size="15" multiple name="client_id[]" onchange="add_addall()" class="form-control " id="tagCreate">
            <?php
            foreach ($clients as $value){
                $name = $value->porfile_name_first.' '.$value->porfile_name_last;
                echo ' <option  value ="' . $value->user_id . '" >' . $name . '</option>';
            }
            ?>
        </select>
            </div>
    </div>  

    <div class="col-xs-4" >
  
<button type="button" class="btn btn-success btn-lg btn-block" <?php if(count($user)==0){ ?> disabled <?php } ?>  onClick="AddToBlack();"  id="add" name="add"><i class="fa fa-plus-circle fa-lg"></i> <?php echo  Yii::t('app','Add selected item(s)'); ?>  </button>
<button type="button" class="btn btn-success btn-lg btn-block" onClick="AddAllToBlack();" id="addall" name="addall"><i class="fa fa-plus-circle fa-lg"></i>   <?php echo  Yii::t('app','ADD ALL') ?></button>
         
<br><br>
<button type="button" class="btn btn-danger btn-lg btn-block" <?php if(count($user)==0){ ?> disabled <?php } ?> name="Remove" id="remove" onClick="RemoveFromBlack();" name="Remove">  
    <i class="fa fa-times-circle fa-lg"></i>  <?php echo  Yii::t('app','Remove selected item(s)') ?>  </button>
<button type="button" class="btn btn-danger btn-lg btn-block" id="Removeall" name="Removeall"  onClick="RemoveAllFromBlack();"><i class="fa fa-times-circle fa-lg"></i> <?php echo  Yii::t('app','Remove All') ?>  </button>
              

    </div>     



    <div class=" col-xs-4 ">
        <?php //print_r($user) ?>
        <div id="destination">
        <select size="15" multiple name="client_id_black[]" class="form-control" onchange="Remove_Removeall()" id="tagUpdate">
            <?php
            foreach ($user as $value){
               $name = $value->porfile_name_first.' '.$value->porfile_name_last;
                echo ' <option  value ="' . $value->user_id . '" >'.$name.'</option>';
            }
              
            ?>
        </select>
            </div>
    </div>

</div>


<div class="row">





<div class="buttons  pull-right">
    <?php
    $this->widget('booster.widgets.TbButton', array('buttonType' => 'submit','id'=>"updateButton", 'size' => 'large', 'context' => 'success', 'label' => Yii::t('app', 'Update'))
    );
    ?>
</div>
    </div>
<div class="row"></div>
<?php $this->endWidget(); ?>

</div><!-- form -->