<?php

header('Content-Type: text/html; charset=ISO-8859-1');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['language'])) {
    $_SESSION['language'] = 'en';
}

$db = mysqli_connect('localhost', 'root', '', 'mff');
//mysqli_set_charset($db, "utf8");

$result = mysqli_query($db, "SELECT users.*, homes.* FROM users LEFT JOIN homes ON homes.id=users.id_home WHERE users.id = " . $_SESSION['id']);

echo (mysqli_error($db));
$user = mysqli_fetch_assoc($result);
$first_name = $user['first_name'];
$last_name = $user['last_name'];
$email = $user['email'];
$birthdate = $user['birthdate'];
$phone = $user['phone'];


//echo (mysqli_fetch_all($result, MYSQLI_NUM)[0])[2];
//echo (json_encode(mysqli_fetch_all($result, MYSQLI_NUM)[0]));

?>
<!DOCTYPE html>

<html>
<head>
	<title>My account - Domisep</title>
	<link rel="stylesheet" type="text/css" media="screen" href="style/full-site-style.min.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="style/dashboard-style.min.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="style/my-account.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="style/icons.min.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="components/modals/modal.min.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="components/footer/footer.min.css" />
	<link rel="stylesheet" href="components/header-nav/header-nav.min.css">
	<link rel="stylesheet" href="components/header-nav/header-dashboard.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="components/header-nav/sticky-header.min.js"></script>
	<script src="scripts/user-rights.min.js"></script>
	<script src="scripts/change-language.min.js"></script>
	<script src="scripts/confirm-delete-account.js"></script>

</head>

<body>
	<?php

// if ($_SESSION['connected']){
//
// }
include 'components/header-nav/header-nav.php';

?>

	<div class="page-content-container">
      	<div class="page-content">
			<div class = "page-title">
				<h1>My account</h1>
			</div>
			<div class="dashboard-big-container">
				<h2>My information</h2>
				<div class="dashboard-inner-container">
				<form id="change-info-form">
					<div>
						<strong>First name</strong>
						<input class="edit-info" style="display: none;" type="text" name="firstname" value=<?php echo $first_name ?>>
						<p class="show-info"><?php echo $first_name ?></p>
					</div>
					<br>
					<div>
						<strong>Last name</strong>
						<input class="edit-info" style="display: none;" type="text" name="lastname" value=<?php echo $last_name ?>>
						<p class="show-info"><?php echo $last_name ?></p>

					</div>	
					<br>
					<div>
						<strong>Phone</strong>
						<input class="edit-info" style="display: none;" type="text" name="phone" value=<?php echo $phone ?>>
						<p class="show-info"><?php echo $phone ?></p>

					</div>
					<br>
					<div>
						<strong>Email</strong>
						<input class="edit-info" style="display: none;" type="mail" name="mail" value=<?php echo $email ?>>
						<p class="show-info"><?php echo $email ?></p>

					</div>
					<br><br>
					<div>
						<button type="button" id="switch-change-info-off" style="display: none;" class="edit-info">Cancel</button>
						<input  class="edit-info" style="display: none;" type="submit" value="Confirm changes">
						<button type="button" id="switch-change-info-on" class="show-info">Change my information</button>
						
					</div>
					<div>
						<p id="change-info-result"></p>
					</div>
				</form>

				</div>
			</div>
			<div class="dashboard-big-container">
				<h2>Change my password</h2>
				<div class="dashboard-inner-container">
				<form id="change-password-form">
					<div>
						<strong>Old password</strong>
						<input type="password" name="old-password">
					</div>
					<br>
					<div>
						<strong>New password</strong>
						<input type="password" name="new-password1">
					</div>
					<br>
					<div>
						<strong>Confirm new password</strong>
						<input type="password" name="new-password2">
					</div>
					<br><br>
					<div>
						<input type="submit" name="change-password" value="Change my password">
					</div>
					<div>
						<p id="change-password-result"></p>
					</div>
				</form>


				</div>
			</div>


			<form method="post" action="./handlers/handle-logout.php">
				<input type="submit" value="Log out" name="logout">
			</form>

			<form method="post" action="./handlers/handle-delete-account.php">
				<input style="display: none;" name="delete-account">
				<input onClick="SubmitDeleteAccount(this.form)" type="button" value="Delete my account" name="delete-account">
			</form>



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
