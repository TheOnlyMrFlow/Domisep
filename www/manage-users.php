<!DOCTYPE html>

<html>

<head>
	<meta charset="utf-8" />
	<title>My House - Domisep</title>
	<link rel="stylesheet" type="text/css" media="screen" href="../style/style.min.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="../style/dashboard-style.min.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="components/modals/modal.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="components/footer/footer.min.css" />
	<link rel="stylesheet" href="components/header-nav/header-nav.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="components/header-nav/sticky-header.min.js"></script>

</head>

<body>
	<?php

    include('components/header-nav/header-nav.php');
		$db = mysqli_connect('localhost', 'root', '', 'mff');

    ?>

		<div class="page-content-container dashboard">
			<div class="page-content dashboard">
				<div class="dashboard-big-container">
					<h2>Add User</h2>
					<div class="dashboard-inner-container">
						<form action="handlers/handle-add-user.php" method="post">
							<div>
								<h3>E-mail</h3>
							</div>
							<div>
								<input type="text" name="e-mail" placeholder="ilove@domisep.fr">
							</div>
							<div>
								<input type="submit" value="Add">
							</div>
						</form>
					</div>
					<h2>Current Users</h2>
					<div class="dashboard-inner-container">
						<table width="100%">
							<colgroup>
								<col width="30%"/>
								<col width="30%"/>
								<col width="30%"/>
								<col width="10%"/>
							</colgroup>
							<tr>
								<th>Mail</th>
								<th>First Name</th>
								<th>Last Name</th>
								<th></th>
							</tr>
							<tr>
								<?php  ?>
							</tr>
						</table>
					</div>
				</div>
			</div>
		</div>

<?php
include('components/modals/contact/contact.php');
include('components/footer/footer.php');
?>
</body>

<script src="scripts/open-modals.js"></script>

</html>
