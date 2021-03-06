<!DOCTYPE html>
<header>
  <div id="nav-container">
    <div class="logo-container">
      <a href="/"><img src="../../resources/images/logo.svg" id="menu-logo"></a>
      <a href="/"><img src="../../resources/images/logo-white.svg" id="menu-logo-white"></a>
    </div>
      <nav id="main-menu">
        <ul id="menu-list">
          <?php if (isset($_SESSION['connected']) && $_SESSION['connected']) {

            if($_SESSION['language']=='en'){
              $house = 'My house';
              $schedule = "Schedule tasks";
              if ($_SESSION['role']!='house_member') {
                $manage = "<li class='menu-item manage-users-opener'><a href='../../manage-users.php'>Manage users</a></li>";
              }
              else{
                $manage = '';
              }
              $account = "My account";
              $contact = "Contact us";
            }elseif ($_SESSION['language']=='fr') {
              $house = 'Ma maison';
              $schedule = htmlentities("Tâches");
              if ($_SESSION['role']!='house_member') {
                $fr = htmlentities("Gérer les utilisateurs");
                $manage = "<li class='menu-item manage-users-opener'><a href='../../manage-users.php'>$fr</a></li>";
              }
              else{
                $manage = '';
              }
              $account = "Mon compte";
              $contact = "Contactez-nous";
            }

            echo "<li class='menu-item my-house-opener'><a href='../../my-house.php'>$house</a></li>
            <li class='menu-item schedule-opener'><a href='../../newtask.php'>$schedule</a></li>
            $manage
            <li class='menu-item my-account-opener'><a href='../../my-account.php'>$account</a></li>
            <li class='menu-item contact-opener'><a>$contact</a></li>";
          } else {
            if($_SESSION['language']=='en'){
              $contact = "Contact us";
              $sign = "Sign up";
              $log = "Log in";
            }elseif ($_SESSION['language']=='fr') {
              $contact = htmlentities("Contactez-nous");
              $sign = htmlentities("Créer un compte");
              $log = htmlentities("Se connecter");
            }
            echo "<li class='menu-item contact-opener'><a>$contact</a></li>
            <li class='menu-item signup-opener'><a>$sign</a></li>
            <li class='menu-item login-opener'><a>$log</a></li>";
            }
          ?>
        </ul>
      </nav>
      <div class="flags-container">
        <a href=<?php $_SERVER['REQUEST_URI'] ?>><img src="../../resources/images/gb flag.svg" id="english_flag"></a>
        <a href=<?php $_SERVER['REQUEST_URI'] ?>><img src="../../resources/images/fr flag.svg" id="french_flag"></a>
      </div>
  </div>

</header>
