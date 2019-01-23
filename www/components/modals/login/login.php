
<div id="modal-login" class="modal">
  <!-- Modal content -->
  <div class="modal-content">
    <a class="close" id="close-login">&times;</a>
    <form id="login-form">
      <h2> <?php if ($_SESSION['language']=='en') {
                    echo('Log in');
                } elseif ($_SESSION['language']=='fr') {
                    echo(htmlentities('Connexion'));
                 } ?></h2>

      <section class="input-container">
        <span>Email</span> <input type="text" name="mail" /><br />
      </section>

      <section class="input-container">
        <span> <?php if ($_SESSION['language']=='en') {
                    echo('Password');
                } elseif ($_SESSION['language']=='fr') {
                    echo(htmlentities('Mot de passe'));
                 } ?></span>
        <input type="password" name="password" /><br />
      </section>
      <div class="submit-container">
        <?php if ($_SESSION['language']=='en') {
                            $language_submit="Submit";
                            $language_forgot="Forgot password?";
                        } elseif ($_SESSION['language']=='fr') {
                            $language_submit=htmlentities("Se connecter");
                            $language_forgot="Mot de passe oublié ?";
                         } 
            echo "
        <input type='submit' value='$language_submit' name='login' />
        <input type='submit' value='$language_forgot' name='forgot-password' />
      </div>"?>
      <p id="login-result"></p>
      <!-- <iframe name="login-result"></iframe> -->
    </form>
  </div>
</div>
