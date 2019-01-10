<?php

header('Content-Type: text/html; charset=ISO-8859-1');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(!isset($_SESSION['language'])){
	$_SESSION['language'] = 'en';
}
require("scripts/fonction_php_component.php");

if (!isset($_SESSION['connected']) || !$_SESSION['connected']){
	header('Location: ./index.php');
}


?>
<!DOCTYPE html>

<html>

<head>
	<meta charset="utf-8" />
	<title>
        <?php if($_SESSION['language']=='en'){
        echo('My House - Domisep');
      }elseif ($_SESSION['language']=='fr') {
        echo('Ma maison - Domisep');
      } ?>
  </title>
	<link rel="stylesheet" type="text/css" media="screen" href="style/add_a_component_pop_up.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="style/dashboard-style.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="style/full-site-style.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="style/component-style.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="components/modals/modal.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="components/footer/footer.css" />

	
	<link rel="stylesheet" href="style/myhouse.css"/>
	<link rel="stylesheet" href="components/header-nav/header-nav.css">
	<link rel="stylesheet" href="components/header-nav/header-dashboard.css">
	
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">


	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
	<script src="components/header-nav/sticky-header.js"></script>
	<script src="scripts/change-language.js"></script>
  <script src="scripts\update-component-values.js"></script>

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
					<!-- <h1><?php if($_SESSION['language']=='en'){
            echo('My House');
          }elseif ($_SESSION['language']=='fr') {
            echo('Ma maison');
          } ?></h1> -->
				</div>
			<section class="section_preset">

				<div class= "preset">
					<button>Preset name</button>
				</div>

				<button class="plus-button plus-button--large"  onclick="location.href='newpreset2.php'" type="button"></button><span id="add-preset-title"><?php if($_SESSION['language']=='en'){
          echo htmlentities('Create a preset');
        }elseif ($_SESSION['language']=='fr') {
          echo htmlentities('Créer un preset');
        } ?></span>

			</section>

			<?php
			$db = mysqli_connect('localhost', 'root', '', 'mff');
			$id_home = $_SESSION['home_id'];
			$components_array = mysqli_query($db, "SELECT id_room,rooms.name,serial_number,components.name,value FROM components INNER JOIN rooms ON components.id_room=rooms.id WHERE rooms.id_home=$id_home ORDER BY rooms.name,components.name");
			$html = '';
			$current_room_id = null;
			$first_room = 1;
      $new_component_line;

			while($component_row = mysqli_fetch_row($components_array)){
				if($component_row[0]!=$current_room_id){
          $new_component_line = 0;
					$current_room_id = $component_row[0];
					$room_name = $component_row[1];
					$component_id = $component_row[2];
					$component_name = $component_row[3];
					$component_value = $component_row[4];
					if(!$first_room){
						$html .= "</div></div></section>";
					}
					$first_room = 0;

          if($_SESSION['language']=='en'){
            $add_component = 'Add a component';
          }elseif ($_SESSION['language']=='fr') {
            $add_component = 'Ajouter un composant';
          }

					$html .= "<section id='$current_room_id' class='dashboard-big-container room'>

								<div class='room_header'>
									<form class='change-room-name'>
										<input value='$current_room_id' name='room_id' style='display: none;'>
              							<input class='room-name' type='text' name='room_name' value='$room_name'>
										<input type='submit' name='update-name' style='display: none;'>

	            					</form> 
	            					<div class='section_add_component'>
										<button class='plus-button new-comp-opener'></button><span id='add-comp-title'>$add_component</span>
									</div>

								</div>
								
						        

								<div class='section_components'>
									<div class='components_line'>
								<div class='delete_room'>
								    <i class='material-icons'>delete</i>
								</div>
									";
            $html .= componentsFunction($component_id, $component_name, $component_value);
            $new_component_line++;
			}
			else{
        if($new_component_line%5==0){
          $html .= "</div><div class='components_line'>";
        }
					$component_id = $component_row[2];
					$component_name = $component_row[3];
					$html .= componentsFunction($component_id, $component_name, $component_value);
          $new_component_line++;
				}
			}


      			if($components_array->num_rows!=0){
      				$html .= "</div></div></section>";
      			}

      $empty_rooms_array = mysqli_query($db, "SELECT rooms.id,rooms.name FROM rooms LEFT JOIN components ON rooms.id=components.id_room WHERE components.id_room IS NULL");
      while($empty_rooms_row = mysqli_fetch_row($empty_rooms_array)){
        $current_room_id = $empty_rooms_row[0];
        $room_name = $empty_rooms_row[1];
        $html .= "<section id='$current_room_id' class='dashboard-big-container room'>

              <div class='room_header'>
              	<form class='change-room-name'>
              		<input value='$current_room_id' name='room_id' style='display: none;'>
              		<input class='room-name' type='text' name='room_name' value='$room_name'>
              		<input type='submit' name='update-name' style='display: none;'>
	            </form>   
	                <div class='section_add_component'>
	                    <button class='plus-button new-comp-opener'></button><span id='add-comp-title'>$add_component</span>
	                </div>

	        </div>
	        <div class='delete_room'>
	            <i class='material-icons'>delete</i>
	        </div>
               
              </section>";
      }

				echo $html;
			?>

			<div class="section_add_room">
				<form method="POST" action="./handlers/handle_add_a_room.php">
				<button class="plus-button plus-button--large" onclick="this.submit()"></button>
				<input style="display: none;" name="new_room">
				<span id="room_name">

					<?php if($_SESSION['language']=='en'){
         					 echo('Add a room');

       				}
       				elseif ($_SESSION['language']=='fr') {
          				echo htmlentities('Ajouter une pièce');
        			} ?>
        	
		        </span>
		        </form>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/livequery/1.1.1/jquery.livequery.js"></script>



<script src="components/modals/component-details/component-details.js"></script>
<script src="components/modals/new-component/new-component.js"></script>
<script src="scripts/change-room-name.js"></script>


</html>
