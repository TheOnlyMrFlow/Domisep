<?php

//require_once('./FormException.php');
require_once 'Home.php';
require_once 'Room.php';
require_once 'Component.php';
require_once 'Invitation.php';

require_once dirname(__FILE__) . '/../utils/dbconnect.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

class User
{

    private $id;

    public static function getUserByMail($mail)
    {
        $db = dbconnect();
$db->set_charset("utf8");
        $mail = mysqli_real_escape_string($db, $mail);
        $stmt = $db->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $mail);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        if ($row = $result->fetch_assoc()) {
            return new User($row['id']);
        } else {
            return false;
        }

    }

    public function __construct($id)
    {
        $this->id = $id;

    }

    public static $passwordRequirements = "Password must be 6 to 16 characters long and must include at least one upper case letter, one lower case letter, and one numeric digit.";

    public static function checkPasswordValidity($input)
    {
        return filter_var($input, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,16}$/")));
    }

    public static function login($email, $password)
    {
        $db = dbconnect();
$db->set_charset("utf8");
        $stmt = $db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute(); //order 66
        $res = $stmt->get_result();
        $row = $res->fetch_assoc();
        if (!$row) {
            return false;
        }
        if (password_verify($password, $row['password'])) {
            $_SESSION['connected'] = true;
            $_SESSION['email'] = $row['email'];
            $_SESSION['id'] = $row['id'];
            $_SESSION['home_id'] = $row['id_home'];
            $_SESSION['home'] = serialize(new Home($row['id_home']));
            $_SESSION['last_name'] = $row['last_name'];
            $_SESSION['first_name'] = $row['first_name'];
            $_SESSION['role'] = $row['role'];
            $_SESSION['birthdate'] = $row['birthdate'];
            $_SESSION['phone'] = $row['phone'];
            return true;
        } else {
            return false;
        }
    }

    /**
     * Signup a user
     * @throws FormException if one field is incorrect
     */
    public static function signup($lastName,
        $firstName,
        $birthDate,
        $email,
        $phone,
        $password1,
        $password2,
        $serialNumber,
        $address,
        $city,
        $zipCode,
        $country) {

        $db = dbconnect();
$db->set_charset("utf8");

        $lastName = mysqli_real_escape_string($db, $lastName);
        $firstName = mysqli_real_escape_string($db, $firstName);
        $birthDate = mysqli_real_escape_string($db, $birthDate);
        $email = mysqli_real_escape_string($db, $email);
        $phone = mysqli_real_escape_string($db, $phone);
        $password1 = mysqli_real_escape_string($db, $password1);
        $password2 = mysqli_real_escape_string($db, $password2);
        $serialNumber = mysqli_real_escape_string($db, $serialNumber);
        $address = mysqli_real_escape_string($db, $address);
        $city = mysqli_real_escape_string($db, $city);
        $zipCode = mysqli_real_escape_string($db, $zipCode);
        $country = mysqli_real_escape_string($db, $country);

        if (empty($lastName)) {
            throw new FormException("Last name is required");
        }
        if (empty($firstName)) {
            throw new FormException("First name is required");
        }
        if (empty($email)) {
            throw new FormException("Email is required");
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new FormException("Email is not valid");
        }
        if (User::exists($email)) {
            throw new FormException("A user already exists with this mail adress");
        }
        if (empty($birthDate)) {
            throw new FormException("Birthdate is required");
        }
        if (empty($phone)) {
            throw new FormException("Phone number name is required");
        }
        if (empty($password1)) {
            throw new FormException("Password is required");
        }
        if (!User::checkPasswordValidity($password1)) {
            throw new FormException(User::$passwordRequirements);
        }
        if (empty($password2)) {
            throw new FormException("Password confirmation is required");
        }
        if ($password1 != $password2) {
            throw new FormException("The two passwords do not match");
        }
        if (empty($serialNumber)) {
            throw new FormException("Your product's serial number is required");
        }
        $sNumberSplit = explode("-", $serialNumber);
        if (sizeof($sNumberSplit) != 3
            ||
            !in_array($sNumberSplit[0], ['sma', 'sen', 'bas'])
            ||
            !in_array($sNumberSplit[1], ['lght', 'temp', 'hmdt', 'smok', 'shtr', 'airc'])
        ) {
            throw new FormException("Your product's serial number is invalid");
        }
        $stmt = $db->prepare("SELECT serial_number FROM components WHERE serial_number = ?");
        $stmt->bind_param("s", $serialNumber);
        $stmt->execute();
        $res = $stmt->get_result();
        if ($res->fetch_assoc()) {
            throw new FormException("Your product's serial number is already used on another account");
        }
        if (empty($address)) {
            throw new FormException("Your address is required");
        }
        if (empty($city)) {
            throw new FormException("Your city is required");
        }
        if (empty($zipCode)) {
            throw new FormException("Your zip code is required");
        }
        if (empty($country)) {
            throw new FormException("Your country is required");
        }

        //$stmt = $db->prepare()

        $password = password_hash($password1, PASSWORD_BCRYPT);
        $birthDate = date('Y-m-d', strtotime($birthDate));

        $homeId = Home::createHome($address, $city, $zipCode, $country);

        $stmt = $db->prepare("INSERT INTO  users (first_name, last_name, email, birthdate, phone, password, id_home, role)  VALUES (?, ?, ?, ?, ?, ?, ?, 'house_manager')");
        $stmt->bind_param("ssssssi", $firstName, $lastName, $email, $birthDate, $phone, $password, $homeId);
        $stmt->execute();
        $stmt->close();

        $roomId = Room::createRoom("Room", $homeId);
        Component::createComponent("Unanmed", $serialNumber, $roomId);

    }

    public static function signupMember($lastName,
        $firstName,
        $birthDate,
        $email,
        $phone,
        $password1,
        $password2,
        $key
    ) {

        $db = dbconnect();
$db->set_charset("utf8");

        $lastName = mysqli_real_escape_string($db, $lastName);
        $firstName = mysqli_real_escape_string($db, $firstName);
        $birthDate = mysqli_real_escape_string($db, $birthDate);
        $email = mysqli_real_escape_string($db, $email);
        $phone = mysqli_real_escape_string($db, $phone);
        $password1 = mysqli_real_escape_string($db, $password1);
        $password2 = mysqli_real_escape_string($db, $password2);

        $invitation = Invitation::find($email, $key);

        if (!$invitation) {
            return false;
        }

        if (empty($lastName)) {
            throw new FormException("Last name is required");
        }
        if (empty($firstName)) {
            throw new FormException("First name is required");
        }
        if (empty($email)) {
            throw new FormException("Email is required");
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new FormException("Email is not valid");
        }
        if (User::exists($email)) {
            throw new FormException("A user already exists with this mail adress");
        }
        if (empty($birthDate)) {
            throw new FormException("Birthdate is required");
        }
        if (empty($phone)) {
            throw new FormException("Phone number name is required");
        }
        if (empty($password1)) {
            throw new FormException("Password is required");
        }
        if (!User::checkPasswordValidity($password1)) {
            throw new FormException(User::$passwordRequirements);
        }
        if (empty($password2)) {
            throw new FormException("Password confirmation is required");
        }
        if ($password1 != $password2) {
            throw new FormException("The two passwords do not match");
        }

        $password = password_hash($password1, PASSWORD_BCRYPT);
        $birthDate = date('Y-m-d', strtotime($birthDate));

        $homeId = $invitation->home->getId();

        $stmt = $db->prepare("INSERT INTO  users (first_name, last_name, email, birthdate, phone, password, id_home, role)  VALUES (?, ?, ?, ?, ?, ?, ?, 'house_member')");
        $stmt->bind_param("ssssssi", $firstName, $lastName, $email, $birthDate, $phone, $password, $homeId);
        echo mysqli_error($db);
        $stmt->execute();
        $userId = $stmt->insert_id;
        $stmt->close();

        $components = $db->prepare("SELECT serial_number FROM components INNER JOIN rooms ON components.id_room=rooms.id WHERE rooms.id_home=?");
        $components->bind_param('i', $homeId);
        $components->execute();
        $components->store_result();
        if ($components->num_rows > 0) {
            $components->bind_result($serialNumber);
            $componentsArray = array();
            while ($components->fetch()) {
                array_push($componentsArray, $serialNumber);
            }
            foreach ($componentsArray as $componentId) {
                $componentId = mysqli_real_escape_string($db, $componentId);
                $stmt = $db->prepare("INSERT INTO user_rights (id_user,serial_number,access_level) VALUES (?,?,'write')");
                $stmt->bind_param("is", $userId, $componentId);
                $stmt->execute();
                $stmt->close();
            }
        }

        return true;

    }

    public static function exists($email)
    {
        $db = dbconnect();
$db->set_charset("utf8");
        $stmt = $db->prepare("SELECT id FROM users WHERE email=? LIMIT 1");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        if ($result->fetch_assoc()) {
            return true;
        }
        return false;

    }

    public function updateInfo($firstName, $lastName, $phone)
    {

        $db = dbconnect();
$db->set_charset("utf8");

        $firstName = mysqli_real_escape_string($db, $firstName);
        $lastName = mysqli_real_escape_string($db, $lastName);
        $phone = mysqli_real_escape_string($db, $phone);

        if (empty($firstName) || empty($lastName) || empty($phone)) {
            throw new FormException('Please fill all the fields');
        }

        $stmt = $db->prepare("UPDATE users SET first_name = ?, last_name = ?, phone = ? WHERE id = ?");
        $stmt->bind_param("sssi", $firstName, $lastName, $phone, $this->id);
        $stmt->execute();

    }

    public static function generateSecretKey()
    {

        $seed = str_split('abcdefghijklmnopqrstuvwxyz'
            . 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'
            . '0123456789'); // and any other characters
        shuffle($seed); // probably optional since array_is randomized; this may be redundant
        $secret_key = '';
        foreach (array_rand($seed, 30) as $k) {
            $secret_key .= $seed[$k];
        }

        return $secret_key;

    }

    public function hashPasswordResetKeyAndSave($secret_key)
    {
        $hashed_secret_key = password_hash($secret_key, PASSWORD_BCRYPT);

        $expirationTime = time() + 86400; //24 hours
        $expiration = date('Y-m-d H:i:s', $expirationTime);
        //$expiration = date( 'Y-m-d H:i:s', $expiration );
        $db = dbconnect();
$db->set_charset("utf8");
        $stmt = $db->prepare("REPLACE INTO  password_reset_keys (id_user, hashed_key, expiration)  VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $this->id, $hashed_secret_key, $expiration);
        $stmt->execute();

    }

    public function changePassword($oldPassword, $newPassword1, $newPassword2)
    {
        $db = dbconnect();
$db->set_charset("utf8");

        $oldPassword = mysqli_real_escape_string($db, $oldPassword);
        $newPassword1 = mysqli_real_escape_string($db, $newPassword1);
        $newPassword2 = mysqli_real_escape_string($db, $newPassword2);

        if (empty($oldPassword) || empty($newPassword1) || empty($newPassword2)) {
            throw new FormException('Please fill all the fields');
        }

        $stmt = $db->prepare("SELECT password FROM users WHERE id = ?");
        $stmt->bind_param("i", $this->id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $trueOldPassword = ($result->fetch_assoc())['password'];

        if (!password_verify($oldPassword, $trueOldPassword)) {
            throw new FormException('Wrong password');
        }

        if ($newPassword1 != $newPassword2) {
            throw new FormException('Passwords dont match');
        }

        if (!User::checkPasswordValidity($newPassword1)) {
            throw new FormException(User::$passwordRequirements);
        }

        $newPassword = password_hash($newPassword1, PASSWORD_BCRYPT);
        $stmt = $db->prepare("UPDATE users SET password = ? WHERE id = ?");
        $stmt->bind_param("si", $newPassword, $this->id);
        $stmt->execute();

    }

    /**
     * Fait par Florian
     *
     * Return les user rights sous la forme
     *
     **/
    public function FunctionName(Type $var = null)
    {
        # code...
    }
    public function getRights()
    {

        $db = dbconnect();
$db->set_charset("utf8");
        $stmt = $db->prepare("SELECT serial_number,access_level FROM user_rights WHERE id_user=?");
        $stmt->bind_param("i", $this->id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $ret = array();
        while ($row = $result->fetch_assoc()) {
            array_push($ret, $row);
        }

        return $ret;

    }

    /**
     * Fait par Florian
     *
     * Retourne les infos d'un user sous forme de key-value pairs
     **/
    public function getAllFields()
    {
        $db = dbconnect();
$db->set_charset("utf8");
        $stmt = $db->prepare("SELECT * FROM users WHERE id = ?");
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