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
			$smart = false;
			if(substr($serial_number, 0 , 3)=='sma'){
				$smart = true;
			}
			$type = substr($serial_number, 4 , 4);
			// $icon = "<span style='color: #4BD763;'><i class='fas fa-lightbulb fa-2x'></i></span>";


			if ($type == 'lght'){
				$icon = "<span style='color: $color;'><i class='fas fa-lightbulb fa-2x'></i></span>";
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
									  <div class='component_title'>
									    $name_component
									  </div>
									  <br>
									  <div class='component_middle'>
									    <div class='logo'>
									      $icon
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
