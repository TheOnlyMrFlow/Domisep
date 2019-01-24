<?php

require_once DIRNAME(__FILE__) . '/utils/dbconnect.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['language'])) {
    $_SESSION['language'] = 'en';
}

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'administrator') {
    header('index.php');
    exit();
}

$conn = dbconnect();
$conn->set_charset("utf8");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['id'];
//this function retrieves the id written in the URL
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$profile = $result->fetch_assoc();

if (empty($profile)) {echo "No user found";}

$stmt = $conn->prepare("SELECT * FROM rooms WHERE id_home = ?");
$stmt->bind_param("i", $profile['id_home']);
$stmt->execute();
$result = $stmt->get_result();
$rooms = array();

while ($user_rooms = $result->fetch_assoc()) {
    array_push($rooms, $user_rooms);
}


$components = array();
foreach ($rooms as $room) {
    $stmt = $conn->prepare("SELECT * FROM components where id_room = ?");
    $stmt->bind_param("i", $room['id']);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($user_components = $result->fetch_assoc()) {
        array_push($components, $user_components);
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
    <link rel="stylesheet" type="text/css" media="screen" href="style/full-site-style.min.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="style/dashboard-style.min.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="style/admin-view-profile.css" />
</head>

<body>

    <div class="page-content-container">
        <div class="page-content">

        <input  type="submit" value="Back to admin space" onclick="window.location.href='/admin-main.php'" />


            <div class="page-title">
                <h1>
                    <?php if ($_SESSION['language'] == 'en') {
    echo ('User details');
} elseif ($_SESSION['language'] == 'fr') {
    echo (htmlentities('Profil utilisateur'));
}?>
                </h1>
            </div>





            <div class="dashboard-big-container">
                <h2><?php echo $profile['first_name'] . " " . $profile['last_name']; ?></h2>
                <div class="dashboard-inner-container">
                    <table id="user_info">
                        <tr>
                            <td><strong>First Name</td>
                            <td><?php echo $profile['first_name'] ?></td>
                        </tr>
                        <tr>
                            <td><strong>Last Name</td>
                            <td><?php echo $profile['last_name'] ?></td>
                        </tr>
                        <tr>
                            <td><strong>Phone Number</td>
                            <td><?php echo $profile['phone'] ?></td>
                        </tr>
                        <tr>
                            <td><strong>Mail</td>
                            <td><?php echo $profile['email'] ?></td>
                        <tr>
                            <td><strong>ID</td>
                            <td><?php echo $profile['id'] ?></td>
                        </tr>
                        <tr>
                            <td><strong>Role</td>
                            <td><?php echo $profile['role'] ?></td>
                        </tr>
                    </table>
                </div>
            </div>

            <br><br>

            <?php

if ($profile['role'] != 'administrator') {
    ?>
            <div class="dashboard-big-container">
                <h2>Sensors owned by the user</h2>
                <div class="dashboard-inner-container">

                    <table id="user_sensors">
                        <tr id="title-row">
                            <th>Serial Number</th>
                            <th>Name</th>
                            <th>Value</th>
                            <th>State</th>
                        </tr>
                        <?php
foreach ($components as $components) {
        echo "<tr><td>" . $components['serial_number'] . "<td>" . $components['name'] . "<td>" . $components['value'] . "<td>" . $components['state'] . "</td></tr>";}?>
                    </table>

                </div>

            </div>


        </div>
    </div>

    <?php }?>






    <?php
include 'components/footer/footer.php';
?>

</body>

</html>
