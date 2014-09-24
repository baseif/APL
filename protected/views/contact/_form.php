<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/main.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.tokeninput.js"></script>

<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/token-input.css" type="text/css" />
<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/token-input-facebook.css" type="text/css" />
<script>


    function showMe(box) {

        var chboxs = document.getElementById("freelanceactivity");
        var vis = "none";
        
            if (chboxs.checked) {
                vis = "block";
            }
        document.getElementById(box).style.display = vis;
    }

</script>
<?php require_once 'js/autocomplete.php'; ?>
<div id="update"></div>
<?php
/* @var $this ContactController */
/* @var $model Contact */
/* @var $form CActiveForm */
?>
   


<div class="form">
<?php //echo date('Y-m-d H:i:s'); ?>
    <?php echo $form->errorSummary($model); ?>
<!--<p class="note">Fields with <span class="required">*</span> are required.</p>-->

    <div class="panel panel-footer">
        <div class="panel-heading">
            <!--<h4 class="panel-title">-->
            <div id="Heading-Advert" data-toggle="collapse" class="btn btn-primary accordion-heading"data-parent="#accordion" href="#Advert1">

                <div class="pull-left"><div id="Glyp-Advert1" class="glyphicon glyphicon-chevron-up"></div></div>&nbsp;  Personal Information &nbsp; <i class="fa fa-info-circle fa-lg"></i>
            </div>
            <!--</h4>-->
        </div>
        <div id="Advert1" class="panel-collapse collapse in">
            <div class="panel-body">
                <div class="row">
                    <?php //echo $form->labelEx($model,'contact_name_ini');     ?>
                    <?php
                    echo $form->textFieldGroup($model, 'contact_name_ini', array('size' => 60, 'maxlength' => 255,
                        'wrapperHtmlOptions' => array('class' => 'col-sm-5',),
                    ));
                    ?>
                    <?php echo $form->error($model, 'contact_name_ini'); ?>
                </div>

                <div class="row">
                    <?php //echo $form->labelEx($model,'contact_name_first');    ?>
                    <?php
                    echo $form->textFieldGroup($model, 'contact_name_first', array('size' => 60, 'maxlength' => 255,
                        'wrapperHtmlOptions' => array('class' => 'col-sm-5',)
                    ));
                    ?>
                    <?php echo $form->error($model, 'contact_name_first'); ?>
                </div>

                <div class="row">
                    <?php //echo $form->labelEx($model,'contact_name_last');    ?>
                    <?php
                    echo $form->textFieldGroup($model, 'contact_name_last', array('size' => 60, 'maxlength' => 255,
                        'wrapperHtmlOptions' => array('class' => 'col-sm-5',),
                    ));
                    ?>
                    <?php echo $form->error($model, 'contact_name_last'); ?>
                </div>

                <div class="row">
                    <?php //echo $form->labelEx($model,'contact_gender');    ?>
                    <?php
                    echo $form->dropDownListGroup(
                            $model, 'contact_gender', array(
                        'wrapperHtmlOptions' => array(
                            'class' => 'col-sm-3',
                        ),
                        'widgetOptions' => array(
                            'data' => array('M' => 'Male', 'F' => 'Female', 'U' => 'Unknown'),
                            'htmlOptions' => array(),
                        )
                            )
                    );
                    ?>
                    <?php // echo $form->textField($model,'contact_gender',array('size'=>1,'maxlength'=>1));   ?>
                    <?php echo $form->error($model, 'contact_gender'); ?>
                </div>

                <div class="row">


                    <?php
                    echo $form->dropDownListGroup(
                            $categories, 'cat_title', array(
                        'wrapperHtmlOptions' => array(
                            'class' => 'col-sm-5',
                            'size' => '20',
                        ),
                        'widgetOptions' => array(
                            'data' => CHtml::listData(BusinessCategory::model()->findAll(), 'cat_id', 'cat_title'
                            ),
                            'htmlOptions' => array('multiple' => true, 'style' => 'height:100px'),
                    )));
                    ?>


                </div>   



                <div class="row">


                    <?php
                    echo $form->dropDownListGroup(
                            $iso_language, 'lang_iso', array(
                        'wrapperHtmlOptions' => array(
                            'class' => 'col-sm-5',
                        ),
                        'widgetOptions' => array(
                            'data' => CHtml::listData(IsoLanguage::model()->findAll(), 'lang_iso', 'language'
                            ),
                            'htmlOptions' => array('multiple' => true, 'style' => 'height:120px'),
                    )));
                    ?>


                </div> 



                

                <button id="add" type="button" class="btn btn-info">Add Company</button>
                <div id="items">
                    <div>
                        <div class="table-responsive">
                            <input type="hidden" name="nbfield" id="nbfield" value="1" />
                            <table class="table table-condensed">
                                <tr><td><b>Company</b> 
                                        <input type="text" name="company1" id="inputcompany1"></td>
                                    <td ><b>Country</b> <input type="text" name="inputcountry1" id="inputcountry1"></td>
                                    <td><b>Functions</b> <input type="text" name="function1" id="inputfunction1"></td>
                                    <td style=" width: 50%;"><b>Channels</b> <input type="text" name="inputchannel1" id="inputchannel1"></td>
                                </tr></table>
                        </div>
                    </div>
                </div>                
                <br /><br />
               <div class="row">

                    <div class="col-sm-5 col-sm-9 checkbox">
                        <label> <input type="checkbox" onclick="showMe('div1')" name="freelanceactivity" id="freelanceactivity" value="freelance" class="inputradio" />
                       Freelance Activity?</label> 
                    </div>
                </div>
                
                <div class="row">
                <div id="div1" style="display:none">
                    
                     <div>
                        <div class="table-responsive">
                           
                            <table class="table table-condensed">
                                <tr>
                                    <td style=" width: 33%;"><b>Country</b> <input type="text" name="countryfreelance" id="countryfreelance"></td>
                                    <td><b>Functions</b> <input type="text" name="functionfreelance" id="functionfreelance"></td>
                                    <td align="left"><b>Channel</b> <input type="text" name="channelfreelance" id="channelfreelance"></td>
                                </tr></table>
                        </div>
                    </div>
                    
                </div>
                </div>
                
                
            </div> 

        </div>
        <br />

    </div>

    <div class="panel panel-footer">
        <div class="panel-heading">
            <!--<h4 class="panel-title">-->
            <div id="Heading-Advert" data-toggle="collapse" class="btn btn-primary accordion-heading"data-parent="#accordion" href="#Advert2">

                <div class="pull-left"><div id="Glyp-Advert2" class="glyphicon glyphicon-chevron-down"></div></div>&nbsp;   Address &nbsp;<i class="fa fa-map-marker fa-lg"></i> 
            </div>
            <!--</h4>-->
        </div>
        <div id="Advert2" class="panel-collapse collapse">
            <div class="panel-body">
                <div class="row col-sm-6">
                    <?php //echo $form->labelEx($model,'contact_adress');     ?>
                    <?php
                    echo $form->textFieldGroup($model, 'contact_adress', array('size' => 60, 'maxlength' => 255,
                        'wrapperHtmlOptions' => array('class' => 'col-sm-10',),
                    ));
                    ?>
                    <?php echo $form->error($model, 'contact_adress'); ?>
                </div>

                <div class="col-sm-13 row">
                    <?php //echo $form->labelEx($model,'contact_address_nr');     ?>
                    <?php
                    echo $form->textFieldGroup($model, 'contact_address_nr', array('size' => 60, 'maxlength' => 255,
                        'wrapperHtmlOptions' => array('class' => 'col-sm-2',),
                    ));
                    ?>
                    <?php echo $form->error($model, 'contact_address_nr'); ?>
                </div>

                <div class="row">
                    <?php ///echo $form->labelEx($model,'contact_address_addon');    ?>
                    <?php
                    echo $form->textFieldGroup($model, 'contact_address_addon', array('size' => 60, 'maxlength' => 255,
                        'wrapperHtmlOptions' => array('class' => 'col-sm-6',),
                    ));
                    ?>
                    <?php echo $form->error($model, 'contact_address_addon'); ?>
                </div>




                <div class="row">
                    <div class="col-sm-3 control-label" >
                        <?php echo $form->labelEx($model, 'contact_iso_country'); ?></div>
                    &nbsp;

                    <?php
                    $this->widget('booster.widgets.TbSelect2', array(
                        'asDropDownList' => true,
                        'model' => $model,
                        'attribute' => 'contact_iso_country',
                        'options' => array(
                            'placeholder' => $model->getAttributeLabel('contact_iso_country'),
                            'width' => '48.5%',
                            'class' => 'col-sm-3',
                            'allowClear' => true,
                        ),
                        'data' => CHtml::listData(IsoCountry::model()->findAll(), 'country_iso', 'country_name'
                        ),
                    ));
                    ?></div>
                <?php // echo $form->dropDownList($model, 'contact_iso_country', CHtml::listData(isocountry::model()->findAll(), 'country_iso', 'country_name')); ?>
                <?php // echo $form->textField($model,'departmentId');  ?>
                <?php // echo $form->textField($model,'contact_iso_country');  ?>
                    <?php echo $form->error($model, 'contact_iso_country'); ?><br>




                <div class="row">
                    <?php //echo $form->labelEx($model,'contact_city');   ?>
                    <?php
                    echo $form->textFieldGroup($model, 'contact_city', array('size' => 60, 'maxlength' => 255,
                        'wrapperHtmlOptions' => array('class' => 'col-sm-6',),
                    ));
                    ?>
                    <?php echo $form->error($model, 'contact_city'); ?>


                </div>
                <br />

            </div>
        </div>
    </div>

    <div class="panel panel-footer">
        <div class="panel-heading">
            <!--<h4 class="panel-title">-->
            <div id="Heading-Advert" data-toggle="collapse" class="btn btn-primary accordion-heading"data-parent="#accordion" href="#Advert3">

                <div class="pull-left"><div id="Glyp-Advert3" class="glyphicon glyphicon-chevron-down"></div></div>&nbsp;  Others &nbsp; <i class="fa fa-tasks fa-lg"></i>
            </div>
            <!--</h4>-->
        </div>
        <div id="Advert3" class="panel-collapse collapse">
            <div class="panel-body">



                <div class="row">
                    <?php //echo $form->labelEx($model,'contact_phone');    ?>
                    <?php
                    echo $form->textFieldGroup($model, 'contact_phone', array('size' => 60, 'maxlength' => 255,
                        'wrapperHtmlOptions' => array('class' => 'col-sm-6',),
                    ));
                    ?>
                    <?php echo $form->error($model, 'contact_phone'); ?>
                </div>

                <div class="row">
                    <?php //echo $form->labelEx($model,'contact_website');    ?>
                    <?php
                    echo $form->textFieldGroup($model, 'contact_website', array('size' => 60, 'maxlength' => 255,
                        'wrapperHtmlOptions' => array('class' => 'col-sm-6',),
                    ));
                    ?>
                    <?php echo $form->error($model, 'contact_website'); ?>
                </div>

                <div class="row">
                    <?php //echo $form->labelEx($model,'contact_tw');    ?>
                    <?php
                    echo $form->textFieldGroup($model, 'contact_tw', array('size' => 60, 'maxlength' => 255,
                        'wrapperHtmlOptions' => array('class' => 'col-sm-6',),
                    ));
                    ?>
                    <?php echo $form->error($model, 'contact_tw'); ?>
                </div>

                <div class="row">
                    <?php //echo $form->labelEx($model,'contact_fb');   ?>
                    <?php
                    echo $form->textFieldGroup($model, 'contact_fb', array('size' => 60, 'maxlength' => 255,
                        'wrapperHtmlOptions' => array('class' => 'col-sm-6',),
                    ));
                    ?>
                    <?php echo $form->error($model, 'contact_fb'); ?>
                </div>

                <div class="row">
                    <?php //echo $form->labelEx($model,'contact_go');   ?>
                    <?php
                    echo $form->textFieldGroup($model, 'contact_go', array('size' => 60, 'maxlength' => 255,
                        'wrapperHtmlOptions' => array('class' => 'col-sm-6',),
                    ));
                    ?>
                    <?php echo $form->error($model, 'contact_go'); ?>
                </div>

                <div class="row">
                    <?php //echo $form->labelEx($model,'contact_yt');   ?>
                    <?php
                    echo $form->textFieldGroup($model, 'contact_yt', array('size' => 60, 'maxlength' => 255,
                        'wrapperHtmlOptions' => array('class' => 'col-sm-6',),
                    ));
                    ?>
                    <?php echo $form->error($model, 'contact_yt'); ?>
                </div>

                <div class="row">
                    <?php //echo $form->labelEx($model,'contact_li');   ?>
                    <?php
                    echo $form->textFieldGroup($model, 'contact_li', array('size' => 60, 'maxlength' => 255,
                        'wrapperHtmlOptions' => array('class' => 'col-sm-6',),
                    ));
                    ?>
                    <?php echo $form->error($model, 'contact_li'); ?>
                </div>



                <?php
                echo $form->ckEditorGroup(
                        $model, 'contact_bio', array(
                    'widgetOptions' => array(
                        'editorOptions' => array(
                            // 'fullpage' => 'js:true',
                            'class' => 'span10',
                            'rows' => 5,
                            'options' => array('plugins' => array('clips', 'fontfamily'), 'lang' => 'ang')
                        )
                    )
                        )
                );
                ?>


                <br />

            </div>
        </div>
    </div>
</div>
<!-- form -->
