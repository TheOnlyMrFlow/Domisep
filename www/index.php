
<?php

session_start();

?>


<!DOCTYPE html>

<html>

<head>
	<meta charset="utf-8" />
	<title>Domisep</title>

	<link rel="stylesheet" type="text/css" media="screen" href="../style/full-site-style.min.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="../style/style.min.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="components/modals/modal.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="components/footer/footer.min.css" />
	<link rel="stylesheet" href="components/header-nav/header-nav.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="components/header-nav/sticky-header.min.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Libre+Baskerville" rel="stylesheet">



</head>

<body>
	<?php

    include('components/header-nav/header-nav.php');

    ?>

		<center>

				<div class="full-screen-image">
						<h1 style="margin-left:-15vw">Your House.
							<br> Reinvented.</h1>
				</div>
				<div class="page-content-container">
					<div class="page-content">
						<h2>What is Domisep ?</h2>
						<h3>At Domisep, we propose our customers a complete range of finely crafted smart sensors. At Domisep, we offer you a doorway to the future.</h3>
						<img class='content-image' src="../resources/images/smart-home-tablet.jpg">

						<h2>Freedom</h2>
						<h3>Control everything from the confort of your bed.</h3>
						<img class='content-image' src="../resources/images/phone-bed.jpg">
				</div>
				</div>
				<a class="signup-opener">Ready to upgrade your life ? Create your account now</a>

		</center>
		<?php
include('components/footer/footer.php');
include('components/modals/contact/contact.php');
include('components/modals/login/login.html');
include('components/modals/signup/signup.php');
?>
</body>

<script src="scripts/open-modals.js"></script>




</html>
