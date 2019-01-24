<?php

require("../../components/component/fonction-php-component.php");
require_once(dirname(__FILE__) . '/../../utils/dbconnect.php');

$serial_number = $_POST['serialNumber'];

$db = dbconnect();
$db->set_charset("utf8");

$query = "SELECT
              rooms.name,
              components.name,
              components.value,
              components.state
          FROM
              components
          INNER JOIN rooms ON components.id_room = rooms.id
          WHERE
                  components.serial_number = ?
          ORDER BY
              rooms.name,
              components.name";

    $component_array = $db->prepare($query);
    $component_array->bind_param('s',$serial_number);
    $component_array->execute();
    $component_row = $component_array->get_result()->fetch_row();
    $name_component = $component_row[1].' - '.$component_row[0];
    $component_value = $component_row[2];
    $state = $component_row[3];
    $right = 'write';


    echo(create_component_html($serial_number, $name_component, $component_value,  $state, $right));
