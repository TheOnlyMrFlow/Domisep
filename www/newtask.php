<?php

header('Content-Type: text/html; charset=ISO-8859-1');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(!isset($_SESSION['language'])){
	$_SESSION['language'] = 'en';
}
require("scripts/fonction_php_component.php");

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>New Task</title>
    <meta charset="utf-8" />
    <title>My House - Domisep</title>
    <link rel="stylesheet" type="text/css" media="screen" href="style/dashboard-style.min.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="style/full-site-style.min.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="style/component-style.min.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="components/modals/modal.min.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="components/footer/footer.min.css" />
    <link rel="stylesheet" href="style/myhouse.min.css"/>
    <link rel="stylesheet" href="components/header-nav/header-nav.min.css">
    <link rel="stylesheet" href="components/header-nav/header-dashboard.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="components/header-nav/sticky-header.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../style/newtask.css"/>
    <script src="scripts/change-language.min.js"></script>
</head>
<body>
  <?php

  if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// if ($_SESSION['connected']){
//
// }
include 'components/header-nav/header-nav.php';

?>
<div class="page-content-container">
  <div class="page-content">
    <div id="NewTask">
        <div id="contentNewTask">
                <h1 id="titleNewTask">New task</h1>
                <div id="c1">
                    Component/preset
                    <!-- <form action="/action_page.php"> -->
                    <br/>Frequency
                    <br/>Start Date
                </div>
                <div id="c2">
                        <div id="component">
                            <form>
                                <select name="components">
                                  <option value="Light A">Lampe A</option>
                                  <option value="Heat A">Chauffage A</option>
                                  <option value="Light B">Lampe B</option>
                                  <option value="Stores">Volets A</option>
                                </select>
                                <input type="submit" value="Submit">
                            </form></div><br/>
                        <div id="frequency">
                            <form>
                                <select name="frequency">
                                    <option value="Daily">Daily</option>
                                    <option value="Hourly">Hourly</option>
                                    <option value="Weekly">Weekly</option>
                                </select>
                                <input type="submit" value="Submit">
                            </form>
                        </div><br/>
                        <div id="time">
                            <form>
                                <input type="datetime-local" id="meeting-time"
                                name="meeting-time" value="2018-06-12T19:30"
                                min="2018-06-07T00:00" max="2018-06-14T00:00">
                            </form>
                        </div><br/>

                </div>
                <div id="c3">State</div>
                <div id="c4">
                    <form>
                        <select name="State">
                            <option value="ON">ON</option>
                            <option value="OFF">OFF</option>
                        </select>
                        <input type="submit" value="Submit">
                    </form></div>
                <div id="c5">Value</div>
                <div id="c6">
                    <form>
                        <select name="Value">
                            <option value="tbd">to be disclosed</option>
                        </select>
                        <input type="submit" value="Submit">
                    </form>
                </div>
        </div>
        <div id="SaveTask">
        <input id="buttonSaveTask" type="button" value="Save the task">
        </div>
    </div>


    <div id="ScheduledTask">
        <div id="contentScheduledTask">
            <h1 id="titleScheduledTask">Scheduled Tasks</h1>
            <table id="presetsTable">
                <tr>
                    <th>Component/preset</th>
                    <th>State</th>
                    <th>Value</th>
                    <th>Frequency</th>
                </tr>
                <tr>
                    <td>Room A</td@>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Holdidays Mode</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </table>
        </div>
    </div>
  </div>

</div>
<?php
include 'components/modals/contact/contact.php';
include 'components/footer/footer.php';
include 'components/modals/component-details/component-details.php';
?>
</body>
</html>
