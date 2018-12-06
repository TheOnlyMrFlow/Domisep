$(document).ready(function() {
  var data = {
    'language' : 'fr'
  }
  $.post('../handlers/change-language.php', data, function(data, textStatus, xhr) {
    /*optional stuff to do after success */
  });
});
