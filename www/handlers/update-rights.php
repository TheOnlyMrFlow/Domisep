<?php

$level = $_POST['level'];
$component = $_POST['component'];
$selected_user_id = $_POST['user_id'];

$db = mysqli_connect('localhost', 'root', '', 'mff');
$result = mysqli_query($db, "UPDATE user_rights SET access_level='$level' WHERE id_user=$selected_user_id AND serial_number='$component'");
echo('level :'.$level.'component : '.$component.'user :'.$selected_user_id.'query :'.$result);
