
<<<<<<< HEAD
=======


<!DOCTYPE html>
>>>>>>> 8595296cb62cafba1835b398a41e0facb786a47d
<div id="modal-contact" class="modal">


	<!-- Modal content -->
	<div class="modal-content">
        <span ></span>

 
<a class="close" id="close-contact">&times;</a>

		<form method="post" action="controllers/contact-us.php" target="contact-result">
			<?php	
			if ($_SESSION['language'] == 'en') {
				$language_email="Your email address";
				$language_object="Object of your request";
				$language_contact="Contact us";
				$language_submit="Send";
						}
			elseif ($_SESSION['language'] == 'fr') {
				$language_email= htmlentities("Votre adresse e-mail");
				$language_object=htmlentities("Objet de la requête");
				$language_contact=htmlentities("Contactez-nous");
				$language_submit="Envoyer";}

			echo "
			<h2>$language_contact</h2>
			<section class='input-container'>
				<input type='text' name='request-email' placeholder= '$language_email' />
			</section>

			<section class='input-container'>
				<input type='text' name='request-subject' placeholder='$language_object' />
			</section>
			<section class='input-container'>
				<textarea style='resize: none;' cols='86' rows='20' name='request-content'></textarea>
			</section>
			<input type='submit' value='$language_submit', name='contact'>"?>
    </form>
    <iframe name="contact-result"></iframe>
	</div>

</div>