<?php

require_once(dirname(__FILE__) . '/../../utils/dbconnect.php');

$id_preset = $_POST['id'];

$db = dbconnect();

$query = "";

$stmt = $db->prepare("SELECT
                          preset_values.serial_number,
                          preset_values.on_off,
                          preset_values.value
                      FROM
                          preset_values
                      WHERE
                          preset_values.id_preset = ?");
$stmt->bind_param("i", $id_preset);
$stmt->execute();
$stmt->bind_result($serial_number,$state,$value);

$array = array();

while($stmt->fetch()){
  $temp = array($serial_number,$state,$value);
  array_push($array, $temp);

}
foreach ($array as $key => $value) {
  $update_component_value = $db->prepare("UPDATE components SET state=?,value=? WHERE serial_number=?");
  $update_component_value->bind_param("ids", $value[1],$value[2],$value[0]);
  $update_component_value->execute();
}
echo (json_encode($array));
