<?php 

session_start();

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8"/>
		<link rel="stylesheet" href="style/myhouse.css"/>
		<title>myhouse.html</title>
	</head>
	<body>
	<div class="page_content">
			
		<section class="section_preset"> 

			<div class= "preset">
				<button>Preset name</button>
			</div>

			<div class="add_preset">
				<a href="add_preset.html">+</a>
			</div>

			<div class="create_preset">
				Create a new preset
			</div>
		
		</section>


		<section class="room">

			<div class="room_title">
				Room 1
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


			<div class="section_add_component">
				<div class="add_component">
					<a href="add_component.html">+</a>
				</div>
				<!-- <div class="create_component"> -->
					<!-- Add a component -->
				<!-- </div> -->
			</div>
		</section>
		<div class="section_add_room">
			<div class="add_room">
				<a href="add_room.html">+</a>
			</div>
			<div class="create_room">
				Add a room
			</div>
		</div>
	</div>	
	</body>
</html>