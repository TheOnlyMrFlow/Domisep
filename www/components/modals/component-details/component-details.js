$(document).ready(function () {

    $("#comp-details-form").ajaxForm({ url: 'localhost/handlers/handlers-modify-component.php', type: 'post' })


    $(".bouton_3_points").click(function () {
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
        let compDetailModal = document.getElementById("modal-comp-details");
        $.get(
            'http://localhost/handlers/ajax-component-details.php?id=' + root.id,
            function (data) {
                data = JSON.parse(data);
                compDetailModal.style.display = "block";
                document.getElementById("comp-details-title").innerHTML = data[0];
                document.getElementById("comp-details-name").value = data[0];
                

            });
    });
});
