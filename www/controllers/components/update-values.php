<?php


$db = mysqli_connect('localhost', 'root', '', 'mff');

$actionType = $_POST['action'];

if ($actionType == 'change_state') {
  $state = $_POST['state'];
  $id = $_POST['id'];
  if ($state == 'false') {
    $bool = 1;
    echo($state);
  }
  elseif($state == 'true'){
    $bool = 0;
    echo($state);
  }
  $result = mysqli_query($db, "UPDATE components SET state=$bool WHERE serial_number='$id'");
}
elseif ($actionType == 'add_value') {
  $id = $_POST['id'];
  $result = mysqli_query($db, "UPDATE components SET value=value+1 WHERE serial_number='$id'");
}
elseif ($actionType == 'remove_value') {
  $id = $_POST['id'];
  $result = mysqli_query($db, "UPDATE components SET value=value-1 WHERE serial_number='$id'");
}
