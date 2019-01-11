$(document).ready(function () {

    $("#comp-details-form").ajaxForm({
        url: 'http://localhost/handlers/handle-modify-component.php',
        type: 'post',
        success: function(data) {console.log(data); location.reload();},
        error: function(err) {console.log("An error occured");}
    })

    var buttons = document.getElementsByClassName("bouton_3_points");


    Array.prototype.forEach.call((buttons), function(el) {
        el.addEventListener("click", function () {
            var root = this;
            var safetyCount = 0;

            while (!root.className.split(' ').includes("component")) {
                root = root.parentElement;
                safetyCount++;
                if (safetyCount > 30) {
                    console.error("Cant find root element of the component");
                    return;
                }
            }
            document.getElementById('comp-details-id').value = root.id;
            
            
            
            $.get(
                encodeURI('http://localhost/controllers/components/details-json.php?id=' + root.id),
                function (compData) {
                    console.log(compData);
                    compData = JSON.parse(compData);
                    
                    document.getElementById("comp-details-title").innerHTML = compData['name'];
                    document.getElementById("comp-details-name").value = compData['name'];

                    var roomSelect = document.getElementById("comp-details-room");

                    roomSelect.innerHTML = "";

                    $.get(
                        'http://localhost/controllers/rooms/list-json.php',
                        function (roomsData) {
                            console.log(roomsData);
                            roomsData = JSON.parse(roomsData);
                            for (var i = 0; i < roomsData.length; i++) {
                                roomSelect.innerHTML +=
                                    "<option value = '"+roomsData[i]['id']+"'>" + roomsData[i]['name'] + "</option>";

                            }
                            roomSelect.value = compData['id_room'];
                        }
                    );


                });
        });
    });



});
