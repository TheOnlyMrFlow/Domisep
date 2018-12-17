<?php

header('Content-Type: text/html; charset=ISO-8859-1');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(!isset($_SESSION['language'])){
	$_SESSION['language'] = 'en';
}
require("scripts/fonction_php_component.php");
$SESSION_home_id = $_SESSION['home_id']; // create a php variable matching the home id of the connected user

// get presets from database //

$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'mff';

$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM presets WHERE id_home = $SESSION_home_id";
$result = mysqli_query($conn, $sql);

$yourpresets = array();

if (mysqli_num_rows($result) > 0)
{
  // output data of each row
  while($presets = mysqli_fetch_assoc($result))
  {
      array_push($yourpresets, $presets);
  }
}
else {
  echo "You have no preset";
}

//les presets sont contenus dans la variable array $yourpresets//

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
    <link rel="stylesheet" href="components/header-nav/header-nav.min.css">
    <link rel="stylesheet" href="components/header-nav/header-dashboard.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="components/header-nav/sticky-header.min.js"></script>
    <link rel="stylesheet" type="text/css" href="style/newtask.css" />
    <script src="scripts/change-language.min.js"></script>
  </head>

  <body>
<?php

  if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_SESSION['connected']){
}
include 'components/header-nav/header-nav.php';//

?>

      <div class="page-content-container">
        <div class="page-content">
          <div class="dashboard-big-container">
            <h2>New task</h2>
            <div class="dashboard-inner-container">

              <div class="half-wrapper">
                <section class="selectors">
                  <span class="label">Presets</span>
                  <select class="dropdown" name="preset">
                    <?php
                    foreach ($yourpresets as $p){
                      echo "<option value =" . $p['id']. ">". $p['name'] . "</option>";
                    }
                    ?>
                  </select>
                </section>
                <section class="selectors">
                  <span class="label">Frequency</span>
                  <select class="dropdown" name="frequency">
                            <option value="notanoption" disabled selected>-- select frequency --</option>
                            <option value="Daily">Daily</option>
                            <option value="Hourly">Hourly</option>
                            <option value="Weekly">Weekly</option>
                            <option value="Monthly">Monthly</option>
                            <option value="One-time instance">One-time instance</option>
                         </select>
                </section>
                <section class="selectors">
                  <span class="label">Date</span>
                  <input type="date" id="start" name="trip-start" value="2018-07-22" min="2018-01-01" max="2018-12-31">
                </section>
                <section class="selectors">
                    <span class="label">Hour</span>
                    <input type="time" name="chosen_time">
                </section>
              </div>
              <input id="buttonSaveTask" type="button" value="Save the task">
            </div>
          </div>


          <div class="dashboard-big-container">
            <h2>Scheduled Tasks</h2>
            <div class="dashboard-inner-container">
              <table id="presetsTable">
                <tr>
                  <th>Component/preset</th>
                  <th>Frequency</th>
                  <th>Hour</th>
                </tr>
                <tr>
                  <td>Room A</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                  <td>Holdidays Mode</td>
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
