<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once(dirname(__FILE__) . '/../models/Room.php');

$id_home = $_SESSION['home_id'];


$errors = array();

$db=mysqli_connect('localhost', 'root', '', 'mff');


if (isset($_POST['remove_room'])){

$selected_room_id = $_POST['remove_room'];

$room = new Room ($selected_room_id);

$room->deleteSelf();



header("Location: ../my-house.php");

if (sizeof($errors)>0){
	header("HTTP/1.1 403 " . $errors[0]);
	// echo(json_encode(errors[0]));

	// header("statusText: LOLOL", true, 403);
	
}
}

?>



