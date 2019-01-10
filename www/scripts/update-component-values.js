$(document).ready(function() {
  $('.component_bas>.form-switch>i').on('click', function(e){
    var id = $(this).parents('div.component').attr('id');
    var state = this.previousElementSibling.checked;
    if (state==false) {
      $(this).parents('.component_bas').siblings(".component_middle").find("i").css("color","#4BD763");
    }
    else {
      $(this).parents('.component_bas').siblings(".component_middle").find("i").css("color","#7A7A7A");
    }

    $.post('../handlers/handle_update_component_values.php', {'state': state,'id':id}, function(data) {
    });
  });
});
