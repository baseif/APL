<?php
/* @var $this SiteController */

$this->pageTitle = Yii::app()->name;
?>

<h1 class="title">

<?php echo  Yii::t('app','What does it cost?');?> </h1>
<hr />
<div class="row">
    <div class="span-12" >   
        <div class="homeparagraph">
            <h3>

<?php echo  Yii::t('app',' Annual subscription');?></h3>
         

<?php echo  Yii::t('app','We have priced the press release sent to any journalist by way of credits. We do this in order to avoid “send all” actions and promote the use of differentiated campaign lists. The annual subscription entitles you to 9.000 credits. Additional credits can be bought by subscribers at the lowest price, i.e. € 0.25 or USD 0.35.
       ');?>     </div>
    </div>
    <div class="span-8" >   
        <div class="homeparagraph">
            <div style="color:#005581; font-size:20px; vertical-align:text-top">
        
<?php echo  Yii::t('app',' Access to  ');?>    <b>
<?php echo  Yii::t('app',' all ');?>   </b> 
<?php echo  Yii::t('app',' african ');?>   <br>
<?php echo  Yii::t('app',' countries ');?>     <br>
            <br>
            <b>
<?php echo  Yii::t('app',' 9000 credits included ');?>   </b>
            </div>
        <br>
        <div style="font-size:36px; color:#ff0000;">
            <b>€ 2.450,00<br>
                <br>
            </b>
        </div>
        </div>
    </div>
    <div class="span-8" >   
        <?php echo CHtml::image(Yii::app()->request->baseUrl . '/images/country-picture.jpg', ''); ?>
    </div>

</div>
<hr />
<div class="row">
    <div class="span-12" >   
        <div class="homeparagraph">
            <h3>
<?php echo  Yii::t('app','   Starters Offer');?>  </h3>
            
<?php echo  Yii::t('app',' We also have an offer for starters without having to take the full subscription. You can start using the Africa Press List for only € 350, not limited in time. You get 1.000 credits with this option. One credit stands for one press release sent to one journalist. Accordingly, with these credits you can send one press release to 1.000 journalists, or 2 press releases to 500 journalists or 10 press releases to 100 journalists, etcetera
      ');?>  
             </div>
    </div>
    <div class="span-8" >   
        <div class="homeparagraph">
         <div style="color: rgb(0, 85, 129); font-size: 20px; vertical-align: text-top;">
<br>

<?php echo  Yii::t('app','Access to');?> <b>
    
<?php echo  Yii::t('app','all');?></b> 

<?php echo  Yii::t('app','african');?><br>

<?php echo  Yii::t('app','countries');?>
</div>
<div style="color:#005581; font-size:20px; vertical-align:text-top">
<b><br>

<?php echo  Yii::t('app','1000 credits included');?></b></div>
<br>
<div style="font-size:36px; color:#ff0000;">
<b>€ 350,00<br>
<br>
</b></div>   
    </div>
    </div>
    <div class="span-8" >   
        <?php echo CHtml::image(Yii::app()->request->baseUrl . '/images/country-picture.jpg', ''); ?>
    </div>

</div>




