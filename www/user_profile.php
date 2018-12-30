<?php

header('Content-Type: text/html; charset=ISO-8859-1');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(!isset($_SESSION['language'])){
	$_SESSION['language'] = 'en';
}
$SESSION_home_id = $_SESSION['home_id'];

$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'mff';

$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
if ($conn->connect_error) 
{
  echo "That did not work";
  die("Connection failed: " . $conn->connect_error);
} 
else
{
  /*echo "We are online";*/
}

/*$sql = "SELECT * FROM users WHERE id_home = $SESSION_home_id";*/
$sql = "SELECT * FROM users";
$result = mysqli_query($conn, $sql);
$userprofile = array();
while($userinfo = mysqli_fetch_assoc($result)) 
  {
    array_push($userprofile, $userinfo);
  } 

if(empty($userinfo))
echo " look at all those chickens";

echo $userinfo['role'];
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>User Profile</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" media="screen" href="user_profile.css" />
  <script src="main.js"></script>
</head>
<body>

<div id="page-content">
<div id="information">
<h1>
  <?php 
  echo $userinfo['first_name'] . " " . $userinfo['last_name'];
  ?>
  Robert Belouvrage
</h1>
<div class="info_container">
<table id="user_info">
<tr>
  <td>First Name</td>
  <td>Robert</td>
</tr>
<tr>
  <td>Last Name</td>
  <td>Belouvrage</td>
</tr>
<tr>
  <td>Address</td>
  <td>Rue des Roseaux</td>
</tr>
<tr>
  <td>Phone Number</td>
  <td>0102038975</td>
</tr>
<tr>
  <td>Mail</td>
  <td>robert.beloulou@robert.fr</td>
<tr>
  <td>ID</td>
  <td>3</td>
</tr>
</table>
</div>
</div>
<br><br>
<div class = "sensors_container">
<h2>Sensors and switches owned by the user</h2>
<div class="sensors">
<table id="user_sensors">
<tr>
  <th>Serial Number</th>
  <th>Type</th>
  <th>Date of Activation</th>
  <th>State</th>
</tr>
<tr>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
</tr>
<tr>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
</tr>
<tr>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
</tr>
</table>
</div>
</div>
</div>
  
</body>
</html>
