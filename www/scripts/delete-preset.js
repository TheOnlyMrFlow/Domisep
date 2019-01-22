function deletePreset(id) {
  if (!confirm("Are you sure you want to delete this preset ?")) return;

  $.post(
    location.origin + "/controllers/presets/delete.php",
    { id: id },
    function(result) {
      console.log(result);
      location.reload();
    }
  );
}
