
<div id="modal-comp-details" class="modal">


  <!-- Modal content -->
  <div class="modal-content">

    <a class="close" id="close-comp-details">&times;</a>

    <form id="comp-details-form">

      <h2 id="comp-details-title"></h2>
        <?php
            if ($_SESSION['language'] == 'en') {
                $language_rename="Rename your component:";
                $language_move="Move your component to:";
                $language_submit="Save your modifications";
                        }
            elseif ($_SESSION['language'] == 'fr') {
                $language_rename= htmlentities("Renommer le composant :");
                $language_move=htmlentities("Déplacer le composant :");
                $language_submit="Sauvegarder les modifications";}

            echo "
            <canvas id='myChart'></canvas>
        <section class='input-container'>
          <span>$language_rename</span>
          <input id='comp-details-name' type='text' name='name'>
        </section>

        <section class='input-container'>
          <span>$language_move</span>
          <select id='comp-details-room' name='room'></select>
        </section>

      <input id='comp-details-id' name='comp-id' style='display: none;' />

      <div class='submit-container'>
        <input type='submit' value='$language_submit' name='update-comp'>
      </div>"
      ?>
    </form>
  </div>

</div>
