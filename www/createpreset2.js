var MainDiv = document.getElementById("MainDiv");

var sensors = document.getElementsByClassName("li-sensor");
Array.prototype.forEach.call(sensors, function(element) {
    element.addEventListener("click", function(){
        MainDiv.innerHTML+=element.id;
        element.style="display: none;";
    })
});
