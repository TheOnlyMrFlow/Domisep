<?php
require_once(dirname(__FILE__) . '/dbconnect.php');
$db = dbconnect();
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(!isset($_SESSION['id'])){
  header('location: index.php');
}
$serial_number = $_POST['serial_number'];

$query2 = "SELECT
    values_history.timestamp,values_history.value
FROM
    values_history
WHERE
    serial_number = ?
ORDER BY
    id
DESC
LIMIT 1, 15";

$times_array = array();
$values_array = array();

$old_values = $db->prepare($query2);
$old_values->bind_param('s',$serial_number);
$old_values->execute();
$old_values->bind_result($time,$value);
// $time = preg_split('/\s+/', $time)[1];

while($old_values->fetch()){
  array_unshift($times_array,preg_split('/\s+/', $time)[1]);
  array_unshift($values_array,$value);
}

echo(json_encode(array($times_array,$values_array)));
