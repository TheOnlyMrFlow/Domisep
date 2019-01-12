$(document).ready(function() {

  $('.component_bas>.form-switch>i').on('click', function(e){
    var id = $(this).closest('div.component').attr('id');
    var state = this.previousElementSibling.checked;
    if (state==false) {
      $(this).parents('.component_bas').prev(".component_middle").find("span>i").css("color","#4BD763");
    }
    else {
      $(this).parents('.component_bas').prev(".component_middle").find("span>i").css("color","#7A7A7A");
    }
    $.post('../controllers/components/update-values.php', {'action':'change_state','state': state,'id':id}, function(data) {
    });
  });

  $('.component>.component_middle>.change-component-value>.component-plus-button').on('click', function(e){
    var valueElement = $(this).parent().prev().children('span:first-child');
    valueElement.text(+valueElement.text()+1);
    var id = $(this).parents('div.component').attr('id');
    $.post('../controllers/components/update-values.php', {'action':'add_value','id':id}, function(data) {
    });
  })

  $('.component>.component_middle>.change-component-value>.component-minus-button').on('click', function(e){
    var valueElement = $(this).parent().prev().children('span:first-child');
    valueElement.text(+valueElement.text()-1);
    var id = $(this).parents('div.component').attr('id');
    $.post('../controllers/components/update-values.php', {'action':'remove_value','id':id}, function(data) {
    });
  })
});
