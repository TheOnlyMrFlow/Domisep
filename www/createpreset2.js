var addedZone = document.getElementById("addedZone");
var select = document.getElementById("select-sensor");
//var sensors = document.getElementsByClassName("li-sensor");


    select.addEventListener("change", function () {

        var el = this.options[this.selectedIndex];
        var data = {
            'serialNumber' : el.value
        };
        $.post('handlers/handle_display_component.php', data, function(response){
            addedZone.innerHTML += response;
        })
        //addedZone.innerHTML += el.value;
    });

function clickCallback(){ 
}



