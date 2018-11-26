var addedZone = document.getElementById("addedZone");

var sensors = document.getElementsByClassName("li-sensor");

for (var i = 0; i < sensors.length; i++) {
    sensors[i].addEventListener("click", function () {
        console.log(this.id);
        addedZone.innerHTML += '<p>' + this.id + '</p>';
        this.style = "display: none;";
    });
}

function clickCallback(){
    
}