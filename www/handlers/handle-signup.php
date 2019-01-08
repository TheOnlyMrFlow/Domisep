<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once('../models/User.php');
require_once('../models/FormException.php');

if (isset($_POST['signup'])) {
  // receive all input values from the form
  $lastName = $_POST['lastname'];
  $firstName = $_POST['firstname'];
  $birthDate = $_POST['birthdate'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $password1 = $_POST['password1'];
  $password2 = $_POST['password2'];
  $serialNumber = $_POST['serialnumber'];
  $address = $_POST['address'];
  $city = $_POST['city'];
  $zipCode = $_POST['zipcode'];
  $country = $_POST['country'];

  try {
    User::signup($lastName,  $firstName,  $birthDate,  $email,  $phone,  $password1,  $password2,  $serialNumber,  $address,  $city,  $zipCode,  $country);
    echo "<script>window.top.location.href =  'http://' + window.location.hostname + '/my-house.php'; </script>";
  }
  catch(FormException $e){
    echo $e->getMessage();
    exit();
  }


}
