<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once(dirname(__FILE__) . '/../../models/Room.php');
require_once(dirname(__FILE__) . '/../../utils/dbconnect.php');


$id_home = $_SESSION['home_id'];


$errors = array();

$db=dbconnect();


if (isset($_POST['remove_room'])){

	$selected_room_id = mysqli_real_escape_string($db, $_POST['remove_room']);

	$room = new Room ($selected_room_id);

	$error = $room->deleteSelf();

	header("Location: ../../my-house.php");

	if (sizeof($errors)>0){
		header("HTTP/1.1 403 " . $errors[0]);
		// echo(json_encode(errors[0]));

		// header("statusText: LOLOL", true, 403);
		
	}
}

?>



