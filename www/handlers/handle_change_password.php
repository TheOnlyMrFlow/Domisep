<?php

require_once('../models/User.php');

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

if (empty($oldPassword) || empty($newPassword1) || empty($newPassword2)) {
    displayErrorAndLeave('Please fill all the fields', 400);
}

if (!isset($_SESSION['id'])) {
    displayErrorAndLeave('You must be connected', 401);
}

$id = $_SESSION['id'];


$db = mysqli_connect('localhost', 'root', '', 'mff');
$sql = "SELECT * FROM users WHERE id = ?";
$stmt = mysqli_stmt_init($db);

if (!mysqli_stmt_prepare($stmt, $sql)) {
    displayErrorAndLeave();
}

mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);

if (!$row) {
    displayErrorAndLeave();
}

if (!password_verify($oldPassword, $row['password'])) {
    displayErrorAndLeave('Wrong password', 400);
}

if ($newPassword1 != $newPassword2) {
    displayErrorAndLeave('Passwords dont match', 400);
}

if (!User::checkPasswordValidity($newPassword1)) {
    displayErrorAndLeave(User::$passwordRequirements, 400);
}

$newPassword = password_hash($newPassword1, PASSWORD_BCRYPT);
$stmt = $db->prepare("UPDATE users SET password = ? WHERE id = ?");
$stmt->bind_param("si", $newPassword, $id);
$stmt->execute();

echo mysqli_error($db);

echo 'Password has been successfully changed';

function displayErrorAndLeave($error = 'Sorry, an error occured', $status = 500)
{
    header("HTTP/1.1 " . $status ." " . $error);
    exit();
}
