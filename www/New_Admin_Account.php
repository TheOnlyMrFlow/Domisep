<?php

header('Content-Type: text/html; charset=ISO-8859-1');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(!isset($_SESSION['id']) || $_SESSION['role']!='administrator'){
  header('location : index.php');
}
if(!isset($_SESSION['language'])){
	$_SESSION['language'] = 'en';
}

$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'mff';

$conn = dbconnect();
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['confirm']))
{
    $firstName = $_POST['firstname'];
    $lastName = $_POST['lastname'];
    $phoneNumber = $_POST['phonenumber'];
    $mail = $_POST['mail'];
    $password = $_POST['password'];
    $repeatPassword = $_POST['repeatpassword'];

$login_check ="SELECT * FROM users WHERE email = '$mail' LIMIT 1";
$result = mysqli_query($conn, $login_check);
$user = mysqli_fetch_assoc($result);

if($user)
{
    echo("This login already exists");
    exit();
}
else
{
$inputPassword = password_hash($password, PASSWORD_BCRYPT);
$stmt = $conn->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
$stmt->bind_param("ss", $mail, $inputPassword);
$stmt->execute();
}
echo("We got there !");
}


?>

<!DOCTYPE <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Create Administrator Account</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="New_Admin_Account.css" />
    <script src="main.js"></script>
</head>
<body>

<?php
  if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if ($_SESSION['connected']){
}
include 'components/header-nav/header-nav.php';//
?>

<div id = "total-wrapper">
<h1><center>Create a new administrator account</center></h1>

<div id = "wrapper">

<form name="newadmin" method="post" onsubmit="return validateForm()">
<section class="input">
<span class ="label">First Name
</span>
<input class = "input" type="text" name="firstname">
<br>
</section>
<section class="input">
<span class ="label">Last Name
</span>
<input class = "input" type="text" name="lastname">
<br><br>
</section>
<section class="input">
<span class ="label">Phone number
</span>
<input class = "input" type="text" name="phonenumber">
<br>
</section>
<section class="input">
<span class ="label">Mail
</span>
<input class = "input" type="text" name="mail">
<br><br>
</section>
<section class="input">
<span class ="label">Password
</span>
<input class = "input" type="password" name="password">
<br>
</section>
<section class="input">
<span class ="label">Repeat Password
</span>
<input class = "input" type="password" name="repeatpassword">
<br><br>
</section>
<br><br>
<section id = "submit_buttons">
<input type="submit" value="Cancel" name="cancel">
<input type="submit" value="Confirm" name="confirm">
</section>
</form>
</div>

<br>
<div id = "validation">

</div>
</div>
<script>
function validateForm()
    {
        var firstname = document.forms["newadmin"]["firstname"].value;
        var lastname = document.forms["newadmin"]["lastname"].value;
        var phonenumber = document.forms["newadmin"]["phonenumber"].value;
        var mail = document.forms["newadmin"]["mail"].value;
        var password1 = document.forms["newadmin"]["password"].value;
        var password2 = document.forms["newadmin"]["repeatpassword"].value;
        if(firstname.length == 0 || lastname.length == 0 || phonenumber.length == 0 || mail.length == 0 || password1.length == 0 )
        {
            alert("Veuillez remplir tous les champs")
            return false;
        }
        if(password1 != password2)
        {
            alert("Les mots de passe doivent etre identiques");
            return false;
        }

    }
</script>

</body>
</html>
