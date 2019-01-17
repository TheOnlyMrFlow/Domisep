<?php

require_once(dirname(__FILE__) . '/utils/dbconnect.php');


header('Content-Type: text/html; charset=ISO-8859-1');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['language'])) {
    $_SESSION['language'] = 'en';
}
require("components/component/fonction-php-component.php");

if (!isset($_SESSION['connected']) || !$_SESSION['connected']) {
    header('Location: ./index.php');
}


?>
<!DOCTYPE html>

<html>

<head>
	<meta charset="utf-8" />
	<title>
        <?php if ($_SESSION['language']=='en') {
    echo('My House - Domisep');
} elseif ($_SESSION['language']=='fr') {
    echo('Ma maison - Domisep');
} ?>
  </title>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" media="screen" href="style/add_a_component_pop_up.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="style/dashboard-style.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="style/full-site-style.min.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="components/component/component-style.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="components/modals/modal.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="components/footer/footer.css" />
	<link rel="stylesheet" href="style/myhouse.css"/>
	<link rel="stylesheet" href="components/header-nav/header-nav.css">
	<link rel="stylesheet" href="components/header-nav/header-dashboard.css">

  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js"></script>
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
					<!-- <h1><?php if ($_SESSION['language']=='en') {
    echo('My House');
} elseif ($_SESSION['language']=='fr') {
    echo('Ma maison');
} ?></h1> -->
				</div>
			<section class="section_preset">

				<div class= "preset">
					<button>Preset name</button>
				</div>

				<button class="plus-button plus-button--large"  onclick="location.href='createpreset.php'" type="button"></button><span id="add-preset-title"><?php if ($_SESSION['language']=='en') {
    echo htmlentities('Create a preset');
} elseif ($_SESSION['language']=='fr') {
    echo htmlentities('Créer un preset');
} ?></span>

			</section>

			<?php
            $db = dbconnect();
            $id_home = $_SESSION['home_id'];
            $id_user = $_SESSION['id'];
            $role = $_SESSION['role'];

            if ($role == 'house_member') {
                $query = "SELECT DISTINCT
                      rooms.id,
                      rooms.name,
                      components.serial_number,
                      components.name,
                      components.value,
                      components.state,
                      user_rights.access_level
                  FROM
                      components
                  INNER JOIN rooms ON components.id_room = rooms.id
                  INNER JOIN user_rights ON components.serial_number = user_rights.serial_number
                  WHERE
                      (
                          rooms.id_home = $id_home AND user_rights.id_user = $id_user AND user_rights.access_level<>'none'
                      )
                  ORDER BY
                      rooms.name,
                      components.name";

                $components_array = mysqli_query($db, $query);
                $html = '';
                $current_room_id = null;
                $first_room = 1;
                $new_component_line;
                $remaining_rooms_vector = array();

                while ($component_row = mysqli_fetch_row($components_array)) {
                    if ($component_row[0]!=$current_room_id) {
                        $new_component_line = 0;
                        $current_room_id = $component_row[0];
                        array_push($remaining_rooms_vector, $current_room_id);
                        $room_name = $component_row[1];
                        $component_id = $component_row[2];
                        $component_name = $component_row[3];
                        $component_value = $component_row[4];
                        $component_state = $component_row[5];
                        $access_level = $component_row[6];

                        if (!$first_room) {
                            $html .= "</div></div></section>";
                        }
                        $first_room = 0;

                        if ($_SESSION['language']=='en') {
                            $add_component = 'Add a component';
                        } elseif ($_SESSION['language']=='fr') {
                            $add_component = 'Ajouter un composant';
                        }

                        $html .= "<section id='$current_room_id' class='dashboard-big-container room'>

                      <div class='room_header'>
                        <form class='change-room-name'>
                              <input value='$current_room_id' name='room_id' style='display: none;'>
                              <input class='room-name' type='text' name='room_name' value='$room_name'>
                              <input type='submit' name='update-name' style='display: none;'>
                        </form>
                        <div class= 'header_left'>
                          <div class='delete_room'>
                            <form method='POST' action='./handlers/handle_delete_a_room.php'>
                              <i class='material-icons delete-room-icon' onclick='this.parentElement.submit()'>delete </i>
                              <input style='display: none;' name='remove_room' value='$current_room_id'>
                              <span id='delete'>
                            </form>
                          </div>
                          <div class='section_add_component'>
                              <button class='plus-button new-comp-opener'></button><span id='add-comp-title'> Add a component</span>
                          </div>
                        </div>
                      </div>

                  <div class='section_components'>
                    <div class='components_line'>";
                        $html .= create_component_html($component_id, $component_name, $component_value, $component_state, $access_level);
                        $new_component_line++;
                    } else {
                        if ($new_component_line%5==0) {
                            $html .= "</div><div class='components_line'>";
                        }
                        $component_id = $component_row[2];
                        $component_name = $component_row[3];
                        $component_value = $component_row[4];
                        $component_state = $component_row[5];
                        $access_level = $component_row[6];

                        $html .= create_component_html($component_id, $component_name, $component_value, $component_state, $access_level);
                        $new_component_line++;
                    }
                }
            } elseif ($role == 'house_manager') {
                $query = "SELECT
                      id_room,
                      rooms.name,
                      serial_number,
                      components.name,
                      value,
                      state
                  FROM
                      components
                  INNER JOIN rooms ON components.id_room = rooms.id
                  WHERE
                      (
                          rooms.id_home = $id_home
                      )
                  ORDER BY
                      rooms.name,
                      components.name";

                $components_array = mysqli_query($db, $query);
                $html = '';
                $current_room_id = null;
                $first_room = 1;
                $new_component_line;
                $remaining_rooms_vector = array();

                while ($component_row = mysqli_fetch_row($components_array)) {
                    if ($component_row[0]!=$current_room_id) {
                        $new_component_line = 0;
                        $current_room_id = $component_row[0];
                        array_push($remaining_rooms_vector, $current_room_id);
                        $room_name = $component_row[1];
                        $component_id = $component_row[2];
                        $component_name = $component_row[3];
                        $component_value = $component_row[4];
                        $component_state = $component_row[5];

                        if (!$first_room) {
                            $html .= "</div></div></section>";
                        }
                        $first_room = 0;

                        if ($_SESSION['language']=='en') {
                            $add_component = 'Add a component';
                        } elseif ($_SESSION['language']=='fr') {
                            $add_component = 'Ajouter un composant';
                        }

                        $html .= "<section id='$current_room_id' class='dashboard-big-container room'>

                      <div class='room_header'>
                        <form class='change-room-name'>
                          <input value='$current_room_id' name='room_id' style='display: none;'>
                                  <input class='room-name' type='text' name='room_name' value='$room_name'>
                          <input type='submit' name='update-name' style='display: none;'>

                              </form>
                        <div class= 'header_left'>
                          <div class='delete_room'>
                            <form method='POST' action='./handlers/handle_delete_a_room.php'>
                              <i class='material-icons delete-room-icon' onclick='this.parentElement.submit()'>delete </i>
                              <input style='display: none;' name='remove_room' value='$current_room_id'>
                              <span id='delete'>
                            </form>
                          </div>
                          <div class='section_add_component'>
                              <button class='plus-button new-comp-opener'></button><span id='add-comp-title'> Add a component</span>
                          </div>
                        </div>
                      </div>

                  <div class='section_components'>
                    <div class='components_line'>";
                        $html .= create_component_html($component_id, $component_name, $component_value, $component_state, 'write');
                        $new_component_line++;
                    } else {
                        if ($new_component_line%5==0) {
                            $html .= "</div><div class='components_line'>";
                        }
                        $component_id = $component_row[2];
                        $component_name = $component_row[3];
                        $component_value = $component_row[4];
                        $component_state = $component_row[5];

                        $html .= create_component_html($component_id, $component_name, $component_value, $component_state, 'write');
                        $new_component_line++;
                    }
                }
            } elseif ($role == 'administrator') {
                $components_array = mysqli_query($db, "SELECT id_room,rooms.name,serial_number,components.name,value,state
                                                     FROM components INNER JOIN rooms ON components.id_room=rooms.id
                                                     WHERE rooms.id_home=$id_home
                                                     ORDER BY rooms.name,components.name");
                $html = '';
                $current_room_id = null;
                $first_room = 1;
                $new_component_line;
                $remaining_rooms_vector = array();

                while ($component_row = mysqli_fetch_row($components_array)) {
                    if ($component_row[0]!=$current_room_id) {
                        $new_component_line = 0;
                        $current_room_id = $component_row[0];
                        array_push($remaining_rooms_vector, $current_room_id);
                        $room_name = $component_row[1];
                        $component_id = $component_row[2];
                        $component_name = $component_row[3];
                        $component_value = $component_row[4];
                        $component_state = $component_row[5];
                        if (!$first_room) {
                            $html .= "</div></div></section>";
                        }
                        $first_room = 0;

                        if ($_SESSION['language']=='en') {
                            $add_component = 'Add a component';
                        } elseif ($_SESSION['language']=='fr') {
                            $add_component = 'Ajouter un composant';
                        }

                        $html .= "<section id='$current_room_id' class='dashboard-big-container room'>

                        <div class='room_header'>
                          <form class='change-room-name'>
                            <input value='$current_room_id' name='room_id' style='display: none;'>
                                    <input class='room-name' type='text' name='room_name' value='$room_name'>
                            <input type='submit' name='update-name' style='display: none;'>

                                </form>
                          <div class= 'header_left'>
                            <div class='delete_room'>
                              <form method='POST' action='./handlers/handle_delete_a_room.php'>
                                <i class='material-icons delete-room-icon' onclick='this.parentElement.submit()'>delete </i>
                                <input style='display: none;' name='remove_room' value='$current_room_id'>
                                <span id='delete'>
                              </form>
                            </div>
                            <div class='section_add_component'>
                                <button class='plus-button new-comp-opener'></button><span id='add-comp-title'> Add a component</span>
                            </div>
                          </div>
                        </div>

                        <div class='section_components'>
                          <div class='components_line'>
                          ";
                        $html .= create_component_html($component_id, $component_name, $component_value, $component_state, 'write');
                        $new_component_line++;
                    } else {
                        if ($new_component_line%5==0) {
                            $html .= "</div><div class='components_line'>";
                        }
                        $component_id = $component_row[2];
                        $component_name = $component_row[3];
                        $component_value = $component_row[4];
                        $component_state = $component_row[5];
                        $html .= create_component_html($component_id, $component_name, $component_value, $component_state, 'write');
                        $new_component_line++;
                    }
                }
            }

            if ($components_array->num_rows!=0) {
                $html .= "</div></div></section>";
            }

      $remaining_rooms_string = implode(',', $remaining_rooms_vector);
      $remaining_rooms = mysqli_query($db, "SELECT id,name FROM rooms WHERE id_home=$id_home AND id NOT IN ($remaining_rooms_string) ORDER BY name");
      if ($remaining_rooms != false) {
          if ($remaining_rooms->num_rows!=0) {
              while ($empty_rooms_row = mysqli_fetch_row($remaining_rooms)) {
                  $current_room_id = $empty_rooms_row[0];
                  $room_name = $empty_rooms_row[1];
                  $html .= "<section id='$current_room_id' class='dashboard-big-container room'>

                      <div class='room_header'>
                      	<form class='change-room-name'>
                      		<input value='$current_room_id' name='room_id' style='display: none;'>
                      		<input class='room-name' type='text' name='room_name' value='$room_name'>
                      		<input type='submit' name='update-name' style='display: none;'>
        	             </form>
                          <div class='header_left'>
          	                <div class='delete_room'>
                              <form method='POST' action='./controllers/rooms/delete.php'>
                                <i class='material-icons delete-room-icon' onclick='this.parentElement.submit()'>delete</i>
                                <input style='display: none;' name='remove_room' value='$current_room_id'>
                                <span id='delete'>
                              </form>
                            </div>
                            <div class='section_add_component'>
          	                   <button class='plus-button new-comp-opener'></button><span id='add-comp-title'> Add a component</span>
          	                </div>
                          </div>

                      </div>

                      </section>";
              }
          }
      }

                echo $html;
            ?>

      			<div class="section_add_room">
              <form method="POST" action="./controllers/rooms/add.php">
              <button onclick="this.parentElement.submit()" class="plus-button-room plus-button--large"></button>
              <input style="display: none;" name="new_room">
              <span id="room_name">

                <?php if ($_SESSION['language']=='en') {
                echo('Add a room');
            } elseif ($_SESSION['language']=='fr') {
                        echo htmlentities('Ajouter une pièce');
                    } ?>

              </span>
            </form>
        </div>
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
<script src="components/modals/component-details/component-details.js"></script>
<script src="components/modals/new-component/new-component.js"></script>
<script src="scripts/change-room-name.js"></script>


</html>
