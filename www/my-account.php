<?php

header('Content-Type: text/html; charset=ISO-8859-1');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(!isset($_SESSION['language'])){
	$_SESSION['language'] = 'en';
}

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
				<form action="#" method="post">
					<div>
						<strong>First name</strong>
						<input type="text" name="first-name">
					</div>
					<br>
					<div>
						<strong>Last name</strong>
						<input type="text" name="last-name">
					</div>
					<br>
					<div>
						<strong>Address</strong>
						<input type="text" name="address">
					</div>
					<br>
					<div>
						<strong>Phone</strong>
						<input type="text" name="phone-number">
					</div>
					<br>
					<div>
						<strong>Email</strong>
						<input type="mail" name="mail">
					</div>
					<br><br>
					<div>
						<input type="submit" value="Update my information">
					</div>
				</form>

				</div>
			</div>
			<div class="dashboard-big-container">
				<h2>Change my password</h2>
				<div class="dashboard-inner-container">
				<form action="#" method="post">
					<div>
						<strong>Old password</strong>
						<input type="password" name="old-password">
					</div>
					<br>
					<div>
						<strong>New password</strong>
						<input type="password" name="new-password-1">
					</div>
					<br>
					<div>
						<strong>Confirm new password</strong>
						<input type="password" name="new-password-2">
					</div>
					<br><br>
					<div>
						<input type="submit" name="change-password" value="Change my password">
					</div>
				</form>

					
				</div>
			</div>


			<form method="post" action="./handlers/handle-logout.php">
				<input type="submit" value="Log out" name="logout">
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


</html>
