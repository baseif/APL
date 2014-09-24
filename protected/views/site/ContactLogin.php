<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>

<h1><?php echo  Yii::t('app','Login');?></h1>

<p><?php echo  Yii::t('app','Please fill out the following form with your login credentials:');?></p>

<div class="form formlogin">
    <div class="rows">
        
       
        <div class="span-8">
<?php $form = $this->beginWidget(
    'booster.widgets.TbActiveForm',
    array(
     //   'id' => 'verticalForm',
    	'type' => 'horizontal',
        'htmlOptions' => array('class' => 'well'), // for inset effect

	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
	'validateOnSubmit'=>true,
	),
)); ?>

 
    
	<p class="note"><?php echo  Yii::t('app','Fields with');?> <span class="required">*</span> <?php echo  Yii::t('app','are required.');?></p>

	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username'); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password'); ?>
		<?php echo $form->error($model,'password'); ?>
<!--		<p class="hint">
			Hint: You may login with <kbd>demo</kbd>/<kbd>demo</kbd> or <kbd>admin</kbd>/<kbd>admin</kbd>.
		</p>-->
	</div>

	<div class="row rememberMe">
		<?php echo $form->checkBox($model,'rememberMe'); ?>
		<?php echo $form->label($model,'rememberMe'); ?>
            <?php echo $form->error($model,'rememberMe'); ?>
	</div>

	<div class="row buttons">
		<?php $this->widget(    'booster.widgets.TbButton',
                        array('buttonType' => 'submit', 'label' => 'Log in')
                ); ?>
	</div>

<?php $this->endWidget(); ?>
        </div>
        
         <div class="span-8">
    <?php $this->widget('ext.hoauth.widgets.HOAuth'); ?>
    
    </div>
        
        </div>
    </div>
</div><!-- form -->
