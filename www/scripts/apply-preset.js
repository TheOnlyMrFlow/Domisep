$(document).ready(function() {
  $('.preset-button').on('click', function(event) {
    $(this).attr('id');
    $.post('./../controllers/presets/apply-preset.php',{'id':$(this).attr('id')},function(response){
      var array = JSON.parse(response);
      for (var row_number in array) {

        var id = array[row_number][0];
        var state = array[row_number][1];
        var value = array[row_number][2];
        console.log(id+state+value);
        $('#'+id)[0].querySelectorAll('.form-switch>input')[0].checked = state;
        if (state==1) {
          $('#'+id+">.component_middle>div.logo>span>i").css("color","#4BD763");
        }
        else {
          $('#'+id+">.component_middle>div.logo>span>i").css("color","#7A7A7A");
        }
        if(value!=null){
          $('#'+id).find('.component-value>span:first-child').text(value);
        }
      }
    });
  })
});
