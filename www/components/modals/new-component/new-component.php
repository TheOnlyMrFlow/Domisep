

<div id="modal-new-comp" class="modal">



	<!-- Modal content -->
	<div class="modal-content">


		<a class="close" id="close-new-comp">&times;</a>

		<div class="title_add_a_component">
			<h2>Add a component</h2><br/><br>
		</div>

		<form action= "handlers/handle_new_component_information.php" method="post" target="new-comp-result">
			
			<div class="gros_bloc">
				<section class="input-container">
					<span>Name your component:</span><input type="text" name="component_name">
				</section>

				<section class="input-container">
					<span>Serial number:</span><input type="text" name="serialnumber">
				</section>

			</div>
			<br>
			<br>
			<div class="submit">
				<input type="submit" value="Submit" name="new_component">
			</div>
		</form>



		<iframe name="new-comp-result"></iframe>

	</div>

</div>