<!DOCTYPE html>
<header>
  <div id="nav-container">
      <a href="/"><img src="././resources/images/logo.svg" id="menu-logo"></a>
      <a href="/"><img src="././resources/images/logo-white.svg" id="menu-logo-white"></a>
      <nav id="main-menu">
        <ul id="menu-list">
          <?php if (basename($_SERVER['PHP_SELF'], '.php') == 'index') {
            echo "<li class='menu-item contact-opener'><a>Contact us</a></li>
            <li class='menu-item signup-opener'><a>Sign up</a></li>
            <li class='menu-item login-opener'><a>Log in</a></li>";
          } else if (in_array(basename($_SERVER['PHP_SELF'], '.php'), ['my-house','my-account','manage-users','schedule-presets'])){
            echo "<li class='menu-item my-house-opener'><a href='../../my-house.php'>My house</a></li>
            <li class='menu-item schedule-opener'><a href='../../schedule-presets.php'>Schedule presets</a></li>
            <li class='menu-item manage-users-opener'><a href='../../manage-users.php'>Manage users</a></li>
            <li class='menu-item my-account-opener'><a href='../../my-account.php'>My account</a></li>";
            }
          ?>
        </ul>
      </nav>
  </div>
</header>
