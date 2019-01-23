<?php

require_once(dirname(__FILE__) . '/../../utils/dbconnect.php');
require_once(dirname(__FILE__) . '/../../models/Component.php');

if (session_status() == PHP_SESSION_NONE) {
  session_start();
}


if (!isset($_POST['id']) || !isset($_POST['action'])) {
  exit();
}

if (!isset($_SESSION['connected']) || !$_SESSION['connected']) { //check if connected
  exit();
}

$db = dbconnect();

$actionType = mysqli_real_escape_string($db, $_POST['action']);
$id = mysqli_real_escape_string($db, $_POST['id']);

$comp = new Component($id);

if ($actionType == 'change_state' && isset($_POST['state'])) {
  $state = mysqli_real_escape_string($db, $_POST['state']);
  
  if ($state == 'false') {
    $comp->updateState(1);
    echo($state);
  }
  elseif($state == 'true'){
    $comp->updateState(0);
    echo($state);
  }
  
}
elseif ($actionType == 'add_value') {
  $comp->addValue(1);
}
elseif ($actionType == 'remove_value') {
  $comp->addValue(-1);
}
