<?php

require_once dirname(__FILE__) . '/../utils/dbconnect.php';
require_once dirname(__FILE__) . '/../models/Component.php';

class Preset
{

    private $id;

    public function __construct($id)
    {
        $this->id = $id;

    }

    public static function createPreset($name, $homeId, $userId, $componentsValuesArray)
    {

        $db = dbconnect();

        $stmt = $db->prepare("INSERT INTO presets (id_home,name) VALUES (?,?)");
        $stmt->bind_param("is", $homeId, $name);
        $stmt->execute();

        $preset_id = $stmt->insert_id;

        foreach ($componentsValuesArray as $componentValues) {
            $serial_number = mysqli_real_escape_string($db, $componentValues[0]);
            $comp = new Component($serial_number);
            $right = $comp->rightsOfUser($userId);
            echo $right;
            if ($right != 'write') {
                continue;
            }
            $state = $componentValues[1];
            $value = $componentValues[2];
            if ($value == null) {
                $stmt = $db->prepare("INSERT INTO preset_values (id_preset,serial_number,on_off) VALUES (?,?,?)");
                $stmt->bind_param("isi", $preset_id, $serial_number, $state);
            } else {
                $stmt = $db->prepare("INSERT INTO preset_values (id_preset,serial_number,on_off,value) VALUES (?,?,?,?)");
                $stmt->bind_param("isii", $preset_id, $serial_number, $state, $value);
            }

            $stmt->execute();
        }

        $stmt->close();

    }

    public function deleteSelf()
    {
        if (!$this->checkBelonging()) {
            return "You have no power here, Gandalf the grey !";
        }

        $db = dbconnect();

        $stmt = $db->prepare("DELETE FROM preset_values WHERE id_preset = ?");
        $stmt->bind_param("i", $this->id);
        $stmt->execute();
        $stmt = $db->prepare("DELETE FROM presets WHERE id = ?");
        $stmt->bind_param("i", $this->id);
        $stmt->execute();

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
        //todo
        $row = $result->fetch_assoc();

        return $row;

    }

    public function getId()
    {
        return $this->id;
    }

    public function checkBelonging()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $db = dbconnect();
        $stmt = $db->prepare("SELECT id_home FROM presets WHERE id = ? LIMIT 1");
        $stmt->bind_param("i", $this->id);
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

    public function apply()
    {

        if (!$this->checkBelonging()) {
            return array();
        }

        $db = dbconnect();
        $stmt = $db->prepare("SELECT
                          preset_values.serial_number,
                          preset_values.on_off,
                          preset_values.value
                      FROM
                          preset_values
                      WHERE
                          preset_values.id_preset = ?");
        $stmt->bind_param("i", $this->id);
        $stmt->execute();
        $stmt->bind_result($serial_number, $state, $value);

        $array = array();

        while ($stmt->fetch()) {
            $temp = array($serial_number, $state, $value);
            array_push($array, $temp);

        }
        foreach ($array as $key => $value) {
            $comp = new Component($value[0]);
            $comp->update($value[1], $value[2]);
        }
        return $array;
    }

}
