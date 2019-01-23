
<!DOCTYPE html>

<footer>
  <div>
    <a class="contact-opener"><?php if ($_SESSION['language']=='en') {
            				echo('Contact us');
        				} elseif ($_SESSION['language']=='fr') {
            				echo(htmlentities('Contactez-nous'));
       					 } ?></a>
    <p>&copy; Copyright <?php echo date("Y"); ?> <?php if ($_SESSION['language']=='en') {
            				echo('DomIsep. All rights reserved.');
        				} elseif ($_SESSION['language']=='fr') {
            				echo(htmlentities('DomIsep. Tous droits reservés.'));
       					 } ?></p>
  </div>
</footer>
