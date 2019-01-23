<div id="modal-signup" class="modal">

    <!-- Modal content -->
    <div class="modal-content">


        <a class="close" id="close-signup">&times;</a>

        <form id="signup-form">

            <h2><?php if ($_SESSION['language']=='en') {
                            echo('Register an account');
                        } elseif ($_SESSION['language']=='fr') {
                            echo(htmlentities('Créer un compte'));
                         } ?></h2>
            <div class="form-container">
                <div class="half-form-container">
                    <section class="input-container">
                        <span><?php if ($_SESSION['language']=='en') {
                            echo('Last name');
                        } elseif ($_SESSION['language']=='fr') {
                            echo(htmlentities('Nom de famille'));
                         } ?></span><input required type="text" name="lastname">
                    </section>
                    <section class="input-container">
                        <span><?php if ($_SESSION['language']=='en') {
                            echo('First name');
                        } elseif ($_SESSION['language']=='fr') {
                            echo(htmlentities('Prénom'));
                         } ?></span><input required type="text" name="firstname">
                    </section>

                    <section class="input-container">
                        <span><?php if ($_SESSION['language']=='en') {
                            echo('Birth date');
                        } elseif ($_SESSION['language']=='fr') {
                            echo(htmlentities('Date de naissance'));
                         } ?></span><input required type="date" name="birthdate">
                    </section>
                    <section class="input-container">
                        <span><?php if ($_SESSION['language']=='en') {
                            echo('Phone number');
                        } elseif ($_SESSION['language']=='fr') {
                            echo(htmlentities('Numéro de téléphone'));
                         } ?></span><input required type="tel" name="phone">
                    </section>


                    <section class="input-container">
                        <span><?php if ($_SESSION['language']=='en') {
                            echo('Address');
                        } elseif ($_SESSION['language']=='fr') {
                            echo(htmlentities('Adresse postale'));
                         } ?></span><input required type="text" name="address">
                    </section>
                    <section class="input-container">
                        <span><?php if ($_SESSION['language']=='en') {
                            echo('City');
                        } elseif ($_SESSION['language']=='fr') {
                            echo(htmlentities('Ville'));
                         } ?></span><input required type="text" name="city">
                    </section>
                    <section class="input-container">
                        <span><?php if ($_SESSION['language']=='en') {
                            echo('Zip code');
                        } elseif ($_SESSION['language']=='fr') {
                            echo(htmlentities('Code postal'));
                         } ?></span><input required type="text" name="zipcode">
                    </section>
                    <section class="input-container">
                        <span><?php if ($_SESSION['language']=='en') {
                            echo('Country');
                        } elseif ($_SESSION['language']=='fr') {
                            echo(htmlentities('Pays'));
                         } ?></span><input required type="text" name="country">
                    </section>
                </div>

                <div class="half-form-container">
                    <section class="input-container">
                        <span><?php if ($_SESSION['language']=='en') {
                            echo('Email address');
                        } elseif ($_SESSION['language']=='fr') {
                            echo(htmlentities('Adresse email'));
                         } ?></span><input required type="emailaddress" name="email">
                    </section>
                    <section class="input-container">
                        <span> <?php if ($_SESSION['language']=='en') {
                            echo('Create a password');
                        } elseif ($_SESSION['language']=='fr') {
                            echo(htmlentities('Créer un mot de passe'));
                         } ?></span><input required type="password" name="password1">
                    </section>
                    <section class="input-container">
                        <span><?php if ($_SESSION['language']=='en') {
                            echo('Confirm your password');
                        } elseif ($_SESSION['language']=='fr') {
                            echo(htmlentities('Confirmer le mot de passe'));
                         } ?></span><input required type="password" name="password2">
                    </section>
                    <section class="input-container">
                        <span><?php if ($_SESSION['language']=='en') {
                            echo('DomIsep product\'s serial number');
                        } elseif ($_SESSION['language']=='fr') {
                            echo(htmlentities('Numéro de série d\'un produit DomIsep'));
                         } ?></span><input required type="text" name="serialnumber">
                    </section>
                </div>
            </div>
            <p><input required type="checkbox" name="terms-and-conditions"/>
      				<?php if ($_SESSION['language']=='en') {
                            echo('By creating an account, you agree to our');
                        } elseif ($_SESSION['language']=='fr') {
                            echo(htmlentities('En créant un compte, vous acceptez nos'));
                         } ?>
      				<a href="./../../../mentions-legales.php" target="_blank"><strong><?php if ($_SESSION['language']=='en') {
                            echo('Terms & Conditions');
                        } elseif ($_SESSION['language']=='fr') {
                            echo(htmlentities('Conditions d\'utilisation'));
                         } ?></strong></a>
      			</p>

                <?php if ($_SESSION['language']=='en') {
                            $language_submit="Submit";
                        } elseif ($_SESSION['language']=='fr') {
                            $language_submit=htmlentities("Valider");
                         } 
            echo "
            <div class='submit-container'>
                <input type='submit' value='$language_submit' name='signup'>
            </div>
            "?>
            <p id="signup-result"></p>
        </form>
    </div>
</div>
