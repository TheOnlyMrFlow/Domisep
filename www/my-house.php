<?php

session_start();

?>

<!DOCTYPE html>

<html>

<head>
	<meta charset="utf-8" />
	<title>My House - Domisep</title>
	<!-- <link rel="stylesheet" type="text/css" media="screen" href="../style/style.css" /> -->
	<link rel="stylesheet" type="text/css" media="screen" href="../style/dashboard-style.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="components/modals/modal.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="components/footer/footer.min.css" />
	<link rel="stylesheet" href="style/myhouse.css"/>
	<link rel="stylesheet" href="components/header-nav/header-nav.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="components/header-nav/sticky-header.min.js"></script>
</head>

<body>
	<?php

// if ($_SESSION['connected']){
//
// }
include 'components/header-nav/header-nav.php';

?>

<center>

		<div class="page-content-container">
      <div class="page-content">

		  <div class="page_content">

			<section class="section_preset">

				<div class= "preset">
					<button>Preset name</button>
				</div>

				<button class="plus-button plus-button--large" href="add_component.html"></button><span id="add-preset-title">Create new preset</span>

			</section>


			<section class="dashboard-big-container room">

				<div class="room_header">
					<h3>Room 1</h3>
					<div class="section_add_component">
							<button class="plus-button" href="add_component.html"></button><span id="add-comp-title">Add a component</span>
					</div>
				</div>

				<div class="section_components">
					<div class="component">
						<div class="component_title">
						Component
						</div>
							<br>
						<div class="component_middle">
							<div class="logo">
								<img src="./resources/images/lightbulb3.png" alt="light">
							</div>
							<div class="fleches">
								<div class="flechehaut">
									<img src="./resources/images/fleche_haut2.png" alt="fleche haut">
								</div>
								<div class="flechebas">
									<img src="./resources/images/fleche_bas2.png" alt="fleche bas">
								</div>
							</div>
						</div>
						<div class="component_bas">

							<div class="onoffswitch">
									<input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch" checked>
								<label class="onoffswitch-label" for="myonoffswitch">
									<span class="onoffswitch-inner"></span>
									<span class="onoffswitch-switch"></span>
								</label>
							</div>
							<div class="bouton_3_points">
								<a href="component_parameters.html">...</a>
							</div>
						</div>
					</div>
				</div>



			</section>
			<div class="section_add_room">
				<button class="plus-button plus-button--large" href="add_component.html"></button><span id="add-room-title">Add a room</span>
			</div>
		</div>

			</div>
		</div>

		</center>

<?php
include 'components/modals/contact/contact.php';
include 'components/footer/footer.php';
?>
</body>

<script src="scripts/open-modals.js"></script>

</html>
