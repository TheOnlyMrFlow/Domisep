<?php

    require_once('../models/Component.php');

    $id = $_GET['id'];
    $db = mysqli_connect('localhost', 'root', '', 'mff');
    mysqli_set_charset($db, "utf8");


    $component = new Component($id);

    echo (json_encode($component->getAllFields()));

    // $result = mysqli_query($db, "SELECT * FROM components WHERE serial_number = '$selected_component_id'");
    // echo (mysqli_error($db));
    // echo (json_encode(mysqli_fetch_all($result, MYSQLI_NUM)[0]));

