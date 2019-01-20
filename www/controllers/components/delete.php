<?php 
    
require_once (dirname(__FILE__) . '/../../utils/dbconnect.php');

$db = dbconnect();


if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


if (!isset($_POST['id'])) {
    displayErrorAndLeave("id is required", 400);
}

if (!isset($_SESSION['connected']) || !$_SESSION['connected']) { //check if connected
    displayErrorAndLeave("You must be connected", 401);
}

if ($_SESSION['role'] == 'house_member') { //check if house_manager
    displayErrorAndLeave("You don't have rights to delete a component", 401);
}

$s_number = mysqli_real_escape_string($db, $_POST['id']);
/* whene deleting a component, it will :

- delete any preset that concerned only this component
- delete it from component table
- delete all entries for this component in the user_rights table
- delete all entries for this component in the preset_values table

*/

$stmt = $db->prepare("DELETE FROM presets WHERE
                        id IN (SELECT id_preset AS id FROM preset_values WHERE serial_number = ?)
                        AND 
                        id NOT IN (SELECT id_preset AS id FROM preset_values WHERE serial_number != ?);");

$stmt->bind_param("ss", $s_number, $s_number);
$stmt->execute();

$stmt = $db->prepare("DELETE FROM preset_values WHERE serial_number = ?;");
$stmt->bind_param("s", $s_number);
$stmt->execute();

$stmt = $db->prepare("DELETE FROM components WHERE serial_number = ?;");
$stmt->bind_param("s", $s_number);
$stmt->execute();

$stmt = $db->prepare("DELETE FROM user_rights WHERE serial_number = ?;");
$stmt->bind_param("s", $s_number);
$stmt->execute();

echo mysqli_error($db);

function displayErrorAndLeave($error = 'Sorry, an error occured', $status = 500)
{
    header("HTTP/1.1 " . $status ." " . $error);
    exit();
}