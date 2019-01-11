<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['connected']) || $_SESSION['connected'] == false) {

    displayErrorAndLeave('You are not connected', 401);
}

require_once(dirname(__FILE__) . '/../Room.php');

// if (!isset($_POST['room_name']) ) {

//     displayErrorAndLeave('Please fill all the fields', 400);
// }



$db = mysqli_connect('localhost', 'root', '', 'mff');


$room_id = mysqli_real_escape_string($db, $_POST['room_id']);
//$room_id = $_POST['room_id'];//
$room_name = mysqli_real_escape_string($db, $_POST['room_name']);



$room = new Room ($room_id);
$room->rename($room_name);




// echo 'Your information have been successfully updated';

function displayErrorAndLeave($error = 'Sorry, an error occured', $status = 500)
{
    header("HTTP/1.1 " . $status ." " . $error);
    exit();
}
?>