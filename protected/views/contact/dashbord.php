


<h1>
<?php echo  Yii::t('app','Account Overview');?></h1>
<div class="row">
 
    <div class="span-9">
        <div class="udetail-box">
            <h3 class="udash-header"><?php echo  Yii::t('app','Personal Information');?></h3>
            <img width="92" height="83" src="<?php echo Yii::app()->request->baseUrl; ?>/images/dash-info.png">
            <table cellspacing="0" cellpadding="2" style="margin-top: 15px;">
                <tbody><tr><td><?php echo  Yii::t('app','Name');?>:</td>
                        <td><?php echo $model->contact_name_first.' '.$model->contact_name_last; ?></td></tr><tr>
                    </tr><tr><td><?php echo  Yii::t('app','Email');?>:</td>
                        <td><a href="mailto:<?php echo $model->contact_email; ?>"><?php echo $model->contact_email; ?></a></td></tr><tr>
                    </tr><tr><td><?php echo  Yii::t('app','Phone');?>:</td>
                        <td><?php echo $model->contact_phone; ?></td></tr><tr>
                    </tr><tr><td><?php echo  Yii::t('app','Address');?>:</td>
                        <td><?php echo $model->contact_adress.' '.$model->contact_address_nr; ?></td></tr><tr>
                    </tr><tr><td style="color:red;" colspan="2"></td></tr>
                </tbody></table>

            <a title="Modify your account details" href="">
                <div style="margin-top: 45px;" class="us-button-edit-profile"></div>
            </a>

        </div>
       </div>
<div class="span-9">
        <div class="udetail-box">
            <h3 class="udash-header"><?php echo  Yii::t('app','Country');?>:</h3>
            <img width="92" height="83" src="<?php echo Yii::app()->request->baseUrl; ?>/images/dash-company.png">
            <table cellspacing="0" cellpadding="2" style="margin-top: 15px;">
                <tbody>
                    <tr><td><?php echo  Yii::t('app','Country');?>:</td>
                        <td><?php 
                        
                       
                        if ($model->contact_iso_country){
                         echo IsoCountry::model()->GetCountryName($model->contact_iso_country);
                        } ?>
                        </td></tr>
                    <tr><td><?php echo  Yii::t('app','City');?>:</td>
                        <td><?php echo $model->contact_city; ?></td></tr>
                    <tr><td><?php echo  Yii::t('app','Adress');?>:</td>
                        <td><?php echo $model->contact_adress; ?></td></tr>
                    <tr><td><?php echo  Yii::t('app','Addon');?>:</td>
                        <td><?php echo $model->contact_address_addon; ?></td></tr>
                    </tbody></table>



        </div>
</div>
    <div class="span-9">

        <div class="udetail-box">
            <h3 class="udash-header"><?php echo  Yii::t('app','Social Network');?></h3>
            <img width="92" height="83" src="<?php echo Yii::app()->request->baseUrl; ?>/images/dash-stats.png">
            <table cellspacing="0" cellpadding="2" style="margin-top: 15px;">
                <tbody>
                    <tr><td>Website:</td>
                        <td><?php echo $model->contact_website; ?></td></tr>
                    <tr><td>Facebook:</td>
                        <td><?php echo $model->contact_fb; ?></td></tr>
                    <tr><td>Twitter:</td>
                        <td><?php echo $model->contact_tw; ?></td></tr>
                    <tr><td>Google +:</td>
                        <td><?php echo $model->contact_go; ?></td></tr>
                    </tbody></table>

            <div>

                <!-- <a href="/en/profile/add-credits.html" title="Buy more credits">
                <div class="us-button-buy" style="margin-bottom: 6px; margin-top: 2px;"></div>
                </a> -->



            </div>

        </div>
    </div>
    </div>
