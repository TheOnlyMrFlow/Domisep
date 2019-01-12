<?php
//session_start();

require_once(dirname(__FILE__) . '/../../models/Component.php');

$errors = array();

$db = mysqli_connect('localhost', 'root', '', 'mff');

if (isset($_POST['new_component'])) {
    $componentName = mysqli_real_escape_string($db, $_POST['component_name']);
    $serialNumber = mysqli_real_escape_string($db, $_POST['serialnumber']);
    $roomId = mysqli_real_escape_string($db, $_POST['room-id']);

    if (empty($componentName)) {array_push($errors, "Component name is required");}
    if (empty($serialNumber)) {array_push($errors, "Your product's serial number is required");}

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
