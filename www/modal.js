var modalContact = document.getElementById('modal-contact');
var buttonContact = document.getElementById("button-contact-us");

// Get the <span> element that closes the modal
var buttonCloseModal = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
buttonContact.onclick = function () {
  modalContact.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
buttonCloseModal.onclick = function () {
  modalContact.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function (event) {
  if (event.target == modalContact) {
    modalContact.style.display = "none";
  }
}