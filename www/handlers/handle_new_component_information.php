<?php
//session_start();


$errors = array();

$db=mysqli_connect('localhost', 'root', '', 'mff');

if (isset($_POST['new_component'])){
	$componentName = mysqli_real_escape_string($db, $_POST['component_name']);
	$serialNumber = mysqli_real_escape_string($db, $_POST['serialnumber']);

if(empty($componentName)){ array_push($errors, "Component name is required");}
if (empty($serialNumber)) { array_push($errors, "Your product's serial number is required"); }

$serial_number_query= "SELECT * FROM components WHERE serial_number='$serialNumber' LIMIT 1";
$result=mysqli_query($db,$serial_number_query);
$component = mysqli_fetch_assoc($result);

if ($component){ //if component exists
	array_push($errors, "Serial Number already used for an existing component");
}


//register serial number if there are no errors in the form
if (count($errors)==0){

//cest probablement ici qu'il faudra inserer l'obtention du type de component et image à partir du serial number

$stmt = $db->prepare("INSERT INTO components (name, serial_number, id_room) VALUES (?,?, 1)");
$stmt->bind_param("ss", $componentName, $serialNumber);
$stmt->execute();

error_log(mysqli_error($db),0);
	
}

else{
	echo $errors[0];
}

}