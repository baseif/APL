<?php
$this->pageTitle = Yii::app()->name . ' - ' . UserModule::t("Registration");
$this->breadcrumbs = array(
    UserModule::t("Registration"),
);
?>



<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/glyphicon.js"></script>

<h1><?php echo UserModule::t("Registration"); ?></h1>
<?php if (Yii::app()->user->hasFlash('registration')): ?>
    <div class="success">
        <?php echo Yii::app()->user->getFlash('registration'); ?>
    </div>
<?php else: ?>
    <span class="col-sm-10">
        <?php
        $this->widget(
                'booster.widgets.TbPanel', array(
            'title' => 'Add Yourself As A Client',
            'context' => 'primary',
            'headerIcon' => 'user',
            'content' => 'You, being a Client............., ',
            'htmlOptions' => array('class' => 'col-sm-15'),
                )
        )
        ?>  </span>
    
    
    <div class="form col-sm-10 well">
  <?php
    $form = $this->beginWidget('booster.widgets.TbActiveForm', array(
        'id' => 'contact-form',
        'htmlOptions' => array('class' => 'well'),
        'type' => 'horizontal',
        'enableClientValidation' => true,
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

       

        <p class="note"><?php echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></p>

        <?php echo $form->errorSummary(array($model, $client)); ?>
                        
        
        <div class="panel panel-footer span-9 pull-right">
        <div class="panel-heading">
                <!--<h4 class="panel-title">-->
                <div id="Heading-Payment" data-toggle="collapse" class="btn btn-primary accordion-heading"data-parent="#accordion" href="#Payment">

                    <div class="pull-left"></div><?php echo  Yii::t('app','Choose your subscription');?> &nbsp;  <i class="fa fa-money fa-lg"></i> 
                </div>
                <!--</h4>-->
            </div>
            <div id="Payment" class="panel-collapse collapse in">
                <div class="panel-body">


                    <div class="row">
                        <b><?php echo  Yii::t('app','Annual subscription');?> </b>
                        <p><?php echo  Yii::t('app','We have priced the press release sent to any journalist by way of credits. We do this in order to avoid “send all” actions and promote the use of differentiated campaign lists. The annual subscription entitles you to 9.000 credits. Additional credits can be bought by subscribers at the lowest price, i.e. € 0,25 or USD 0,35.');?> </p>

<b><?php echo  Yii::t('app','Starters Offer');?></b>
<p>
<?php echo  Yii::t('app','We also have an offer for starters without having to take the full subscription. You can start using the Africa Press List for only €350, not limited in time. You get 1,000 credits with this option. One credit stands for one press release sent to one journalist. Accordingly, with these credits you can send one press release to 1,000 journalists, or 2 press releases to 500 journalists or 10 press releases to 100 journalists, etc.');?>
 <br /><?php //echo CHtml::image(Yii::app()->request->baseUrl . '/images/tableau.jpg', ''); ?>
</p>
<p>
    <a href="<?php echo Yii::app()->request->baseUrl.'/uploads/termsofuseapl.pdf' ?>" target="_blank"><?php echo  Yii::t('app','Download the terms of use');?></a>   
    
</p>

<p>
<div class="span-">
<?php echo $form->radioButtonListGroup(
			$client,
			'credittype',
			array(
                            
				'widgetOptions' => array(
					'data' => array(
						
						Yii::t('app','<div class="typeaccount">Annual subscription</div> <div class="price">2,450 €</div>'),
                                                Yii::t('app','<div class="typeaccount">Starters Offer 1000 Credits</div> <div class="price"> 350,00 €</div>'),
                                                Yii::t('app','<div class="typeaccount">Free Package</div>'),
					)
				),
                            'wrapperHtmlOptions' => array('class' => 'col-sm-7')
			)
		); ?>
    </div>
</p>

  </div> 

            </div>
        </div>
        </div>

        <div class="panel panel-footer span-13">
            
            
            <div class="panel-heading">
                <!--<h4 class="panel-title">-->
                <div id="Heading-Advert" data-toggle="collapse" class="btn btn-primary accordion-heading"data-parent="#accordion" href="#Advert">

                    <div class="pull-left"><div id="Glyp-Advert" class="glyphicon glyphicon-chevron-up"></div></div>&nbsp; <?php echo  Yii::t('app','Login information');?> &nbsp;  <i class="fa fa-key fa-lg"></i>
                </div>
                <!--</h4>-->
            </div>
            <div id="Advert" class="panel-collapse collapse in">
                <div class="panel-body">


                    <div class="row">
                        <?php // echo $form->labelEx($model, 'username'); ?>
                        <?php
                        echo $form->textFieldGroup($model, 'username', array('size' => 60, 'maxlength' => 255,
                            'wrapperHtmlOptions' => array('class' => 'col-sm-8',),
                        ));
                        ?>
                        <?php // echo $form->error($model, 'username');  ?>

    <!--                            <span class="label label-info"    
                                      >Minimum is 6 characters <br>Must contain at least one special character</span></div>-->


                        <?php //echo $form->labelEx($model, 'password'); ?>
                        <?php
                        echo $form->passwordFieldgROUP($model, 'password', array('size' => 60, 'maxlength' => 255,
                            'wrapperHtmlOptions' => array('class' => 'col-sm-8',),
                            'hint' => '<div class="span-8"><strong>Note:</strong> Minimum is 6 characters and Must contain at least one special character.</div>'
                        ));
                        ?>
                        <?php // echo $form->error($model, 'password'); ?>
    <!--                            <p class="hint">
                        <?php // echo UserModule::t("Minimal password length 4 symbols."); ?>
        </p>-->


                        <?php //echo $form->labelEx($model, 'verifyPassword'); ?>
                        <?php
                        echo $form->passwordFieldGroup($model, 'verifyPassword', array('size' => 60, 'maxlength' => 255,
                            'wrapperHtmlOptions' => array('class' => 'col-sm-8',),
                        ));
                        ?>
                        <?php // echo $form->error($model, 'verifyPassword'); ?>


                        <?php //echo $form->labelEx($model, 'email'); ?>
                        <?php
                        echo $form->textFieldGroup($model, 'email', array('size' => 60, 'maxlength' => 255,
                            'wrapperHtmlOptions' => array('class' => 'col-sm-8',),
                        ));
                        ?>
                        <?php // echo $form->error($model, 'email'); ?>



  </div> 

            </div>
        </div>
    </div>

        <?php $this->renderPartial('/../../../views/Client/_form', array('model' => $client, 'form' => $form)); ?>
    
    <div class="panel panel-footer span-12">

        <?php if (UserModule::doCaptcha('registration')): ?>
            <div class="row">
                <?php echo $form->labelEx($model, 'verifyCode'); ?>

                <?php $this->widget('CCaptcha'); ?>
                <?php echo $form->textField($model, 'verifyCode'); ?>
                <?php echo $form->error($model, 'verifyCode'); ?>

                <p class="hint"><?php echo UserModule::t("Please enter the letters as they are shown in the image above."); ?>
                    <br/><?php echo UserModule::t("Letters are not case-sensitive."); ?></p>
            </div>
          <?php endif; ?>
        </div>

        <div class="clear"></div>
    <div class="row">
        <div class="buttons pull-right" >
            <?php
            $this->widget('booster.widgets.TbButton', array('buttonType' => 'submit',
                'size' => 'large',
                'context' => 'success',
                'label' => (UserModule::t('Register')),
//                );
            ));
            ?>


        </div>  
    </div>


    <?php $this->endWidget(); ?>
    </div><!-- form -->

    
    
<?php endif; ?>