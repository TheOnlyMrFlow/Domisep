<?php

require_once(dirname(__FILE__) . '/dbconnect.php');
//changer le lien du fichier

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$errorManager = "You cannot delete the account of the House Manager";
$errorAdmin = "You cannot delete an administrator account";

if(isset($_POST['delete_user']))
{
    $your_role = $_POST['role_user'];
    $your_id = $_POST['id_user'];
    $db = dbconnect();
$db->set_charset("utf8");
    if($your_role == 'administrator')
    {
        echo "<script>{alert('You cannot delete the account of an administrator');
            window.history.back()
            </script>";
        exit();
        
    }
    elseif($your_role == 'house_manager')
    {
        echo "<script>alert('You cannot delete the account of an House Manager');
            window.history.back();
            </script>";

        exit();   

    }
    else
    {
        $sqlDeleteU = "DELETE FROM users WHERE id = $your_id";
        $sqlDeleteR = "DELETE FROM user_rights where id_user = $your_id";
        if ($db->query($sqlDeleteU) === TRUE && $db->query($sqlDeleteR) === TRUE) 
        {
            echo "<script>alert('Record deleted successfully');
            window.history.go(-2);
            </script>";
        } 
        else 
        {
            echo "<script>alert('An error occurred');
            window.history.go(-2);
            </script>" . $db->error;
        }
    }

}


?>