<?php

require("../scripts/fonction_php_component.php");

$serial_number = $_POST['serialNumber'];
$name = "Component A";
$component_value = 17;

componentsFunction($serial_number, $name, $component_value);


