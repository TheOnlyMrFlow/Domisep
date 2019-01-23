<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once(dirname(__FILE__) . '/../../models/User.php');
require_once(dirname(__FILE__) . '/../../models/FormException.php');

if (isset($_POST['signup'])) {

  if (  !isset($_POST['lastname']) ||
        !isset($_POST['firstname']) ||
        !isset($_POST['birthdate']) ||
        !isset($_POST['email']) ||
        !isset($_POST['phone']) ||
        !isset($_POST['password1']) ||
        !isset($_POST['password2']) ||
        !isset($_POST['serialnumber']) ||
        !isset($_POST['address']) ||
        !isset($_POST['city']) ||
        !isset($_POST['zipcode']) ||
        !isset($_POST['country'])) {

          header('Location: ./index.php');

        }
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

// to signup to an already existing house, thanx to an invitation key
else if (isset($_POST['signup-member'])) {

echo ' on est la ';
  if (  !isset($_POST['lastname']) ||
        !isset($_POST['firstname']) ||
        !isset($_POST['birthdate']) ||
        !isset($_POST['email']) ||
        !isset($_POST['phone']) ||
        !isset($_POST['password1']) ||
        !isset($_POST['password2']) ||
        !isset($_POST['key'])) {

          echo ' on est ici meme';
          //header('Location: ../index.php');

        }


  $lastName = $_POST['lastname'];
  $firstName = $_POST['firstname'];
  $birthDate = $_POST['birthdate'];
  $password1 = $_POST['password1'];
  $password2 = $_POST['password2'];
  $phone = $_POST['phone'];



  $email = $_POST['email'];
  $key = $_POST['key'];

  try {
    $signupResult = User::signupMember($lastName, $firstName, $birthDate, $email, $phone, $password1, $password2, $key);
    if (!$signupResult) {
      // echo qquechose de pas beau
    }
  }
  catch(FormException $e){
    echo $e->getMessage();
    exit();
  }




}
