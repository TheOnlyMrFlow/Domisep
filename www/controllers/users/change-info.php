<?php

require_once(dirname(__FILE__) . '/../../models/FormException.php');
require_once(dirname(__FILE__) . '/../../models/User.php');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['connected']) || $_SESSION['connected'] == false) {

    displayErrorAndLeave('You are not connected', 401);
}

if (!isset($_POST['firstname']) ||
    !isset($_POST['lastname']) ||
    !isset($_POST['phone'])) {

    displayErrorAndLeave('Please fill all the fields', 400);
}

$firstName = $_POST['firstname'];
$lastName = $_POST['lastname'];
$phone = $_POST['phone'];

try {
    $user = new User($_SESSION['id']);
    $user->updateInfo($firstName, $lastName, $phone);
    echo 'Your information have been successfully updated';

}
catch (FormException $e) {
    displayErrorAndLeave($e->getMessage());

}
catch (Exception $e) {
    displayErrorAndLeave($e->getMessage());
}


function displayErrorAndLeave($error = 'Sorry, an error occured', $status = 500)
{
    header("HTTP/1.1 " . $status ." " . $error);
    exit();
}
