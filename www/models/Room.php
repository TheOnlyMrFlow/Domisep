<?php

require_once(dirname(__FILE__) . '/../utils/dbconnect.php');


class Room
{

    private $id;

    public function __construct($id) {
        $this->id = $id;

    }

    public static function createRoom($name, $homeId) {

    $db=dbconnect();
    $stmt = $db->prepare("INSERT INTO rooms (name, id_home) VALUES (?, ?)");

    $stmt->bind_param("si", $name, $homeId);
    $stmt->execute();
    echo mysqli_error($db);

    $stmt->close();

    }

    public function deleteSelf() {
        if (!$this->checkBelonging()) {
            return "You don't own this room";
        }
        $db=dbconnect();
        $stmt2 = $db->prepare("SELECT serial_number FROM components WHERE id_room = ?");
        $stmt2->bind_param("i", $this->id);
        $stmt2->execute();
        $res = $stmt2->get_result();
        if ($res->fetch_assoc()) {
            return "You can't delete an empty room";
        }
        $stmt2->close();
        $stmt1 = $db->prepare("DELETE FROM rooms WHERE id=?");
        $stmt1->bind_param("i", $this->id);
        $stmt1->execute();
        $stmt1->close();
        echo mysqli_error($db);
    }

    function rename($newName) {

        if (!$this->checkBelonging()) {
            return "You don't own this room";
        }

        $db=dbconnect();
        $stmt = $db->prepare("UPDATE rooms SET name = ? WHERE id = ?");
        $stmt->bind_param("si", $newName, $this->id);
        $stmt->execute();
        echo mysqli_error($db);
        $stmt->close();



    }
    /**
     * Fait par Florian
     *
     * Retourne les infos d'une room sous forme de key-value pairs
     **/
    public function getAllFields(): array
    {
        if (!$this->checkBelonging()) {
            return "You don't own this room";
        }

        $db = dbconnect();
        $stmt = $db->prepare("SELECT * FROM rooms WHERE id = ?");
        $stmt->bind_param("i", $this->id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $row = $result->fetch_assoc();

        return $row;

    }

    public function getComponents(){

        if (!$this->checkBelonging()) {
            return "You don't own this room";
        }

        $db = dbconnect();
        $stmt = $db->prepare("SELECT id FROM components WHERE id_room = ?");
        $stmt->bind_param("i", $this->id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $ret = array();
        while ($row = $result->fetch_assoc()){
            array_push($ret, new Component($row['id']));
        }
        return $ret;
    }

    public function getId()
    {
        return $this->id;
    }

    public function checkBelonging() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $db = dbconnect();
        $stmt = $db->prepare("SELECT id_home FROM rooms WHERE id = ? LIMIT 1");
        $stmt->bind_param("s", $this->id);
        $stmt->execute();
        $res = $stmt->get_result();
        if ($row = $res->fetch_assoc()) {
            if ($row['id_home'] != $_SESSION['home_id']) {
                return false;
            } else {
                return true;
            }
        }

        return false;
    }

}
