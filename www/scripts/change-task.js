$(document).ready(function() {
  $('.task-row .form-switch>i').on('click', function(e) {
    var id = $(this).closest('tr.task-row').attr('id');
    var state = this.previousElementSibling.checked;
    console.log(id + state);
    $.post('../controllers/tasks/change-task.php', {
      'action': 'change_state',
      'state': state,
      'id': id
    }, function(data) {});
  });
});
