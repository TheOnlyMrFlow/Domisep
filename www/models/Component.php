<?php

require_once(dirname(__FILE__) . '/../utils/dbconnect.php');

class Component
{

    private $id;

    public function __construct($id) {
        $this->id = $id;

    }

    /**
     * Fait par Florian
     *
     * Retourne un true si c'est ok, false si le serial number est deja utilise.
     **/
    public static function createComponent($name, $serialNumber, $roomId) {

        $errors = array();

        $db = dbconnect();
        $stmt = $db->prepare("SELECT * FROM components WHERE serial_number=? LIMIT 1");
        $stmt->bind_param("s", $serialNumber);
        $stmt->execute();
        $result = $stmt->get_result();
        $exisitng = $result->fetch_array();
        $stmt->close();

        //header("HTTP/1.1 403 " . isset($exisitng));
        //if ($exisitng)


        if (isset($exisitng)) {
            return false;
        }

        $stmt = $db->prepare("INSERT INTO components (name, serial_number, id_room) VALUES (?,?, ?)");
        $stmt->bind_param("ssi", $name, $serialNumber, $roomId);
        $stmt->execute();
        $stmt->close();
        $houseMembers = $db->prepare("SELECT
                                          users.id
                                      FROM
                                          users
                                      INNER JOIN rooms ON users.id_home = rooms.id_home
                                      WHERE
                                          rooms.id = ? AND users.role='house_member'");
        $houseMembers->bind_param('i',$roomId);
        $houseMembers->execute();
        $houseMembers->store_result();
        if($houseMembers->num_rows > 0){
            $houseMembers->bind_result($userId);
            $houseMembersArray = array();
            while($houseMembers->fetch()){
              array_push($houseMembersArray, $userId);
            }
            foreach($houseMembersArray as $userId) {
              $stmt = $db->prepare("INSERT INTO user_rights (id_user,serial_number,access_level) VALUES (?,?,'write')");
              $stmt->bind_param("is",$userId,$serialNumber);
              $stmt->execute();
              $stmt->close();
          }
        }
        return true;

    }

    /**
     * Fait par Florian
     *
     * Retourne les infos d'un component sous forme de key-value pairs
     **/
    public function getAllFields(): array
    {
        $db = dbconnect();
        $stmt = $db->prepare("SELECT * FROM components WHERE serial_number = ?");
        $stmt->bind_param("s", $this->id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $row = $result->fetch_assoc();

        return $row;

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
        $stmt = $db->prepare("  SELECT id_home
                        FROM  rooms
                        INNER JOIN  components
                        ON rooms.id = components.id_room
                        WHERE serial_number = ?");

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

    public function rightsOfUser($userId) {
        // return either 'unowned, none, read or write'
        if (!$this->checkBelonging()) {
            return 'unowned';
        }

        $db = dbconnect();
        $stmt = $db->prepare("SELECT role FROM users WHERE id = ? ");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $res = $stmt->get_result();
        $row = $res->fetch_assoc();
        if ($row['role'] == 'administrator' || $row['role'] == 'house_manager') {
            return 'write';
        }
        
        $db = dbconnect();
        $stmt = $db->prepare("SELECT access_level FROM user_rights WHERE id_user = ? AND serial_number = ?");
        $stmt->bind_param("is", $userId, $this->id);
        $stmt->execute();
        $res = $stmt->get_result();
        $row = $res->fetch_assoc();
        return $row['access_level'];

    }

    public function deleteSelf() {
        if (!$this->checkBelonging()) {
            return "Nice try";
        }

        /* whene deleting a component, it will :

        - delete any preset that concerned only this component
        - delete it from component table
        - delete all entries for this component in the user_rights table
        - delete all entries for this component in the preset_values table

        */


        $db = dbconnect();
        $stmt = $db->prepare("DELETE FROM presets WHERE
                        id IN (SELECT id_preset AS id FROM preset_values WHERE serial_number = ?)
                        AND 
                        id NOT IN (SELECT id_preset AS id FROM preset_values WHERE serial_number != ?);");

        $stmt->bind_param("ss", $this->id, $this->id);
        $stmt->execute();

        $stmt = $db->prepare("DELETE FROM preset_values WHERE serial_number = ?;");
        $stmt->bind_param("s", $this->id);
        $stmt->execute();

        $stmt = $db->prepare("DELETE FROM components WHERE serial_number = ?;");
        $stmt->bind_param("s", $this->id);
        $stmt->execute();

        $stmt = $db->prepare("DELETE FROM user_rights WHERE serial_number = ?;");
        $stmt->bind_param("s", $this->id);
        $stmt->execute();

    }

    public function modify ($newName, $newRoomId) {
        if (!$this->checkBelonging()) {
            return "Nice try";
        }
        $db = dbconnect();
        $stmt = $db->prepare("UPDATE components SET name = ?, id_room = ? WHERE serial_number = ?");
        $stmt->bind_param("sis", $newName, $newRoomId, $this->id);
        $stmt->execute();
    }

    public function update($state, $value) {
        if (!$this->checkBelonging()) {
            return;
        }
        $db = dbconnect();
        $stmt = $db->prepare("UPDATE components SET state = ?, value = ? WHERE serial_number = ?");
        $stmt->bind_param("ids", $state, $value, $this->id);
        $stmt->execute();
    }

    public function updateState($state) {
        if (!$this->checkBelonging()) {
            return;
        }
        $db = dbconnect();
        $stmt = $db->prepare("UPDATE components SET state= ? WHERE serial_number= ?");
        $stmt->bind_param("is", $state, $this->id);
        $stmt->execute();

    }

    public function addValue($delta) {
        if (!$this->checkBelonging()) {
            return;
        }
        $db = dbconnect();
        $stmt = $db->prepare("UPDATE components SET value=value + ? WHERE serial_number= ?");
        $stmt->bind_param("is", $delta, $this->id);
        $stmt->execute();

    }

}
