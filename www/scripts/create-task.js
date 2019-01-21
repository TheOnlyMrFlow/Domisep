$(document).ready(function() {
  $(document).on("submit", "form", function(e) {
    if (!$("select[name='preset']").val() || !$("select[name='frequency']").val() || !$("input[name='trip-start']").val() || !$("input[name='time']").val()) {
      alert("Please fill all the fields");
      e.preventDefault();
      return false;
    }
  });
});
