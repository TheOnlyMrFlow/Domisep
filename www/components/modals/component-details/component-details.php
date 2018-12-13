


<div id="modal-comp-details" class="modal">


<!-- Modal content -->
<div class="modal-content">

<a class="close" id="close-comp-details">&times;</a>

    <form id="comp-details-form">

        <h2 id="comp-details-title"></h2>

        <div class="gros_bloc">
		<section class="input-container">
			<span>Renommer le composant</span>
            <input id="comp-details-name" type="text" name="name" placeholder="*Name*"><br>
    	</section>

		<section class="input-container">
            <span>Deplacer le composant :</span>
            <div class="select-container">
            <select id="comp-details-room" name="room"></select>
            </div>
        </section>
        
        </div>

        <br>
        <br>
        <br>

        <input id="comp-details-id" name="comp-id" style="display: none;" />
        
        <div class="submit">
            <input type="submit" value="Delete component" name="delete-comp">
            <input type="submit" value="Sauvegarder les modifications" name="update-comp">
		</div>
</form>
</div>

</div>
