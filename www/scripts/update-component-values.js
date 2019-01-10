$(document).ready(function() {
  $('.switch').on('click', function(e){
    var id = $(this).parents('div.component').attr('id');
    var state = $(this).children('input').val();
    var action = 'change_state';
    $.post('../handlers/handle_update_component_values.php', {'state': state,'id':id,'action':action}, function(data) {

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
