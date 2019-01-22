$(document).ready(function() {
  var addedZone = $('.components_line:last-child');
  var select = $("#select-sensor");

  select.on("change", function() {

    var el = this.options[this.selectedIndex];
    el.remove();
    var data = {
      'serialNumber': el.value
    };
    $.post('controllers/presets/display-selected-component.php', data, function(response) {
      if (addedZone.children('.component').length == 4) {
        addedZone.after("<div class='components_line'></div>");
        addedZone = $('.components_line:last-child');
      }
      addedZone.append(response);
    })
  });

  $('.dashboard-inner-container').on('click', '.fa-minus-square', function(event) {
    event.preventDefault();
    $(this).parent('.component').remove();
    var title = $(this).siblings('.component_title').text();
    var o = new Option(title, $(this).parents('.component').attr('id'));
    $(o).html(title);
    $("#select-sensor").append(o);
  });

  $('.dashboard-inner-container').on('click','.component_bas>.form-switch>i', function(e) {
    var id = $(this).closest('div.component').attr('id');
    var state = this.previousElementSibling.checked;
    if (state == false) {
      $(this).parents('.component_bas').prev(".component_middle").find("span>i").css("color", "#4BD763");
    } else {
      $(this).parents('.component_bas').prev(".component_middle").find("span>i").css("color", "#7A7A7A");
    }
  });
  $('.dashboard-inner-container').on('click','.component>.component_middle>.change-component-value>.component-plus-button', function(e) {
    var valueElement = $(this).parent().prev().children('span:first-child');
    valueElement.text(+valueElement.text() + 1);
    var id = $(this).parents('div.component').attr('id');
  })

  $('.dashboard-inner-container').on('click','.component>.component_middle>.change-component-value>.component-minus-button', function(e) {
    var valueElement = $(this).parent().prev().children('span:first-child');
    valueElement.text(+valueElement.text() - 1);
    var id = $(this).parents('div.component').attr('id');
  })

  $('#Save').on('click', function(event) {
    var dataArray = [];
    var presetName = $('#NamePreset').val();

    $('.component').each(function(index) {
      var serialNumber = $(this).attr('id');
      var state = $(this)[0].querySelectorAll('.form-switch>input')[0].checked;
      if(state==false){
        state=0;
      }
      else{
        state=1;
      }
      var value = $(this).find('.component-value>span:first-child').text();
      if (value != ''){
        value = +value;
      }
      else{
        value = null;
      }
      var temp = [serialNumber,state,value];
      dataArray.push(temp);
    });

    $.post('controllers/presets/create.php',{'name':presetName,'data' : dataArray},function(response){
      window.location.href = './../my-house.php';
    });
  })
});
