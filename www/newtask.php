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

            <div id="title">
                <h1 id="titleNewTask">New task</h1>
            </div>

            <div class="total-wrapper">

                <div class="half-wrapper">
                    <section class = "selectors">
                        <span class ="label">Component</span>
                        <select class ="dropdown" name="components">
                            <option value="notanoption" disabled selected>-- select a component --</option>
                            <option value="Light A">Lampe A</option>
                            <option value="Heat A">Chauffage A</option>
                            <option value="Light B">Lampe B</option>
                            <option value="Stores">Volets A</option>
                        </select>
                    </section>
                    <section class = "selectors">
                        <span class="label">State</span>
                        <select class ="dropdown" name="State">
                            <option value="notanoption" disabled selected>-- select a state --</option>
                            <option value="ON">ON</option>
                            <option value="OFF">OFF</option>
                        </select>
                    </section>
                    <section class = "selectors">
                        <span class="label">Value</span>
                        <select class ="dropdown" name="Value">
                            <option value="tbd" disabled selected>-- to be disclosed --</option>
                        </select>
                    </section>
                    <section class = "selectors">
                        <span class ="label">Frequency</span>
                        <select class ="dropdown" name="frequency">
                            <option value="notanoption" disabled selected>-- select frequency --</option>
                            <option value="Daily">Daily</option>
                            <option value="Hourly">Hourly</option>
                            <option value="Weekly">Weekly</option>
                         </select>
                    </section>
                    <section class = "selectors">
                        <span class="label">Date</span>
                        <input type="date" id="start" name="trip-start"
                                value="2018-07-22"
                                min="2018-01-01" max="2018-12-31">
                    </section>
                 </div>

                 <div class="half-wrapper">
                     <section class = "saveSection">
                     <input id="buttonSaveTask" type="button" value="Save the task">
                    </section>
                 </div>
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

<?php
include 'components/modals/contact/contact.php';
include 'components/footer/footer.php';
include 'components/modals/component-details/component-details.php';
?>
</body>
</html>
