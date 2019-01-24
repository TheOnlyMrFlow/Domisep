<?php

require_once (dirname(__FILE__) . '/../../utils/dbconnect.php');
require_once (dirname(__FILE__) . '/../../models/User.php');

//changer le lien du fichier

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


if(!isset($_SESSION['role']) || $_SESSION['role']!='administrator'){
    header('Location: /index.php');
    exit();
  }
  if(!isset($_SESSION['language'])){
      $_SESSION['language'] = 'en';
  }

$errorManager = "You cannot delete the account of the House Manager";
$errorAdmin = "You cannot delete an administrator account";

if(isset($_POST['delete-user']) && isset($_POST['id']))
{
    $db = dbconnect();
    $db->set_charset("utf8");
    $id = mysqli_real_escape_string($db, $_POST['id']);

    $user = new User($id);
    $userInfos = $user->getAllFields();

    if ($userInfos['role'] != 'house_member' ) {
        echo "You cannot delete a house_manager or an administrator
        <script>setTimeout(function(){   window.history.back();}, 1500);
            </script>";
        exit();
    }

    $stmt = $db->prepare("DELETE FROM users WHERE id = ? ");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    $stmt = $db->prepare("DELETE FROM user_rights WHERE id_user = ? ");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();


    header("Location: /admin-main.php");


}


?>
