<?php

require_once(dirname(__FILE__) . '/../../utils/dbconnect.php');
$conn = dbconnect();

if (isset($_POST['savetask']))
{
  $selectedPreset = $_POST['preset'];
  $selectedPresetArray = explode( "-", $selectedPreset);
  $selectedPresetId = $selectedPresetArray[0];
  $selectedPresetName = $selectedPresetArray[1];
  $selectedFrequency = $_POST['frequency'];
  $selectedStartDate = $_POST['trip-start'];
  $selectedHour = $_POST['time'];

  switch ($selectedFrequency) {
    case 'Daily':
      $frequency = 86400;
      break;
    case 'Weekly':
    $frequency = 604800;
      break;
    case 'Monthly':
    $frequency = 2592000;
      break;
    case 'One-time instance':
    $frequency = 0;
      break;
  }

  $stmt = $conn->prepare("INSERT INTO tasks (id_preset, name, start_date, hour ,frequency) VALUES (?, ?, ?, ?, ?)");
  $stmt->bind_param("sssss", $selectedPresetId, $selectedPresetName, $selectedStartDate, $selectedHour, $frequency);
  $stmt->execute();
  header('location:./../../newtask.php');
  exit;
}
