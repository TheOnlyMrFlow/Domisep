<?php


$db = mysqli_connect('localhost', 'root', '', 'mff');

$actionType = $_POST['action'];

if ($actionType == 'change_state') {
  $state = $_POST['state'];
  $result = mysqli_query($db, "UPDATE components SET state='$state' WHERE serial_number='$id'");
}
elseif ($actionType == 'add_value') {
  $id = $_POST['id'];
  $result = mysqli_query($db, "UPDATE components SET value=value+1 WHERE serial_number='$id'");
}
elseif ($actionType == 'remove_value') {
  $id = $_POST['id'];
  $result = mysqli_query($db, "UPDATE components SET value=value-1 WHERE serial_number='$id'");
}
