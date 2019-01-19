<?php

require_once(dirname(__FILE__) . '/../../utils/dbconnect.php');

session_start();

$db = dbconnect();

$componentsValuesArray = $_POST['data'];
$name = $_POST['name'];
$home_id = $_SESSION['home_id'];

echo($home_id.$name);

$name = mysqli_real_escape_string($db, $name);
$stmt = $db->prepare("INSERT INTO presets (id_home,name) VALUES (?,?)");
$stmt->bind_param("is", $home_id,$name);
$stmt->execute();
$preset_id = $stmt->insert_id;

foreach ($componentsValuesArray as $componentValues) {
  $serial_number = mysqli_real_escape_string($db, $componentValues[0]);
  $state = $componentValues[1];
  $value = $componentValues[2];
  if($value==null){
    $stmt = $db->prepare("INSERT INTO preset_values (id_preset,serial_number,on_off) VALUES (?,?,?)");
    $stmt->bind_param("isi", $preset_id,$serial_number,$state);
  }
  else{
    $stmt = $db->prepare("INSERT INTO preset_values (id_preset,serial_number,on_off,value) VALUES (?,?,?,?)");
    $stmt->bind_param("isii", $preset_id,$serial_number,$state,$value);
  }

  $stmt->execute();
}
