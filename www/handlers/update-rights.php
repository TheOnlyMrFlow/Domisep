<?php

if (!defined('ABSPATH')) {
    die;
}

$level = $_POST['level'];
$component = $_POST['component'];

$db = mysqli_connect('localhost', 'root', '', 'mff');

mysqli_query($db, "INSERT INTO user_rights (access_level) VALUES($level) WHERE serial_number = $component");
