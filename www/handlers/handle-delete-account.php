<?php

require_once '../utils/logout.php';

mysqli_report(MYSQLI_REPORT_STRICT);

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['connected']) || $_SESSION['connected'] == false) {

    displayErrorAndLeave('You are not connected', 401);
}

if (isset($_POST['delete-account'])) {

    $id_user = $_SESSION['id'];
    $id_home = $_SESSION['home_id'];

    $db = mysqli_connect('localhost', 'root', '', 'mff');
    $db->begin_transaction();

    try {

        if ($_SESSION['role'] == 'house_manager') {

            $getRoomsQuery = $db->query("SELECT id FROM rooms WHERE id_home = $id_home");
            if ($getRoomsQuery) {

                $roomIds = array();
                while ($r = $getRoomsQuery->fetch_assoc()) {
                    array_push($roomIds, $r['id']);
                }
                $roomIdsAsString = '(' . implode(',', $roomIds) . ')';

                $getComponentsQuery = $db->query("SELECT serial_number FROM components WHERE id_room IN $roomIdsAsString");
                $compIds = array();
                if ($getComponentsQuery) {
                    while ($c = $getComponentsQuery->fetch_assoc()) {
                        array_push($compIds, $c['serial_number']);
                    }
                    $compIdsAsString = "('" . implode("','", $compIds) . "')";
                    echo $compIdsAsString;

                    $db->query("DELETE FROM components WHERE serial_number IN $compIdsAsString");

                }

                $db->query("DELETE FROM rooms WHERE id IN $roomIdsAsString");

            }

        }


        $db->query("DELETE FROM users WHERE id = $id_user");

        
        $db->commit();

    } catch (Exception $e) {
        $db->rollback(); 
    }

    logOut();

    header("Location: ./../../index.php");
}

function displayErrorAndLeave($error = 'Sorry, an error occured', $status = 500)
{
    header("HTTP/1.1 " . $status . " " . $error);
    exit();
}
