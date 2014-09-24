<script>


    $(document).ready(function() {
        //when the Add Filed button is clicked
        var i = 1;

        /***Company Initial**/
        $("#inputcompany" + i).tokenInput([
<?php
$company = Company::model()->FindAllWithNofreelance();

foreach ($company as $value) {
    echo '{id:' . $value->comp_id . ', name:"' . $value->comp_name . '"},';
}
?>
        ], {theme: "facebook", preventDuplicates: true, tokenLimit: 1
        });

        /***Country Initial**/
        $("#inputcountry" + i).tokenInput([
<?php
$country = IsoCountry::model()->FindCountyAfrica();

foreach ($country as $value) {
    echo '{id:"' . $value->country_iso . '", name:"' . $value->country_name . '"},';
}
?>
        ], {theme: "facebook", preventDuplicates: true,
        });


        /***Function Initial**/
        $("#inputfunction" + i).tokenInput([
<?php
$function = Functions::model()->findAll();

foreach ($function as $value) {
    echo '{id:' . $value->function_id . ', name:"' . $value->function_title . '"},';
}
?>
        ], {theme: "facebook", preventDuplicates: true,
        });


        /***Channel Initial**/
        $("#inputchannel" + i).tokenInput([
<?php
$channel = Channel::model()->findAll();

foreach ($channel as $value) {
    echo '{id:' . $value->channel_id . ', name:"' . $value->channel_title . '"},';
}
?>
        ], {theme: "facebook", preventDuplicates: true,
        });


       
        $("#countryfreelance").tokenInput([
<?php
$country = IsoCountry::model()->FindCountyAfrica();

foreach ($country as $value) {
    echo '{id:"' . $value->country_iso . '", name:"' . $value->country_name . '"},';
}
?>
        ], {theme: "facebook", preventDuplicates: true,
        });
      
        $("#functionfreelance").tokenInput([
<?php
$function = Functions::model()->findAll();

foreach ($function as $value) {
    echo '{id:' . $value->function_id . ', name:"' . $value->function_title . '"},';
}
?>
        ], {theme: "facebook", preventDuplicates: true,
        });
$("#channelfreelance").tokenInput([
<?php
foreach ($channel as $value) {
    echo '{id:' . $value->channel_id . ', name:"' . $value->channel_title . '"},';
}
?>
        ], {theme: "facebook", preventDuplicates: true,
        });


        $("#add").click(function(e) {
            i++;
            document.getElementById('nbfield').value = i;
            //Append a new row of code to the "#items" div
            $("#items").append('<div class="table-responsive"><table class="table table-condensed"><tr><td><b>Company</b><input type="text" name="company' + i + '" id="inputcompany' + i + '"></td><td><b>Country</b><input type="text" name="inputcountry' + i + '" id="inputcountry' + i + '"></td><td><b>Functions</b><input type="text" name="function' + i + '" id="inputfunction' + i + '"></td><td><b>Channel</b><input type="text" name="inputchannel' + i + '" id="inputchannel' + i + '"></td><td><br><button class="delete btn btn-danger" type="button">Delete</button></td></tr></table></div>');

            $("#inputcompany" + i).tokenInput([
<?php
foreach ($company as $value) {
    echo '{id:' . $value->comp_id . ', name:"' . $value->comp_name . '"},';
}
?>
            ], {theme: "facebook", preventDuplicates: true, tokenLimit: 1
            });



            $("#inputcountry" + i).tokenInput([
<?php
foreach ($country as $value) {
    echo '{id:"' . $value->country_iso . '", name:"' . $value->country_name . '"},';
}
?>
            ], {theme: "facebook", preventDuplicates: true,
            });

            $("#inputfunction" + i).tokenInput([
<?php
foreach ($function as $value) {
    echo '{id:' . $value->function_id . ', name:"' . $value->function_title . '"},';
}
?>
            ], {theme: "facebook", preventDuplicates: true,
            });
            
            
            $("#inputchannel" + i).tokenInput([
<?php
foreach ($channel as $value) {
    echo '{id:' . $value->channel_id . ', name:"' . $value->channel_title . '"},';
}
?>
            ], {theme: "facebook", preventDuplicates: true,
            });

        });
        
        
        

       



        $("body").on("click", ".delete", function(e) {
            $(this).closest("div").remove();
        });
    });

</script>
