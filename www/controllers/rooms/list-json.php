<?php

require_once(dirname(__FILE__) .'/../../models/Home.php');
require_once(dirname(__FILE__) . '/../../models/Room.php');

require_once(dirname(__FILE__) . '/../../utils/dbconnect.php');


session_start();

$db = dbconnect();
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
