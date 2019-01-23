<?php

require_once(dirname(__FILE__) . '/utils/dbconnect.php');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(!isset($_SESSION['id'])){
  header('location: index.php');
}
if (!isset($_SESSION['language'])) {
    $_SESSION['language'] = 'en';
}

$db = dbconnect();
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
  <link rel='stylesheet' type='text/css' media='screen' href='=component-style.min.css' />
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
      		<?php	
			if ($_SESSION['language'] == 'en') {
				$language_account="My account";
				$language_info="My information";
				$language_1name="First name:";
				$language_name="Last name:";
				$language_phone="Phone number:";
				$language_email="Email address:";
				$language_cancel="Cancel";
				$language_change="Change my information";
				$language_save="Confirm changes";
				$language_change_pass="Change my password";
				$language_old_pass="Old password:";
				$language_new_pass="New password:";
				$language_new_pass_conf="Confirm password:";
				$language_log_out="Log out";
				$language_delete="Delete account";
}
				
						
			elseif ($_SESSION['language'] == 'fr') {
				$language_account=htmlentities("Mon compte");
				$language_info=htmlentities("Mes informations");
				$language_1name=htmlentities("Prénom :");
				$language_name=htmlentities("Nom de famille :");
				$language_phone=htmlentities("Numéro de téléphone :");
				$language_email= htmlentities("Adresse e-mail :");
				$language_cancel=htmlentities("Annuler");
				$language_change=htmlentities("Modifier les informations");
				$language_save=htmlentities("Confirmer les modifications");
				$language_change_pass=htmlentities("Modifier le mot de passe");
				$language_old_pass=htmlentities("Ancien mot de passe :");
				$language_new_pass=htmlentities("Nouveau mot de passe :");
				$language_new_pass_conf="Confirmation mot de passe :";
				$language_log_out="Déconnexion";
				$language_delete="Supprimer le compte";

			}
				


			echo "
			<div class = 'page-title'>
				<h1>$language_account</h1>
			</div>
			<div class='dashboard-big-container'>
				<h2>$language_info</h2>
				<div class='dashboard-inner-container'>
				<form id='change-info-form'>
					<div>
						<strong>$language_1name</strong>
						<input class='edit-info' style='display: none;' type='text' name='firstname' value=$first_name>
						<p class='show-info'>$first_name</p>
					</div>
					<br>
					<div>
						<strong>$language_name</strong>
						<input class='edit-info' style='display: none;' type='text' name='lastname' value=$last_name>
						<p class='show-info'>$last_name</p>

					</div>
					<br>
					<div>
						<strong>$language_phone</strong>
						<input class='edit-info' style='display: none;' type='text' name='phone' value=$phone>
						<p class='show-info'>$phone</p>

					</div>
					<br>
					<div>
						<strong>$language_email</strong>
						<input disabled class='edit-info' style='display: none;' type='mail' name='mail' value=$email>
						<p class='show-info'>$email</p>

					</div>
					<br><br>
					<div>
						<button type='button' id='switch-change-info-off' style='display: none;' class='edit-info'>$language_cancel</button>
						<input  class='edit-info' style='display: none;' type='submit' value='$language_save'>
						<button type='button' id='switch-change-info-on' class='show-info, button-info'>$language_change</button>

					</div>
					<div>
						<p id='change-info-result'></p>
					</div>
				</form>

				</div>
			</div>
			<div class='dashboard-big-container'>
				<h2>$language_change_pass</h2>
				<div class='dashboard-inner-container'>
				<form id='change-password-form'>
					<div>
						<strong>$language_old_pass</strong>
						<input type='password' name='old-password'>
					</div>
					<br>
					<div>
						<strong>$language_new_pass</strong>
						<input type='password' name='new-password1'>
					</div>
					<br>
					<div>
						<strong>$language_new_pass_conf</strong>
						<input type='password' name='new-password2'>
					</div>
					<br><br>
					<div>
						<input type='submit' name='change-password' value='$language_change_pass'>
					</div>
					<div>
						<p id='change-password-result'></p>
					</div>
				</form>


				</div>
			</div>


			<form method='post' action='./controllers/users/logout.php'>
				<input type='submit' value='$language_log_out' name='logout'>
			</form>

			<form method='post' action='./controllers/users/delete-account.php'>
				<input style='display: none;'' name='delete-account'>
				<input class='delete' onClick='SubmitDeleteAccount(this.form)' type='button' value='$language_delete' name='delete-account'>
			</form>



		</div>
	</div>"?>

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
