<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

//require_once(dirname(__FILE__) . '/../models/Room.php');

$id_home = $_SESSION['home_id'];

if (isset($_POST['new_room'])) {

	$roomName = "Room";

	Room::createRoom($roomName);

header("Location: ../my-house.php");

	
}



