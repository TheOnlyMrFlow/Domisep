$(document).ready(function () {

	

	Array.prototype.forEach.call($(".change-room-name"), (el)=>{
		console.log($(el));
		$(this).ajaxForm({
		url: location.origin + '/controllers/rooms/rename.php',
		type: 'post',
		success: function(data){
			console.log($(this).children(".room-name"));
			$(".room-name").blur();


		},
		error: function(err){
			console.log("err " + err);
		}

	})
	});


	
})