<?php

require_once('./models/Invitation.php');

header('Content-Type: text/html; charset=ISO-8859-1');
// if (session_status() == PHP_SESSION_NONE) {
//     session_start();
// }
if (!isset($_SESSION['language'])) {
    $_SESSION['language'] = 'en';
}

$db = mysqli_connect('localhost', 'root', '', 'mff');

?>
<!DOCTYPE html>

<html>
<head>
	<title>My account - Domisep</title>
	<link rel="stylesheet" type="text/css" media="screen" href="style/full-site-style.min.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="style/dashboard-style.min.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="style/icons.min.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="components/modals/modal.min.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="components/footer/footer.min.css" />
	<link rel="stylesheet" href="components/header-nav/header-nav.min.css">
	<link rel="stylesheet" href="components/header-nav/header-dashboard.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="components/header-nav/sticky-header.min.js"></script>
	<script src="scripts/change-language.min.js"></script>

</head>

<body>
	<?php

// if ($_SESSION['connected']){
//
// }
include 'components/header-nav/header-nav.php';


if (!isset($_GET['key']) || !isset($_GET['mail'])){
	header('Location: ./../index.php');
	exit();
}

$db = mysqli_connect('localhost', 'root', '', 'mff');
$key =  mysqli_real_escape_string($db, $_GET['key']);
$mail = mysqli_real_escape_string($db, $_GET['mail']);
//$key = $_GET['key'];

if (empty($key) || empty($mail)){
	header('Location: ./../index.php');
	exit();
}


$invitation = Invitation::find($mail, $key);

if (!$invitation){
	header('Location: ./../index.php');
	exit();
}

$home_id = $invitation->home->getId();

$ownerQuery = $db->query("SELECT first_name, last_name FROM users WHERE id_home = $home_id AND role='house_manager'");
$row = $ownerQuery->fetch_assoc();
$ownerName = $row['first_name'] . ' ' . $row['last_name'];


?>

	<div class="page-content-container">
      	<div class="page-content">
			<div class = "page-title">
				<h1><?php echo $ownerName ?> invited you to join his house</h1>
			</div>
			<div class="dashboard-big-container">
			<h2>Please fill your information</h2>
				<div class="dashboard-inner-container">
				<form method="POST" action="./controllers/users/signup.php">
				<div>
						<strong>Email</strong>
						<input readonly value="<?php echo $mail ?>" type="mail" name="email-disabled">
						<input value="<?php echo $mail ?>" style="display:none;" type="mail" name="email">
					</div>
					<br>
				<div>
						<strong>First name</strong>
						<input type="text" name="firstname">
					</div>
					<br>
					<div>
						<strong>Last name</strong>
						<input type="text" name="lastname">
					</div>
					<br>
					<div>
						<strong>Password</strong>
						<input type="password" name="password1">
					</div>
					<br>
					<div>
						<strong>Confirm password</strong>
						<input type="password" name="password2">
					</div>
					<br>
					<div>
						<strong>Phone</strong>
						<input type="text" name="phone">
					</div>
					<br>
					<div>
						<strong>Birthdate</strong>
						<input type="date" name="birthdate">
					</div>
					<br>
					<br>
					<input style="display: none;" name="key" value='<?php echo $key ?>'>
					<div>
						<input type="submit" value="Signup" name="signup-member">
					</div>
					<div>
						<p id="signup-result"></p>
					</div>
				</form>
			</div>



		</div>
	</div>

<?php
include 'components/modals/contact/contact.php';
include 'components/footer/footer.php';
include 'components/modals/component-details/component-details.php';
?>
</body>

<script src="scripts/open-modals.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js"></script>

<script src="components/modals/component-details/component-details.js"></script>
<script src="scripts/change-password.js"></script>
<script src="scripts/change_user_info.js"></script>


</html>
