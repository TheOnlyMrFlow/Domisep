<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(!isset($_SESSION['id'])){
  header('location: index.php');
}
if(!isset($_SESSION['language'])){
	$_SESSION['language'] = 'en';
}
?>

<!DOCTYPE html>

<html>

<head>
	<meta charset="utf-8" />
	<title>Reset my password</title>
	<link rel="stylesheet" type="text/css" media="screen" href="style/style.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="components/modals/modal.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="components/footer/footer.min.css" />
	<link rel="stylesheet" href="components/header-nav/header-nav.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="components/header-nav/sticky-header.min.js"></script>
	<script src="scripts/change-language.min.js"></script>
</head>

<body>
	<?php

include('components/header-nav/header-nav.php');

?>


<?php

    if (isset($_GET['id']) && isset($_GET['key'])) {
        $id = $_GET['id'];
        $secret_key = $_GET['key'];
    }

?>

    <div class="page-content-container">
        <form method="post" action="/controllers/users/reset-password" target='reset-password-result'>
                <p>Choose a new password :</p>
                <input type="password" name="password1"></input>
                <p>Confirm your new password :</p>
                <input type="password" name="password2">
                <input name="id" value="<?php echo $id; ?>" style="display: none;"></input>
                <input name="key" value="<?php echo $secret_key; ?>" style="display: none;"></input>
                <input type="submit" value="submit" name="reset-password"></input>

        </form>
        <iframe name="reset-password-result"></iframe>
	</div>

<?php
include 'components/modals/contact/contact.php';
include 'components/footer/footer.php';
?>
</body>

<script src="scripts/open-modals.js"></script>

</html>
