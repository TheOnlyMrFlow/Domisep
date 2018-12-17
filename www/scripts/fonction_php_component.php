<!-- Fonction php component
 -->
<?php
function componentsFunction($serial_number, $name_component, $component_value){
				$expected_value=$component_value;
				$html=	"<div class='component' id='$serial_number'>
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
									<div class='expected_value'>$expected_value</div>
									<div class='flechebas'>
										<img src='./resources/images/fleche_bas2.png' alt='fleche bas'>
									</div>
									
								</div>

							</div>
							<div class='real_value'> 32 </div>
							
							<div class='component_bas'>
								
							<label class='switch'>
							  <input type='checkbox' checked>
							  <span class='slider round'></span>
							</label>
								<div class='bouton_3_points comp-details-opener'>
									<a href='#'>...</a>
								</div>
							</div>
						</div>";
				return($html);
	}
?>
