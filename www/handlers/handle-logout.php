<?php

session_start();

if (isset($_POST['logout'])) 
{
    

    // remove all session variables
    session_unset(); 

    // destroy the session 
    session_destroy();    
    

    header("Location: ../index.php");
    
}
