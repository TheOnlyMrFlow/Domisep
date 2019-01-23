<?php

require_once DIRNAME(__FILE__) . '/utils/dbconnect.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['language'])) {
    $_SESSION['language'] = 'en';
}

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'administrator') {
    header("Location: ./my-house.php");
    exit();
}

$conn = dbconnect();
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$stmt = $conn->prepare("SELECT * FROM users WHERE role IN ('administrator')");
$stmt->execute();
$result = $stmt->get_result();

$users_admin = array();

while ($admin_list = $result->fetch_assoc()) {
    array_push($users_admin, $admin_list);
}

$stmt = $conn->prepare("SELECT * FROM users WHERE role NOT IN ('administrator')");
$stmt->execute();
$result = $stmt->get_result();

$users_common = array();

while ($common_list = $result->fetch_assoc()) {
    array_push($users_common, $common_list);
}

//include 'components/header-nav/header-nav.php';

?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link rel="stylesheet" type="text/css" media="screen" href="style/style.css" /> -->
    <link rel="stylesheet" type="text/css" media="screen" href="style/full-site-style.min.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="style/dashboard-style.min.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="style/admin-main.css" />



</head>

<body>

    <div class="page-content-container">
        <div class="page-content">

            <div class="page-title">
                <h1>
                    <?php if ($_SESSION['language'] == 'en') {
    echo ('Administrator space');
} elseif ($_SESSION['language'] == 'fr') {
    echo (htmlentities('Espace administrateur'));
}?>
                </h1>
            </div>

            <!-- <h1> -->
            <div class="dashboard-big-container">
                <h2>Administrators</h2>
                <div class="dashboard-inner-container">

                    <table id="admin-info">
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>User Id</th>
                            <th>Mail</th>
                        </tr>
                        <tr>
                            <?php
foreach ($users_admin as $admin) {
    $var = $admin['id'];
    ?>
                        <tr onclick="window.location.href='<?php echo '/admin-view-profile.php?id=' . $var ?>'">
                            <td><?php echo $admin['first_name'] ?></td>
                            <td><?php echo $admin['last_name'] ?></td>
                            <td><?php echo $var ?></td>
                            <td><?php echo $admin['email'] ?></td>
                        </tr>
                        <?php }
?>
                        </tr>
                    </table>


                    <br>
                </div>
                <center><input name="newadmin" id="newadmin" type="submit" value="Create a new administrator account" onclick="window.location.href='/admin-new-account.php'" /></center>
            </div>



            <div class="dashboard-big-container">
                <h2>Common users</h2>
                <div class="dashboard-inner-container">
                    <table id="common-info">
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>User Id</th>
                            <th>Mail</th>
                        </tr>
                        <tr>
                            <?php
foreach ($users_common as $common) {?>
                        <tr onclick="window.location.href='<?php echo '/admin-view-profile.php?id=' . $common['id'] ?>'">
                            <td> <?php echo $common['first_name'] ?></td>
                            <td> <?php echo $common['last_name'] ?></td>
                            <td><?php echo $common['id'] ?></td>
                            <td><?php echo $common['email'] ?></td>
                        </tr>
                        <?php }
?>
                        </tr>

                    </table>
                </div>
            </div>

        </div>
    </div>

    <?php
include 'components/footer/footer.php';
?>

</body>

</html>