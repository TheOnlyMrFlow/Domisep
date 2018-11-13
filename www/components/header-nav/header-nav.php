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
          } else if (basename($_SERVER['PHP_SELF'], '.php') == 'my-house'){
            echo "<li class='menu-item my-house-opener'><a>My house</a></li>
            <li class='menu-item schedule-opener'><a>Schedule presets</a></li>
            <li class='menu-item manage-users-opener'><a>Manage users</a></li>
            <li class='menu-item my-account-opener'><a>My account</a></li>";
            }
          ?>
        </ul>
      </nav>
  </div>
</header>
