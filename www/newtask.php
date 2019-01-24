<?php

require_once (DIRNAME(__FILE__) . '/utils/dbconnect.php');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(!isset($_SESSION['language'])){
	$_SESSION['language'] = 'en';
}
if(!isset($_SESSION['id'])){
  header('location: index.php');
}
$SESSION_home_id = $_SESSION['home_id']; // create a php variable matching the home id of the connected user

// get presets from database //

$conn = dbconnect();
$conn->set_charset("utf8");
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

//maintenant : une fois le preset et les paramètres sélectionnés, les envoyer vers la bdd

//penser à supprimer le colonne on/off de la base de donnée mff
//diviser la colonne deadline en deux colonnes : date et hour

//sélection des tasks
$sql2 = "SELECT * FROM tasks WHERE id_preset IN (SELECT id as id_preset FROM presets WHERE id_home = $SESSION_home_id)";
$result2 = mysqli_query($conn, $sql2);
$yourtasks = array();
while($returnedTasks = mysqli_fetch_assoc($result2))
  {
    array_push($yourtasks, $returnedTasks);
  }

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
    <link rel="stylesheet" type="text/css" media="screen" href="components/component/component-style.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="components/modals/modal.min.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="components/footer/footer.min.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="stylesheet" href="components/header-nav/header-nav.min.css">
    <link rel="stylesheet" href="components/header-nav/header-dashboard.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="components/header-nav/sticky-header.min.js"></script>
    <script src="scripts/create-task.min.js"></script>
    <script src="scripts/change-task.min.js"></script>
    <link rel="stylesheet" type="text/css" href="style/newtask.css" />
    <script src="scripts/change-language.min.js"></script>
  </head>
  <body>

<?php
  if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include 'components/header-nav/header-nav.php';
?>

      <div class="page-content-container">
        <div class="page-content">
        
          <div class="page-title">
                  <h1><?php if ($_SESSION['language']=='en') {
            echo('Tasks');
        } elseif ($_SESSION['language']=='fr') {
            echo(htmlentities('Tâches'));
        } ?></h1>
          </div>
          <div class="dashboard-big-container">
            <h2>New Task</h2>
            <div class="dashboard-inner-container">

              <div class="half-wrapper">
              <form method="post" action='<?php echo(htmlspecialchars('./controllers/tasks/create-task.php')) ?>'>
                <section class="selectors">
                  <span class="label">Presets</span>
                  <select class="dropdown" name="preset">
                  <option value ="notanoption" disabled selected>-- select preset --</option>
                    <?php
                    foreach ($yourpresets as $p){
                      echo "<option value ='" . $p['id']."-".$p['name']."'>". $p['name'] . "</option>";
                    }
                    ?>
                  </select>
                  <i onclick="location.href='createpreset.php'" class='fas fa-plus fa-lg preset-add-button'><span id="add-preset-title">
                    <?php if ($_SESSION['language']=='en') {
                      echo htmlentities('Create a preset');
                  } elseif ($_SESSION['language']=='fr') {
                      echo htmlentities('Créer un preset');
                  } ?>
                </span></i>
                </section>
                <section class="selectors">
                  <span class="label">Frequency</span>
                  <select class="dropdown" name="frequency">
                            <option value="notanoption" disabled selected>-- select frequency --</option>
                            <option value="Daily">Daily</option>
                            <option value="Weekly">Weekly</option>
                            <option value="Monthly">Monthly</option>
                            <option value="One-time instance">One-time instance</option>
                  </select>

                </section>
                <section class="selectors">
                  <span class="label">
                  <?php if ($_SESSION['language']=='en') {
                      echo htmlentities('Date');
                  } elseif ($_SESSION['language']=='fr') {
                      echo htmlentities('Date');
                  } ?></span>
                  <input type="date" id="start" name="trip-start" value="2018-07-22" min="2018-01-01" max="2019-12-31">
                </section>
                <section class="selectors">
                    <span class="label">
                    <?php if ($_SESSION['language']=='en') {
                      echo htmlentities('Hour');
                  } elseif ($_SESSION['language']=='fr') {
                      echo htmlentities('Heure');
                  } ?></span>
                    <input type="time" name="time">
                </section>
                <br/><br/>
                <center>
                <input id="buttonSaveTask" type="submit" value="Save the task" name="savetask" >
                </center>
                </form>
              </div>
            </div>
          </div>

          <div class="dashboard-big-container">
            <h2>
            <?php if ($_SESSION['language']=='en') {
                      echo htmlentities('Scheduled Tasks');
                  } elseif ($_SESSION['language']=='fr') {
                      echo htmlentities('Tâches programmées');
                  } ?>
            </h2>
            <div class="dashboard-inner-container">
              <table id="presetsTable">
                <colgroup>
                <col width='30%'/>
                <col width='20%'/>
                <col width='20%'/>
                <col width='20%'/>
                <col width='10%'/>
                </colgroup>
                <tr>
                  <th>Preset</th>
                  <th>
                  <?php if ($_SESSION['language']=='en') {
                      echo htmlentities('Frequency');
                  } elseif ($_SESSION['language']=='fr') {
                      echo htmlentities('Fréquence');
                  } ?>
                  </th>
                  <th>
                  <?php if ($_SESSION['language']=='en') {
                      echo htmlentities('Next date');
                  } elseif ($_SESSION['language']=='fr') {
                      echo htmlentities('Prochaine date');
                  } ?>
                  </th>
                  <th>
                  <?php if ($_SESSION['language']=='en') {
                      echo htmlentities('Hour');
                  } elseif ($_SESSION['language']=='fr') {
                      echo htmlentities('Heure');
                  } ?>
                  </th>
                  <th>On/Off</th>
                </tr>
                <tr>
                  <?php
                    foreach($yourtasks as $t)
                    {
                      if ($t['on_off']==0) {
                        $checked = '';
                      } else {
                        $checked = 'checked';
                      }
                      switch ($t['frequency']) {
                        case 86400:
                          $frequency = 'each day';
                          break;
                        case 604800:
                        $frequency = 'each week';
                          break;
                        case 2592000:
                        $frequency = 'each month';
                          break;
                        case 0:
                        $frequency = 'no repeat';
                          break;
                      }
                      echo "<tr class='task-row' id=".$t['id']."><td>". $t['name']. "</td><td>" . $frequency . "</td><td>" . $t['start_date'] . "</td><td>" .$t['hour']."</td><td><label class='form-switch'>
                        <input $checked type='checkbox'>
                        <i></i>
                      </label></td></tr>";
                    }
                    ?>
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

  <script src="scripts/open-modals.js"></script>


  </html>
