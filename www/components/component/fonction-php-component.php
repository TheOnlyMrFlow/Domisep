<!-- Fonction php component
 -->
<?php
function create_component_html($serial_number, $name_component, $component_value,  $state, $right){
	    //header('Content-Type: text/html; charset=ISO-8859-1');
			if ($state == 0) {
				$checked = "";
				$color = '#7A7A7A';
			}
			else{
				$checked = "checked";
				$color = '#4BD763';
			}
			$adjust='';
			if(strlen($serial_number)>8){
				$type = substr($serial_number, 4 , 4);
			}
			else {
				$type = null;
			}
			if ($right == 'read') {
				$pointer_events_none = 'no-click';
				$cursor_not_allowed_beg = "<div class='cursor-not-allowed'>";
				$cursor_not_allowed_end = "</div>";
			}
			else{
				$pointer_events_none = '';
				$cursor_not_allowed_beg = '';
				$cursor_not_allowed_end = '';
			}


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
				$adjust = "$cursor_not_allowed_beg<div class='change-component-value'>
										<button class='change-value-button component-plus-button $pointer_events_none'><i class='fas fa-plus fa-lg'></i></button>
										<button class='change-value-button component-minus-button $pointer_events_none'><i class='fas fa-minus fa-lg'></i></button>
									</div>$cursor_not_allowed_end";
			}
			elseif($type == 'airc'){
				$icon = "<span style='color: $color;'><i class='fas fa-temperature-high fa-2x' ></i></span>";
				$component_value = "<div class='component-value'>"."<span>".$component_value."</span><span>&deg;C</span></div>";
				$adjust = "$cursor_not_allowed_beg<div class='change-component-value'>
										<button class='change-value-button component-plus-button $pointer_events_none'><i class='fas fa-plus fa-lg'></i></button>
										<button class='change-value-button component-minus-button $pointer_events_none'><i class='fas fa-minus fa-lg'></i></button>
									</div>$cursor_not_allowed_end";
			}
			else{
				$icon = "<span style='color: $color;'><i class='fas fa-question fa-2x' ></i></span>";
				$component_value = "";
			}
				$html=	"
									<div class='component' id='$serial_number'>
										$cursor_not_allowed_beg<i onClick='deleteComponent(\"$serial_number\")' class='far fa-minus-square fa-lg $pointer_events_none'></i>$cursor_not_allowed_end
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
									$cursor_not_allowed_beg
									  <div class='component_bas'>
									    <label class='form-switch $pointer_events_none'>
									      <input class='$pointer_events_none' $checked type='checkbox'>
									      <i class='$pointer_events_none'></i>
									    </label>
									    <i class='fas fa-ellipsis-h comp-details-opener $pointer_events_none'></i>
									  </div>
										$cursor_not_allowed_end
									</div>";
				return($html);
	}
?>
