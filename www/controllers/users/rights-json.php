<?php

require_once(dirname(__FILE__) . '/../../models/User.php');

require_once(dirname(__FILE__) . '/../../utils/dbconnect.php');


$selected_user_id = $_POST['user_id'];

// $db = dbconnect();
// $result = mysqli_query($db, "SELECT serial_number,access_level FROM user_rights WHERE id_user=$selected_user_id");
// echo(json_encode(mysqli_fetch_all($result,MYSQLI_NUM)));

$user = new User($_POST['user_id']);
echo (json_encode($user->getRights()));
