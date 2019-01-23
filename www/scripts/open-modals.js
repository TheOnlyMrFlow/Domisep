$(document).ready(function() {

  var signupOpeners = document.getElementsByClassName("signup-opener");
  var loginOpeners = document.getElementsByClassName("login-opener");
  var contactOpeners = document.getElementsByClassName("contact-opener");
  var newCompOpeners = document.getElementsByClassName("new-comp-opener");
  var compDetailsOpeners = document.getElementsByClassName("comp-details-opener");

  var signupCloser = document.getElementById("close-signup");
  var loginCloser = document.getElementById("close-login");
  var contactCloser = document.getElementById("close-contact");
  var newCompCloser = document.getElementById("close-new-comp");
  var compDetailsCloser = document.getElementById("close-comp-details");


  var signupModal = document.getElementById("modal-signup");
  var loginModal = document.getElementById("modal-login");
  var contactModal = document.getElementById("modal-contact");
  var newCompModal = document.getElementById("modal-new-comp");
  var compDetailsModal = document.getElementById("modal-comp-details");

  jQuery('.modal').click(function(e) {
    e.stopPropagation();
    if (!jQuery(e.target).closest('.modal-content').length && jQuery(e.target).is('.modal')) {
      document.getElementById('myChart').style.display = 'none';
      jQuery('.modal').css({
        'display': 'none',
      });
    }
  });

  Array.prototype.forEach.call(signupOpeners, function(el) {
    el.addEventListener("click", function() {
      jQuery('.modal').css({
        'display': 'none',
      });
      if (signupModal != undefined) {
        signupModal.style.display = "block";
      }
    });
    console.log(el.tagName);
  });

  Array.prototype.forEach.call(loginOpeners, function(el) {
    el.addEventListener("click", function() {
      jQuery('.modal').css({
        'display': 'none',
      });
      if (loginModal != undefined) {
        loginModal.style.display = "block";
      }
    });
    console.log(el.tagName);
  });

  Array.prototype.forEach.call(contactOpeners, function(el) {
    el.addEventListener("click", function() {
      jQuery('.modal').css({
        'display': 'none',
      });
      if (contactModal != undefined) {
        contactModal.style.display = "block";
      }
    });
    console.log(el.tagName);
  });

  Array.prototype.forEach.call(newCompOpeners, function(el) {
    el.addEventListener("click", function() {
      jQuery('.modal').css({
        'display': 'none',
      });
      if (newCompModal != undefined) {
        newCompModal.style.display = "block";
      }
    });
    console.log(el.tagName);
  });

  Array.prototype.forEach.call(compDetailsOpeners, function(el) {
    el.addEventListener("click", function() {
      jQuery('.modal').css({
        'display': 'none',
      });
      if (compDetailsModal != undefined) {
        compDetailsModal.style.display = "block";
      }
    });
    console.log(el.tagName);
  });

  if (signupCloser != undefined) {
    signupCloser.addEventListener("click", function() {
      if (signupModal != undefined) {
        signupModal.style.display = "none";
      }
    });
  };

  if (loginCloser != undefined) {
    loginCloser.addEventListener("click", function() {
      if (loginModal != undefined) {
        loginModal.style.display = "none";
      }
    });
  };

  contactCloser.addEventListener("click", function() {
    if (contactModal != undefined) {
      contactModal.style.display = "none";
    }
  });

  newCompCloser.addEventListener("click", function() {
    if (newCompModal != undefined) {
      newCompModal.style.display = "none";
    }
  });

  compDetailsCloser.addEventListener("click", function() {
    if (compDetailsModal != undefined) {
      document.getElementById('myChart').style.display = 'none';
      compDetailsModal.style.display = "none";
    }
  });

});
