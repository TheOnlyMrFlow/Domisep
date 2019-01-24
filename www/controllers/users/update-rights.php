<?php

require_once(dirname(__FILE__) . './../../utils/dbconnect.php');


$level = $_POST['level'];
$component = $_POST['component'];
$selected_user_id = $_POST['user_id'];

$db = dbconnect();
$db->set_charset("utf8");
$stmt = $db->prepare("UPDATE user_rights SET access_level=? WHERE id_user=? AND serial_number=?");
$stmt->bind_param("sis",$level,$selected_user_id,$component);
$stmt->execute();
echo('level :'.$level.'component : '.$component.'user :'.$selected_user_id.'query :'.$stmt);
