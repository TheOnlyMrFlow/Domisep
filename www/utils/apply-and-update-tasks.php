<?php
require_once(dirname(__FILE__) . '/dbconnect.php');
$db = dbconnect();
$db->set_charset("utf8");
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(!isset($_SESSION['id'])){
  header('location: index.php');
}
else{
  $id_home = $_SESSION['home_id'];
  $id_user = $_SESSION['id'];
  $role = $_SESSION['role'];
    if ($role == 'house_member') {
        $query = "SELECT DISTINCT
              components.serial_number,
              components.value,
              components.state
          FROM
              components
          INNER JOIN rooms ON components.id_room = rooms.id
          INNER JOIN user_rights ON components.serial_number = user_rights.serial_number
          WHERE
              (
                  rooms.id_home = ? AND user_rights.id_user = ? AND user_rights.access_level<>'none'
              )
          ORDER BY
              rooms.name,
              components.name";
          $stmt = $db->prepare($query);
          $stmt->bind_param('ii',$id_home,$id_user);
          $stmt->execute();

    } elseif ($role == 'house_manager') {
        $query = "SELECT
              serial_number,
              value,
              state
          FROM
              components
          INNER JOIN rooms ON components.id_room = rooms.id
          WHERE
              (
                  rooms.id_home = ?
              )
          ORDER BY
              rooms.name,
              components.name";
          $stmt = $db->prepare($query);
          $stmt->bind_param('i',$id_home);
          $stmt->execute();
    }
    $stmt->bind_result($serial_number,$value,$state);

    $array = array();

    while($stmt->fetch()){
      $temp = array($serial_number,$state,$value);
      array_push($array, $temp);

    }
    foreach ($array as $key => $value) {
      $update_component_value = $db->prepare("UPDATE components SET state=?,value=? WHERE serial_number=?");
      $update_component_value->bind_param("ids", $value[1],$value[2],$value[0]);
      $update_component_value->execute();
    }
    echo (json_encode($array));
}
