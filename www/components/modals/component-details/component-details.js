$(document).ready(function() {



  $("#comp-details-form").ajaxForm({
    url: location.origin + '/controllers/components/modify.php',
    type: 'post',
    success: function(data) {
      console.log(data);
      location.reload();
    },
    error: function(err) {
      console.log("An error occured");
    }
  })

  var buttons = document.getElementsByClassName("comp-details-opener");



  Array.prototype.forEach.call((buttons), function(el) {
    el.addEventListener("click", function() {
      console.log('click');
      var root = this;
      var safetyCount = 0;

      while (!root.className.split(' ').includes("component")) {
        root = root.parentElement;
        safetyCount++;
        if (safetyCount > 30) {
          console.error("Cant find root element of the component");
          return;
        }
      }
      document.getElementById('comp-details-id').value = root.id;



      $.get(
        encodeURI(location.origin + '/controllers/components/details-json.php?id=' + root.id),
        function(compData) {
          console.log(compData);
          compData = JSON.parse(compData);

          document.getElementById("comp-details-title").innerHTML = compData['name'];
          document.getElementById("comp-details-name").value = compData['name'];

          var roomSelect = document.getElementById("comp-details-room");

          roomSelect.innerHTML = "";

          $.get(
            location.origin + '/controllers/rooms/list-json.php',
            function(roomsData) {
              console.log(roomsData);
              roomsData = JSON.parse(roomsData);
              for (var i = 0; i < roomsData.length; i++) {
                roomSelect.innerHTML +=
                  "<option value = '" + roomsData[i]['id'] + "'>" + roomsData[i]['name'] + "</option>";

              }
              roomSelect.value = compData['id_room'];
            }
          );
          var chart = document.getElementById('myChart');
          if (root.id.substr(0, 3) == 'sen' || root.id.substr(0, 3) == 'sma') {
            chart.style.display = 'block';
            $.post('./../utils/update-chart.php', {
              'serial_number': root.id
            }, function(response) {
              var array = JSON.parse(response);
              console.log(array);

              var tempData = {
                labels: array[0],
                datasets: [{
                  fillColor: "rgba(172,194,132,0.4)",
                  strokeColor: "#ACC26D",
                  pointColor: "#fff",
                  pointStrokeColor: "#9DB86D",
                  data: array[1]
                }]
              };
              var ctx = chart.getContext('2d');

              var myLineChart = new Chart(ctx, {
                type: 'line',
                data: tempData,
                options: {

                  legend: "Values history"
                }
              });
            });
          }
        });
    });
  });
});
