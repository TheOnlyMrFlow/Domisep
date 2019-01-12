$(document).ready(function () {

    console.log(location);

    $("#add-user-form").ajaxForm({
        url: location.origin + ':' + (location.port || 80) + '/controllers/users/invite-member.php',
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
