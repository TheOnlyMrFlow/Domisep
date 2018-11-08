

let signupOpeners = document.getElementsByClassName("signup-opener");
let loginOpeners = document.getElementsByClassName("login-opener");
let contactOpeners = document.getElementsByClassName("contact-opener");

let signupCloser = document.getElementById("close-signup");
let loginCloser = document.getElementById("close-login");
let contactCloser = document.getElementById("close-contact");

let signupModal = document.getElementById("modal-signup");
let loginModal = document.getElementById("modal-login");
let contactModal = document.getElementById("modal-contact");


Array.prototype.forEach.call(signupOpeners, function(el) {
    el.addEventListener("click", function(){
        if (signupModal != undefined){
            signupModal.style.display = "block";
        }
    });
    console.log(el.tagName);
});

Array.prototype.forEach.call(loginOpeners, function(el) {
    el.addEventListener("click", function(){
        if (loginModal != undefined){
            loginModal.style.display = "block";
        }
    });
    console.log(el.tagName);
});

Array.prototype.forEach.call(contactOpeners, function(el) {
    el.addEventListener("click", function(){
        if (contactModal != undefined){
            contactModal.style.display = "block";
        }
    });
    console.log(el.tagName);
});




signupCloser.addEventListener("click", function() {
    if (signupModal != undefined){
        signupModal.style.display = "none";
    }
});

loginCloser.addEventListener("click", function() {
    if (loginModal != undefined){
        loginModal.style.display = "none";
    }
});

contactCloser.addEventListener("click", function() {
    if (contactModal != undefined){
        contactModal.style.display = "none";
    }
});
