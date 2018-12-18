<?php


if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once '../../vendor/autoload.php';
require_once '../../globalVars.php';

if (!isset($_POST['invite-user']) || !isset($_POST['mail'])) {
    exit();
}

$db = mysqli_connect('localhost', 'root', '', 'mff');

$mail = mysqli_real_escape_string($db, $_POST['mail']);

if (empty($mail)) {
    displayErrorAndLeave("Please fill the mail field", 403);
}

if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
    displayErrorAndLeave("Incorrect email", 403);
}

echo $mail;

$stmt = $db->prepare("SELECT id FROM users WHERE email = ?");
$stmt->bind_param("s", $mail);
$result = $stmt->execute();

if ($stmt->fetch()) {
    displayErrorAndLeave("This mail already has a Domisep account", 403);
}

$stmt->close();

$seed = str_split('abcdefghijklmnopqrstuvwxyz'
    . 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'
    . '0123456789');
shuffle($seed);
$secret_key = '';
foreach (array_rand($seed, 30) as $k) {
    $secret_key .= $seed[$k];
}

$hashed_secret_key = password_hash($secret_key, PASSWORD_BCRYPT);


$stmt = $db->prepare("INSERT INTO invite_keys (email, hashed_key, id_home)  VALUES (?, ?, ?)");
$stmt->bind_param("ssi", $mail, $hashed_secret_key, $_SESSION['home_id']);
$stmt->execute();


sendInviteMail($mail, $hashed_secret_key);


function sendInviteMail($email, $secret_key)
{
    $transport = (new Swift_SmtpTransport('smtp.gmail.com', 587, 'tls'))
        ->setUsername('contact.domisep@gmail.com')
        ->setPassword('WeLoveC00kies');

    $mailer = new Swift_Mailer($transport);

    $base_url = constant('BASE_URL');

    $inviter = $_SESSION['first_name'] . ' ' . $_SESSION['last_name'];

    // Create a message
    $messageToCustomer = (new Swift_Message("You received an invitation"))
        ->setFrom(['contact.domisep@gmail.com' => 'Service client Domisep'])
        ->setTo([$email])
        ->setBody(
            " <p>You have been invited to join $inviter's house on Domisep ! </p>
        <p>Please follow <a href='$base_url/invited/?key=$secret_key'>this link</a> to create your account to access the home space</p>
        ", 'text/html'
        );

    $result = $mailer->send($messageToCustomer);

    if ($result > 0) {
        echo 'message sent';
    } else {
        echo 'fail sending mail';
    }

}

function displayErrorAndLeave($error = 'Sorry, an error occured', $status = 500)
{
    header("HTTP/1.1 " . $status . " " . $error);
    exit();
}
