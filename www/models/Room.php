<?php
class Room
{

    private $id;

    public function __construct($id) {
        $this->id = $id;
        
    }

    public static function createRoom($name, $homeId) {
    $db=mysqli_connect('localhost', 'root', '', 'mff');
    $stmt = $db->prepare("INSERT INTO rooms (name, id_home) VALUES (?, ?)");
    $stmt->bind_param("si", $roomName, $homeId);
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
        $db = mysqli_connect('localhost', 'root', '', 'mff');
        $stmt = $db->prepare("SELECT * FROM rooms WHERE id = ?");
        $stmt->bind_param("i", $this->id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $row = $result->fetch_assoc();

        return $row;
       
    }

    public function getComponents(){
        $db = mysqli_connect('localhost', 'root', '', 'mff');
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
    
}