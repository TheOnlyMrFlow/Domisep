$(document).ready(function () {

    console.log(location.origin + ':' + (location.port || 80) + '/controllers/users/change-password.php');
    

    $("#change-password-form").ajaxForm({
        url: location.origin + '/controllers/users/change-password.php',
        type: 'post',
        success: function(data) {
            console.log(data);
            document.getElementById("change-password-result").innerHTML=data;
        },
        error: function(err) {
            console.log(err);
            document.getElementById("change-password-result").innerHTML=err['statusText'];
        }
    })


});
