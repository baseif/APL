<?php
/* @var $this ContactController */
/* @var $model Contact */
/* @var $form CActiveForm */
?>

<script type="text/javascript">

function selectCheckbox(eventcheck,allcheckbox){


        if ((document.getElementById(eventcheck).checked)) { // check select status
//            
        
            $('.'+allcheckbox).each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1"               
            });
        } else {
            $('.'+allcheckbox).each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                       
            });
        }
         
    }

</script>


<div class="last"><br><br>
    <div id="col-xs-12 col-md-8">

        <?php
        $this->widget('booster.widgets.TbTabs', array(
            'type' => 'tabs',
            'placement' => 'right',
            'tabs' => array(
                array('label' => ('Edit Login Information'), 'url' => array('/user/profile/edit'), 'icon' => 'edit'),
                array('label' => ('Edit Personal Information '), 'url' => array('/contact/update/' . Yii::app()->user->id), 'icon' => 'pencil'),
                array('label' => ('Change password'), 'url' => array('/user/profile/changepassword'), 'icon' => 'lock'),),
            'htmlOptions' => array('class' => 'operations'),
        ));
        ?>
    </div><!-- sidebar -->
</div> 

<div class="form span-20">
    <?php
    $contact = Contact::model()->findByPk(Yii::app()->user->id);
    $form = $this->beginWidget('booster.widgets.TbActiveForm', array(
        'id' => 'contact-form',
        'htmlOptions' => array('class' => 'col-sm-4', 'class' => 'well'),
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


    <?php echo $form->errorSummary($model); ?>

    <div class="panel panel-footer">
        <div class="panel-heading">
            <!--<h4 class="panel-title">-->
            <div id="Heading-Advert" data-toggle="collapse" class="btn btn-primary accordion-heading"data-parent="#accordion" href="#Advert1">

                <div class="pull-left"><div id="Glyp-Advert1" class="glyphicon glyphicon-chevron-up"></div></div>&nbsp;  Personal Information &nbsp; 
                <i class="fa fa-info-circle fa-lg"></i>
            </div>
            <!--</h4>-->
        </div>
        <div id="Advert1" class="panel-collapse collapse in">
            <div class="panel-body">

                <div class="row">
                    <?php //echo $form->labelEx($model,'contact_name_ini');   ?>
                    <?php
                    echo $form->textFieldGroup($model, 'contact_name_ini', array('size' => 60, 'maxlength' => 255,
                        'wrapperHtmlOptions' => array('class' => 'col-sm-6',),
                    ));
                    ?>
                    <?php echo $form->error($model, 'contact_name_ini'); ?>
                </div>

                <div class="row">
                    <?php //echo $form->labelEx($model,'contact_name_first');  ?>
                    <?php
                    echo $form->textFieldGroup($model, 'contact_name_first', array('size' => 60, 'maxlength' => 255,
                        'wrapperHtmlOptions' => array('class' => 'col-sm-6',)
                    ));
                    ?>
                    <?php echo $form->error($model, 'contact_name_first'); ?>
                </div>

                <div class="row">
                    <?php //echo $form->labelEx($model,'contact_name_last');  ?>
                    <?php
                    echo $form->textFieldGroup($model, 'contact_name_last', array('size' => 60, 'maxlength' => 255,
                        'wrapperHtmlOptions' => array('class' => 'col-sm-6',),
                    ));
                    ?>
                    <?php echo $form->error($model, 'contact_name_last'); ?>
                </div>

                <div class="row">
                    <?php //echo $form->labelEx($model,'contact_gender');  ?>
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
                    <?php echo $form->error($model, 'contact_gender'); ?>
                </div>
                
                <div class="row">
                   
                    
                <div class="form-group validating">
                   <label class="col-sm-3 control-label">Company / Publisher name</label>
                       <div class="col-sm-9">
                    <?php
 if(count($companyselected)>0){
     $catselected = $companyselected;
 foreach($catselected as $cat){
    $selectedValues[$cat->company_id] = Array ( 'selected' => 'selected' );    
 }
 }                   
 else{
     $selectedValues = '';
 }
$datacompany = CHtml::listData(Company::model()->findAll('comp_id <> 1'), 'comp_id', 'comp_name');
echo CHtml::activeDropDownList($company,'comp_id',
                          $datacompany,
                          array(
                                'name'=>'Company',
                                'class'=>'form-control',
                                'title'=>"Company",
                                 'style'=>'width:348px;',
                                'options' => $selectedValues,
                                          ));
                    ?>
                                        </div>
                                    </div>
                    
                    
                </div>
                <div class="row">
                    <div class="form-group"><br />If your company does'nt exist, write here</div>
                    <div class="form-group">
                        <label for="Contact_contact_name_ini" class="col-sm-3 control-label">Company / Publisher name</label>
                        <div class="col-sm-5 col-sm-9">
                            <input type="text" maxlength="255" id="Contact_contact_comany" name="Contact[company]" placeholder="Company" class="form-control">   
                            </div>
                    </div>
                </div>
                <div class="row col-sm-6">

                                    <div class="form-group validating">
                                        <label class="col-sm-3 control-label">Field of interest</label>
                                            <div class="col-sm-9">
                    <?php
 if(count($contact->businessCategories)>0){
     $catselected = $contact->businessCategories;
       $selectedValues = array();
 foreach($catselected as $cat){
    $selectedValues[$cat->cat_id] = Array ( 'selected' => 'selected' );    
 }
 }                   
 else{
     $selectedValues = '';
 }
$datacategorie = CHtml::listData(BusinessCategory::model()->findAll(), 'cat_id', 'cat_title');
echo CHtml::activeDropDownList($categories,'cat_id',
                          $datacategorie,
                          array('multiple'=>'multiple',
                                'name'=>'businessCategory',
                                'class'=>'form-control',
                                'title'=>"businessCategory",
                                 'style'=>'height:120px;',
                                'options' => $selectedValues,
                                          ));
                    ?>
                                        </div>
                                    </div>

                </div>

                <div class="row col-sm-6">
                     <div class="form-group validating">
                                        <label class="col-sm-3 control-label">Position</label>
                                            <div class="col-sm-9">
                    <?php
 if(count($functionselected)>0){
       $selectedValues = array();
     $catselected = $functionselected;
 foreach($catselected as $cat){
    $selectedValues[$cat->function_id] = Array ( 'selected' => 'selected' );    
 }
 }                   
 else{
     $selectedValues = '';
 }
$datafunction = CHtml::listData(Functions::model()->findAll(), 'function_id', 'function_title');
echo CHtml::activeDropDownList($function,'function_id',
                          $datafunction,
                          array('multiple'=>'multiple',
                                'name'=>'Function',
                                'class'=>'form-control',
                                'title'=>"Function",
                                 'style'=>'height:120px;',
                                'options' => $selectedValues,
                                          ));
                    ?>
                                        </div>
                                    </div>
                </div>
                
 <div class="row col-sm-6">
 <div class="form-group validating">
<label class="col-sm-3 control-label">Language</label>
    <div class="col-sm-9">
                    <?php
 if(count($contact->isoLanguages)>0){
   $languageselected =   $contact->isoLanguages;
     $selectedValues = array();
foreach($languageselected as $lang){
    $selectedValues[$lang->lang_iso] = Array ( 'selected' => 'selected' );    
 }  
     
 }
 else{
     $selectedValues = '';
 }

 $datalang = CHtml::listData(IsoLanguage::model()->findAll(), 'lang_iso', 'language');
echo CHtml::activeDropDownList($iso_language,'lang_iso',
                          $datalang,
                          array('multiple'=>'multiple',
                                'name'=>'isoLanguage',
                                'class'=>'form-control',
                                'title'=>"isoLanguage",
                                 'style'=>'height:120px;',
                                'options' => $selectedValues,
                                          ));
                    ?>

</div>
 </div>
</div> 
                
                 <div class="row col-sm-6">
                    
                     
                     <div class="form-group validating">
                                        <label class="col-sm-3 control-label">Media Type</label>
                                            <div class="col-sm-9">
                    <?php
                    
 if(count($channelselected)>0){
     $catselected = $channelselected;
     $selectedValues = array();
     foreach($catselected as $cat){
     
    $selectedValues[$cat->channel_id] = Array ( 'selected' => 'selected' );    
 }
 
 }                   
 else{
     $selectedValues = '';
 }
 //echo count($selectedValues);

$datachannel = CHtml::listData(Channel::model()->findAll(), 'channel_id', 'channel_title');
echo CHtml::activeDropDownList($channel,'channel_id',
                          $datachannel,
                          array('multiple'=>'multiple',
                                'name'=>'Channel',
                                'class'=>'form-control',
                                'title'=>"Channel",
                                 'style'=>'height:120px;',
                                'options' => $selectedValues,
                                          ));
                    ?>
                                        </div>
                                    </div>
                     
                     
                </div>
                
                <div class="row">
                            <table width="100%">
                                <tr><td><label><input style="" type="checkbox"  id="selectall" value="" name="allcountry" onClick="selectCheckbox('selectall','checkboxcountry')" />&nbsp;Select All</label></td></tr>
                                <tr>
                    <?php
                    $georegion = GeoRegion::model()->GeoRegionAfrica();
                    $i=0;
                    
                    foreach($georegion as $value){
                        echo '<td valign="top" style="vertical-align:top;">
                            <label>
                        <input id="selectregion'.$i.'" class="checkboxcountry" onClick="selectCheckbox(\'selectregion'.$i.'\',\'checkbox'.$i.'\')" style="float:left; margin-right:5px"  type="checkbox" value="'.$value->geo_region_id.'" name="georegion[]" />
                            '.$value->region_name.'</label>';
                        $country = IsoCountry::model()->FindCountyByGeeoRegion($value->geo_region_id);
                        echo '<br />';
                        
                        foreach($country as $c){
                            $selected='';
                            $j=0;
                            $t=0;
                            while($j<count($countiesselected) && $t==0){    
                                if($countiesselected[$j]->geo_country_id == $c->country_iso){
                                    $selected = "checked='checked'";
                                    $t=1;
                                }
                                $j++;
                            }
                            echo '<label style="font-weight:normal;">
                                <input '.$selected.' style="" type="checkbox" class="checkboxcountry checkbox'.$i.'" value="'.$c->country_iso.'" name="country[]" />
                                &nbsp;&nbsp;'.$c->country_name.'</label>';
                        }
                        echo '</td>';
                        $i++;
                    }
                    ?>
                             </tr></table>
                </div>
                
        </div>
    </div>

    <div class="panel panel-footer">
        <div class="panel-heading">
            <!--<h4 class="panel-title">-->
            <div id="Heading-Advert" data-toggle="collapse" class="btn btn-primary accordion-heading"data-parent="#accordion" href="#Advert2">

                <div class="pull-left"><div id="Glyp-Advert2" class="glyphicon glyphicon-chevron-down"></div></div>&nbsp;   Address &nbsp; 
                <i class="fa fa-map-marker fa-lg"></i> 
            </div>
            <!--</h4>-->
        </div>
        <div id="Advert2" class="panel-collapse collapse">
            <div class="panel-body">

                <div class="row">
                    <?php //echo $form->labelEx($model,'contact_adress');   ?>
                    <?php
                    echo $form->textFieldGroup($model, 'contact_adress', array('size' => 60, 'maxlength' => 255,
                        'wrapperHtmlOptions' => array('class' => 'col-sm-6',),
                    ));
                    ?>
                    <?php echo $form->error($model, 'contact_adress'); ?>
                </div>

                <div class="row">
                    <?php //echo $form->labelEx($model,'contact_address_nr');   ?>
                    <?php
                    echo $form->textFieldGroup($model, 'contact_address_nr', array('size' => 60, 'maxlength' => 255,
                        'wrapperHtmlOptions' => array('class' => 'col-sm-6',),
                    ));
                    ?>
                    <?php echo $form->error($model, 'contact_address_nr'); ?>
                </div>

                <div class="row">
                    <?php ///echo $form->labelEx($model,'contact_address_addon');   ?>
                    <?php
                    echo $form->textFieldGroup($model, 'contact_address_addon', array('size' => 60, 'maxlength' => 255,
                        'wrapperHtmlOptions' => array('class' => 'col-sm-6',),
                    ));
                    ?>
                    <?php echo $form->error($model, 'contact_address_addon'); ?>
                </div>

                
                

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

                <?php echo $form->error($model, 'contact_iso_country'); ?><br>




                <div class="row">
                    <?php //echo $form->labelEx($model,'contact_city');  ?>
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

                <div class="pull-left"><div id="Glyp-Advert3" class="glyphicon glyphicon-chevron-down"></div></div>&nbsp;  Others&nbsp;
                <i class="fa fa-tasks fa-lg"></i>
            </div>
            <!--</h4>-->
        </div>
        <div id="Advert3" class="panel-collapse collapse">
            <div class="panel-body">

                <div class="row">
                    <?php //echo $form->labelEx($model,'contact_phone');  ?>
                    <?php
                    echo $form->textFieldGroup($model, 'contact_phone', array('size' => 60, 'maxlength' => 255,
                        'wrapperHtmlOptions' => array('class' => 'col-sm-6',),
                    ));
                    ?>
                    <?php echo $form->error($model, 'contact_phone'); ?>
                </div>

                <div class="row">
                    <?php //echo $form->labelEx($model,'contact_website');  ?>
                    <?php
                    echo $form->textFieldGroup($model, 'contact_website', array('size' => 60, 'maxlength' => 255,
                        'wrapperHtmlOptions' => array('class' => 'col-sm-6',),
                    ));
                    ?>
                    <?php echo $form->error($model, 'contact_website'); ?>
                </div>

                <div class="row">
                    <?php //echo $form->labelEx($model,'contact_tw');   ?>
                    <?php
                    echo $form->textFieldGroup($model, 'contact_tw', array('size' => 60, 'maxlength' => 255,
                        'wrapperHtmlOptions' => array('class' => 'col-sm-6',),
                    ));
                    ?>
                    <?php echo $form->error($model, 'contact_tw'); ?>
                </div>

                <div class="row">
                    <?php //echo $form->labelEx($model,'contact_fb');  ?>
                    <?php
                    echo $form->textFieldGroup($model, 'contact_fb', array('size' => 60, 'maxlength' => 255,
                        'wrapperHtmlOptions' => array('class' => 'col-sm-6',),
                    ));
                    ?>
                    <?php echo $form->error($model, 'contact_fb'); ?>
                </div>

                <div class="row">
                    <?php //echo $form->labelEx($model,'contact_go');  ?>
                    <?php
                    echo $form->textFieldGroup($model, 'contact_go', array('size' => 60, 'maxlength' => 255,
                        'wrapperHtmlOptions' => array('class' => 'col-sm-6',),
                    ));
                    ?>
                    <?php echo $form->error($model, 'contact_go'); ?>
                </div>

                <div class="row">
                    <?php //echo $form->labelEx($model,'contact_yt');  ?>
                    <?php
                    echo $form->textFieldGroup($model, 'contact_yt', array('size' => 60, 'maxlength' => 255,
                        'wrapperHtmlOptions' => array('class' => 'col-sm-6',),
                    ));
                    ?>
                    <?php echo $form->error($model, 'contact_yt'); ?>
                </div>

                <div class="row">
                    <?php //echo $form->labelEx($model,'contact_li');  ?>
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




            </div>
            <br />

        </div>
    </div>   
    <div class="row">
        <div class="buttons pull-right" >
            <?php
            $this->widget('booster.widgets.TbButton', array('buttonType' => 'submit',
                'size' => 'large', 'context' => 'success', 'label' => 'Update')
            );
            ?>

            <?php //echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save');      ?>
        </div> 
    </div>     



    <?php $this->endWidget(); ?>
</div>
<!-- form -->
