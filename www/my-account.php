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
	<meta charset="utf-8" />
	<title>My House - Domisep</title>
	<link rel="stylesheet" type="text/css" media="screen" href="style/dashboard-style.min.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="style/full-site-style.min.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="style/component-style.min.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="components/modals/modal.min.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="components/footer/footer.min.css" />
	<link rel="stylesheet" href="style/myhouse.min.css"/>
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

?>

		<div class="page-content-container">
      <div class="page-content">
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
