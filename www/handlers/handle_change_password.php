<?php

include '../utils/input-checker.php';

if (!isset($_SESSION['connected']) || $_SESSION['connected'] == false) {

    displayErrorAndLeave('Unauthorized access');
}

if (!isset($_POST['change-password']) ||
    !isset($_POST['old-password']) ||
    !isset($_POST['new-password1']) ||
    !isset($_POST['new-password2'])) {

    displayErrorAndLeave('Please fill all the fields');
}

$oldPassword = $_POST['old-password'];
$newPassword1 = $_POST['new-password1'];
$newPassword2 = $_POST['new-password2'];

if (empty($oldPassword) || empty($newPassword1) || empty($newPassword2)) {
    displayErrorAndLeave('Please fill all the fields');
}

if (!isset($_SESSION['id'])) {
    displayErrorAndLeave('You must be connected');
}

$db = mysqli_connect('localhost', 'root', '', 'mff');
$sql = "SELECT * FROM users WHERE id = ?";
$stmt = mysqli_stmt_init($db);

if (!mysqli_stmt_prepare($stmt, $sql)) {
    displayErrorAndLeave();
}

mysqli_stmt_bind_param($stmt, "i", $_SESSION['id']);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);

if (!$row) {
    displayErrorAndLeave();
}

if (!password_verify($oldPassword, $row['password'])) {
    displayErrorAndLeave('Wrong password');
}

if ($newPassword1 != $newPassword2) {
    displayErrorAndLeave('Passwords dont match');
}

if (!checkPassword($newPassword1)) {
    displayErrorAndLeave(passwordRequirements);
}

$sql = "SELECT * FROM users WHERE id = ?";
$stmt = mysqli_stmt_init($db);

$newPassword = password_hash($newPassword1, PASSWORD_BCRYPT);
$stmt = $db->prepare("UPDATE users SET password = ? WHERE id = ?");
$stmt->bind_param("si", $newPassword, $_SESSION['id']);
$stmt->execute();

echo 'Password has been successfully changed';

function displayErrorAndLeave($error = 'Sorry, an error occured')
{
    echo $error;
    exit();
}
