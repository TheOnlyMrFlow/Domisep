$(document).ready(function() {

  $.get('../handlers/change-language.php',function(response) {
    if(response=='en'){
      $('#french_flag').css('opacity', '0.5');
    }
    else if (response=='fr') {
      $('#english_flag').css('opacity', '0.5');
    }
  });

  $('#french_flag').on('click', function(event){
    $('#french_flag').css('opacity', '1');
    var data = {
      'language' : 'fr'
    }
    $.post('../handlers/change-language.php', data);
    $('#english_flag').css('opacity', '0.5');
  })
  $('#english_flag').on('click', function(event){
    $('#english_flag').css('opacity', '1');
    var data = {
      'language' : 'en'
    }
    $.post('../handlers/change-language.php', data);
    $('#french_flag').css('opacity', '0.5');
  })

});
