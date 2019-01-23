$(document).ready(function() {
  $("#signup-form").ajaxForm({
    url: location.origin + "/controllers/users/signup.php",
    type: "post",
    success: function(data) {
      console.log(data);
      if (data == "ok") {
        window.location.href = location.origin + "/my-house.php"; //www.google.com";
      }
      document.getElementById("signup-result").innerHTML = data;
    },
    error: function(err) {
      console.log(err["statustext"]);
      document.getElementById("signup-result").innerHTML = err["statusText"];
    }
  });
});
