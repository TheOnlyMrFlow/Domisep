<?php
require_once(dirname(__FILE__) . './../../utils/dbconnect.php');
$db = dbconnect();
$db->set_charset("utf8");
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(!isset($_SESSION['id'])){
  header('location: index.php');
}
$serial_number = $_POST['serial_number'];
$last_time = $_POST['last_time'];
$seconds = strtotime("1970-01-01 $last_time UTC");

$query2 = "SELECT
    values_history.timestamp,
    values_history.value
FROM
    values_history
WHERE
    serial_number = ? AND(
        values_history.timestamp >(
            CURRENT_DATE + INTERVAL ? SECOND
        ) OR values_history.timestamp = CAST(CURRENT_TIMESTAMP AS DATE)
    ) ORDER BY values_history.timestamp LIMIT 1";

$new_value = $db->prepare($query2);
$new_value->bind_param('si',$serial_number,$seconds);
$new_value->execute();
$new_value->bind_result($time,$value);

while($new_value->fetch()){
  echo(json_encode(array(preg_split('/\s+/', $time)[1],$value)));
}
