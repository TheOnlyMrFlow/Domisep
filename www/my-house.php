<?php

session_start();
header('Content-Type: text/html; charset=ISO-8859-1');

if (!isset($_SESSION['connected']) || !$_SESSION['connected']){
	header('Location: ./index.php');
}


?>

<!DOCTYPE html>

<html>

<head>
	<meta charset="utf-8" />
	<title>My House - Domisep</title>
	<link rel="stylesheet" type="text/css" media="screen" href="style/add_a_component_pop_up.css" />
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
				<div class="page-title">
					<h1>My House</h1>
				</div>
			<section class="section_preset">

				<div class= "preset">
					<button>Preset name</button>
				</div>

				<button class="plus-button plus-button--large"  onclick="location.href='newpreset2.php'" type="button"></button><span id="add-preset-title">Create new preset</span>

			</section>

			<?php
			$db = mysqli_connect('localhost', 'root', '', 'mff');
			$id_home = $_SESSION['home_id'];
			$components_array = mysqli_query($db, "SELECT id_room,rooms.name,serial_number,components.name,value FROM components INNER JOIN rooms ON components.id_room=rooms.id WHERE rooms.id_home=$id_home ORDER BY rooms.name,components.name");
			$html = '';
			$current_room_id = null;
			$first_room = 1;
			while($component_array = mysqli_fetch_row($components_array)){
				if($component_array[0]!=$current_room_id){
					$current_room_id = $component_array[0];
					$room_name = $component_array[1];
					$component_id = $component_array[2];
					$component_name = $component_array[3];
					$component_value = $component_array[4];
					if(!$first_room){
						$html .= "</div></div></section>";
					}
					$first_room = 0;
					$html .= "<section class='$current_room_id dashboard-big-container room'>

								<div class='room_header'>
									<h3>$room_name</h3>
									<div class='section_add_component'>
											<button class='plus-button new-comp-opener'></button><span id='add-comp-title'>Add a component</span>
									</div>
								</div>

								<div class='section_components'>
									<div class='components_line'>
										<div class='component' id='$component_id'>
											<div class='component_title'>
											$component_name
											</div>
												<br>
											<div class='component_middle'>
												<div class='logo'>
													<img src='./resources/images/lightbulb3.png' alt='light'>
												</div>
												<div class='fleches'>
													<div class='flechehaut'>
														<img src='./resources/images/fleche_haut2.png' alt='fleche haut'>
													</div>
													<div class='flechebas'>
														<img src='./resources/images/fleche_bas2.png' alt='fleche bas'>
													</div>
												</div>
											</div>
											<div class='component_bas'>

												<div class='onoffswitch'>
														<input type='checkbox' name='onoffswitch' class='onoffswitch-checkbox' id='myonoffswitch' checked>
													<label class='onoffswitch-label' for='myonoffswitch'>
														<span class='onoffswitch-inner'></span>
														<span class='onoffswitch-switch'></span>
													</label>
												</div>
												<div class='bouton_3_points'>
													<a href='#'>...</a>
												</div>
											</div>
										</div>";
			}
			else{
					$component_id = $component_array[2];
					$component_name = $component_array[3];
					$html .= "<div class='component' id='$component_id'>
						<div class='component_title'>
						$component_name
						</div>
							<br>
						<div class='component_middle'>
							<div class='logo'>
								<img src='./resources/images/lightbulb3.png' alt='light'>
							</div>
							<div class='fleches'>
								<div class='flechehaut'>
									<img src='./resources/images/fleche_haut2.png' alt='fleche haut'>
								</div>
								<div class='flechebas'>
									<img src='./resources/images/fleche_bas2.png' alt='fleche bas'>
								</div>
							</div>
						</div>
						<div class='component_bas'>

							<div class='onoffswitch'>
									<input type='checkbox' name='onoffswitch' class='onoffswitch-checkbox' id='myonoffswitch' checked>
								<label class='onoffswitch-label' for='myonoffswitch'>
									<span class='onoffswitch-inner'></span>
									<span class='onoffswitch-switch'></span>
								</label>
							</div>
							<div class='bouton_3_points'>
								<a href='#'>...</a>
							</div>
						</div>
					</div>";
				}
			}
			if($components_array->num_rows!=0){
				$html .= "</div></div></section>";
			}
				echo $html;
			?>

			<div class="section_add_room">
				<button class="plus-button plus-button--large" href="add_component.html"></button><span id="add-room-title">Add a room</span>
			</div>
		</div>
	</div>
</div>

<?php
include 'components/modals/contact/contact.php';
include 'components/footer/footer.php';
include 'components/modals/component-details/component-details.php';
include 'components/modals/new-component/new-component.php';
?>
</body>

<script src="scripts/open-modals.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js"></script>

<script src="components/modals/component-details/component-details.js"></script>


</html>
