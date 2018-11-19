<?php 


// Swift Mailer Library
require_once '../../vendor/autoload.php';

if (isset($_POST['contact'])) {
  // receive all input values from the form
  $userEmail =  $_POST['request-email'];
  $subject = $_POST['request-subject'];
  $content = $_POST['request-content'];

}

else {
  exit();
}


$transport = (new Swift_SmtpTransport('smtp.gmail.com', 587, 'tls' ))
  ->setUsername('contact.domisep@gmail.com')
  ->setPassword('WeLoveC00kies');

$mailer = new Swift_Mailer($transport);

// Create a message
$messageToCustomer = (new Swift_Message("We received your request"))
  ->setFrom(['contact.domisep@gmail.com' => 'Service client Domisep'])
  ->setTo([$userEmail])
  ->setBody(
    " <p>Your request had been received by our services, we will reach you as soon as possible</p>
      <p>This was your request :</p>
      <div style='background-color: #dddbdb; padding: 50px;'><p>$content</p></div>
    ", 'text/html'
    );

// Send the message
$result = $mailer->send($messageToCustomer);

if ($result > 0){
    echo 'success';
}
else {
    echo 'failure';
}


