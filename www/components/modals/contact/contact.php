


<div id="modal-contact" class="modal">


	<?php
//if "email" variable is filled out, send email
  if (isset($_REQUEST['request-email']))  {

    $to      = "comte.florian@gmail.com";
    $subject = $_REQUEST['request-subject'];
    $message = $_REQUEST['request-content'];
    $headers = array(
        'From' => 'comte.florian@gmail.com',
        'Reply-To' => 'comte.florian@gmail.com',
        'X-Mailer' => 'PHP/' . phpversion()
    );
    
    mail($to, $subject, $message, $headers);
    
   echo '<script>console.log("Sent")</script>';
  }
  
  //if "email" variable is not filled out, display the form
  else  {
    echo '<script>console.log("Not sent")</script>';
?>

	<!-- Modal content -->
	<div class="modal-content">
        <span ></span>


<a class="close" id="close-contact">&times;</a>

		<form action="/" method="post">

			<h2>Contact us</h2>

			<input type="text" name="request-email" placeholder="Your e-mail adress" />
			<br>
			<input type="text" name="request-subject" placeholder="Object of your request" />
			<br>
			<textarea style="resize: none;" cols="86" rows="20" name="request-content"></textarea>
			<br>
			<input type="submit" value="Send">
		</form>
	</div>

</div>


<?php
 } 
?>