$('document').ready(function () {

    let signupOpeners = document.getElementsByClassName("signup-opener");
    let loginOpeners = document.getElementsByClassName("login-opener");
    let contactOpeners = document.getElementsByClassName("contact-opener");
    let newCompOpeners = document.getElementsByClassName("new-comp-opener");

    let signupCloser = document.getElementById("close-signup");
    let loginCloser = document.getElementById("close-login");
    let contactCloser = document.getElementById("close-contact");
    let newCompCloser = document.getElementById("close-new-comp");


    let signupModal = document.getElementById("modal-signup");
    let loginModal = document.getElementById("modal-login");
    let contactModal = document.getElementById("modal-contact");
    let newCompModal = document.getElementById("modal-new-comp");




    Array.prototype.forEach.call(signupOpeners, function (el) {
        el.addEventListener("click", function () {
            if (signupModal != undefined) {
                signupModal.style.display = "block";
            }
        });
        console.log(el.tagName);
    });

    Array.prototype.forEach.call(loginOpeners, function (el) {
        el.addEventListener("click", function () {
            if (loginModal != undefined) {
                loginModal.style.display = "block";
            }
        });
        console.log(el.tagName);
    });

    Array.prototype.forEach.call(contactOpeners, function (el) {
        el.addEventListener("click", function () {
            if (contactModal != undefined) {
                contactModal.style.display = "block";
            }
        });
        console.log(el.tagName);
    });

    Array.prototype.forEach.call(newCompOpeners, function (el) {
        el.addEventListener("click", function () {
            if (newCompModal != undefined) {
                newCompModal.style.display = "block";
            }
        });
        console.log(el.tagName);
    });

    if (signupCloser != undefined){
      signupCloser.addEventListener("click", function () {
          if (signupModal != undefined) {
              signupModal.style.display = "none";
          }
      });
    };

     if(loginCloser != undefined){
       loginCloser.addEventListener("click", function () {
           if (loginModal != undefined) {
               loginModal.style.display = "none";
           }
       });
     };


    contactCloser.addEventListener("click", function () {
        if (contactModal != undefined) {
            contactModal.style.display = "none";
        }
    });

    newCompCloser.addEventListener("click", function () {
        if (newCompModal != undefined) {
            newCompModal.style.display = "none";
        }
    });

    jQuery('.modal').click(function (e) {
        e.stopPropagation();
        if (!jQuery(e.target).closest('.modal-content').length && jQuery(e.target).is('.modal')) {
            jQuery('.modal').css({
                'display': 'none',
            });
        }
    });

});
