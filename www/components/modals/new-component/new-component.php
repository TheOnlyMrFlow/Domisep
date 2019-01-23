
<<<<<<< HEAD
=======
<!DOCTYPE html>

>>>>>>> 8595296cb62cafba1835b398a41e0facb786a47d
<div id="modal-new-comp" class="modal">
	<!-- Modal content -->
	<div class="modal-content">

		<a class="close" id="close-new-comp">&times;</a>
			<?php 
				if ($_SESSION['language'] == 'en') {
					$language_add="Add a component";
					$language_name_comp="Name your component:";
					$language_serial="Serial Number:";
					$language_submit="Submit";}
				elseif ($_SESSION['language'] == 'fr') {
			   		$language_add= htmlentities('Ajouter un composant');
			   		$language_name_comp=htmlentities("Nom de votre composant :");
					$language_serial=htmlentities("Numéro de série :");
					$language_submit=htmlentities("Valider");}

		echo "
		<h2>$language_add</h2><br/>

		<form id='new-comp-form'>
		
			<section class='input-container'>
				<span>$language_name_comp</span><input type='text' name='component_name'>
			</section>

			<section class='input-container'>
				<span>$language_serial</span><input type='text' name='serialnumber'>
			</section>

			<input id='room-id' name='room-id' style='display: none;'/>
			<p id='new-comp-result'></p>

			<div class='submit-container'>
				<input type='submit' value='$language_submit' name='new_component'>
			</div>

		</form>
		"?>
	</div>
</div>
