<?php
/* @var $this ContactController */
/* @var $model Contact */
/* @var $form CActiveForm */
?>
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

$("body").on("click", ".delete", function(e) {
            $(this).closest("div").remove();
        });

$(document).ready(function() {

$("#countryfreelance").tokenInput([
<?php
$country = IsoCountry::model()->FindCountyAfrica();

foreach ($country as $value) {
    echo '{id:"' . $value->country_iso . '", name:"' . $value->country_name . '"},';
}
?>
        ], {theme: "facebook", preventDuplicates: true,
            prePopulate: [
                   <?php
                        $countryselected = ContactGeoCoverage::model()->findAllBySql("select geo_country_id from contact_geo_coverage where contact_id = $contact_id and company_id = 999999999");
                       if(count($countryselected)>0){
                           foreach($countryselected as $countryvalue){
                          $namecountry = IsoCountry::model()->findByPk($countryvalue->geo_country_id);
                            echo  '{id:"'.$namecountry->country_iso.'", name:"'.$namecountry->country_name.'"},'; 
                       }
                       }
                        
                        
  
				   ?>
                ]
        });
      
        $("#functionfreelance").tokenInput([
<?php
$function = Functions::model()->findAll();

foreach ($function as $value) {
    echo '{id:' . $value->function_id . ', name:"' . $value->function_title . '"},';
}
?>
        ], {theme: "facebook", preventDuplicates: true,
            
            prePopulate: [
                   <?php
                        $functionselected = ContactFunction::model()->findAllBySql("select function_id from contact_function where contact_id = $contact_id and company_id = 999999999");
                       if(count($functionselected)>0){
                          foreach($functionselected as $functionvalue){
                          $namefunction = Functions::model()->findByPk($functionvalue->function_id);
                            echo  '{id:'.$namefunction->function_id.', name:"'.$namefunction->function_title.'"},'; 
                       } 
                       }
                        
                        
  
				   ?>
                ]
            
        });
$("#channelfreelance").tokenInput([
<?php
$channel = Channel::model()->findAll();
foreach ($channel as $value) {
    echo '{id:' . $value->channel_id . ', name:"' . $value->channel_title . '"},';
}
?>
        ], {theme: "facebook", preventDuplicates: true,
            prePopulate: [
                   <?php
                        $channelselected = RoleChannel::model()->findAllBySql("select channel_id from role_channel where contact_id = $contact_id and company_id = 999999999");
                       if(count($channelselected)>0){
                        foreach($channelselected as $channelvalue){
                          $namechannel = Channel::model()->findByPk($channelvalue->channel_id);
                            echo  '{id:'.$namechannel->channel_id.', name:"'.$namechannel->channel_title.'"},'; 
                       }
                       }
                       ?>
                ]
        });

});

</script>
<style type="text/css">
    ul.token-input-list-facebook {
        width: 155px;
    }
</style>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/glyphicon.js"></script>
<?php //require_once 'js/autocomplete.php'; ?>
<div id="update"></div>

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
                                        <label class="col-sm-3 control-label">Field of interest</label>
                                            <div class="col-sm-5 col-sm-9">
                    <?php
 if(count($contact->businessCategories)>0){
     $catselected = $contact->businessCategories;
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
                                        </div></div>

                </div>   

                <div class="row">

 <div class="form-group validating">
                                        <label class="col-sm-3 control-label">Language</label>
                                            <div class="col-sm-5 col-sm-9">
                    <?php
 if(count($contact->isoLanguages)>0){
   $languageselected =   $contact->isoLanguages;
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

</div></div>
                </div> 

                
                <button id="add" type="button" class="btn btn-info">Add Company</button>
               
                <div id="items">
                 <?php $i=1; ?>   
                <input type="hidden" name="nbfield" id="nbfield" value="<?php echo $i ?>" />
                 <?php
                 
                foreach($companyselected as $valuecompany){
                    ?>
                
                <script>    
                document.getElementById('nbfield').value = <?php echo $i ?>;    
                $(document).ready(function() {
                 //when the Add Filed button is clicked
        var i = <?php echo $i ?>;

        /***Company Initial**/
        $("#inputcompany" + <?php echo $i ?>).tokenInput([
<?php
$company = Company::model()->FindAllWithNofreelance();

foreach ($company as $value) {
    echo '{id:' . $value->comp_id . ', name:"' . $value->comp_name . '"},';
}
?>
        ], {theme: "facebook", preventDuplicates: true, tokenLimit: 1,
            
            prePopulate: [
                   <?php
                   
                       $namecompany = Company::model()->findByPk($valuecompany->company_id);
                       echo  '{id:'.$namecompany->comp_id.', name:"'.$namecompany->comp_name.'"},';
  
				   ?>
                ]
            
        });
        
        $("#inputcountry" + <?php echo $i ?>).tokenInput([
<?php
$country = IsoCountry::model()->FindCountyAfrica();

foreach ($country as $value) {
    echo '{id:"' . $value->country_iso . '", name:"' . $value->country_name . '"},';
}
?>
        ], {theme: "facebook", preventDuplicates: true,
            
            prePopulate: [
                   <?php
                        $countryselected = ContactGeoCoverage::model()->findAllBySql("select geo_country_id from contact_geo_coverage where contact_id = $contact_id and company_id = $valuecompany->company_id");
                       if(count($countryselected)>0){
                          foreach($countryselected as $countryvalue){
                          $namecountry = IsoCountry::model()->findByPk($countryvalue->geo_country_id);
                            echo  '{id:"'.$namecountry->country_iso.'", name:"'.$namecountry->country_name.'"},'; 
                       } 
                       }
                        
                        
  
				   ?>
                ]
            
        });
       
       
        $("#inputfunction" + i).tokenInput([
<?php
$function = Functions::model()->findAll();

foreach ($function as $value) {
    echo '{id:' . $value->function_id . ', name:"' . $value->function_title . '"},';
}
?>
        ], {theme: "facebook", preventDuplicates: true,
            prePopulate: [
                   <?php
                        $functionselected = ContactFunction::model()->findAllBySql("select function_id from contact_function where contact_id = $contact_id and company_id = $valuecompany->company_id");
                       if(count($functionselected)>0){
                          foreach($functionselected as $functionvalue){
                          $namefunction = Functions::model()->findByPk($functionvalue->function_id);
                            echo  '{id:'.$namefunction->function_id.', name:"'.$namefunction->function_title.'"},'; 
                       } 
                       }
                        
                        
  
				   ?>
                ]
        });
        
        
        $("#inputchannel" + i).tokenInput([
<?php
$channel = Channel::model()->findAll();

foreach ($channel as $value) {
    echo '{id:' . $value->channel_id . ', name:"' . $value->channel_title . '"},';
}
?>
        ], {theme: "facebook", preventDuplicates: true,
            prePopulate: [
                   <?php
                        $channelselected = RoleChannel::model()->findAllBySql("select channel_id from role_channel where contact_id = $contact_id and company_id = $valuecompany->company_id");
                       if(count($channelselected)>0){
                         foreach($channelselected as $channelvalue){
                          $namechannel = Channel::model()->findByPk($channelvalue->channel_id);
                            echo  '{id:'.$namechannel->channel_id.', name:"'.$namechannel->channel_title.'"},'; 
                       }  
                       }
                        
                       ?>
                ]
        });
          });
                </script>       
                    <div class="table-responsive">
                            
                            <table class="table table-condensed">
                                <tr><td style=" width: 20%;"><b>Company</b> 
                                        <input type="text" name="company<?php echo $i ?>" id="inputcompany<?php echo $i ?>"></td>
                                    <td style=" width: 20%;"><b>Country</b> <input type="text" name="inputcountry<?php echo $i ?>" id="inputcountry<?php echo $i ?>"></td>
                                    <td><b>Functions</b> <input type="text" name="function<?php echo $i ?>" id="inputfunction<?php echo $i ?>"></td>
                                    <td><b>Channels</b> <input type="text" name="inputchannel<?php echo $i ?>" id="inputchannel<?php echo $i ?>"></td>
                                    <td><button class="delete btn btn-danger" type="button">Delete</button></td>
                                </tr></table>
                        </div>
                    <?php
                    $i++;
                }
                ?>
                
                
                <script>
               var i=<?php echo $i; ?>    
                $("#add").click(function(e) {
            document.getElementById('nbfield').value = i;
           
            //Append a new row of code to the "#items" div
            $("#items").append('<div class="table-responsive"><table class="table table-condensed"><tr><td><b>Company</b><input type="text" name="company'+i+'" id="inputcompany'+i+'"></td><td><b>Country</b><input type="text" name="inputcountry'+i+'" id="inputcountry'+i+'"></td><td><b>Functions</b><input type="text" name="function'+i+'" id="inputfunction'+i+'"></td><td><b>Channel</b><input type="text" name="inputchannel'+i+'" id="inputchannel'+i+'"></td><td><br><button class="delete btn btn-danger" type="button">Delete</button></td></tr></table></div>');

            $("#inputcompany" + i).tokenInput([
<?php
$company = Company::model()->FindAllWithNofreelance();
if(count($company)>0){
   foreach ($company as $value) {
    echo '{id:' . $value->comp_id . ', name:"' . $value->comp_name . '"},';
} 
}

?>
            ], {theme: "facebook", preventDuplicates: true, tokenLimit: 1
            });



            $("#inputcountry" + i).tokenInput([
<?php
if(count($country)>0){
foreach ($country as $value) {
    echo '{id:"' . $value->country_iso . '", name:"' . $value->country_name . '"},';
}
}
?>
            ], {theme: "facebook", preventDuplicates: true,
            });

            $("#inputfunction" + i).tokenInput([
<?php
if(count($function)>0){
foreach ($function as $value) {
    echo '{id:' . $value->function_id . ', name:"' . $value->function_title . '"},';
}
}
?>
            ], {theme: "facebook", preventDuplicates: true,
            });
            
            
            $("#inputchannel" + i).tokenInput([
<?php
if(count($channel)>0){
foreach ($channel as $value) {
    echo '{id:' . $value->channel_id . ', name:"' . $value->channel_title . '"},';
}
}
?>
            ], {theme: "facebook", preventDuplicates: true,
            });
            i++;
        });
                
                </script>
                
                
                </div>
                <br /><br />
               <div class="row">

                    <div class="col-sm-5 col-sm-9">
                        <input type="checkbox" onclick="showMe('div1')" name="freelanceactivity" id="freelanceactivity" value="freelance" class="inputradio" <?php if(count($freelanceselected)>0){  ?>checked="checked" <?php } ?> /><label>Freelance Activity?</label> 
                    </div>
                </div>
                
                <div class="row">
                 <?php if(count($freelanceselected)>0){$style='';}else{$style='style="display:none"';} ?>   
                <div id="div1" <?php echo $style ?>>
                    
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
