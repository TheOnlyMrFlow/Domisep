<?php

require_once (DIRNAME(__FILE__) . '/utils/dbconnect.php');

header('Content-Type: text/html; charset=ISO-8859-1');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(!!isset($_SESSION['id']) || $_SESSION['role']!='administrator'){
  header('location: index.php');
}
if(!isset($_SESSION['language'])){
	$_SESSION['language'] = 'en';
}

$conn = dbconnect();
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
                      $var = $admin['id'];
                      ?>
                      <tr><td><?php echo $admin['first_name']?></td>
                        <td><?php echo $admin['last_name'] ?></td>
                        <td><center><a id = 'externalLink' href="<?php echo 'user_profile.php?id=' . $var ?>"><?php echo $var ?></a></center></td>
                        <td><?php echo $admin['email']?></td>
                      </tr>
                    <?php }
                ?>
                </tr>
            </table>
            <br>
            <br>
            <br>
            <center>
                <input name="newadmin" type="button" value="Create a new administrator account" onclick="window.open('New_Admin_Account.php')"/>
            <center>
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
                    { ?>
                      <tr>
                        <td> <?php echo $common['first_name'] ?></td>
                        <td> <?php echo $common['last_name'] ?></td>
                        <td>
                            <center>
                                <a id = externalLink href="<?php echo 'user_profile.php?id=' . $common['id'] ?>"><?php echo $common['id']?></a>
                            </center>
                        </td>
                        <td><?php echo $common['email']?></td>
                      </tr>";
                    <?php }
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
