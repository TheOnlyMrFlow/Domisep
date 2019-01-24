<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'administrator') {
    header('Location: /index.php');
    exit();
}
if (!isset($_SESSION['language'])) {
    $_SESSION['language'] = 'en';
}

//$conn = dbconnect();
$conn->set_charset("utf8");
//if ($conn->connect_error) {
//die("Connection failed: " . $conn->connect_error);
//}
?>

<!DOCTYPE <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Create Administrator Account</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="/style/admin-new-account.css" />
    <script src="main.js"></script>
</head>
<body>


<div id="page-content">

    <div id = "total-wrapper">
        <h1 id = "page-title"><center>Create a new administrator account</center></h1>
        <div id = "wrapper">

            <form name="newadmin" method="post" action="controllers/admin/new-admin.php">
                <section class="input">
                    <span class ="label">First Name</span>
                    <input class = "input" type="text" name="firstname">
                    <br>
                </section>
                <section class="input">
                    <span class ="label">Last Name</span>
                    <input class = "input" type="text" name="lastname">
                    <br><br>
                </section>
                <section class="input">
                    <span class ="label">Phone number</span>
                    <input class = "input" type="text" name="phonenumber">
                    <br>
                </section>
                <section class="input">
                    <span class ="label">Mail</span>
                    <input class = "input" type="text" name="mail">
                    <br><br>
                </section>
                <section class="input">
                    <span class ="label">Password</span>
                    <input class = "input" type="password" name="password">
                    <br>
                </section>
                <section class="input">
                    <span class ="label">Repeat Password</span>
                    <input class = "input" type="password" name="repeatpassword">
                    <br><br>
                </section>
                <br><br>
                <section id = "submit_buttons">
                    <input id = "confirm" type="submit" value="Confirm" name="new-admin">
                </section>
            </form>
        </div>

        <br>
        <div id = "validation">

    </div>
</div>

<center><input style="margin-top: 50px;"type="submit" value="Back to admin space" onclick="window.location.href='/admin-main.php'" /></center>


</div>


</body>
</html>
