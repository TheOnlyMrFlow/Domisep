<?php

require_once (dirname(__FILE__) . '/../../utils/dbconnect.php');
require_once (dirname(__FILE__) . '/../../models/User.php');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if(!isset($_SESSION['role']) || $_SESSION['role']!='administrator'){
  header('Location: /index.php');
  exit();
}
if(!isset($_SESSION['language'])){
	$_SESSION['language'] = 'en';
}

if (isset($_POST['new-admin']))
{
    $db = dbconnect();
    $firstName = mysqli_real_escape_string($db, $_POST['firstname']);
    $lastName = mysqli_real_escape_string($db, $_POST['lastname']);
    $phoneNumber = mysqli_real_escape_string($db, $_POST['phonenumber']);
    $mail = mysqli_real_escape_string($db, $_POST['mail']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
    $repeatPassword = mysqli_real_escape_string($db, $_POST['repeatpassword']);

    if (empty($firstName)
        ||
        empty($lastName)
        ||
        empty($phoneNumber)
        ||
        empty($mail)
        ||
        empty($password)
        ||
        empty($repeatPassword)
        ||
        !filter_var($mail, FILTER_VALIDATE_EMAIL)
        ||
        $password != $repeatPassword
        ||
        !User::checkPasswordValidity($password)
        ) {
            echo 'Either password or mail is invalid, or passwords inputs dont match';
            exit();
        }

    $stmt = $db->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $mail);
    $stmt->execute();
    $res = $stmt->get_result();
    if ($res->fetch_assoc()) {
        echo("This email already exists");
        exit();
    }

    $inputPassword = password_hash($password, PASSWORD_BCRYPT);
    $stmt = $db->prepare("INSERT INTO users (first_name, last_name, phone, birthdate, email, password, role) VALUES (?, ?, ?, '1997-01-15', ?, ?, 'administrator')");

    $stmt->bind_param("sssss", $firstName, $lastName, $phoneNumber, $mail, $inputPassword);
    $stmt->execute();

    header("Location: /admin-main.php");
    exit();

}