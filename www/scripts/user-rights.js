$(document).ready(function() {
  $('.view-button').on('click', function(event){
    if($(this).hasClass('off')){
      $(this).removeClass('off').addClass('on');
      $(this).parent().next().children().css('display', 'block');
      var data = {
        'level' : 'read',
        'component' : $(this).parents('tr').attr('class')
      }
      $.post('./handlers/update-rights.php',data, function(data) {
        /*optional stuff to do after success */
      });
    }
    else{
      $(this).removeClass('on').addClass('off');
      $(this).parent().next().children().css('display', 'none');
    }
  })
  $('.edit-button').on('click', function(event){
    if($(this).hasClass('off')){
      $(this).removeClass('off').addClass('on');
    }
    else{
      $(this).removeClass('on').addClass('off');
    }
  })
});
