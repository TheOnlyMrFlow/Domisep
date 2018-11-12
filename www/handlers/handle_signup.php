<?php
session_start();


$errors = array(); 

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'mff');

// REGISTER USER
if (isset($_POST['signup'])) {
  // receive all input values from the form
  $lastName = mysqli_real_escape_string($db, $_POST['lastname']);
  $firstName = mysqli_real_escape_string($db, $_POST['firstname']);
  $birthDate = mysqli_real_escape_string($db, $_POST['birthdate']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $phone = mysqli_real_escape_string($db, $_POST['phone']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password2']);
  $serialNumber = mysqli_real_escape_string($db, $_POST['serialnumber']);
  $address = mysqli_real_escape_string($db, $_POST['address']);
  $city = mysqli_real_escape_string($db, $_POST['city']);
  $zipCode = mysqli_real_escape_string($db, $_POST['zipcode']);
  $country = mysqli_real_escape_string($db, $_POST['country']);


  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($lastName)) { array_push($errors, "Last name is required"); }
  if (empty($firstName)) { array_push($errors, "First name is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($phone)) { array_push($errors, "Phone number name is required"); }
  if (empty($password1)) { array_push($errors, "Password is required"); }
  if (empty($password2)) { array_push($errors, "Password confirmation is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }
  if (empty($serialNumber)) { array_push($errors, "Your product's serial number is required"); }
  if (empty($address)) { array_push($errors, "Your address is required"); }
  if (empty($city)) { array_push($errors, "Your city is required"); }
  if (empty($zipCode)) { array_push($errors, "Your zip code is required"); }
  if (empty($country)) { array_push($errors, "Your country is required"); }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    array_push($errors, "Email already exists");
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = $password1;//va falloir l'encrypter plus tard

    $newHomeQuery = "INSERT INTO homes (address, city, zip_code, country) VALUES ('$address', '$city', '$zipCode', '$country')";
    mysqli_query($db, $query);
    $homeId = mysqli_insert_id($con);


  	$newUserQuery = "INSERT INTO users (first_name last_name, email, birthdate, phone, password, id_home) 
  			  VALUES('$firstName', '$lastName', '$email', '$birthDate', '$phone', '$password', '$homeID')";
  	mysqli_query($db, $newUserQuery);
  	$_SESSION['email'] = $email;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: index.php');
  }
}
