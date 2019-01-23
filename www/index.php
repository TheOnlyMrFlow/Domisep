<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['language'])) {
    $_SESSION['language'] = 'en';
}

?>

<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8" />
    <title>Domisep</title>

    <link rel="stylesheet" type="text/css" media="screen" href="style/full-site-style.min.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="style/style.min.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="components/modals/modal.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="components/footer/footer.min.css" />
    <link rel="stylesheet" href="components/header-nav/header-nav.min.css">
    <link rel="stylesheet" href="components/header-nav/header-home.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js"></script>

    <script src="components/header-nav/sticky-header.min.js"></script>
    <script src="scripts/change-language.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Libre+Baskerville" rel="stylesheet">



</head>

<body>
    <?php

include 'components/header-nav/header-nav.php';

?>

    <center>

        <div class="full-screen-image">
           <h1 class='main-title'>Domisep</h1>

        </div>

            <?php   
            if ($_SESSION['language'] == 'en') {
                $language_what_is="What is DomIsep?";
                $language_text="At Domisep, we propose our customers a complete range of finely crafted smart sensors. At Domisep,
                    we offer you a doorway to the future.";
                $language_control_text="Control everything from the confort of your bed.";
                $language_upgrade="Ready to upgrade your life ? Create your account now";
                $language_freedom="Freedom";
                
}
                
                        
            elseif ($_SESSION['language'] == 'fr') {
                $language_what_is=htmlentities("DomIsep c'est quoi?");
                $language_text=htmlentities("A DomIsep, nous proposons à nos clients une selection de capteurs intelligents ultra-performants. Ensemble, façonnons votre avenir dès maintenant.");
                $language_control_text=htmlentities("Contrôlez ce qui vous entoure depuis le confort de votre lit");
                $language_upgrade=htmlentities("Prêt à améliorer votre quotidien? Créez votre compte dès maintenant");
                $language_freedom=htmlentities("Liberté");
                }


            
            
        echo "
        <div class='page-content-container'>
            <div class='page-content'>
                <h2>$language_what_is</h2>
                <h3>$language_text</h3>
                <img class='content-image' src='../resources/images/monsieur-doigt.jpg'>

                <h2>$language_freedom</h2>
                <h3>$language_control_text</h3>
                <img class='content-image' src='../resources/images/phone-bed.jpg'>
                <div class='signup-wrapper'>
                    <a class='signup-opener'>$language_upgrade</a>
                </div>
            </div>
        </div>"?>

    </center>
    <?php
include 'components/footer/footer.php';
include 'components/modals/contact/contact.php';
include 'components/modals/login/login.php';
include 'components/modals/signup/signup.php';
?>
</body>

<script src="scripts/open-modals.js"></script>
<script src="components/modals/login/login.js"></script>
<script src="components/modals/signup/signup.js"></script>





</html>
