<?php

require_once (DIRNAME(__FILE__) . '/dbconnect.php');

header('Content-Type: text/html; charset=ISO-8859-1');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if($_SESSION['id']==null){
  header('index.php');
}
if(!isset($_SESSION['language'])){
	$_SESSION['language'] = 'en';
}

$conn = dbconnect();
if ($conn->connect_error)
{
  echo "That did not work";
  die("Connection failed: " . $conn->connect_error);
}
else
{
  /*echo "We are online";*/
}

$your_id = $_GET['id'];
//this function retrieves the id written in the URL
$sql = "SELECT * FROM users WHERE id = $your_id";
$result = mysqli_query($conn, $sql);
$userprofile = array();
if(mysqli_num_rows($result) > 0)
{
  while($userinfo = mysqli_fetch_assoc($result))
  {
    array_push($userprofile, $userinfo);
  }
}

if(empty($userprofile)){echo"No user found";}

foreach($userprofile as $profile)
{
  echo "";
}

$sql2 = "SELECT * FROM rooms WHERE id_home = $profile[id_home]";
$result2 = mysqli_query($conn, $sql2);
$rooms = array();
if(mysqli_num_rows($result2) > 0)
{
  while($user_rooms = mysqli_fetch_assoc($result2))
  {
    array_push($rooms, $user_rooms);
  }
}
if(empty($rooms))
{
  echo"I live in a house with no room so what";
}

$components = array();
foreach($rooms as $rooms)
{
  $sql3 = "SELECT * FROM components where id_room = $rooms[id]";
  $result3 = mysqli_query($conn, $sql3);
  if(mysqli_num_rows($result3) > 0)
{
  while($user_components = mysqli_fetch_assoc($result3))
  {
    array_push($components, $user_components);
  }
}

}

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>User Profile</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" media="screen" href="user-profile.css" />
  <script src="main.js"></script>
</head>
<body>

<div id="page-content">
<h1 id = "page-title"><center>User Profile<center></h1>
<div id="information">
<h1 id="profile-name">
  <?php
  echo $profile['first_name'] . " " . $profile['last_name'];
  ?>
</h1>
<div class="info_container">
<table id="user_info">
<tr>
  <td><strong>First Name</td>
  <td><?php echo $profile['first_name']?></td>
</tr>
<tr>
  <td><strong>Last Name</td>
  <td><?php echo $profile['last_name']?></td>
</tr>
<tr>
  <td><strong>Phone Number</td>
  <td><?php echo $profile['phone']?></td>
</tr>
<tr>
  <td><strong>Mail</td>
  <td><?php echo $profile['email']?></td>
<tr>
  <td><strong>ID</td>
  <td><?php echo $profile['id']?></td>
</tr>
</table>
</div>
</div>

<br><br>

<?php 

if ($profile['role'] != 'administrator') {
	?>
  <div class = "sensors_container">
<h1>Sensors owned by the user</h1>
<div class="sensors">

<table id="user_sensors">
<tr id = "title-row">
  <th>Serial Number</th>
  <th>Name</th>
  <th>Value</th>
  <th>State</th>
</tr>
<?php
foreach($components as $components)
{
   echo "<tr><td>". $components['serial_number'] . "<td>". $components['name']. "<td>". $components['value']. "<td>". $components['state']. "</td></tr>";}?>
</table>

</div>

</div>

<form name = "delete_user" method = "post" action = "/delete-user.php">
<br><br>
<div><center>
  <input style = "display:none" name = "id_user" value = "<?php echo $your_id ?>">
  <input style = "display:none" name = "role_user" value = "<?php echo $profile['role'] ?>">
  <button id = "delete" onclick = "return deleteUser()" name = "delete_user">Delete this user</button>
<center></div>
<br>
</form>

</div>

<?php } ?> 

<script>
function deleteUser()
    {
      return confirm("Are you sure you want to delete this user from the database ?");
    }
</script>




<?php
include 'components/footer/footer.php';
?>

</body>
</html>
