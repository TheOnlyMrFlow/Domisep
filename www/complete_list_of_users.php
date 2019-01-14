<?php

header('Content-Type: text/html; charset=ISO-8859-1');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(!isset($_SESSION['language'])){
	$_SESSION['language'] = 'en';
}

$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'mff';

$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT * FROM users WHERE role IN ('administrator')";
$result = mysqli_query($conn, $sql);

$users_admin = array();

if (mysqli_num_rows($result) > 0)
{
    while($admin_list = mysqli_fetch_assoc($result))
    {
        array_push($users_admin, $admin_list);
    }
}
else
{
    echo("No admin in the database");
}

$sql2 = "SELECT * FROM users WHERE role NOT IN ('administrator')";
$result2 = mysqli_query($conn, $sql2);

$users_common = array();

if (mysqli_num_rows($result2) > 0)
{
    while($common_list = mysqli_fetch_assoc($result2))
    {
        array_push($users_common, $common_list);
    }
}
else
{
    echo("No common user in the database");
}

include 'components/header-nav/header-nav.php';

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="complete_list_of_users.css" />
    <script src="main.js"></script>
</head>
<body>

<div id = "admin-div">
    <h2>Administrator</h2>
        <div id = "admin-div-content">
            <table id = "admin-info">
                <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>User Id</th>
                <th>Mail</th>
                </tr>
                <tr>
                <?php 
                    foreach ($users_admin as $admin)
                    {
                      echo "<tr><td>" . $admin['first_name'] . 
                      "<td>" . $admin['last_name'] . 
                      "<td>" . "<center>". $admin['id'] . 
                      "<center>" . "<td>" . $admin['email'] . "</tr>";
                    }
                ?>
                </tr>
            </table>
            <br>
            <br>
            <br>
            <center><input type = "button" value = "Create administrator account"><center>
            <br>
</div>
<br>
</div>

<br><br>

<div id = "common-div">
    <h2>Common users</h2>
    <div id = "common-div-content">
            <table id = "common-info">
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>User Id</th>
                    <th>Mail</th>
                </tr>
                <tr>
                <?php 
                    foreach ($users_common as $common)
                    {
                      echo "<tr><td>" . $common['first_name'] . 
                      "<td>" . $common['last_name'] . 
                      "<td>" . "<center>". $common['id'] . 
                      "<center>" . "<td>" . $common['email'] . "</tr>";
                    }
                ?>
                </tr>
  
            </table>
    </div>
    <br><br><br><br><br><br>
</div>

<?php
include 'components/footer/footer.php';
?>
 
</body>
</html>