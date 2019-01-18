$(document).ready(function() {
  var addedZone = $('.components_line:last-child');
  var select = document.getElementById("select-sensor");

  select.addEventListener("change", function() {

    var el = this.options[this.selectedIndex];
    el.remove();
    // select.val("disabled");
    var data = {
      'serialNumber': el.value
    };
    $.post('handlers/handle_display_component.php', data, function(response) {
      if (addedZone.children('.component').length == 4) {
        addedZone.after("<div class='components_line'></div>");
        addedZone = $('.components_line:last-child');
      }
      addedZone.append(response);
    })
    //addedZone.innerHTML += el.value;
  });

  $('.dashboard-inner-container').on('click','.fa-minus-square', function(event) {
    // event.preventDefault();
    alert($(this).siblings('.component-title').text());
    alert($(this).parents('.component').attr('id'));
    select.append($('<option>', {
      value: $(this).parents('.component').attr('id'),
      text: $(this).next('.component-title').text()
    }));
  });

});
