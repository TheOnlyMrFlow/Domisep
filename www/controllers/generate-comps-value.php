<?php 

require_once(dirname(__FILE__) . '/../utils/dbconnect.php');


$db = dbconnect();

$add = rand(-2, 2);

$stmt = $db->prepare("SELECT serial_number, value FROM components");
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc())
{
	if (explode("-", $row[serial_number])[0] == "sma") {
		continue;
	}
	$newVal = min(max($row[value] + rand(-2, 2), 13), 35);

	$stmt = $db->prepare("UPDATE components SET value = ? WHERE serial_number = ?");
	$stmt->bind_param("is", $newVal, $row[serial_number]);
	$stmt->execute();
}

