<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<?php
//$form = $this->beginWidget('booster.widgets.TbActiveForm', array(
//    'id' => 'contact-form',
//    'htmlOptions' => array('class' => 'well', 'class' => 'col-sm-5'),
//    'type' => 'horizontal',
//    'enableClientValidation' => true,
//    'clientOptions' => array(
//        'validateOnSubmit' => true,
//    ),
// Please note: When you enable ajax validation, make sure the corresponding
// controller action is handling ajax validation correctly.
// There is a call to performAjaxValidation() commented in generated controller code.
// See class documentation of CActiveForm for details on this.
// ));
?>
<div class="panel panel-footer span-12">
    <div class="panel-heading">
        <!--<h4 class="panel-title">-->
        <div id="Heading-Advert" data-toggle="collapse" class="btn btn-primary accordion-heading"data-parent="#accordion" href="#Advert1">

            <div class="pull-left"><div id="Glyp-Advert1" class="glyphicon glyphicon-chevron-up"></div></div>&nbsp;  <?php echo Yii::t('app', 'Personal Information'); ?> &nbsp; 
            <i class="fa fa-info-circle fa-lg"></i>
        </div>
        <!--</h4>-->
    </div>
    <div id="Advert1" class="panel-collapse collapse in">
        <div class="panel-body">

            <div class="row">
                <?php //echo $form->labelEx($model, 'porfile_name_first'); ?>
                <?php
                echo $form->textFieldGroup($model, 'porfile_name_first', array('size' => 60, 'maxlength' => 255,
                    'wrapperHtmlOptions' => array('class' => 'col-sm-9',),
                ));
                ?>
                <?php // echo $form->error($model, 'porfile_name_first');  ?>
            </div>

            <div class="row">
                <?php //echo $form->labelEx($model, 'porfile_name_last'); ?>
                <?php
                echo $form->textFieldGroup($model, 'porfile_name_last', array('size' => 60, 'maxlength' => 255,
                    'wrapperHtmlOptions' => array('class' => 'col-sm-9',),
                ));
                ?>


            </div>
            <br />

        </div>
    </div>
</div>


<div class="panel panel-footer span-20">
    <div class="panel-heading">
        <!--<h4 class="panel-title">-->
        <div id="Heading-Advert" data-toggle="collapse" class="btn btn-primary accordion-heading"data-parent="#accordion" href="#Advert3">

            <div class="pull-left"><div id="Glyp-Advert3" class="glyphicon glyphicon-chevron-up"></div></div>&nbsp;   <?php echo Yii::t('app', 'Company Information'); ?> &nbsp;
            <i class="fa fa-suitcase fa-lg"></i>
        </div>
        <!--</h4>-->
    </div>
    <div id="Advert3" class="panel-collapse collapse in">
        <div class="panel-body">





            <div class="row">
                <?php //echo $form->labelEx($model, 'porfile_phone');   ?>
                <?php
                echo $form->textFieldGroup($model, 'porfile_phone', array('size' => 60, 'maxlength' => 255,
                    'wrapperHtmlOptions' => array('class' => 'col-sm-5',),
                ));
                ?>
                <?php echo $form->error($model, 'porfile_phone'); ?>
            </div>

            <div class="row">
                <?php // echo $form->labelEx($model, 'porfile_mobile');   ?>
                <?php
                echo $form->textFieldGroup($model, 'porfile_mobile', array('size' => 60, 'maxlength' => 255,
                    'wrapperHtmlOptions' => array('class' => 'col-sm-5',),
                ));
                ?>
                <?php echo $form->error($model, 'porfile_mobile'); ?>
            </div>

            <div class="row">
                <?php //echo $form->labelEx($model, 'porfile_camp_name');   ?>
                <?php
                echo $form->textFieldGroup($model, 'porfile_camp_name', array('size' => 60, 'maxlength' => 255,
                    'wrapperHtmlOptions' => array('class' => 'col-sm-5',),
                ));
                ?>
                <?php echo $form->error($model, 'porfile_camp_name'); ?>
            </div>

            <div class="row">   
                <?php
                echo $form->textFieldGroup($model, 'porfile_camp_function', array('size' => 60, 'maxlength' => 255,
                    'wrapperHtmlOptions' => array('class' => 'col-sm-5',),
                ));
                ?>
                <?php echo $form->error($model, 'porfile_camp_function'); ?>
            </div>




            <div class="row">
                <div class="col-sm-3 control-label" >
                    <?php echo $form->labelEx($model, 'porfile_camp_country'); ?></div>

                &nbsp;
                <?php
                $this->widget('booster.widgets.TbSelect2', array(
                    'asDropDownList' => true,
                    'model' => $model,
                    'attribute' => 'porfile_camp_country',
                    'options' => array(
                        'placeholder' => $model->getAttributeLabel('porfile_camp_country'),
                        'width' => '39.6%',
                        'class' => 'col-sm-5',
                        'allowClear' => true,
                    ),
                    'data' => CHtml::listData(IsoCountry::model()->findAll(), 'country_iso', 'country_name'
                    ),
                ));
                ?><br><br>
                <?php // echo $form->dropDownList($model, 'contact_iso_country', CHtml::listData(isocountry::model()->findAll(), 'country_iso', 'country_name')); ?>
                <?php // echo $form->textField($model,'departmentId'); ?>
                <?php // echo $form->textField($model,'contact_iso_country'); ?>
                <?php echo $form->error($model, 'porfile_camp_country'); ?>
            </div>

            <div class="row">
                <?php //echo $form->labelEx($model, 'porfile_camp_account'); ?>
                <?php
                echo $form->textFieldGroup($model, 'porfile_camp_account', array('size' => 60, 'maxlength' => 255,
                    'wrapperHtmlOptions' => array('class' => 'col-sm-5',),
                ));
                ?>
                <?php echo $form->error($model, 'porfile_camp_account'); ?>
            </div>

            <div class="row">
                <?php //echo $form->labelEx($model, 'porfile_camp_email'); ?>
                <?php
                echo $form->textFieldGroup($model, 'porfile_camp_email', array('size' => 60, 'maxlength' => 255,
                    'wrapperHtmlOptions' => array('class' => 'col-sm-5',),
                ));
                ?>
                <?php echo $form->error($model, 'porfile_camp_email'); ?>
            </div>

            <div class="row">
                <?php //echo $form->labelEx($model, 'porfile_camp_website'); ?>
                <?php
                echo $form->textFieldGroup($model, 'porfile_camp_website', array('size' => 60, 'maxlength' => 255,
                    'wrapperHtmlOptions' => array('class' => 'col-sm-5',),
                ));
                ?>
                <?php echo $form->error($model, 'porfile_camp_website'); ?>
            </div>

            <div class="row">
                <?php //echo $form->labelEx($model, 'porfile_coc');  ?>
                <?php
                echo $form->textFieldGroup($model, 'porfile_coc', array('size' => 60, 'maxlength' => 255,
                    'wrapperHtmlOptions' => array('class' => 'col-sm-5',),
                ));
                ?>
                <?php echo $form->error($model, 'porfile_coc'); ?>
            </div>



            <div class="row"> 
                <?php echo $form->labelEx($model, 'profile_remarks'); ?>
                <?php
                $form->widget(
                        'booster.widgets.TbCKEditor', array(
                    'name' => 'profile_remarks',
                    'editorOptions' => array(
                        // From basic `build-config.js` minus 'undo', 'clipboard' and 'about'
                        'plugins' => 'basicstyles,toolbar,enterkey,entities,floatingspace,wysiwygarea,indentlist,link,list,dialog,dialogui,button,indent,fakeobjects'
                    )
                        )
                );
                ?> 

                <?php echo $form->error($model, 'profile_remarks'); ?>
            </div>






            <!--<div class="row">-->
            <?php //echo $form->labelEx($model, 'usetting_sender_name');  ?>
            <?php
//                        echo $form->textFieldGroup($model, 'usetting_sender_name', array('size' => 60, 'maxlength' => 255,
//                            'wrapperHtmlOptions' => array('class' => 'col-sm-5',),
//                        ));
            ?>
            <?php // echo $form->error($model, 'usetting_sender_name'); ?>
            <!--</div>-->

            <!--<div class="row">-->
            <?php //echo $form->labelEx($model, 'usetting_sender_email');  ?>
            <?php
            //
//                        echo $form->textFieldGroup($model, 'usetting_sender_email', array('size' => 60, 'maxlength' => 255,
//                            'wrapperHtmlOptions' => array('class' => 'col-sm-5',),
//                        ));
            ?>
<?php // echo $form->error($model, 'usetting_sender_email');  ?>
            <!--</div>-->

            <!--<div class="row">-->
            <?php //echo $form->labelEx($model, 'usetting_replyto_name');  ?>
            <?php
//                        echo $form->textFieldGroup($model, 'usetting_replyto_name', array('size' => 60, 'maxlength' => 255,
//                            'wrapperHtmlOptions' => array('class' => 'col-sm-5',),
//                        ));
            ?>
<?php // echo $form->error($model, 'usetting_replyto_name');  ?>
            <!--</div>-->

            <!--<div class="row">-->
            <?php //echo $form->labelEx($model, 'usetting_replyto_email');  ?>
            <?php
//                        echo $form->textFieldGroup($model, 'usetting_replyto_email', array('size' => 60, 'maxlength' => 255,
//                            'wrapperHtmlOptions' => array('class' => 'col-sm-5',),
//                        ));
            ?>
<?php // echo $form->error($model, 'usetting_replyto_email');  ?>
            <!--</div>-->

            <!--                    <div class="row">
            <?php //echo $form->labelEx($model, 'usetting_bounce_email');  ?>
            <?php
//                        echo $form->textFieldGroup($model, 'usetting_bounce_email', array('size' => 60, 'maxlength' => 255,
//                            'wrapperHtmlOptions' => array('class' => 'col-sm-5',),
//                        ));
            ?>
<?php // echo $form->error($model, 'usetting_bounce_email');  ?>
                                </div>-->




        </div>
        <br />

    </div>

</div>
<div class="panel panel-footer span-20">
    <div class="panel-heading">
        <!--<h4 class="panel-title">-->
        <div id="Heading-Advert" data-toggle="collapse" class="btn btn-primary accordion-heading"data-parent="#accordion" href="#Advert2">

            <div class="pull-left"><div id="Glyp-Advert2" class="glyphicon glyphicon-chevron-down"></div></div>&nbsp;   <?php echo Yii::t('app', 'Address'); ?>&nbsp; 
            <i class="fa fa-map-marker fa-lg"></i> 
        </div>
        <!--</h4>-->
    </div>
    <div id="Advert2" class="panel-collapse collapse">
        <div class="panel-body">

            <!--<div id="monaccordeon">
                <div class="accordion-group">
                    
                    <div class="btn btn-primary accordion-heading" data-toggle="collapse" data-parent="#monaccordeon" data-target="#item2">
                    <span  class="glyphicon glyphicon-chevron-down"></span> Address </div>
                    <div id="item2" class="collapse accordion-group ">
                        <div class="accordion-inner">
                            <fieldset>-->
            <div class="row col-sm-6">
                <?php //echo $form->labelEx($model, 'porfile_address'); ?>
                <?php
                echo $form->textFieldGroup($model, 'porfile_address', array('size' => 60, 'maxlength' => 255,
                    'wrapperHtmlOptions' => array('class' => 'col-sm-10',),
                ));
                ?>
<?php echo $form->error($model, 'porfile_address'); ?>
            </div>

            <div class="col-sm-13 row">
                <?php //echo $form->labelEx($model, 'porfile_address_nr');  ?>
                <?php
                echo $form->textFieldGroup($model, 'porfile_address_nr', array('size' => 60, 'maxlength' => 255,
                    'wrapperHtmlOptions' => array('class' => 'col-sm-2',),
                ));
                ?>
<?php echo $form->error($model, 'porfile_address_nr'); ?>
            </div>

            <div class="row">
                <?php //echo $form->labelEx($model, 'porfile_address_addon'); ?>
                <?php
                echo $form->textFieldGroup($model, 'porfile_address_addon', array('size' => 60, 'maxlength' => 255,
                    'wrapperHtmlOptions' => array('class' => 'col-sm-6',),
                ));
                ?>
                <?php echo $form->error($model, 'porfile_address_addon'); ?>

                <?php //echo $form->labelEx($model, 'porfile_city'); ?>
                <?php
                echo $form->textFieldGroup($model, 'porfile_city', array('size' => 60, 'maxlength' => 255,
                    'wrapperHtmlOptions' => array('class' => 'col-sm-6',),
                ));
                ?>
<?php echo $form->error($model, 'porfile_city'); ?>

                <div class="col-sm-3 control-label" >
<?php echo $form->labelEx($model, 'porfile_country'); ?></div>&nbsp; 


                <?php
                $this->widget('booster.widgets.TbSelect2', array(
                    'asDropDownList' => true,
                    'model' => $model,
                    'attribute' => 'porfile_country',
                    'options' => array(
                        'placeholder' => $model->getAttributeLabel('porfile_country'),
                        'width' => '47.6%',
                        'class' => 'col-sm-5',
                        'allowClear' => true,
                    ),
                    'data' => CHtml::listData(IsoCountry::model()->findAll(), 'country_iso', 'country_name'
                    ),
                ));
                ?><br><br>
                <?php // echo $form->dropDownList($model, 'contact_iso_country', CHtml::listData(isocountry::model()->findAll(), 'country_iso', 'country_name')); ?>
                <?php // echo $form->textField($model,'departmentId'); ?>
                <?php // echo $form->textField($model,'contact_iso_country'); ?>
<?php echo $form->error($model, 'porfile_camp_country'); ?>


            </div>
            <br />

        </div>
    </div>
</div>



<?php //$this->endWidget(); ?>
