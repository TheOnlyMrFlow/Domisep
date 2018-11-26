<?php

$selected_user_id = $_POST['user_id'];

$db = mysqli_connect('localhost', 'root', '', 'mff');
$result = mysqli_query($db, "SELECT serial_number,access_level FROM user_rights WHERE id_user=$selected_user_id");
echo(json_encode(mysqli_fetch_all($result,MYSQLI_NUM)));
