<?php

require_once('../models/User.php');

// Swift Mailer Library
require_once '../../vendor/autoload.php';
require_once '../../globalVars.php';

if (!isset($_POST['forgot-password']) ) {
    exit();
}

if (!isset($_POST['mail'])) {
    displayErrorAndLeave('Please fill in your mail', 400);
}

$emailaddress = $_POST['mail'];
if (empty($emailaddress)) {
    displayErrorAndLeave('Please fill in your mail', 400);
}


    $user = User::getUserByMail($emailaddress);
    if ($user == false) {
        displayErrorAndLeave('This address is not registered');
    }
    $secret_key = User::generateSecretKey();
    $user->hashPasswordResetKeyAndSave($secret_key);

    sendResetMail($emailaddress, $user->getId(), $secret_key);


function sendResetMail($email, $id, $secret_key)
{
    $transport = (new Swift_SmtpTransport('smtp.gmail.com', 587, 'tls'))
    ->setUsername('contact.domisep@gmail.com')
    ->setPassword('WeLoveC00kies');

    $mailer = new Swift_Mailer($transport);

    $base_url = constant('BASE_URL');

    // Create a message
    $messageToCustomer = (new Swift_Message("Reset your password"))
    ->setFrom(['contact.domisep@gmail.com' => 'Service client Domisep'])
    ->setTo([$email])
    ->setBody(
        " <p>You have requested to reset your password, you can follow this link to set a new one.</p>
        <p>This link will be working for the next 24 hours.</p>
        <a href='$base_url/reset-password?id=$id&key=$secret_key'>Reset your password</a>
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
    echo $error;
    header("HTTP/1.1 " . $status ." " . $error);
    
    exit();
}
// $messageToSelf = (new Swift_Message("New request received"))
//     ->setFrom(['contact.domisep@gmail.com'=> $userEmail])
//     ->setTo(['contact.domisep@gmail.com'])
//     ->setBody(
    //         " <p>A new request has been received from $userEmail :</p>
    //       <div style='background-color: #dddbdb; padding: 50px;'>
    //         <h1>$subject</h1>
    //         <p>$content</p>
    //       </div>
    //     ", 'text/html'
    //     );

    // // Send the message
    // $result = $mailer->send($messageToSelf);
