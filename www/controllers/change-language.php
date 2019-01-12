<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(!isset($_SESSION['language'])){
	$_SESSION['language'] = 'en';
}
if(isset($_POST['language'])){
  $_SESSION['language'] = $_POST['language'];
}
echo($_SESSION['language']);
