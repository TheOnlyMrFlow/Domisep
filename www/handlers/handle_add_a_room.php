<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$id_home = $_SESSION['home_id'];


$errors = array();

$db=mysqli_connect('localhost', 'root', '', 'mff');

if (isset($_POST['new_room'])){
	$roomName = "Room";


$stmt = $db->prepare("INSERT INTO rooms (name, id_home) VALUES (?, ?)");
$stmt->bind_param("si", $roomName, $id_home);
$stmt->execute();

error_log(mysqli_error($db),0);

header("Location: ../my-house.php");

if (sizeof($errors)>0){
	header("HTTP/1.1 403 " . $errors[0]);
	// echo(json_encode(errors[0]));

	// header("statusText: LOLOL", true, 403);
	

}
	
}



