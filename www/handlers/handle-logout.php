<?php

require_once '../utils/logout.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST['logout'])) 
{
    

    logOut();

    // // remove all session variables
    // session_unset(); 

    // // destroy the session 
    // session_destroy();    
    

    header("Location: ../index.php");
    
}
