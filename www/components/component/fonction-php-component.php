<!-- Fonction php component
 -->
<?php
function componentsFunction($serial_number, $name_component, $component_value,  $state, $right){
			if ($state == 0) {
				$checked = "";
				$color = '#7A7A7A';
			}
			else{
				$checked = "checked";
				$color = '#4BD763';
			}
			$adjust='';
			$type = substr($serial_number, 4 , 4);


			if ($type == 'lght'){
				$icon = "<span style='color: $color;'><i class='fas fa-lightbulb fa-2x'></i></span>";
				$component_value = "";
			}
			elseif($type == 'temp'){
				$icon = "<span style='color: $color;'><i class='fas fa-thermometer-half fa-2x' ></i></span>";
				$component_value = "<div class='component-value'>"."<span>".$component_value."</span><span>&deg;C</span></div>";
			}
			elseif($type == 'hmdt'){
				$icon = "<span style='color: $color;'><i class='fas fa-tint fa-2x'></i></span>";
				$component_value = "<div class='component-value'>"."<span>".$component_value."</span><span>%</span></div>";
			}
			elseif($type == 'smok'){
				$icon = "<span style='color: $color;'><i class='fas fa-joint fa-2x' ></i></span>";
				$component_value = "";
			}
			elseif($type == 'shtr'){
				$icon = "<span style='color: $color;'><i class='fas fa-align-justify fa-2x'></i></span>";
				$component_value = "<div class='component-value'>"."<span>".$component_value."</span><span>%</span></div>";
				$adjust = "<div class='change-component-value'>
										<button class='component-plus-button'><i class='fas fa-plus fa-lg'></i></button>
										<button class='component-minus-button'><i class='fas fa-minus fa-lg'></i></button>
									</div>";
			}
			elseif($type == 'airc'){
				$icon = "<span style='color: $color;'><i class='fas fa-temperature-high fa-2x' ></i></span>";
				$component_value = "<div class='component-value'>"."<span>".$component_value."</span><span>&deg;C</span></div>";
				$adjust = "<div class='change-component-value'>
										<button class='component-plus-button'><i class='fas fa-plus fa-lg'></i></button>
										<button class='component-minus-button'><i class='fas fa-minus fa-lg'></i></button>
									</div>";
			}
			else{
				$icon = "<span style='color: $color;'><i class='fas fa-question fa-2x' ></i></span>";
			}

				$html=	"
									<div class='component' id='$serial_number'>
									  <div class='component_title'>
									    $name_component
									  </div>
									  <div class='component_middle'>
									    <div class='logo'>
									      $icon
									    </div>
											$component_value
											$adjust
										</div>
									  <div class='component_bas'>
									    <label class='form-switch'>
									      <input $checked type='checkbox'>
									      <i></i>
									    </label>
									    <div class='bouton_3_points comp-details-opener'>
									      <a href='#'>...</a>
									    </div>
									  </div>
									</div>";
				return($html);
	}
?>
