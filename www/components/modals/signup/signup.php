<link rel="stylesheet" type="text/css" media="screen" href="components/modals/signup/signup.css" />


<div id="modal-signup" class="modal">

	<!-- Modal content -->
	<div class="modal-content" align="center">


		<a class="close" id="close-signup">&times;</a>		

		<div class="modal-subcontent">
			<form method="post" action="./handlers/handle-signup.php" target="signup-result">

				<h2>Register an account</h2>
				<br/>

				<section>
						 Last name:
					<br> First name:
					<br> Email address:
					<br> Birth date:
					<br> Phone number:
					<br> Create a password:
					<br> Confirm your password:
					<br> Domisep product's serial number :
					<br>
					<br> Address :
					<br> City :
					<br> Zip code :
					<br> Country :
					<br>
				</section>

				<aside>
					<input type="text" name="lastname">
					<br>
					<input type="text" name="firstname">
					<br>
					<input type="emailaddress" name="email">
					<br>
					<input type="date" name="birthdate">
					<br>
					<input type="tel" name="phone">
					<br>
					<input type="password" name="password1">
					<br>
					<input type="password" name="password2">
					<br>
					<input type="text" name="serialnumber">
					<br>
					<br>
					<input type="text" name="address">
					<br>
					<input type="text" name="city">
					<br>
					<input type="text" name="zipcode">
					<br>
					<input type="text" name="country">
					<br>
				</aside>
				<br>
				<p>By creating an account, you agree to our
					<strong>Terms and Conditions</strong>
				</p>
				<p class="submit">
					<input type="submit" value="Submit" name="signup">
				</p>
			</form>
			<iframe name="signup-result"></iframe>
		</div>
	</div>

</div>