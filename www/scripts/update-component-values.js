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

  $('.component>.component_middle>.change-component-value>.component-plus-button').on('click', function(e){
    var valueElement = $(this).parent().prev().children('span:first-child');
    valueElement.text(+valueElement.text()+1)
    var id = $(this).parents('div.component').attr('id');
    var action = 'add_value';

    $.post('../handlers/handle_update_component_values.php', {'action':action,'id':id}, function(data) {

    });
  })

  $('.component>.component_middle>.change-component-value>.component-minus-button').on('click', function(e){
    var valueElement = $(this).parent().prev().children('span:first-child');
    valueElement.text(+valueElement.text()-1)
    var id = $(this).parents('div.component').attr('id');
    var action = 'remove_value';
    $.post('../handlers/handle_update_component_values.php', {'action':action,'id':id}, function(data) {

    });
  })
});
