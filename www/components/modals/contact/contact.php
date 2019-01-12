


<div id="modal-contact" class="modal">


	<!-- Modal content -->
	<div class="modal-content">
        <span ></span>


<a class="close" id="close-contact">&times;</a>

		<form method="post" action="controllers/contact-us.php" target="contact-result">

			<h2>Contact us</h2>

			<input type="text" name="request-email" placeholder="Your e-mail adress" />
			<br>
			<input type="text" name="request-subject" placeholder="Object of your request" />
			<br>
			<textarea style="resize: none;" cols="86" rows="20" name="request-content"></textarea>
			<br>
			<input type="submit" value="Send", name="contact">
    </form>
    <iframe name="contact-result"></iframe>
	</div>

</div>
