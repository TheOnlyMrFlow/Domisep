<?php

if (!isset($_SESSION['connected']) || $_SESSION['connected'] == false) {

    displayErrorAndLeave('Unauthorized access');
}

if (!isset($_POST['change-password']) ||
    !isset($_POST['firstname']) ||
    !isset($_POST['lastname']) ||
    !isset($_POST['address']) ||
    !isset($_POST['city']) ||
    !isset($_POST['zipcode']) ||
    !isset($_POST['country']) ||
    !isset($_POST['phone'])) {

    displayErrorAndLeave('Please fill all the fields');
}

$db = mysqli_connect('localhost', 'root', '', 'mff');

$lastName = mysqli_real_escape_string($db, $_POST['lastname']);
$firstName = mysqli_real_escape_string($db, $_POST['firstname']);
$phone = mysqli_real_escape_string($db, $_POST['phone']);
$address = mysqli_real_escape_string($db, $_POST['address']);
$city = mysqli_real_escape_string($db, $_POST['city']);
$zipCode = mysqli_real_escape_string($db, $_POST['zipcode']);
$country = mysqli_real_escape_string($db, $_POST['country']);

$stmt = $db->prepare("UPDATE users SET last_name = ?, first_name = ?, phone = ? WHERE id = ?");
$stmt->bind_param("sss", $lastname, $firstName, $phone);
$stmt->execute();


