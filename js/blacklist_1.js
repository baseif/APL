
function AddToBlack(){       
        
            source = blacklistform.elements['client_id[]'];
            destination = blacklistform.elements['client_id_black[]'];            
       for (var i = 0; i < source.options.length; i++) {
            if (source.options[i].selected == true) {
                var trouve = 0;
                for (var j = 0; j < destination.options.length; j++) {
                    if (source.options[i].value == destination.options[j].value) {
                        trouve = 1;
                    }
                }
                if (trouve == 0) {
                    var option = document.createElement("option");
                    option.text = source.options[i].text;
                    option.value = source.options[i].value;
                    destination.add(option);
                }
            }
        }
        for (var i = 0; i < destination.options.length; i++) {
            destination.options[i].selected = true;
        }        
        
 }
 
 
  function AddAllToBlack(){       
        
            source = blacklistform.elements['client_id[]'];   
            destination = blacklistform.elements['client_id_black[]'];  
      destinationid = document.getElementById("tagUpdate");

        $('#tagUpdate')
                .find('option')
                .remove()
                .end();
        for (var i = 0; i < source.options.length; i++) {
            var option = document.createElement("option");
            option.text = source.options[i].text;
            option.value = source.options[i].value;
            destination.add(option);
            destination.options[i].selected = true;
        }         
     
 }
 
 
 function RemoveAllFromBlack(){       
           
            destinationid = document.getElementById("tagUpdate");

        $('#tagUpdate')
                .find('option')
                .remove()
                .end();        
       
 }
 
 
 function RemoveFromBlack(){       
       
            source = blacklistform.elements['client_id[]'];   
            destination = blacklistform.elements['client_id_black[]']; 
        var matrix = [];
        var j = 0;
        for (var i = 0; i < destination.options.length; i++) {
            if (destination.options[i].selected != true) {
                matrix[j] = [];
                matrix[j][0] = destination.options[i].value;
                matrix[j][1] = destination.options[i].text;
                j++;
               
            }
        }
        $('#tagUpdate')
                .find('option')
                .remove()
                .end();
        
        for(var i =0; i<j; i++){
            var option = document.createElement("option");
            option.value = matrix[i][0];
            option.text = matrix[i][1];
            destination.add(option);
            destination.options[i].selected = true;
        }       
        
 }

