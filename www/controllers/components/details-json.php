<?php

    require_once(dirname(__FILE__) . '/../../models/Component.php');
    require_once(dirname(__FILE__) . '/../../utils/dbconnect.php');


    $id = $_GET['id'];
    $db = dbconnect();


    $component = new Component($id);

    echo (json_encode($component->getAllFields()));
