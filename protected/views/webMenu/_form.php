<?php
/* @var $this WebMenuController */
/* @var $model WebMenu */
/* @var $form CActiveForm */
?>

<div class="form">



    <?php
    $form = $this->beginWidget('booster.widgets.TbActiveForm', array(
        'id' => 'web-menu-form',
        'type' => 'horizontal',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
    ));
    ?>

    <p class="note"><?php echo  Yii::t('app','  Fields with ');?><span class="required">*</span><?php echo  Yii::t('app',' are required. ');?> </p>

        <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php //  echo $form->labelEx($model,'menu_title'); ?>
        <?php
        echo $form->textFieldGroup($model, 'menu_title', array('size' => 60, 'maxlength' => 255,
            'wrapperHtmlOptions' => array('class' => 'col-sm-6',),
        ));
        ?>
        <?php echo $form->error($model, 'menu_title'); ?>
    </div>

    <div class="row">
        <?php // echo $form->labelEx($model,'menu_title_c'); ?>
        <?php
        echo $form->textFieldGroup($model, 'menu_title_c', array('size' => 60, 'maxlength' => 255,
            'wrapperHtmlOptions' => array('class' => 'col-sm-6',),
        ));
        ?>are required.

        <?php echo $form->error($model, 'menu_title_c'); ?>
    </div>

    <div class="row">
        <?php // echo $form->labelEx($model,'menu_parent'); ?>
        <?php
        echo $form->textFieldGroup($model, 'menu_parent', array('size' => 60, 'maxlength' => 255,
            'wrapperHtmlOptions' => array('class' => 'col-sm-6',),
        ));
        ?>

        <?php echo $form->error($model, 'menu_parent'); ?>
    </div>

    <div class="row">
        <?php // echo $form->labelEx($model,'menu_path');  ?>
        <?php
        echo $form->textFieldGroup($model, 'menu_path', array('size' => 60, 'maxlength' => 255,
            'wrapperHtmlOptions' => array('class' => 'col-sm-6',),
        ));
        ?>

        <?php echo $form->error($model, 'menu_path'); ?>
    </div>

    <div class="row">
        <?php // echo $form->labelEx($model,'menu_header'); ?>
<?php
echo $form->textFieldGroup($model, 'menu_header', array('size' => 60, 'maxlength' => 255,
    'wrapperHtmlOptions' => array('class' => 'col-sm-6',),
));
?>

        <?php echo $form->error($model, 'menu_header'); ?>
    </div>

    <div class="row">
<?php // echo $form->labelEx($model,'menu_header_c');  ?>
<?php
echo $form->textFieldGroup($model, 'menu_header_c', array('size' => 60, 'maxlength' => 255,
    'wrapperHtmlOptions' => array('class' => 'col-sm-6',),
));
?>

        <?php echo $form->error($model, 'menu_header_c'); ?>
    </div>

    <div class="row">
<?php // echo $form->labelEx($model,'menu_order');  ?>
        <?php
        echo $form->textFieldGroup($model, 'menu_order', array('size' => 60, 'maxlength' => 255,
            'wrapperHtmlOptions' => array('class' => 'col-sm-6',),
        ));
        ?>

        <?php echo $form->error($model, 'menu_order'); ?>
    </div>

    <div class="row">
        <?php // echo $form->labelEx($model,'menu_type'); ?>
        <?php
        echo $form->textFieldGroup($model, 'menu_type', array('size' => 17, 'maxlength' => 17,
            'wrapperHtmlOptions' => array('class' => 'col-sm-6',),
        ));
        ?>
<?php echo $form->error($model, 'menu_type'); ?>
    </div>

    <div class="row">
        <?php // echo $form->labelEx($model,'menu_online'); ?>
        <?php
        echo $form->textFieldGroup($model, 'menu_online', array('size' => 60, 'maxlength' => 255,
            'wrapperHtmlOptions' => array('class' => 'col-sm-6',),
        ));
        ?>
        <?php echo $form->error($model, 'menu_online'); ?>
    </div>

    <div class="row">
        
        <?php echo $form->ckEditorGroup(
			$model,
			'menu_content',
			array(
		   		'wrapperHtmlOptions' => array(
					'class' => 'col-sm-5', 
				),
				'widgetOptions' => array(
					'editorOptions' => array(
						'fullpage' => 'js:true',
						/* 'width' => '640', */
						/* 'resize_maxWidth' => '640', */
						/* 'resize_minWidth' => '320'*/
					)
				)
			)
		); ?>
        
        
        <?php // echo $form->labelEx($model,'menu_content');  ?>
        <?php //echo $form->textArea($model, 'menu_content', array('rows' => 6, 'cols' => 50)); ?>
<?php echo $form->error($model, 'menu_content'); ?>
    </div>

    <div class="row">
        <?php // echo $form->labelEx($model,'menu_lang_country'); ?>
        <?php
        echo $form->textFieldGroup($model, 'menu_lang_country', array('size' => 60, 'maxlength' => 255,
            'wrapperHtmlOptions' => array('class' => 'col-sm-6',),
        ));
        ?>

<?php echo $form->error($model, 'menu_lang_country'); ?>
    </div>

    <div class="row">
        <?php //  echo $form->labelEx($model,'menu_lang_group'); ?>
        <?php
        echo $form->textFieldGroup($model, 'menu_lang_group', array('size' => 60, 'maxlength' => 255,
            'wrapperHtmlOptions' => array('class' => 'col-sm-6',),
        ));
        ?>

        <?php echo $form->error($model, 'menu_lang_group'); ?>
    </div>

    <div class="row">
    <?php // echo $form->labelEx($model,'menu_added'); ?>
<?php
echo $form->textFieldGroup($model, 'menu_added', array('size' => 60, 'maxlength' => 255,
    'wrapperHtmlOptions' => array('class' => 'col-sm-6',),
));
?>

<?php echo $form->error($model, 'menu_added'); ?>
    </div>

    <div class="row buttons">
<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->