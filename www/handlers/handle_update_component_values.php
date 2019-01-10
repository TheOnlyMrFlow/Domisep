<?php

$state = $_POST['state'];
$id = $_POST['id'];
if ($state =='false') {
  $state = 1;
}
elseif($state == 'true'){
  $state = 0;
}

$db = mysqli_connect('localhost', 'root', '', 'mff');
$result = mysqli_query($db, "UPDATE components SET state=$state WHERE serial_number='$id'");
