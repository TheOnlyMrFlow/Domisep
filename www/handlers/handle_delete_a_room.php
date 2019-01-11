<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$id_home = $_SESSION['home_id'];


$errors = array();

$db=mysqli_connect('localhost', 'root', '', 'mff');


if (isset($_POST['remove_room'])){

$selected_room_id = $_POST['remove_room'];
	
$stmt = $db->prepare("DELETE FROM rooms WHERE id=?");

echo mysqli_error($db);

$stmt->bind_param("s", $selected_room_id);
$stmt->execute();

$statement = $db->prepare("DELETE FROM components WHERE id_room=?");
$statement->bind_param("s", $selected_room_id);
$statement->execute();


header("Location: ../my-house.php");

if (sizeof($errors)>0){
	header("HTTP/1.1 403 " . $errors[0]);
	// echo(json_encode(errors[0]));

	// header("statusText: LOLOL", true, 403);
	
}
}

?>



