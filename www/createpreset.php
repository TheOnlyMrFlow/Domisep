<?php

header('Content-Type: text/html; charset=ISO-8859-1');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(!isset($_SESSION['id'])){
  header('location: index.php');
}
if (!isset($_SESSION['language'])) {
    $_SESSION['language'] = 'en';
}
require("components/component/fonction-php-component.php");
require_once(dirname(__FILE__) . '/utils/dbconnect.php');

?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Create Preset</title>
    <link rel="stylesheet" type="text/css" href="./style/createpreset.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU"
        crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" media="screen" href="style/dashboard-style.min.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="style/full-site-style.min.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="components/modals/modal.min.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="components/footer/footer.min.css" />
    <link rel='stylesheet' type='text/css' media='screen' href='components/component/component-style.min.css' />
    <link rel="stylesheet" href="components/header-nav/header-nav.min.css">
    <link rel="stylesheet" href="components/header-nav/header-dashboard.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="components/header-nav/sticky-header.min.js"></script>
    <script src="scripts/change-language.min.js"></script>
    <script src="scripts/createpreset.js"></script>
</head>

<body>
  <?php

include 'components/header-nav/header-nav.php';
$home_id = $_SESSION['home_id'];
$role = $_SESSION['role'];
$user_id = $_SESSION['id'];
$db = dbconnect();
?>
  <div class="page-content-container">
    <div class="page-content">
      <div class="dashboard-big-container">
          <h2>Create preset</h2>
          <div class="dashboard-inner-container">
            <div class="">
              <h3>Preset name</h3>
            </div>
            <div>
              <input id="NamePreset" type="text" name="Name of the preset" placeholder="  example : holidays">
            </div>
          </div>
          <div class="dashboard-inner-container">
            <div>
              <h3>Add sensor</h3>
            </div>
            <div>
              <select id="select-sensor">
              <?php
              if ($role == 'house_member') {
                  $query = "SELECT DISTINCT
                        rooms.name,
                        components.serial_number,
                        components.name
                    FROM
                        components
                    INNER JOIN rooms ON components.id_room = rooms.id
                    INNER JOIN user_rights ON components.serial_number = user_rights.serial_number
                    WHERE
                        (
                            rooms.id_home = $home_id AND user_rights.id_user = $user_id AND user_rights.access_level='write'
                        )
                    ORDER BY
                        rooms.name,
                        components.name";

                }
              elseif($role=='house_manager'){
                $query = "SELECT
                              rooms.name,
                              components.serial_number,
                              components.name
                        FROM
                            components
                        INNER JOIN rooms ON components.id_room = rooms.id
                        WHERE
                                rooms.id_home = $home_id
                        ORDER BY
                            rooms.name,
                            components.name";

              }
              $components_array = mysqli_query($db, $query);
              $html = "<option value='disabled' selected>-- Select a sensor --</option>";
              while ($component_row = mysqli_fetch_row($components_array)) {
                  $room_name = $component_row[0];
                  $component_id = $component_row[1];
                  $component_name = $component_row[2];
                  $html .= "<option value='$component_id'>$room_name - $component_name</option>";
              }
              echo $html;
              ?>
            </select>
          </div>
          </div>
          <div class="dashboard-inner-container" id="addedZone">
            <div class='section_components'>
              <div class='components_line'></div>
            </div>
          </div>

              <div class = "dashboard-inner-container" id="SaveZone">
                <div>
                  <input id="Save" type="submit" value="Save the preset">
                </div>
              </div>
            </div>
        </div>

      <!-- <div id="MainDiv">
              <div id="CapteursDiv"><br/>
                <section id="dropdown">

                          <option value="sensor A" class="li-sensor" id="1">Sensor A</option>
                          <option value="sensor B" class="li-sensor" id="2">Sensor B</option>
                          <option value="sensor C" class="li-sensor" id="3">Sensor 4</option>
                          <option value="sensor D" class="li-sensor" id="4">Sensor C</option>
                      </select>
                </section>
              </div>

      </div>




      <i class="fa fa-arrow-left"></i> -->


  </div>

  <?php
  include 'components/modals/contact/contact.php';
  include 'components/footer/footer.php';
  include 'components/modals/component-details/component-details.php';
  ?>

</body>
</html>
