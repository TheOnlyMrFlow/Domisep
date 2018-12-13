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
            var compDetailModal = document.getElementById("modal-comp-details");
            $.get(
                encodeURI('http://localhost/handlers/ajax-component-details.php?id=' + root.id),
                function (compData) {
                    console.log(compData);
                    compData = JSON.parse(compData);
                    compDetailModal.style.display = "block";
                    document.getElementById("comp-details-title").innerHTML = compData[0];
                    document.getElementById("comp-details-name").value = compData[0];

                    var roomSelect = document.getElementById("comp-details-room");

                    roomSelect.innerHTML = "";

                    $.get(
                        'http://localhost/handlers/ajax-rooms-of-house.php',
                        function (roomsData) {
                            console.log(roomsData);
                            roomsData = JSON.parse(roomsData);
                            for (var i = 0; i < roomsData.length; i++) {
                                roomSelect.innerHTML +=
                                    "<option value = '"+roomsData[i][0]+"'>" + roomsData[i][1] + "</option>";

                            }
                            roomSelect.value = compData[2];
                        }
                    );


                });
        });
    });



});
