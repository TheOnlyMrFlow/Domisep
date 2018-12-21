<?php
class Invitation
{

    private $id;
    private $key;
    private $mail;
    private $home;

    private function __construct($key) {
        $this->key = $key;
        $db = mysqli_connect('localhost', 'root', '', 'mff');
        $stmt = $db->prepare("SELECT * FROM invite_keys WHERE inv_key = ?");
        $stmt->bind_param("s", $key);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $row = $result->fetch_assoc();

        $this->id = $row['id'];
        $this->mail = $row['email'];
        $this->home = new Home($row['id_home']);
    }

    public function getMail(): string
    {
        return $this->mail;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function getHome(): home
    {
        return $this->mail;
    }

    
}