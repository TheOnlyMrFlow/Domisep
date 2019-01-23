<?php
//session_start();

require_once(dirname(__FILE__) . '/../../models/Component.php');
require_once(dirname(__FILE__) . '/../../utils/dbconnect.php');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


$errors = array();

$db = dbconnect();



if (isset($_POST['new_component'])) {
    
    if (!isset($_SESSION['connected']) || !$_SESSION['connected']) { //check if connected
        array_push($errors, "You must be connected");
    }

    

    $componentName = mysqli_real_escape_string($db, $_POST['component_name']);
    $serialNumber = mysqli_real_escape_string($db, $_POST['serialnumber']);
    $roomId = mysqli_real_escape_string($db, $_POST['room-id']);

    if (empty($componentName)) {array_push($errors, "Component name is required");}
    if (empty($serialNumber)) {array_push($errors, "Your product's serial number is required");}
    $serialNumberArray = explode('-', $serialNumber);
    if (!in_array($serialNumberArray[0], array('sen','sma')) || !in_array($serialNumberArray[1], array('lght','temp','hmdt','smok','shtr','airc'))) {
      array_push($errors, "Your product's serial number is incorrect");
    }


    if (count($errors) == 0) {

        if (!Component::createComponent($componentName, $serialNumber, $roomId)) { //if component exists
            array_push($errors, "Serial Number already used for an existing component");
        }
    }

    if (count($errors) == 0) {

        header("GGWP", true, 200);

    } else {
        header("HTTP/1.1 403 " . $errors[0]);
        // echo(json_encode(errors[0]));

        // header("statusText: LOLOL", true, 403);

    }

}
