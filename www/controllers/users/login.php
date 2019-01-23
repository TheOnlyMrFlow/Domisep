<?php

require_once dirname(__FILE__) . '/../../models/Home.php';
require_once dirname(__FILE__) . '/../../models/User.php';
require_once dirname(__FILE__) . '/../../utils/dbconnect.php';

if (isset($_POST['login'])) {
    $db = dbconnect();
    $emailaddress = mysqli_real_escape_string($db, $_POST['mail']);
    $password = $_POST['password'];

    if (empty($emailaddress) || empty($password)) {
        //header("Location: ../index.php?error=emptyfields");
        echo 'Please fill both fields';
        exit();
    }

    if (User::login($emailaddress, $password)) {
        if ($_SESSION['role'] == 'administrator') {
            echo 'admin';
        }
        else {
            echo 'ok';
        }
        
    } else {
        echo 'Incorrect email or password';
    }

} else if (isset($_POST['forgot-password'])) {
    include "./forgot-password.php";
} else {
    //header("Location: ../index.php");
    echo 'password error';
    exit();
}