<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once dirname(__FILE__) . '/../../models/Room.php';

if (!isset($_SESSION['connected']) || !$_SESSION['connected']) {
    header("Location: ../../my-house.php");
    exit();
}

$homeId = $_SESSION['home_id'];

if (isset($_POST['new_room'])) {

    $roomName = "Room";

    Room::createRoom($roomName, $homeId);

    header("Location: ../../my-house.php");

}