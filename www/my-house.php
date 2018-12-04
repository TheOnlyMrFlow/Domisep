<?php

session_start();
require('scripts/fonction_php_component.php');

?>

<!DOCTYPE html>

<html>

<head>
	<meta charset="utf-8" />
	<title>My House - Domisep</title>
	<link rel="stylesheet" type="text/css" media="screen" href="../style/full-site-style.min.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="../style/component-style.min.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="../style/dashboard-style.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="components/modals/modal.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="components/footer/footer.min.css" />
	<link rel="stylesheet" href="style/myhouse.css"/>
	<link rel="stylesheet" href="components/header-nav/header-nav.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="components/header-nav/sticky-header.min.js"></script>
	<script src="jquery.js"></script>
	<script src="myhouse_jquery.js"></script>
</head>

<body>
	<?php

// if ($_SESSION['connected']){
//
// }
include 'components/header-nav/header-nav.php';
		$db = mysqli_connect('localhost', 'root', '', 'mff');

?>

<center>

		<div class="page-content-container">
      <div class="page-content">

		  <div class="page_content">

			<section class="section_preset">

				<div class= "preset">
<!-- 					<button>Preset name</button>
 -->
				</div>

				<button class="plus-button plus-button--large" href="add_component.html"></button><span id="add-preset-title">Create new preset</span>

			</section>



			<?php
				if($_SESSION['role']='house_manager'){
					$component_query=mysqli_query($db,"SELECT id_room,rooms.name,serial_number,components.name,value FROM components INNER JOIN rooms ON components.id_room=rooms.id WHERE rooms.id_home=$id_home ORDER BY rooms.name,components.name");
");
				}

			?>









		<!-- 	<section class="dashboard-big-container room">

				<div class="room_header">
					<?php
						//$id_home = $_SESSION['id_home'];
						$id_home=1;

						$rooms= mysqli_query($db,"SELECT name FROM rooms");
							// $html='';
							while ($donnees_room = mysqli_fetch_array($rooms))
							{
								$name_room = $donnees_room[0];

							}

							echo "<h3> $name_room </h3>";

							?>
					<div class="section_add_component">
							<button class="plus-button" href="add_component.html"></button><span id="add-comp-title">Add a component</span>
					</div>
				</div>

				<div class="section_components">
					<div class="components_line">
<!-- 										<?php
							//$id_home = $_SESSION['id_home'];
							$id_home=1;

							$components= mysqli_query($db,"SELECT name FROM components");
							while ($donnees_component = mysqli_fetch_array($components))
							{
								$name_component = $donnees_component[0];
							}
							echo $name_component;
							?> -->


							$= mysqli_query($db,"SELECT * FROM components");

							<?php
							componentsFunction('efgg','evrt','verg','ferf');
							?>


							</div>

					</div>


			</section> -->
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
