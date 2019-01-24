<?php

require_once dirname(__FILE__) . '/../../models/Invitation.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once dirname(__FILE__) . '/../../../vendor/autoload.php';
require_once dirname(__FILE__) . '/../../../globalVars.php';

require_once dirname(__FILE__) . '/../../utils/dbconnect.php';

if (!isset($_POST['invite-user']) || !isset($_POST['mail'])) {
    exit();
}

$db = dbconnect();
$db->set_charset("utf8");

$mail = mysqli_real_escape_string($db, $_POST['mail']);

if (empty($mail)) {
    displayErrorAndLeave("Please fill the mail field", 403);
}

if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
    displayErrorAndLeave("Incorrect email", 403);
}

$stmt = $db->prepare("SELECT id FROM users WHERE email = ?");
$stmt->bind_param("s", $mail);
$result = $stmt->execute();

if ($stmt->fetch()) {
    displayErrorAndLeave("This mail already has a Domisep account", 403);
}

$stmt->close();

$result = Invitation::generateAndSend($mail, $_SESSION['home_id'], 'contact.domisep@gmail.com', 'WeLoveC00kies', $mail);

if ($result > 0) {
    echo 'Invitation sent to' . $mail;
} else {
    echo 'Invitation has failed, please check that the mail you entered exists';
}

function displayErrorAndLeave($error = 'Sorry, an error occured', $status = 500)
{
    header("HTTP/1.1 " . $status . " " . $error);
    exit();
}