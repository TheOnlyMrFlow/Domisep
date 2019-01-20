function deleteComponent (id) {

    if (!confirm("Are you sure you want to delete this component ?")) return;

    $.post(
        location.origin + '/controllers/components/delete.php',
        { 'id': id },
        function(result) {
            console.log(result);
            location.reload();
        }
    );
}