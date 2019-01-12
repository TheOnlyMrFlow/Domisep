$(document).ready(function () {




    var editEls = document.getElementsByClassName("edit-info");
    var showEls = document.getElementsByClassName("show-info");

    console.log(editEls);
    console.log(showEls);
    
    var cancelButton = document.getElementById("switch-change-info-off");
    var switchOnButton = document.getElementById("switch-change-info-on");

    cancelButton.onclick = () => {
        Array.prototype.forEach.call(editEls, function (el) {            
            el.style.display="none";
        });
        Array.prototype.forEach.call(showEls, function (el) {
            el.style.display="block";
        });
    }

    switchOnButton.onclick = () => {
        Array.prototype.forEach.call(editEls, function (el) {
            el.style.display="block";
        });
        Array.prototype.forEach.call(showEls, function (el) {
            el.style.display="none";
        });
    }


    $("#change-info-form").ajaxForm({
        url: location.origin + '/controllers/users/change-info.php',
        type: 'post',
        success: function(data) {
            console.log(data);
            location.reload();
        },
        error: function(err) {
            console.log(err['statustext']);
            document.getElementById("change-info-result").innerHTML=err['statusText'];
        }
    });


});
