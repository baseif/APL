<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/main.js"></script>
<h1>Buy Credits</h1>
<div class="span-12">
<div class="form">

    
     <form method="post" action="" id="profile-form" class="well form-horizontal"> 
    <div class="row">
         
    </div>
                <?php $url = Yii::app()->request->baseUrl.'/index.php/Client/calculateprice'; ?>
         <div class="row">     
             <label class="col-sm-4 control-label" style="font-size:16px;">Choose your Credit</label>
             <div class="col-sm-5 col-sm-9">
             <input name="credit" type="text"  maxlength="40" placeholder="credit" class="form-control" onkeyup="calculatePrice('<?php echo $url ?>',this.value);">
          </div>
             </div>
         <div class="row"> 
              <label class="col-sm-4 control-label" style="font-size:16px;">Total Price</label>

             <div id="price" class="col-sm-5 col-sm-9 price" >
                 0 €
                 <br />
                 0 $
             </div>
             
             
         </div>
         <div class="row">
            <div class="buttons pull-right">
                
                <input type="submit" name="send" value="Choose" disabled id="choose" class="btn btn-success btn-lg" />
                
            </div>
            </div>
    </form>
    </div>
        
    </div>
<div class="span-14 ">
    <div class="well form-horizontal">
    <div id="list_de_trucs" class="table-responsive">
        <b>Buy Credits for single use or without subscription</b>
<table class="table table-bordered table-condensed table-body-center">
    
    <tr>
        
        <th>Administration free</th><th>from</th><th>to</th><th>395 €</th><th>525 $</th>
        
    </tr>
    <tr><td></td><td>-</td><td>1000</td><td>0.45 €</td><td>0.61 $</td></tr>
    <tr><td></td><td>1000</td><td>2500</td><td>0.40 €</td><td>0.54 $</td></tr>
    <tr><td></td><td>2500</td><td>5000</td><td>0.35 €</td><td>0.47 $</td></tr>
    <tr><td></td><td>5000</td><td>10000</td><td>0.30 €</td><td>0.41 $</td></tr>
    <tr><td></td><td>10000</td><td>-</td><td>0.25 €</td><td>0.61 $</td></tr>
</table>
    
</div>
    </div>
</div>
