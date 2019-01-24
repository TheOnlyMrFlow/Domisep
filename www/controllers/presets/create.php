<?php

require_once(dirname(__FILE__) . '/../../utils/dbconnect.php');
require_once(dirname(__FILE__) . '/../../models/Preset.php');

if (session_status() == PHP_SESSION_NONE) {
  session_start();
}


if (!isset($_POST['data']) || !isset($_POST['name'])) {
  displayErrorAndLeave("Missing name or data", 400);
}

if (!isset($_SESSION['connected']) || !$_SESSION['connected']) { //check if connected
  displayErrorAndLeave("You must be connected", 401);
}

$db = dbconnect();
$db->set_charset("utf8");

$componentsValuesArray = $_POST['data'];
$name = mysqli_real_escape_string($db, $_POST['name']);

Preset::createPreset($name, $_SESSION['home_id'], $_SESSION['id'], $componentsValuesArray);
