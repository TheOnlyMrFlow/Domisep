<?php 

function logOut() {
    $_SESSION['connected'] = false;
    
    unset($_SESSION['email']);
    unset($_SESSION['id']);
    unset($_SESSION['home_id']);
    unset($_SESSION['last_name']);
    unset($_SESSION['first_name']);
    unset($_SESSION['role']);
    unset($_SESSION['birthdate']);
    unset($_SESSION['phone']);
}