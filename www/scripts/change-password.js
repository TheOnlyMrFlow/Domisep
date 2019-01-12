$(document).ready(function () {

    $("#change-password-form").ajaxForm({
        url: location.origin + '/controllers/users/change-password.php',
        type: 'post',
        success: function(data) {
            console.log(data);
            document.getElementById("change-password-result").innerHTML=data;
        },
        error: function(err) {
            console.log(err['statustext']);
            document.getElementById("change-password-result").innerHTML=err['statusText'];
        }
    })


});
