<?php

require_once(dirname(__FILE__) . '/../../utils/dbconnect.php');


$db = dbconnect();
mysqli_set_charset($db, "utf8");

$selected_component_id = $_POST['comp-id'];


if (isset($_POST['update-comp'])) {

    $newName = $_POST['name'];
    $newRoomId = $_POST['room'];

    $stmt = $db->prepare("UPDATE components SET name = ?, id_room = ? WHERE serial_number = ?");
    $stmt->bind_param("sis", $newName, $newRoomId, $selected_component_id);
    $stmt->execute();

}
