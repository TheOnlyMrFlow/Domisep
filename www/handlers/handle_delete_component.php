<?php 

echo 'recieved';


if (!isset($_POST['delete-comp'])){
    exit();
}

echo 'set';



$selected_component_id = $_POST['comp-id'];

 $db = mysqli_connect('localhost', 'root', '', 'mff');
 mysqli_set_charset($db,"utf8");
 
$stmt = $db->prepare("DELETE FROM components WHERE serial_number = ?");
$stmt->bind_param("s", $selected_component_id);
$stmt->execute();


