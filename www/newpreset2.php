<?php
session_start();
require("scripts/fonction_php_component.php");
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Create Preset</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="./style/createpreset2.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU"
        crossorigin="anonymous">
      <link rel="stylesheet" type="text/css" media="screen" href="style/dashboard-style.min.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="style/full-site-style.min.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="style/component-style.min.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="components/modals/modal.min.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="components/footer/footer.min.css" />
    <link rel="stylesheet" href="components/header-nav/header-nav.min.css">
    <link rel="stylesheet" href="components/header-nav/header-dashboard.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="components/header-nav/sticky-header.min.js"></script>

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
      <p>
          <input id="NamePreset" type="text" name="Name of the preset" placeholder="Name of the preset">
          <br /><br/>
      </p>

      <div id="MainDiv">
              <div id="CapteursDiv"><br/>
                  <form>
                      <select id="select-sensor">
                          <option value="Select a sensor" disabled selected>-- Select a sensor --</option>
                          <option value="sensor A" class="li-sensor" id="1">Sensor A</option>
                          <option value="sensor B" class="li-sensor" id="2">Sensor B</option>
                          <option value="sensor C" class="li-sensor" id="3">Sensor 4</option>
                          <option value="sensor D" class="li-sensor" id="4">Sensor C</option>
                      </select>
                  </form>
              </div>

          <div id="addedZone">
          </div>
      </div>



      <div id="SaveZone">
          <input id="Save" type="button" value="Save the preset">
      </div>

      <i class="fa fa-arrow-left"></i>


    </div>
  </div>

  <?php
  include 'components/modals/contact/contact.php';
  include 'components/footer/footer.php';
  include 'components/modals/component-details/component-details.php';
  ?>

</body>

<script src="./scripts/createpreset2.js"></script>

</html>
