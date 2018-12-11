<?php
session_start();

$db = mysqli_connect('localhost', 'root', '', 'mff');
mysqli_set_charset($db,"utf8");

$homeId = $_SESSION['home_id'];
$result = mysqli_query($db, "SELECT id, name FROM rooms WHERE id_home = $homeId");
echo(mysqli_error($db));
echo(json_encode(mysqli_fetch_all($result,MYSQLI_NUM)));
