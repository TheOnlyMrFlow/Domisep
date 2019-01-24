<?php

require_once(dirname(__FILE__) . '/../../models/User.php');

require_once(dirname(__FILE__) . '/../../utils/dbconnect.php');


$selected_user_id = $_POST['user_id'];

$user = new User($_POST['user_id']);
echo (json_encode($user->getRights()));
