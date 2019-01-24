<?php
    
    require_once(dirname(__FILE__) . '/../utils/dbconnect.php');


class Home
{

    private $id;

    public function __construct($id) {
        $this->id = $id;

    }

    public static function createHome ($address, $city, $zipCode, $country) {
        $db = dbconnect();
$db->set_charset("utf8");
        $stmt = $db->prepare("INSERT INTO homes (address, city, zip_code, country) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $address, $city, $zipCode, $country);
        $stmt->execute();
        $stmt->close();

        return mysqli_insert_id($db);
    }

    public function getRooms() {
        $db = dbconnect();
$db->set_charset("utf8");
        $stmt = $db->prepare("SELECT id FROM rooms WHERE id_home = ?");
        $stmt->bind_param("i", $this->id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $ret = array();
        while ($row = $result->fetch_assoc()){
            array_push($ret, new Room($row['id']));
        }

        return $ret;

    }



    /**
     * Fait par Florian
     *
     * Retourne les infos d'une maison sous forme de key-value pairs
     **/
    public function getAllFields()
    {
        $db = dbconnect();
$db->set_charset("utf8");
        $stmt = $db->prepare("SELECT * FROM homes WHERE id = ?");
        $stmt->bind_param("i", $this->id);
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

}
