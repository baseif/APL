<?php
/* @var $this PressController */
/* @var $model Press */
/* @var $form CActiveForm */
?>
<script>
    $(document).ready(function() {

        document.getElementById("Press_press_status_0").checked = true;

        $('#Advert').on('show.bs.collapse', function() {
            $('#Glyp-Advert').removeClass('glyphicon glyphicon-chevron-down').addClass('glyphicon glyphicon-chevron-up');
        });
        $('#Advert').on('hide.bs.collapse', function() {
            $('#Glyp-Advert').removeClass('glyphicon glyphicon-chevron-up').addClass('glyphicon glyphicon-chevron-down');
        });
//document.getElementById("Press_press_date_started").disabled=true;
//
//document.getElementById("yw4").disabled=true;


    });
</script>


<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/main.js"></script>
<div class="form">

    <?php
    $form = $this->beginWidget('booster.widgets.TbActiveForm', array(
        'id' => 'press-form',
        'htmlOptions' => array('class' => 'col-sm-5', 'class' => 'well', 'enctype' => 'multipart/form-data'),
        'type' => 'horizontal',
        'enableClientValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => false,
        ),
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => true,
    ));
    ?> 


    <p class="note"><?php echo  Yii::t('app','Fields with');?> <span class="required">*</span> <?php echo  Yii::t('app','are required.');?></p>

    <?php echo $form->errorSummary($model); ?>
    <h2><?php echo  Yii::t('app','Email Information');?></h2> 
    <!--	<div class="row">
    <?php echo $form->labelEx($model, 'press_user'); ?>
    <?php echo $form->textFieldGroup($model, 'press_user'); ?>
    <?php echo $form->error($model, 'press_user'); ?>
            </div>-->


    <div class="form-group">


        <div class="col-sm-3 control-label" >

            <?php echo $form->labelEx($model, 'Contact List'); ?> :</div><i class="fa fa-list-alt"></i> 
            <?php //echo $form->dropDownList($model, 'list_id', CHtml::listData(ListContact::model()->findAll(), 'list_id', 'list_name')); ?>
            <?php
            $this->widget('booster.widgets.TbSelect2', array(
                'asDropDownList' => true,
                'model' => $model,
                'attribute' => 'list_id',
                'options' => array(
                    'placeholder' => $model->getAttributeLabel('list_id'),
                    'width' => '48.5%',
                    'class' => 'col-sm-3',
                    'allowClear' => true,
                ),
                'data' => CHtml::listData($list, 'list_id', 'list_name'
                ),
            ));
            ?>
            <?php echo $form->error($model, 'list_id'); ?>
    </div>






    <div class="row">
        <?php //  echo $form->labelEx($model, 'Subject:');  ?> 
        <?php echo $form->textFieldGroup($model, 'press_subject', array('size' => 60, 'maxlength' => 255, 'wrapperHtmlOptions' => array('class' => 'col-sm-6',),)); ?>

        <?php echo $form->error($model, 'press_subject'); ?>
    </div>

    <div class="row">
        <?php // echo $form->labelEx($model, 'press_content'); ?>

        <?php
        echo $form->ckEditorGroup(
                $model, 'press_content', array(
            'wrapperHtmlOptions' => array(
            /* 'class' => 'col-sm-5', */
            ),
            'widgetOptions' => array(
                'editorOptions' => array(
                    'fullpage' => 'js:true',
                    'width' => '540',
                /* 'resize_maxWidth' => '640', */
                /* 'resize_minWidth' => '320' */
                )
            )
                )
        );
        ?>

        <?php // echo $form->textArea($model, 'press_content', array('rows' => 6, 'cols' => 50));   ?>
        <?php echo $form->error($model, 'press_content'); ?>
    </div>





    <h2><?php echo  Yii::t('app','Sender & ReplyTo');?></h2>


    <?php // echo $form->labelEx($model, 'sender_name');  ?>
    <?php // echo $form->textFieldGroup($model, 'press_sender_name', array('size' => 60, 'maxlength' => 255, 'wrapperHtmlOptions' => array('class' => 'col-sm-6 '),)); ?>
    <?php // echo $form->error($model, 'press_sender_name'); ?>


    <!--<div id="monaccordeon">
        <div class="accordion-group">
            <div class="btn btn-info accordion-heading" data-toggle="collapse" data-parent="#monaccordeon" data-target="#item1">
            <span  class="glyphicon glyphicon-chevron-down"></span>  Edit  </div>
            <div id="item1" class="collapse accordion-group in ">
                <div class="accordion-inner">-->

    <div class="panel panel-footer">
    <div class="panel-heading">
        <!--<h4 class="panel-title">-->
        <div id="Heading-Advert" data-toggle="collapse" class="btn btn-info accordion-heading"data-parent="#accordion" href="#Advert">

            <div class="pull-left"><div id="Glyp-Advert" class="glyphicon glyphicon-chevron-down"></div></div>&nbsp; <?php echo  Yii::t('app','Edit Sender Name & ReplyTo');?> 
        </div>
        <!--</h4>-->
    </div>
    <div id="Advert" class="panel-collapse collapse">
        <div class="panel-body">
            <div class="row">   
               
                    <?php // echo $form->labelEx($model, 'sender_name');  ?>
                    <?php echo $form->textFieldGroup($model, 'press_sender_name', array('size' => 60, 'maxlength' => 255, 'wrapperHtmlOptions' => array('class' => 'col-sm-6 '),)); ?>
                    <?php echo $form->error($model, 'press_sender_name'); ?>

                    <?php // echo $form->labelEx($model, 'sender_email');  ?>
                    <?php echo $form->textFieldGroup($model, 'press_sender_email', array('size' => 60, 'maxlength' => 255, 'wrapperHtmlOptions' => array('class' => 'col-sm-6',),)); ?>
                    <?php echo $form->error($model, 'press_sender_email'); ?>

                    <?php // echo $form->labelEx($model, 'replyto_name');  ?>
                    <?php
                    echo $form->textFieldGroup($model, 'press_replyto_name', array('size' => 60, 'maxlength' => 255, 'wrapperHtmlOptions' => array('class' => 'col-sm-6',),
                    ));
                    ?>
                    <?php echo $form->error($model, 'press_replyto_name'); ?>
                    <?php // echo $form->labelEx($model, 'replyto_email'); ?>
                    <?php
                    echo $form->textFieldGroup($model, 'press_replyto_email', array('size' => 60, 'maxlength' => 255,
                        'wrapperHtmlOptions' => array('class' => 'col-sm-6',),
                    ));
                    ?>
                    <?php echo $form->error($model, 'press_replyto_email'); ?>
                    <?php //echo $form->error($model, 'porfile_name_last');  ?>
                </div>
                <br />
            
        </div>
        </div>
    </div>
<!--</fieldset>
</div>
</div>     
</div>
</div>
<br> -->


<h2><?php echo  Yii::t('app','Publication Type & Date');?></h2>

<!--<div class="row">
<?php echo $form->labelEx($model, 'press_date'); ?>
<?php echo $form->textFieldGroup($model, 'press_date'); ?>
<?php echo $form->error($model, 'press_date'); ?>
        </div>

-->
<!--
    <div class="row">
<?php // echo $form->labelEx($model, 'press_date_completed'); ?>
<?php
echo $form->datePickerGroup(
        $model, 'press_date_completed', array(
    'widgetOptions' => array(
        'options' => array(
            'language' => 'fr',
            'format' => 'yyyy-mm-dd',
        ),
    ),
    'wrapperHtmlOptions' => array(
        'class' => 'col-sm-5',
    ),
    'hint' => '',
    'prepend' => '<i class="glyphicon glyphicon-calendar"></i>'
        )
);
?> 
        
<?php //echo $form->textFieldGroup($model, 'press_date_completed'); ?>
<?php echo $form->error($model, 'press_date_completed'); ?>
    </div>
-->

<!--    <div class="row">
<?php // echo $form->labelEx($model, 'press_contacts_mailed'); ?>
<?php echo $form->textFieldGroup($model, 'press_contacts_mailed'); ?>
<?php echo $form->error($model, 'press_contacts_mailed'); ?>
    </div>-->
<!--
    <div class="row">
<?php // echo $form->labelEx($model, 'press_contacts_failed'); ?>
<?php echo $form->textFieldGroup($model, 'press_contacts_failed'); ?>
<?php echo $form->error($model, 'press_contacts_failed'); ?>
    </div>
-->



<!--das muss gemacht werden  seif bitte nicht vergessen !!!!!!!!!!!!-->

<div class="row">
    <?php //echo $form->labelEx($model, 'press_file_1'); ?>
    <?php echo $form->fileFieldGroup($model, 'press_file_1', array('wrapperHtmlOptions' => array('class' => 'col-sm-4'))); ?>
    <?php // echo $form->error($model, 'press_file_1'); ?>     
</div>

<div class="row">
    <?php //echo $form->labelEx($model, 'press_file_2'); ?>
    <?php echo $form->fileFieldGroup($model, 'press_file_2', array('wrapperHtmlOptions' => array('class' => 'col-sm-4'))); ?>
    <?php // echo $form->error($model, 'press_file_2'); ?>
</div>

<div class="row">
    <?php //echo $form->labelEx($model, 'press_file_3'); ?>
    <?php echo $form->fileFieldGroup($model, 'press_file_3', array('wrapperHtmlOptions' => array('class' => 'col-sm-4'))); ?>
    <?php // echo $form->error($model, 'press_file_3'); ?>
</div>

<!--    <div class="row">
<?php // echo $form->labelEx($model, 'press_pub_abc'); ?>
<?php echo $form->textFieldGroup($model, 'press_pub_abc'); ?>
<?php echo $form->error($model, 'press_pub_abc'); ?>
    </div>-->

<!--	<div class="row">
<?php echo $form->labelEx($model, 'press_pub_linkedin'); ?>
<?php echo $form->textFieldGroup($model, 'press_pub_linkedin'); ?>
<?php echo $form->error($model, 'press_pub_linkedin'); ?>
        </div>

        <div class="row">
<?php echo $form->labelEx($model, 'press_pub_facebook'); ?>
<?php echo $form->textFieldGroup($model, 'press_pub_facebook'); ?>
<?php echo $form->error($model, 'press_pub_facebook'); ?>
        </div>

        <div class="row">
<?php echo $form->labelEx($model, 'press_pub_twitter'); ?>
<?php echo $form->textFieldGroup($model, 'press_pub_twitter'); ?>
<?php echo $form->error($model, 'press_pub_twitter'); ?>
        </div>-->



<?php
//    echo $form->radioButtonList($model, 'press_status', array('Q' => ' Send directly to Mail Queue (Publish Now)',
//        'D' => 'Dont Send (Save as draft for later)',
//        ));
?>

<div class="row">

    <?php
    echo $form->radioButtonListGroup(
            $model, 'press_status', array(
        'wrapperHtmlOptions' => array(
            'class' => 'col-sm-6',
        ),
        'widgetOptions' => array(
            'data' => array(
                'N' => Yii::t('app','Send directly to Mail Queue (Publish Now)'),
                'D' => Yii::t('app','Dont Send (Save as draft for later)'),
                'Q' => Yii::t('app','Choose Date'),
            ),
            'htmlOptions' => array('onClick' => "return choosedate();",
            ),
        //'events' => array(
    )));
    ?>

</div>

<div class="row ">
    <div class="col-xs-5">
<?php // echo $form->labelEx($model, 'choose Date');   ?>
        <?php //echo $form->textFieldGroup($model, 'press_date_started');   ?>

        <?php //echo $form->radioButtonGroup($model, 'press_date_started');  ?>
        <?php
        echo $form->datePickerGroup(
                $model, 'press_date_started', array(
            'widgetOptions' => array(
                // 'htmlOptions' => array('disabled' => true),



                'options' => array(
                    'language' => 'fr',
                    'format' => 'yyyy-mm-dd'
                ),
            ),
            'wrapperHtmlOptions' => array(
                'class' => 'col-sm-4',
            ),
            'prepend' => '<i class="glyphicon glyphicon-calendar"></i>'
                )
        );
        ?>

        <?php echo $form->error($model, 'press_date_started'); ?>
    </div>
    <div class="col-xs-5">
<?php
$this->widget(
        'booster.widgets.TbTimePicker', array(
//                         
    // 'htmlOptions' => array('disabled' => true),

    'model' => $model,
    'attribute' => 'hours',
    'options' => array(
        'showMeridian' => false
    ),
    'wrapperHtmlOptions' => array('class' => 'col-md-3'),
        )
);
?>  
    </div>   </div>

<!--    <div class="row buttons">
<?php // echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save');   ?>
    </div>-->
<!--<div class="row pull-right">-->
    <!--<button type="button" type="submit" class="btn btn-success btn-lg "> <i class="fa fa-floppy-o"></i>  Save</button>-->

<div class="row">
    <div class="buttons push-22" >
<?php
$this->widget('booster.widgets.TbButton', array('buttonType' => 'submit',
    'size' => 'large',
    'context' => 'danger',
    'label'=> Yii::t('app','Test it'),
));
?>


    </div>
    <div class="buttons pull-right" >
<?php
$this->widget('booster.widgets.TbButton', array('buttonType' => 'submit',
    'size' => 'large',
    'context' => 'success',
    'label'=> Yii::t('app','Create'),
));
?>


    </div>






</div>

<br>  <br>
</div><!-- form --<?php
        $this->endWidget();

        unset($form);
?>

