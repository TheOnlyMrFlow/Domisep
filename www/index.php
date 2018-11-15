<?php //include('handlers/handle_signup.php') ?>



<!DOCTYPE html>

<html>

<head>
	<meta charset="utf-8" />
	<title>Domisep</title>

	<link rel="stylesheet" type="text/css" media="screen" href="../style/style.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="components/modals/modal.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="components/footer/footer.min.css" />
	<link rel="stylesheet" href="components/header-nav/header-nav.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="components/header-nav/sticky-header.min.js"></script>


</head>

<body>
	<?php

    include('components/header-nav/header-nav.php');

    ?>

		<center>

			<div class="page-content">

				<h1>
		Your House. Reinvented.
		<br/>
	</h1>
				<p>
					<img src=" ../resources/images/smarthome1.jpg" width="900">
				</p>
				<h2>
		What is Domisep ?
	</h2>
				<p>
					<img src="../resources/images/smart-home-tablet.jpg" width="900" >
				</p>
				<p>
					At Domisep, we propose our customers a complete range of finely crafted smart sensors. At Domisep, we offer you a doorway to the future.
				</p>
				<p>
					<img src="../resources/images/phone-bed.jpg" width="900">
				</p>
				<p>
					Control everything from the confort of your bed.
				</p>
				<br/>
				<h1>
		Ready to upgrade your life ? Create your account now
	</h1>
				<br/>
				<br/>
				<a class="signup-opener"><h2>Create my account</h2></a>

			</div>


		<?php
    include('components/footer/footer.php');
    include('components/modals/contact/contact.php');
    include('components/modals/login/login.html');
    include('components/modals/signup/signup.php');
  ?>
	
</center>

</body>

	<script src="scripts/open-modals.js"></script>




</html>
