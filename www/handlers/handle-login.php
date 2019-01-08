<?php

require_once('../models/Home.php');

if (isset($_POST['login']))
{
    $db = mysqli_connect('localhost', 'root', '', 'mff');
    $emailaddress = mysqli_real_escape_string($db, $_POST['mail']);
    $password = $_POST['password'];



    if(empty($emailaddress) || empty($password))
    {
        //header("Location: ../index.php?error=emptyfields");
        echo 'Please fill both fields';
        exit();
    }

    else
    {
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = mysqli_stmt_init($db);
        if (!mysqli_stmt_prepare($stmt, $sql))
        {
            //header("Location: ../index.php?error=sqlerror");
            echo 'Sorry, an error happened. Please contact Domisep.';
            exit();
        }
        else
        {
            mysqli_stmt_bind_param($stmt, "s", $emailaddress );
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            // echo (serialize($result));

            if($row = mysqli_fetch_assoc($result))
            {


                $passwordCheck = password_verify($password, $row['password']);

                if($passwordCheck == false)
                {
                    //header("Location: ../index.php?error=passworderror");
                    echo('wrong password');
                    exit();
                }
                else if ($passwordCheck == true)
                {

                    if (session_status() == PHP_SESSION_NONE) {
                        session_start();
                    }

                    $db = mysqli_connect('localhost', 'root', '', 'mff');

                    $_SESSION['connected'] = true;
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['id'] = $row['id'];
                    $_SESSION['home_id'] = $row['id_home'];
                    $_SESSION['home'] = serialize(new Home($row['id_home']));
                    $_SESSION['last_name'] = $row['last_name'];
                    $_SESSION['first_name'] = $row['first_name'];
                    $_SESSION['role'] = $row['role'];
                    $_SESSION['birthdate'] = $row['birthdate'];
                    $_SESSION['phone'] = $row['phone'];
                    //echo 'success';

                    echo "<script>window.top.location.href =  'http://' + window.location.hostname + '/my-house.php'; </script>";
                    exit();
                }
                else
                {
                    //header("Location: ../index.php?error=passworderror");
                    echo 'Incorrect name or password';
                    exit();
                }
            }
            else {
                echo 'Incorrect name or password';
            }
        }
    }
}

else if (isset($_POST['forgot-password'])) {
    include("./handle-forgot-password.php");
}

else
{
    //header("Location: ../index.php");
    echo 'password error';
    exit();
}
