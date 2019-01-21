<?php

require_once(dirname(__FILE__) . '/../../utils/dbconnect.php');
require_once(dirname(__FILE__) . '/../../models/Component.php');


$db = dbconnect();
mysqli_set_charset($db, "utf8");

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['connected']) || !$_SESSION['connected']) { //check if connected
    displayErrorAndLeave("You must be connected", 401);
}

if (isset($_POST['update-comp']) &&
    isset($_POST['name']) &&
    isset($_POST['room']) &&
    isset($_POST['comp-id'])) {

    $newName = mysqli_real_escape_string($db, $_POST['name']);
    $newRoomId = mysqli_real_escape_string($db, $_POST['room']);
    $serial_number = mysqli_real_escape_string($db, $_POST['comp-id']);

    $comp = new Component($serial_number);

    $error = $comp->modify($newName, $newRoomId);

    if ($error) {
        displayErrorAndLeave($error, 401);        
    }

    function displayErrorAndLeave($error = 'Sorry, an error occured', $status = 500)
    {
        header("HTTP/1.1 " . $status ." " . $error);
        exit();
    }
    

}
