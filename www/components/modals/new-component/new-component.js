


$(document).ready(function () {

	$("#new-comp-form").ajaxForm({
        url: location.origin + '/controllers/components/create.php',
        type: 'post',
        success: function(data) {console.log(data); location.reload();  },
        error: function(err) {
        	console.log(err);
        	var p = document.getElementById("new-comp-result");
        	console.log(p);
        	p.innerHTML = err.statusText;
        }
    })



    var buttons = document.getElementsByClassName("new-comp-opener");


    Array.prototype.forEach.call((buttons), function(el) {
        el.addEventListener("click", function () {
            var root = this;
            var safetyCount = 0;

            while (!root.className.split(' ').includes("room")) {
                root = root.parentElement;
                safetyCount++;
                if (safetyCount > 30) {
                    console.error("Cant find root element of the room");
                    return;
                }
            }
            document.getElementById('room-id').value = root.id;
        });
    });



});
