<?php 

include('../utils/input-checker.php');
require_once('../models/User.php');

if (isset($_POST['id']) && isset($_POST['key'])) {
    $db = mysqli_connect('localhost', 'root', '', 'mff');    
    $id = mysqli_real_escape_string($db, $_POST['id']);
    $secret_key = $_POST['key'];

    $sql = "SELECT * FROM password_reset_keys WHERE id_user = ?";
    $stmt = mysqli_stmt_init($db);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        //header("Location: ../index.php?error=sqlerror");
        echo 'Sorry, an error happened. Please contact Domisep.';
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($result)) {

            $db_hashed_key = $row['hashed_key'];

            $today = date("Y-m-d H:i:s");
            $expires = $row['expiration'];
            
            $today_time = strtotime($today);
            $expire_time = strtotime($expires);
            
            if ($expire_time < $today_time) {
                displayErrorAndLeave();
            } else if(password_verify($secret_key, $db_hashed_key)){

                if (isset($_POST['password1']) && isset($_POST['password2'])){

                    $password1 =$_POST['password1'];
                    $password2 = $_POST['password2'];

                    if ($password1 != $password2){
                        displayErrorAndLeave("Passwords do not match");
                    } else if (!User::checkPasswordValidity($password1)){
                        displayErrorAndLeave("Password must be at least 4 characters, no more than 16 characters, and must include at least one upper case letter, one lower case letter, and one numeric digit.");
                    } else {

                        $new_password = password_hash($password1, PASSWORD_BCRYPT);
                        $stmt = $db->prepare("UPDATE users SET password = ? WHERE id = ?");
                        $stmt->bind_param("si", $new_password, $id);
                        $stmt->execute();

                        $stmt = $db->prepare("DELETE FROM password_reset_keys WHERE id_user = ?");
                        $stmt->bind_param("i", $id);
                        $stmt->execute();

                        echo "<script>window.top.location.href =  'http://' + window.location.hostname; </script>";
                        
                    }


                } else {
                    displayErrorAndLeave();
                }


            }
            else {

                displayErrorAndLeave();
            }

        }
        else {
            displayErrorAndLeave();

        }
    }
     
}
else {
    displayErrorAndLeave();    
}

function displayErrorAndLeave($error = 'Sorry, you tried to reset your password from a link either expired or invalid'){
    echo $error;
    exit();
}

?>