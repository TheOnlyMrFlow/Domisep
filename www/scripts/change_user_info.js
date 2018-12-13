$(document).ready(function () {

    $("#change-info-form").ajaxForm({
        url: 'http://localhost/handlers/handle_change_user_info.php',
        type: 'post',
        success: function(data) {
            console.log(data);
            document.getElementById("change-info-result").innerHTML=data;
        },
        error: function(err) {
            console.log(err['statustext']);
            document.getElementById("change-info-result").innerHTML=err['statusText'];
        }
    })


});
