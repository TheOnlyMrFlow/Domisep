
<div id="modal-login" class="modal">



	<!-- Modal content -->
	<div class="modal-content">


		<a class="close" id="close-login">&times;</a>
		<form method="post" action="controllers/users/login.php" target="login-result">
			<h2>Connexion</h2>

			<section class="input-container">
				<span>Mail</span>
				<input type="text" name="mail"><br>
			</section>

			<section class="input-container">
				<span>Mot de passe </span>
				<input type="password" name="password"><br>
			</section>
			<div class="submit-container">
				<input type="submit" value="Se connecter" name="login">
				<input type="submit" value="Forgot password ?" name="forgot-password">
			</div>
			<iframe name="login-result"></iframe>

			<a href="#">Créer un compte</a>
		</form>
	</div>
</div>