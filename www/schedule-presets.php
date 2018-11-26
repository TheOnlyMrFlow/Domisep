<?php 

session_start();

?>


<!DOCTYPE html>

<html>

<head>
	<meta charset="utf-8" />
	<title>My House - Domisep</title>
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

		<div class="page-content-container">
      <div class="page-content">

			</div>
		</div>
		
<?php
include('components/modals/contact/contact.php');
include('components/footer/footer.php');
?>
</body>

<script src="scripts/open-modals.js"></script>

</html>
