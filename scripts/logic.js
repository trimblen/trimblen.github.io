//unseable at the moment
function verifyIDs() {
    var selectlist  = document.getElementById("idSelect");
    console.log(selectlist.options.length);
	
    if(!selectlist.options.length > 1) {
        alert(selectlist.options.length);
        return false;
    }
}

function addIDs() {
    var paremeter_id        = document.getElementsByName('parameter_id');
    var paremeter_value     = paremeter_id[0].value;
    var selectlist          = document.getElementById("idSelect");

    console.log(selectlist);
   // alert(paremeter_value);
    if (paremeter_value == "") {
        alert("Please, enter id!");
		
        return;
    }

    var id_array = paremeter_value.split(",")
   // alert(id_array.length);
    if(id_array.length == 0){
        alert("Net id cherez zapyatuu!");
        return;
    }

    for (var i = 0; i < id_array.length; i++) {
        //alert(id_array[i]);
        if(id_array[i]!= " " && !isNaN(id_array[i])) {
          var isSim   =  getSimiliarValue(id_array[i], selectlist);
          if (!isSim){
              var newOption = document.createElement('option');
              newOption.text   =  id_array[i].toString();
              newOption.value  =  id_array[i];
              newOption.id     =  id_array[i];
              selectlist.add(newOption);
          }
        }
    }
}

function getSimiliarValue(array_comma_element, select_array){
    var isSimiliar = false;
	
       for (var i = 0; i < select_array.options.length; i++) {
            var option = select_array.options[i];
            if (array_comma_element.toString() == option.text){
                isSimiliar = true;
            }
        }

    return isSimiliar;
}

function deleteIDs() {
    var selectlist  = document.getElementById("idSelect");
    valuefordelete  = selectlist.selectedIndex;
	
    if(valuefordelete !== -1) {
        selectlist.removeChild(selectlist[valuefordelete]);
    }
}


function changeRequisites(req_id) {
    var addID       = document.getElementById("addID");
    var delID       = document.getElementById("delID");
    var desID       = document.getElementById("descriptionID");
    var selectlist  = document.getElementById("idSelect");

    if (req_id=="heroes_info"){
        addID.value         = "Добавить игрока...";
        delID.value         = "Удалить  игрока...";
        desID.placeholder   = "Выбранные игроки";
		
        selectlist.setAttribute('required',   "");
        //console.log(selectlist);

    }   else if(req_id=="places_info"){
        addID.value         = "Добавить город...";
        delID.value         = "Удалить  город...";
        desID.placeholder   = "Выбранные города";

        selectlist.removeAttribute('required');
        //console.log(selectlist);
    }   else{

        addID.value         = "Добавить мастера...";
        delID.value         = "Удалить  мастера...";
        desID.placeholder   = "Выбранные мастера";
		
        selectlist.setAttribute('required',   "");
        //console.log(selectlist);
    }
}