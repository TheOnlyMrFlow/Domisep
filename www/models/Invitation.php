<?php

require_once dirname(__FILE__) . "/../../vendor/autoload.php";
require_once dirname(__FILE__) . "/../../globalVars.php";
require_once dirname(__FILE__) . "/Home.php";

require_once dirname(__FILE__) . '/../utils/dbconnect.php';

//require_once '../../vendor/autoload.php';
//require_once '../../globalVars.php';
//require_once 'Home.php';

class Invitation
{

    // pas utile de stocker la key puisque elle est encryptee
    public $id;
    public $mail;
    public $home;

    public static function find($mail, $key)
    {

        $db = dbconnect();
        $stmt = $db->prepare("SELECT * FROM invite_keys WHERE email = ?");
        $stmt->bind_param("s", $mail);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        while ($row = $result->fetch_assoc()) {
            if (password_verify($key, $row['inv_key'])) {
                return new self($row['id']);
            }
        }

        return false;

    }

    public static function generateAndSend($mail, $home_id, $from, $pw, $key)
    {

        $seed = str_split(
            'abcdefghijklmnopqrstuvwxyz'
            . 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'
            . '0123456789');
        shuffle($seed);
        $key = '';
        foreach (array_rand($seed, 30) as $k) {
            $key .= $seed[$k];
        }

        $hashed_key = password_hash($key, PASSWORD_BCRYPT);

        $db = dbconnect();

        $stmt = $db->prepare("INSERT INTO invite_keys (email, inv_key, id_home)  VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $mail, $hashed_key, $home_id);
        $stmt->execute();

        return self::sendInvitationMail($from, $mail, $pw, $key);

    }

    private static function sendInvitationMail($from, $to, $pw, $key)
    {
        $transport = (new Swift_SmtpTransport('smtp.gmail.com', 587, 'tls'))
            ->setUsername($from)
            ->setPassword($pw);

        $mailer = new Swift_Mailer($transport);

        $base_url = constant('BASE_URL');

        $inviter = $_SESSION['first_name'] . ' ' . $_SESSION['last_name'];

        // Create a message
        $messageToCustomer = (new Swift_Message("You received an invitation"))
            ->setFrom([$from => 'Service client Domisep'])
            ->setTo([$to])
            ->setBody(
                " <p>You have been invited to join $inviter's house on Domisep ! </p>
            <p>Please follow <a href='$www.domisep.floriancomte.fr/invited.php?key=$key&mail=$to'>this link</a> to create your account to access the home space</p>
            ", 'text/html'
            );

        return $mailer->send($messageToCustomer);

    }

    private function __construct($id)
    {
        $this->id = $id;
        $db = dbconnect();
        $stmt = $db->prepare("SELECT * FROM invite_keys WHERE id = ?");
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $row = $result->fetch_assoc();

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