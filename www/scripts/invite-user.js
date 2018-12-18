$(document).ready(function () {

    $("#add-user-form").ajaxForm({
        url: 'http://localhost/handlers/handle_invite_user.php',
        type: 'post',
        success: function(data) {
            console.log(data);
            document.getElementById("invite-user-result").innerHTML=data;
            cancelButton.click();
        },
        error: function(err) {
            console.log(err['statustext']);
            document.getElementById("invite-user-result").innerHTML=err['statusText'];
        }
    });


});
