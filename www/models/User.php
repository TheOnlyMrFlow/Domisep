<?php

//require_once('./FormException.php');
require_once('Home.php');

class User
{

    private $id;

    
    public function __construct($id) {
        $this->id = $id;
        
    }

    public static $passwordRequirements = "Password must be 6 to 16 characters long and must include at least one upper case letter, one lower case letter, and one numeric digit.";

    public static function checkPasswordValidity($input){
        return filter_var($input, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,16}$/")));
    }

    /**
 * Signup a user
 * @throws FormException if one field is incorrect
 */
    public static function signup(  $lastName,
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
                                    $country)
    {

        $db = mysqli_connect('localhost', 'root', '', 'mff');


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
        if (!User::checkPasswordValidity($password1)){
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

         $password = password_hash($password1, PASSWORD_BCRYPT);
         $birthDate = date( 'Y-m-d', strtotime( $birthDate ) );
     
     
         $homeId = Home::createHome($address, $city, $zipCode, $country);

         $stmt = $db->prepare("INSERT INTO  users (first_name, last_name, email, birthdate, phone, password, id_home, role)  VALUES (?, ?, ?, ?, ?, ?, ?, 'house_manager')");
         $stmt->bind_param("ssssssi", $firstName, $lastName, $email, $birthDate, $phone, $password, $homeId);
         $stmt->execute();
         $stmt->close();

     


    }

    public static function exists($email) {
        $db = mysqli_connect('localhost', 'root', '', 'mff');
        $stmt = $db->prepare("SELECT id FROM users WHERE email=? LIMIT 1");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        if ($result->fetch_assoc()){
            return true;
        }
        return false;

    }

    /**
     * Fait par Florian
     *
     * Retourne les infos d'un user sous forme de key-value pairs
     **/
    public function getAllFields()
    {
        $db = mysqli_connect('localhost', 'root', '', 'mff');
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