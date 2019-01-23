<?php

require_once(dirname(__FILE__) . '/../../utils/dbconnect.php');

$db = dbconnect();

$actionType = $_POST['action'];

if ($actionType == 'change_state') {
  $state = $_POST['state'];
  $id = $_POST['id'];
  if ($state == 'false') {
    $bool = 1;
  }
  elseif($state == 'true'){
    $bool = 0;
  }
  $stmt = $db->prepare("UPDATE tasks SET on_off=? WHERE id=?");
  $stmt->bind_param("ii",$bool,$id);
  $stmt->execute();
}
elseif ($actionType == 'remove_task') {
  $id = $_POST['id'];
  $result = mysqli_query($db, "UPDATE components SET value=value+1 WHERE serial_number='$id'");
}
