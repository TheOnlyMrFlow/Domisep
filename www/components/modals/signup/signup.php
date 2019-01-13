<div id="modal-signup" class="modal">

	<!-- Modal content -->
	<div class="modal-content">


		<a class="close" id="close-signup">&times;</a>

		<form method="post" action="./controllers/users/signup.php" target="signup-result">

			<h2>Register an account</h2>
			<div class="form-container">
				<div class="half-form-container">
					<section class="input-container">
						<span>Last name</span><input required type="text" name="lastname">
					</section>
					<section class="input-container">
						<span>First name</span><input required type="text" name="firstname">
					</section>

					<section class="input-container">
						<span>Birth date</span><input required type="date" name="birthdate">
					</section>
					<section class="input-container">
						<span>Phone number</span><input required type="tel" name="phone">
					</section>


					<section class="input-container">
						<span>Address</span><input required type="text" name="address">
					</section>
					<section class="input-container">
						<span>City</span><input required type="text" name="city">
					</section>
					<section class="input-container">
						<span>Zip code</span><input required type="text" name="zipcode">
					</section>
					<section class="input-container">
						<span>Country</span><input required type="text" name="country">
					</section>
				</div>

				<div class="half-form-container">
					<section class="input-container">
						<span>Email address</span><input required type="emailaddress" name="email">
					</section>
					<section class="input-container">
						<span>Create a password</span><input required type="password" name="password1">
					</section>
					<section class="input-container">
						<span>Confirm your password</span><input required type="password" name="password2">
					</section>
					<section class="input-container">
						<span>Domisep product's serial number</span><input required type="text" name="serialnumber">
					</section>
				</div>
			</div>
			<p>By creating an account, you agree to our
				<strong>Terms and Conditions</strong>
			</p>
			<div class="submit-container">
				<input type="submit" value="Submit" name="signup">
			</div>
			<iframe name="signup-result"></iframe>
		</form>
	</div>
</div>
