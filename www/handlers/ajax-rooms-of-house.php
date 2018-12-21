<?php

require_once('../models/Home.php');
require_once('../models/Room.php');

session_start();

$db = mysqli_connect('localhost', 'root', '', 'mff');
mysqli_set_charset($db,"utf8");


$home = $_SESSION['home'];
$home = unserialize($home);
$rooms = $home->getRooms();
$res = array();
foreach ($rooms as $r) {
    array_push($res, $r->getAllFields());
}
echo(json_encode($res));

// $homeId = $_SESSION['home_id'];
// echo(json_encode(Home::getRoomsOf($homeId)));

