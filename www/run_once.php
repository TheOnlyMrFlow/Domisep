<?php

// $db = mysqli_connect('localhost', 'root', '', 'mff');
// $result = mysqli_query($db, 'SELECT id,id_home FROM users');
// while ($user_row = mysqli_fetch_array($result)) {
//   $user_id = $user_row[0];
//   $user_home = $user_row[1];
//   $result2 = mysqli_query($db, "SELECT serial_number FROM components INNER JOIN rooms ON components.id_room=rooms.id WHERE rooms.id_home=$user_home");
//   if($result2!=false){
//     while ($component_row = mysqli_fetch_array($result2)) {
//       $component = $component_row[0];
//       echo($user_id.' '.$user_home.' '.$component);
//       if (mysqli_query($db, "INSERT INTO user_rights (id_user,serial_number,access_level) VALUES ($user_id,'$component','read')")) {
//           echo "New record created successfully";
//     } else {
//         echo "Error:<br>" . mysqli_error($db);
//     }
//
//   }
//   }
// }