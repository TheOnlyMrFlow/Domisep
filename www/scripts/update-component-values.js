$(document).ready(function() {
  $('.switch').on('click', function(e){
    var id = $(this).parents('div.component').attr('id');
    var state = $(this).children('input').val();
    alert(state);
    $.post('../handlers/handle_update_component_values.php', {'state': state,'id':id}, function(data) {

    });
  });
});
