
function AddToBlack() {

    source = blacklistform.elements['client_id[]'];
    destination = blacklistform.elements['client_id_black[]'];
    for (var i = 0; i < source.options.length; i++) {
        if (source.options[i].selected == true) {
            var option = document.createElement("option");
            option.text = source.options[i].text;
            option.value = source.options[i].value;
            destination.add(option);
        }
    }
    for (var i = 0; i < destination.options.length; i++) {
        destination.options[i].selected = true;
        for (var j = 0; j < source.options.length; j++) {
            if (destination.options[i].value == source.options[j].value) {
                source.remove(j);
            }
        }
    }

}


function AddAllToBlack() {

    source = blacklistform.elements['client_id[]'];
    destination = blacklistform.elements['client_id_black[]'];
    for (var i = 0; i < source.options.length; i++) {
        var option = document.createElement("option");
        option.text = source.options[i].text;
        option.value = source.options[i].value;
        destination.add(option);
        destination.options[i].selected = true;
    }
    $('#tagCreate')
            .find('option')
            .remove()
            .end();

}


function RemoveAllFromBlack() {

    destinationid = document.getElementById("tagUpdate");
    source = blacklistform.elements['client_id[]'];
    destination = blacklistform.elements['client_id_black[]'];

    for (var i = 0; i < destination.options.length; i++) {
        var option = document.createElement("option");
        option.text = destination.options[i].text;
        option.value = destination.options[i].value;
        source.add(option);
        source.options[i].selected = true;
    }

    $('#tagUpdate')
            .find('option')
            .remove()
            .end();

}


function RemoveFromBlack() {


    source = blacklistform.elements['client_id[]'];
    destination = blacklistform.elements['client_id_black[]'];
    for (var i = 0; i < destination.options.length; i++) {
        if (destination.options[i].selected == true) {
            var option = document.createElement("option");
            option.text = destination.options[i].text;
            option.value = destination.options[i].value;
            source.add(option);
        }
    }
    for (var i = 0; i < source.options.length; i++) {
        source.options[i].selected = true;
        for (var j = 0; j < destination.options.length; j++) {
            if (source.options[i].value == destination.options[j].value) {
                destination.remove(j);
            }
        }
    }


}

