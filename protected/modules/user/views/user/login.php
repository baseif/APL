<script type="text/javascript" >
$(document).ready(function() {
$( ".facebook" ).empty();
$( ".twitter" ).empty();
});
</script>
<style type="text/css">
    .facebook{ width:50px;}
    .twitter{ width:50px; position: absolute; top:-63px; left: 32%;}
</style>
<?php
$this->pageTitle = Yii::app()->name . ' - ' . UserModule::t("Login");
$this->breadcrumbs = array(
    UserModule::t("Login"),
);
?>
<!--
<h1><?php // echo UserModule::t("Login");   ?></h1>-->
<h1><?php echo  Yii::t('app','My Space');?></h1>





<div class="row">
    <?php if (Yii::app()->user->hasFlash('loginMessage')): ?>

        <div class="success">
            <?php echo Yii::app()->user->getFlash('loginMessage'); ?>
        </div>

    <?php endif; ?>

    <p><?php echo UserModule::t("Please fill out the following form with your login credentials:"); ?></p>


 <!--<div class="form col-sm-10 well">-->

    <div class="form col-md-4 ">
        <div class="rows">
            <?php
            $form = $this->beginWidget(
                    'booster.widgets.TbActiveForm', array(
                //   'id' => 'verticalForm',
                'type' => 'horizontal',
                'htmlOptions' => array('class' => 'well'), // for inset effect
                'id' => 'login1-form',
                'enableClientValidation' => true,
                'clientOptions' => array(
                    'validateOnSubmit' => true,
                ),
            ));
            ?>


            <p class="note"><?php echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></p>

            <?php echo CHtml::errorSummary($model); ?>

            <div class="row">
                 <?php
                echo $form->textFieldGroup($model, 'username', array('size' => 60, 'maxlength' => 255,
                    'wrapperHtmlOptions' => array('class' => 'col-sm-9',),
                ));
                ?>
                <?php // echo CHtml::activeLabelEx($model, 'username'); ?>
                <?php //  $form->textFieldGroup$model, 'username') ?>
                <?php // echo CHtml::activeTextField($model, 'username') ?>
            </div>

            <div class="row">
                 <?php
                echo $form->PasswordFieldGroup($model, 'password', array('size' => 60, 'maxlength' => 255,
                    'wrapperHtmlOptions' => array('class' => 'col-sm-9',),
                ));
                ?>
                <?php // echo CHtml::activeLabelEx($model, 'password'); ?>
                <?php // echo CHtml::activePasswordField($model, 'password') ?>
            </div>

            <div class="row">
                <p >
                    <?php  echo CHtml::link(UserModule::t("Register"), Yii::app()->getModule('user')->registrationUrl); ?> | <?php  echo CHtml::link(UserModule::t("Lost Password?"), Yii::app()->getModule('user')->recoveryUrl); ?>
                </p>
            </div>

            <div class= col-sm-10">
                 <?php
                echo $form->checkboxGroup($model, 'rememberMe', array('size' => 60, 'maxlength' => 255,
                    'wrapperHtmlOptions' => array('class' => 'col-sm-9'),
                ));
                ?>
               
                <?php // echo CHtml::activeCheckBox($model, 'rememberMe'); ?>
                <?php // echo CHtml::activeLabelEx($model, 'rememberMe'); ?>
            </div>

            <div class="row">
             <div class="buttons pull-right" >
<?php
$this->widget('booster.widgets.TbButton', array('buttonType' => 'submit',
    'size' => 'large',
    'context' => 'success',
    'label'=> UserModule::t("Login"),
));
?>
             </div>  </div>
<!--            <div class="row submit">
                <?php // echo CHtml::submitButton(UserModule::t("Login")); ?>
            </div>-->
</div>
            <?php echo CHtml::endForm(); ?>
        </div><!-- form -->


        <?php 
//        $form = new CForm(array(
//            'elements' => array(
//                'username' => array(
//                    'type' => 'text',
//                    'maxlength' => 32,
//                ),
//                'password' => array(
//                    'type' => 'password',
//                    'maxlength' => 32,
//                ),
//                'rememberMe' => array(
//                    'type' => 'checkbox',
//                )
//            ),
//            'buttons' => array(
//                'login' => array(
//                    'type' => 'submit',
//                    'label' => 'Login',
//                ),
//            ),
//                ), $model);
        ?><?php $this->endWidget(); ?>
        </div>
    <div class="span-5" >
        <div class="span-8 journalist">
            <div class="push-13">
  
             <div style="margin-top: -250px;">
                    <?php $this->widget('ext.hoauth.widgets.HOAuth'); ?>    
                </div>
            </div> </div>

    </div>
