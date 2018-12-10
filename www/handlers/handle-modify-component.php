<?php 

if (!isset($_POST['update-comp'])){
    exit();
}

$selected_component_id = $_POST['comp-id'];
$newName = $_POST['name'];
$newRoomId = $_POST['room'];


 $db = mysqli_connect('localhost', 'root', '', 'mff');
 mysqli_set_charset($db,"utf8");
 
$stmt = $db->prepare("UPDATE components SET name = ?, id_room = ? WHERE serial_number = ?");
$stmt->bind_param("sis", $newName, $newRoomId, $selected_component_id);
$stmt->execute();
