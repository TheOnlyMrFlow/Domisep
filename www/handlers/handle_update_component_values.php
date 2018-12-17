<?php

$state = $_POST['state'];

$db = mysqli_connect('localhost', 'root', '', 'mff');
$result = mysqli_query($db, "UPDATE components SET state='$state' WHERE serial_number='$id'");
echo('level :'.$level.'component : '.$component.'user :'.$selected_user_id.'query :'.$result);
