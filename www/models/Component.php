<?php
class Component
{

    private $id;

    public function __construct($id) {
        $this->id = $id;
        
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