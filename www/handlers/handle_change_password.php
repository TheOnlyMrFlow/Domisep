<?php

require_once('../models/User.php');
require_once('../models/FormException.php');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include '../utils/input-checker.php';

if (!isset($_SESSION['connected']) || $_SESSION['connected'] == false) {
    displayErrorAndLeave('You are not connected', 401);
}

if (!isset($_POST['change-password']) ||
    !isset($_POST['old-password']) ||
    !isset($_POST['new-password1']) ||
    !isset($_POST['new-password2'])) {

    displayErrorAndLeave('Please fill all the fields', 400);
}

$oldPassword = $_POST['old-password'];
$newPassword1 = $_POST['new-password1'];
$newPassword2 = $_POST['new-password2'];

try {
    $user = new User($_SESSION['id']);
    $user->changePassword($oldPassword, $newPassword1, $newPassword2);
    echo 'Password has been successfully changed';
}
catch (FormException $e) {
    displayErrorAndLeave($e->getMessage(), 400);
}
catch(Exception $e) {
    displayErrorAndLeave();
}



function displayErrorAndLeave($error = 'Sorry, an error occured', $status = 500)
{
    header("HTTP/1.1 " . $status ." " . $error);
    exit();
}
