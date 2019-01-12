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
        //$db = mysqli_connect('localhost', 'root', '', 'mff');
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

        return true;



    }

    /**
     * Fait par Florian
     *
     * Retourne les infos d'un component sous forme de key-value pairs
     **/
    public function getAllFields(): array
    {
        $db = mysqli_connect('localhost', 'root', '', 'mff');
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
    
}