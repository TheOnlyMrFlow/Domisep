<!DOCTYPE html>

<html>

<head>
	<meta charset="utf-8" />
	<title>Domisep</title>

	<link rel="stylesheet" type="text/css" media="screen" href="../style/style.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="components/modals/modal.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="components/header-nav/header-nav.css" />



</head>

<body>
	<?php 

	include('components/header-nav/header-nav.html');

	include('pages/homepage/homepage.html');
	  
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