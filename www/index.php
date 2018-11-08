<!DOCTYPE html>

<html>

<head>
	<meta charset="utf-8" />
	<title>Domisep</title>

	<link rel="stylesheet" type="text/css" media="screen" href="../style/style.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="components/modals/modal.css" />


</head>

<body>
	<?php 

	include('components/header-nav/header-nav.html');

	?>

	<center>

<div class="page-content">

	<h1>
		Your House. Reinvented.
		<br/>
	</h1>
	<p>
		<img src=" ../resources/images/smarthome1.jpg" width="1200" height="580">
	</p>
	<h2>
		What is Domisep ?
	</h2>
	<p>
		<img src="../resources/images/smart-home-tablet.jpg" width="1200" height="650">
	</p>
	<p>
		At Domisep, we propose our customers a complete range of finely crafted smart sensors. At Domisep, we offer you a doorway
		to the future.
	</p>
	<p>
		<img src="../resources/images/phone-bed.jpg" width="1200" height="650">
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
	<a href='<?php strtok($_SERVER["REQUEST_URI"],'?')?>?signup=true'>
		<h2>
			Create my account
		</h2>
	</a>

</div>

</center>

	<?php 

	//include('pages/homepage/homepage.html');
	  
	include('components/footer/footer.php'); 

	if (isset($_GET['contact'])){
		include('components/modals/contact/contact.php');
	}
	else if (isset($_GET['login'])){
		include('components/modals/login/login.html');
	}
	else if (isset($_GET['signup'])){
		include('components/modals/signup/signup.html');
	}
  ?>
</body>

</html>