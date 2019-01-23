$(document).ready(function() {
  $("#login-form").ajaxForm({
    url: location.origin + "/controllers/users/login.php",
    type: "post",
    success: function(data) {
      console.log(data);
      if (data == "ok") {
        window.location.href = location.origin + "/my-house.php";
      } else if (data == "admin") {
        window.location.href = location.origin + "/admin-main.php";
      }
      document.getElementById("login-result").innerHTML = data;
    },
    error: function(err) {
      console.log(err["statustext"]);
      document.getElementById("login-result").innerHTML = err["statusText"];
    }
  });
});
