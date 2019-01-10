<?php

require_once '../models/Invitation.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once '../../vendor/autoload.php';
require_once '../../globalVars.php';

if (!isset($_POST['invite-user']) || !isset($_POST['mail'])) {
    exit();
}

$db = mysqli_connect('localhost', 'root', '', 'mff');

$mail = mysqli_real_escape_string($db, $_POST['mail']);

if (empty($mail)) {
    displayErrorAndLeave("Please fill the mail field", 403);
}

if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
    displayErrorAndLeave("Incorrect email", 403);
}

echo $mail;

$stmt = $db->prepare("SELECT id FROM users WHERE email = ?");
$stmt->bind_param("s", $mail);
$result = $stmt->execute();

if ($stmt->fetch()) {
    displayErrorAndLeave("This mail already has a Domisep account", 403);
}

$stmt->close();


$result = Invitation::generateAndSend($mail, $_SESSION['home_id'], 'contact.domisep@gmail.com', 'WeLoveC00kies', $mail);

if ($result > 0) {
    echo 'message sent';
} else {
    echo 'fail sending mail';
}



function displayErrorAndLeave($error = 'Sorry, an error occured', $status = 500)
{
    header("HTTP/1.1 " . $status . " " . $error);
    exit();
}
