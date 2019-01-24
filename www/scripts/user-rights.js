$(document).ready(function() {
  $("select[name='user-id']").change(function(){
    var data = {
      'user_id' : $(this).children('option:selected').val()
    }
    $.post('../controllers/users/rights-json.php',data,
    function(response) { //success callback
      var parsed_response = JSON.parse(response);
      for (var i in parsed_response) {
        var serial_number = parsed_response[i]['serial_number'];
        var level = parsed_response[i]['access_level'];
        if(level=='read'){
          $("tr."+serial_number+" td div.view-button").removeClass('off').addClass('on');
          $("tr."+serial_number+" td div.edit-button").css('display','block');
        }
        else if (level=='write') {
          $("tr."+serial_number+" td div.edit-button").css('display','block');
          $("tr."+serial_number+" td div.view-button").removeClass('off').addClass('on');
          $("tr."+serial_number+" td div.edit-button").removeClass('off').addClass('on');
        }
      }
      $('div.dashboard-inner-container.change-user-rights').css('display','flex');
    });
  });
  $('.view-button').on('click', function(event){
    var triggered_button = $(this);
    if(triggered_button.hasClass('off')){
      var data = {
        'level' : 'read',
        'component' : triggered_button.parents('tr').attr('class'),
        'user_id' : $("select[name='user-id']").children('option:selected').val()
      }
      $.post('./../controllers/users/update-rights.php',data, function(response) {
        triggered_button.removeClass('off').addClass('on');
        triggered_button.parent().next().children().css('display', 'block');
      });
    }
    else{
      var data = {
        'level' : 'none',
        'component' : triggered_button.parents('tr').attr('class'),
        'user_id' : $("select[name='user-id']").children('option:selected').val()
      }

      $.post('./../controllers/users/update-rights.php',data, function(response) {
        triggered_button.removeClass('on').addClass('off');
        triggered_button.parent().next().children().css('display', 'none');
        triggered_button.parent().next().children().removeClass('on').addClass('off');
      });
    }
  })
  $('.edit-button').on('click', function(event){
    var triggered_button = $(this);
    if(triggered_button.hasClass('off')){
      var data = {
        'level' : 'write',
        'component' : triggered_button.parents('tr').attr('class'),
        'user_id' : $("select[name='user-id']").children('option:selected').val()
      }

      $.post('./../controllers/users/update-rights.php',data, function(response) {
        triggered_button.removeClass('off').addClass('on');
      });
    }
    else{
      var data = {
        'level' : 'read',
        'component' : triggered_button.parents('tr').attr('class'),
        'user_id' : $("select[name='user-id']").children('option:selected').val()
      }

      $.post('./../controllers/users/update-rights.php',data, function(response) {
        triggered_button.removeClass('on').addClass('off');
      });
    }
  })
});
