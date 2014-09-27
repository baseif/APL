<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>
</div> 


<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/glyphicon.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/main.js"></script>


<div class="last"><br><br>
    <div id="col-xs-12 col-md-8">

        <?php
        $this->widget('booster.widgets.TbTabs', array(
            'type' => 'tabs',
            'placement' => 'right',
            'tabs' => array(
                array('label' =>  Yii::t('app','Edit Login Information'), 'url' => array('/user/profile/edit'), 'icon' => 'edit'),
                array('label' =>  Yii::t('app','Edit Personal Information'), 'url' => array('/client/update/'), 'icon' => 'pencil'),
                array('label' =>  Yii::t('app','Change password'), 'url' => array('/user/profile/changepassword'), 'icon' => 'lock')),
            'htmlOptions' => array('class' => 'operations'),
        ));
        ?>
    </div><!-- sidebar -->
</div>



<?php
//$this->menu = 
//  ((UserModule::isAdmin()) ? array('label' => UserModule::t('Manage Users'), 'url' => array('/user/admin')) : array()),
// array('label' => UserModule::t('List User'), 'url' => array('/user')),
//    
//    array('label'=>UserModule::t('My Dashbord'), 'url' => array('/'.$varuser.'/dashbord/')), 
//    array('label'=>UserModule::t('Edit Login Information'), 'url'=>array('edit')),
//    array('label'=>UserModule::t('Edit Personal Information '), 'url'=>array('/'.$varuser.'/update/'.Yii::app()->user->id)),
//    
//    array('label' => UserModule::t('Change password'), 'url' => array('changepassword')),
// array('label' => UserModule::t('Logout'), 'url' => array('/user/logout')),
//);
?>


<div class="form  span-20">
<?php
$form = $this->beginWidget('booster.widgets.TbActiveForm', array(
    'id' => 'contact-form',
    'htmlOptions' => array('class' => 'col-sm-4', 'class' => 'well'),
    'type' => 'horizontal',
    'enableClientValidation' => true,
    'clientOptions' => array(
        'validateOnSubmit' => false,
    ),
    'enableAjaxValidation' => True,
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        ));
?>

    <!--<p class="note">Fields with <span class="required">*</span> are required.</p>-->

<?php echo $form->errorSummary($model); ?>

    <!--
        <div class="row">
<?php //echo $form->labelEx($model,'user_package_id');  ?>
    <?php //echo $form->textFieldGroup($model, 'user_package_id');   ?>
    <?php //echo $form->error($model, 'user_package_id');  ?>
        </div>
        <div class="row">
<?php //echo $form->labelEx($model,'user_email');  ?>
    <?php
//        echo $form->textFieldGroup($model, 'user_email', array('size' => 60, 'maxlength' => 255,
//            'wrapperHtmlOptions' => array('class' => 'col-sm-5',),
//        ));
//        
    ?>
    <?php //echo $form->error($model, 'user_email'); ?>
        </div>
     <span class="label label-info"    
                                    >Minimum is 6 characters <br>Must contain at least one special character</span>
        <div class="row">
<?php //echo $form->labelEx($model,'user_pass');   ?>
    <?php
//        echo $form->passwordFieldGroup($model, 'user_pass', array('size' => 60, 'maxlength' => 255,
//            'wrapperHtmlOptions' => array('class' => 'col-sm-5',),
//        ));
//        
    ?>
    <?php // echo $form->error($model, 'user_pass'); ?>
        </div>
        <div class="row">   
<?php //echo $form->labelEx($model, 'repeat_password');   ?> 
    <?php
//        echo $form->passwordFieldGroup($model, 'user_pass_repeat', array('size' => 60, 'maxlength' => 255,
//            'wrapperHtmlOptions' => array('class' => 'col-sm-5',),
//        ));
//        
    ?>
    <?php // echo $form->error($model, 'user_pass_repeat'); ?>  </div>
    
        <div class="row">
<?php //echo $form->labelEx($model, 'porfile_initials');   ?>
    <?php
//        echo $form->textFieldGroup($model, 'porfile_initials', array('size' => 60, 'maxlength' => 255,
//            'wrapperHtmlOptions' => array('class' => 'col-sm-5',),
//        ));
    ?>
    <?php // echo $form->error($model, 'porfile_initials'); ?>
        </div>-->

    <!--    <div id="monaccordeon">
            <div class="accordion-group">
                
                <div class="btn btn-primary accordion-heading" data-toggle="collapse" data-parent="#monaccordeon" data-target="#item1"> 
            <span  class="glyphicon glyphicon-chevron-down"></span> Personal Information</div>
                <div id="item1" class="collapse accordion-group in ">
                    <div class="accordion-inner">
                            <fieldset>-->
    <div class="panel panel-footer">
        <div class="panel-heading">
            <!--<h4 class="panel-title">-->
            <div id="Heading-Advert" data-toggle="collapse" class="btn btn-primary accordion-heading"data-parent="#accordion" href="#Advert">

                <div class="pull-left"><div id="Glyp-Advert" class="glyphicon glyphicon-chevron-down"></div></div>&nbsp;  <?php echo  Yii::t('app','Personal Information') ?>&nbsp;
                <i class="fa fa-info-circle fa-lg"></i>
                
            </div>
            <!--</h4>-->
        </div>
        <div id="Advert" class="panel-collapse collapse">
            <div class="panel-body">
                <div class="row">
<?php //echo $form->labelEx($model, 'porfile_name_first');   ?>
                    <?php
                    echo $form->textFieldGroup($model, 'porfile_name_first', array('size' => 60, 'maxlength' => 255,
                        'wrapperHtmlOptions' => array('class' => 'col-sm-5',),
                    ));
                    ?>
                    <?php // echo $form->error($model, 'porfile_name_first'); ?>

                    <?php //echo $form->labelEx($model, 'porfile_name_last');  ?>
                    <?php
                    echo $form->textFieldGroup($model, 'porfile_name_last', array('size' => 60, 'maxlength' => 255,
                        'wrapperHtmlOptions' => array('class' => 'col-sm-5',),
                    ));
                    ?>
                    <?php //echo $form->error($model, 'porfile_name_last'); ?>
                    <!--                    </div>
                                                    </fieldset>
                                    </div>
                                </div>     
                            </div>
                        </div>
                        <br>-->
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
                
                <br />

            </div>
        </div>
    </div>


    
    
     <div class="panel panel-footer">
    <div class="panel-heading">
        <!--<h4 class="panel-title">-->
        <div id="Heading-Advert" data-toggle="collapse" class="btn btn-primary accordion-heading"data-parent="#accordion" href="#Advert1">

            <div class="pull-left"><div id="Glyp-Advert1" class="glyphicon glyphicon-chevron-down"></div></div>&nbsp; <?php echo  Yii::t('app','Address') ?> &nbsp; 
             <i class="fa fa-map-marker fa-lg"></i> 
        </div>
        <!--</h4>-->
    </div>
    <div id="Advert1" class="panel-collapse collapse">
        <div class="panel-body">
    
<!--    <div id="monaccordeon">
        <div class="accordion-group">

            <div class="btn btn-primary accordion-heading" data-toggle="collapse" data-parent="#monaccordeon" data-target="#item2"> 
                <span  class="glyphicon glyphicon-chevron-down"></span> Address </div>
            <div id="item2" class="collapse accordion-group ">
                <div class="accordion-inner">
                    <fieldset>-->
                        <div class="row">
<?php //echo $form->labelEx($model, 'porfile_address');   ?>
                            <?php
                            echo $form->textFieldGroup($model, 'porfile_address', array('size' => 60, 'maxlength' => 255,
                                'wrapperHtmlOptions' => array('class' => 'col-sm-5',),
                            ));
                            ?>
                            <?php echo $form->error($model, 'porfile_address'); ?>
                        </div>

                        <div class="row">
<?php //echo $form->labelEx($model, 'porfile_address_nr');    ?>
                            <?php
                            echo $form->textFieldGroup($model, 'porfile_address_nr', array('size' => 60, 'maxlength' => 255,
                                'wrapperHtmlOptions' => array('class' => 'col-sm-5',),
                            ));
                            ?>
                            <?php echo $form->error($model, 'porfile_address_nr'); ?>
                        </div>

                        <div class="row">
<?php //echo $form->labelEx($model, 'porfile_address_addon');  ?>
                            <?php
                            echo $form->textFieldGroup($model, 'porfile_address_addon', array('size' => 60, 'maxlength' => 255,
                                'wrapperHtmlOptions' => array('class' => 'col-sm-5',),
                            ));
                            ?>
                            <?php echo $form->error($model, 'porfile_address_addon'); ?>
                        </div>

                        <div class="row">
<?php //echo $form->labelEx($model, 'porfile_city');  ?>
                            <?php
                            echo $form->textFieldGroup($model, 'porfile_city', array('size' => 60, 'maxlength' => 255,
                                'wrapperHtmlOptions' => array('class' => 'col-sm-5',),
                            ));
                            ?>
                            <?php echo $form->error($model, 'porfile_city'); ?>
                        </div>


                        <div class="row">
                            <div class="col-sm-3 control-label" >
<?php //echo $form->labelEx($model, 'porfile_country'); ?></div>

&nbsp;
<?php
//$this->widget('booster.widgets.TbSelect2', array(
//    'asDropDownList' => true,
//    'model' => $model,
//    'attribute' => 'porfile_country',
//    'options' => array(
//        'placeholder' => $model->getAttributeLabel('porfile_country'),
//        'width' => '39.6%',
//        'class' => 'col-sm-5',
//        'allowClear' => true,
//    ),
//    'data' => CHtml::listData(IsoCountry::model()->findAll(), 'country_iso', 'country_name'
//    ),
//));


echo $form->dropDownListGroup(
			$model,
			'porfile_country',
			array(
				'wrapperHtmlOptions' => array(
					'class' => 'col-sm-6',
				),
				'widgetOptions' => array(
					'data' => CHtml::listData(IsoCountry::model()->findAll(), 'country_iso', 'country_name'),
					'htmlOptions' => array(),
				)
			)
		);

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

<!--
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>     
    </div>
    <br>-->


<!--    <div id="monaccordeon">
        <div class="accordion-group">
            <div class="btn btn-primary accordion-heading" data-toggle="collapse" data-parent="#monaccordeon" data-target="#item3"> 
                <span  class="glyphicon glyphicon-chevron-down"></span> Others </div>
            <div id="item3" class="collapse accordion-group">
                <div class="accordion-inner">

                    <fieldset>-->

    <div class="panel panel-footer">
    <div class="panel-heading">
        <!--<h4 class="panel-title">-->
        <div id="Heading-Advert" data-toggle="collapse" class="btn btn-primary accordion-heading"data-parent="#accordion" href="#Advert2">

            <div class="pull-left"><div id="Glyp-Advert2" class="glyphicon glyphicon-chevron-down"></div></div>&nbsp;  <?php echo  Yii::t('app','Others') ?>  &nbsp;   
             <i class="fa fa-tasks fa-lg"></i>
        </div>
        <!--</h4>-->
    </div>
    <div id="Advert2" class="panel-collapse collapse">
        <div class="panel-body">




                        <div class="row">
<?php //echo $form->labelEx($model, 'porfile_phone');    ?>
                            <?php
                            echo $form->textFieldGroup($model, 'porfile_phone', array('size' => 60, 'maxlength' => 255,
                                'wrapperHtmlOptions' => array('class' => 'col-sm-5',),
                            ));
                            ?>
                            <?php echo $form->error($model, 'porfile_phone'); ?>
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

<?php //echo $form->labelEx($model, 'porfile_camp_country'); ?>


<?php
//$this->widget('booster.widgets.TbSelect2', array(
//    'asDropDownList' => true,
//    'model' => $model,
//    'attribute' => 'porfile_camp_country',
//    'options' => array(
//        'placeholder' => $model->getAttributeLabel('porfile_camp_country'),
//        'width' => '39.6%',
//        'class' => 'col-sm-5',
//        'allowClear' => true,
//    ),
//    'data' => CHtml::listData(IsoCountry::model()->findAll(), 'country_iso', 'country_name'
//    ),
//));
$url = Yii::app()->request->baseUrl.'/index.php/Client/Companyaccount'  ;
echo $form->dropDownListGroup(
			$model,
			'porfile_camp_country',
			array(
				'wrapperHtmlOptions' => array(
					'class' => 'col-sm-6',
				),
				'widgetOptions' => array(
					'data' => CHtml::listData(IsoCountry::model()->findAll(), 'country_iso', 'country_name'),
					'htmlOptions' => array("onChange"=>"return sendData('id_country='+this.value,'$url','countryaccount');"),
				)
			)
		);

?>
                            <?php // echo $form->dropDownList($model, 'contact_iso_country', CHtml::listData(isocountry::model()->findAll(), 'country_iso', 'country_name')); ?>
                            <?php // echo $form->textField($model,'departmentId'); ?>
                            <?php // echo $form->textField($model,'contact_iso_country'); ?>
                            <?php echo $form->error($model, 'porfile_camp_country'); ?>
                        </div>

                        <div class="row" id="countryaccount">
<?php //echo $form->labelEx($model, 'porfile_camp_account');  ?>
                            <?php
                            echo $form->textFieldGroup($model, 'porfile_camp_account', array('size' => 60, 'maxlength' => 255,
                                'wrapperHtmlOptions' => array('class' => 'col-sm-5',),
                            ));
                            ?>
                            <?php echo $form->error($model, 'porfile_camp_account'); ?>
                        </div>

                        <div class="row">
<?php //echo $form->labelEx($model, 'porfile_camp_email');   ?>
                            <?php
                            echo $form->textFieldGroup($model, 'porfile_camp_email', array('size' => 60, 'maxlength' => 255,
                                'wrapperHtmlOptions' => array('class' => 'col-sm-5',),
                            ));
                            ?>
                            <?php echo $form->error($model, 'porfile_camp_email'); ?>
                        </div>

                        <div class="row">
<?php //echo $form->labelEx($model, 'porfile_camp_website');   ?>
                            <?php
                            echo $form->textFieldGroup($model, 'porfile_camp_website', array('size' => 60, 'maxlength' => 255,
                                'wrapperHtmlOptions' => array('class' => 'col-sm-5',),
                            ));
                            ?>
                            <?php echo $form->error($model, 'porfile_camp_website'); ?>
                        </div>

                        <div class="row">
<?php //echo $form->labelEx($model, 'porfile_coc');    ?>
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



<?php
//echo $form-> textAreaGroup($model, 'profile_remarks', array(
//                                                    'wrapperHtmlOptions' => array(
//                                                            'class' => 'col-sm-5',
//                                                    ),
//                                                    'widgetOptions' => array(
//                                                            'htmlOptions' => array('rows' => 5),
//                                                    )
//                                            )); 
?>
                            <?php echo $form->error($model, 'profile_remarks'); ?>
                        </div>






                        <!--<div class="row">-->
<?php //echo $form->labelEx($model, 'usetting_sender_name');  ?>
                            <?php
//                            echo $form->textFieldGroup($model, 'usetting_sender_name', array('size' => 60, 'maxlength' => 255,
//                                'wrapperHtmlOptions' => array('class' => 'col-sm-5',),
//                            ));
//                            ?>
                            <?php // echo $form->error($model, 'usetting_sender_name'); ?>
                        <!--</div>-->

                        <!--<div class="row">-->
<?php //echo $form->labelEx($model, 'usetting_sender_email');   ?>
                            <?php
//                            echo $form->textFieldGroup($model, 'usetting_sender_email', array('size' => 60, 'maxlength' => 255,
//                                'wrapperHtmlOptions' => array('class' => 'col-sm-5',),
//                            ));
//                            ?>
                            <?php // echo $form->error($model, 'usetting_sender_email'); ?>
                        <!--</div>-->

                        <!--<div class="row">-->
<?php //echo $form->labelEx($model, 'usetting_replyto_name');   ?>
                            <?php
//                            echo $form->textFieldGroup($model, 'usetting_replyto_name', array('size' => 60, 'maxlength' => 255,
//                                'wrapperHtmlOptions' => array('class' => 'col-sm-5',),
//                            ));
                            ?>
                            <?php // echo $form->error($model, 'usetting_replyto_name'); ?>
                        <!--</div>-->

                        <!--<div class="row">-->
<?php //echo $form->labelEx($model, 'usetting_replyto_email');   ?>
                            <?php
//                            echo $form->textFieldGroup($model, 'usetting_replyto_email', array('size' => 60, 'maxlength' => 255,
//                                'wrapperHtmlOptions' => array('class' => 'col-sm-5',),
//                            ));
                            ?>
                            <?php // echo $form->error($model, 'usetting_replyto_email'); ?>
<!--                        </div>-->

                        <!--<div class="row">-->
<?php //echo $form->labelEx($model, 'usetting_bounce_email');   ?>
                            <?php
//                            echo $form->textFieldGroup($model, 'usetting_bounce_email', array('size' => 60, 'maxlength' => 255,
//                                'wrapperHtmlOptions' => array('class' => 'col-sm-5',),
//                            ));
                            ?>
                            <?php // echo $form->error($model, 'usetting_bounce_email'); ?>

                            <!--</div>-->
                <br />
            
        </div>
        </div>
    </div>
                            <!--                        </div>
                    </fieldset>


                </div>
            </div>

        </div>
    </div>-->
    <br>
    <div class="row">
        <div class="buttons pull-right" >
<?php
$this->widget('booster.widgets.TbButton', array('buttonType' => 'submit', 'size' => 'large', 'context' => 'success',  'label'=> Yii::t('app','Update'))
);
?>

        </div> </div> </div>

<?php $this->endWidget(); ?>
<!-- form -->