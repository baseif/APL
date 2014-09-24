<?php
/* @var $this SiteController */

$this->pageTitle = Yii::app()->name;
?>

<h1 class="title">

<?php echo  Yii::t('app','Why the Africa Press List ?');?> </h1>
<hr />
<div class="row">
    <div class="span-16" >   
        <div class="homeparagraph">




<?php echo  Yii::t('app','The Africa Press List wishes to provide an effective and efficient solution to </br>
            international organizations and companies that want to reach an (press) audience that </br>
            is African or has an interest in Africa.');?> 
           </br>
            </br>
            </br>
          

<?php echo  Yii::t('app','If the following complies with your needs, we recommend you to sign-up.');?>  </br></br>

            <ul >
                <li class="li2">

<?php echo  Yii::t('app','Social media integrated press release campaigns');?> </li>
                <li class="li2">

<?php echo  Yii::t('app','You can personalize the search system in the database with own search terms');?> </li>
                <li class="li2">

<?php echo  Yii::t('app','More than 30 thematic categories to select journalists and media titles');?> </li>
                <li class="li2">

<?php echo  Yii::t('app','You can select entire Africa, regions, countries and cities');?> </li>
                <li class="li2">

<?php echo  Yii::t('app',' Draft your own selection lists and keep these online available');?></li>
                <li class="li2">

<?php echo  Yii::t('app','Keep a history of your press releases sent out');?> </li>
                <li class="li2">

<?php echo  Yii::t('app','All press releases are published on the blog of Africa Business Communities and</li>
                redistributed to the biggest Africa related Linkedin groups and twitter channels');?> 
            </ul>
            

<?php echo  Yii::t('app','In a later phase, we will launch the Africa Press List for local companies or organizations only active in some or only one country(ies) in Africa. Herewith, the Africa Press List provides flexible local solutions at low costs.</p>
            ');?> 
            <p>&nbsp;</p>
        
        <hr />
        

<?php echo  Yii::t('app','
Stay up to date with our newest development and services.
You can also follow us on social media.');?> 

        </div>
    </div>
    <div class="span-12" >
        
        <a href="<?php echo Yii::app()->request->baseUrl ?>/user/create"><?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/addpressrel.jpg', ''); ?></a><br /><br />
        <a href="<?php echo Yii::app()->request->baseUrl ?>/contact/create"> <?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/registerjour.jpg', ''); ?></a>
    </div>
</div>


