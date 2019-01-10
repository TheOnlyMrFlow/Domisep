<!-- Fonction php component
 -->
<?php
function componentsFunction($serial_number, $name_component, $component_value,  $state, $right){
		$adjust = "";
			$type = substr($serial_number, 4 , 4);
			$icon = "<i class='fas fa-lightbulb fa-2x'></i>";


			if ($type == 'lght'){
				$icon = "<i class='fas fa-lightbulb fa-2x' ></i>";
				$component_value = "";
			}
			elseif($type == 'temp'){
				$icon = "<i class='fas fa-thermometer-half fa-2x' ></i>";
				$component_value = "<div class='component-value'>"."<span>".$component_value."</span><span>&deg;C</span></div>";
			}
			elseif($type == 'hmdt'){
				$icon = "<i class='fas fa-tint fa-2x'></i>";
				$component_value = "<div class='component-value'>"."<span>".$component_value."</span><span>%</span></div>";
			}
			elseif($type == 'smok'){
				$icon = "<i class='fas fa-joint fa-2x' ></i>";
				$component_value = "";
			}
			elseif($type == 'shtr'){
				$icon = "<i class='fas fa-align-justify fa-2x'></i>";
				$component_value = "";
			}
			elseif($type == 'airc'){
				$icon = "<i class='fas fa-temperature-high fa-2x' ></i>";
				$component_value = "<div class='component-value'>"."<span>".$component_value."</span><span>&deg;C</span></div>";
				$adjust = "<div class='change-component-value'>
										<button class='component-plus-button'><i class='fas fa-plus fa-lg'></i></button>
										<button class='component-minus-button'><i class='fas fa-minus fa-lg'></i></button>
									</div>";
			}

				$expected_value=$component_value;
				$html=	"
				<div class='component' id='$serial_number'>
							<div class='component_title'>$name_component</div>
							<div class='component_middle'>
								<div class='logo'>
									$icon
								</div>
								$component_value
								$adjust
							</div>
						</div>";
						$à_garder = "							<div class='component_bas'>
														<label class='switch'>
														  <input type='checkbox' checked>
														  <span class='slider round'></span>
														</label>
														<div class='bouton_3_points comp-details-opener'>
															<a href='#'>...</a>
														</div>
													</div>";
				return($html);
	}
?>
