<?php

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

$db = mysqli_connect('localhost', 'root', '', 'mff');

$lastName = mysqli_real_escape_string($db, $_POST['lastname']);
$firstName = mysqli_real_escape_string($db, $_POST['firstname']);
$phone = mysqli_real_escape_string($db, $_POST['phone']);


$id = $_SESSION['id'];

$stmt = $db->prepare("UPDATE users SET last_name = ?, first_name = ?, phone = ? WHERE id = ?");
$stmt->bind_param("sssi", $lastName, $firstName, $phone, $id);
$stmt->execute();

echo 'Your information have been successfully updated';

function displayErrorAndLeave($error = 'Sorry, an error occured', $status = 500)
{
    header("HTTP/1.1 " . $status ." " . $error);
    exit();
}
