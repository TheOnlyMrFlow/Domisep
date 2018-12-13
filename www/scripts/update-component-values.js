$(document).ready(function() {
  $('.switch').on('click', function(e){
    var state = $(this).parents('div.component').attr('id');
    $.post('/path/to/file', state: state, function(data, textStatus, xhr) {
      /*optional stuff to do after success */
    });
  });
});
