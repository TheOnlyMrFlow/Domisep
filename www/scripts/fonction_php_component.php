<!-- Fonction php component
 -->
<?php

function componentsFunction($serial_number, $name_component, $component_value){

				$html=	"<div class='$serial_number component'>
							<div class='component_title'>
							$name_component
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
									<a href='component_parameters.html'>...</a>
								</div>
							</div>
						</div>";
				echo($html);
	}
?>
