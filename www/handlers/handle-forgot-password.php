<?php

// Swift Mailer Library
require_once '../../vendor/autoload.php';
require_once '../../globalVars.php';

if (isset($_POST['forgot-password'])) {
    $db = mysqli_connect('localhost', 'root', '', 'mff');
    $emailaddress = mysqli_real_escape_string($db, $_POST['mail']);
    
    if (empty($emailaddress)) {
        echo 'Please fill your email address';
        exit();
    } else if (!filter_var($emailaddress, FILTER_VALIDATE_EMAIL)) {
        echo 'This is not a valid email';
        exit();
    }
    
    $sql = "SELECT id, email FROM users WHERE email = ?";
    $stmt = mysqli_stmt_init($db);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        //header("Location: ../index.php?error=sqlerror");
        echo 'Sorry, an error happened. Please contact Domisep.';
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "s", $emailaddress);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if ($row = mysqli_fetch_assoc($result)) {
            
            //$secret_key = random_bytes(60);
            
            $seed = str_split('abcdefghijklmnopqrstuvwxyz'
            . 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'
            . '0123456789'); // and any other characters
            shuffle($seed); // probably optional since array_is randomized; this may be redundant
            $secret_key = '';
            foreach (array_rand($seed, 30) as $k) {
                $secret_key .= $seed[$k];
            }
            
            $hashed_secret_key = password_hash($secret_key, PASSWORD_BCRYPT);
            
            $expirationTime = time() + 86400; //24 hours
            $expiration = date('Y-m-d H:i:s', $expirationTime);
            //$expiration = date( 'Y-m-d H:i:s', $expiration );
            
            $stmt = $db->prepare("REPLACE INTO  password_reset_keys (id_user, hashed_key, expiration)  VALUES (?, ?, ?)");
            $stmt->bind_param("iss", $row['id'], $hashed_secret_key, $expiration);
            $stmt->execute();
            
            echo (mysqli_error($db));
            
            sendResetMail($row['email'], $row['id'], $secret_key);
            
        }
    }
} else {
    exit();
}

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
    