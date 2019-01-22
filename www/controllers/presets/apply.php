<?php

require_once(dirname(__FILE__) . '/../../utils/dbconnect.php');
require_once(dirname(__FILE__) . '/../../models/Preset.php');


if (session_status() == PHP_SESSION_NONE) {
  session_start();
}


if (!isset($_POST['id'])) {
  displayErrorAndLeave("id is required", 400);
}

if (!isset($_SESSION['connected']) || !$_SESSION['connected']) { //check if connected
  displayErrorAndLeave("You must be connected", 401);
}

$db = dbconnect();

$id_preset = mysqli_real_escape_string($db, $_POST['id']);


if ($_SESSION['role'] == 'house_member') { //check if house_manager
  displayErrorAndLeave("You don't have rights to delete a component", 401);
}


$preset = new Preset($id_preset);

echo(json_encode($preset->apply()));
