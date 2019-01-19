<?php

require_once(dirname(__FILE__) . '/utils/dbconnect.php');


header('Content-Type: text/html; charset=ISO-8859-1');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if($_SESSION['role']!='house_manager' && $_SESSION['id']!='administrator' ){
  header('index.php');
}
if(!isset($_SESSION['language'])){
	$_SESSION['language'] = 'en';
}

?>


<!DOCTYPE html>
<html>

<head>
	<title>My House - Domisep</title>
	<link rel="stylesheet" type="text/css" media="screen" href="style/full-site-style.min.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="style/dashboard-style.min.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="style/manage-users.min.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="style/icons.min.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="components/modals/modal.min.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="components/footer/footer.min.css" />
	<link rel="stylesheet" href="components/header-nav/header-nav.min.css">
	<link rel="stylesheet" href="components/header-nav/header-dashboard.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="components/header-nav/sticky-header.min.js"></script>
	<script src="scripts/change-language.min.js"></script>
	<script src="scripts/user-rights.js"></script>

</head>

<body>
	<?php

include('components/header-nav/header-nav.php');
$db = dbconnect();
?>

		<div class="page-content-container dashboard">
			<div class="page-content dashboard">
				<div class="page-title">
					<h1>Manage Users</h1>
				</div>
				<div class="dashboard-big-container">
						<h2>Users</h2>
						<div class="dashboard-inner-container">
							<table id="users-table" width="100%">
								<colgroup>
									<col width="30%"/>
									<col width="30%"/>
									<col width="30%"/>
									<col width="10%"/>
								</colgroup>
								<thead>
									<tr>
										<th>Last Name</th>
										<th>First Name</th>
										<th>Mail</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									<?php
									$home_id = $_SESSION['home_id'];
									$users_array = mysqli_query($db,"SELECT id, first_name, last_name, email FROM users WHERE id_home=$home_id ORDER BY last_name,first_name ASC");
									$html = '';
									while ($user_row = mysqli_fetch_array($users_array)) {
										$id = $user_row[0];
										$first_name = $user_row[1];
										$last_name = $user_row[2];
										$email = $user_row[3];

										$html .= "		<tr>
										<td>$first_name</td>
										<td>$last_name</td>
										<td>$email</td>
										<td>$id</td>
										</tr>";
									}
									echo $html;
									?>
								</tbody>
							</table>
						</div>
						<div class="dashboard-inner-container">
							<form id="add-user-form">
								<div>
									<h3>Add a member</h3>
								</div>
								<div>
									<input required type="text" name="mail" placeholder="zac.smith@example.com">
								</div>
								<div>
									<input type="submit" name="invite-user" value="Invite">
								</div>
							</form>
						</div>
						<p id="invite-user-result"></p>

				</div>
				<div class="dashboard-big-container">
						<h2>User Rights</h2>
						<div class="dashboard-inner-container select-user">
							<div>
								<h3>Select User</h3>
							</div>
							<div>
								<select name="user-id" placeholder="select user">
									<?php
									// $home_id = $_SESSION['id_home'];
									$html = '';
									$home_id = 1;
									// $current_user_id = $_SESSION['id'];
									$current_user_id = 1;

									$users_array = mysqli_query($db,"SELECT id, first_name, last_name, email FROM users WHERE id_home=$home_id AND role='house_member' ORDER BY last_name,first_name ASC");
									$html = "<option disabled selected value > select user </option>";
									while ($user_row = mysqli_fetch_row($users_array)) {
										$id = $user_row[0];
										$first_name = $user_row[1];
										$last_name = $user_row[2];
										$html .= "<option value='$id'>$first_name $last_name</option>";
									}
									echo $html;
									?>
								</select>
							</div>
						</div>
						<div class="dashboard-inner-container change-user-rights">
							<?php
								// $id_home = $_SESSION['id_home'];
								$id_home = 1;
								$components_array = mysqli_query($db, "SELECT id_room,rooms.name,serial_number,components.name FROM components INNER JOIN rooms ON components.id_room=rooms.id WHERE rooms.id_home=$id_home ORDER BY rooms.name,components.name");
								$html = '';
								$current_room_id = null;
								$first_room = 1;
								while($component_array = mysqli_fetch_row($components_array)){
									if($component_array[0]!=$current_room_id){
										$current_room_id = $component_array[0];
										$room_name = $component_array[1];
										$component_id = $component_array[2];
										$component_name = $component_array[3];
										if(!$first_room){
											$html .= "</table></div>";
										}
										$first_room = 0;
										$html .= "<div class='$current_room_id room-container'>
										<h3>$room_name</h3>
										<table width='100%'>
										<colgroup>
										<col width='80%'/>
										<col width='10%'/>
										<col width='10%'/>
										</colgroup>
										<tr class='$component_id'>
										<td>$component_name</td>
										<td><div class='view-button ic ic-eye off'></div></td>
										<td><div class='edit-button ic ic-pencil off'></div></td>
										</tr>";
									}
									else{
										$component_id = $component_array[2];
										$component_name = $component_array[3];
										$html .= "<tr class='$component_id'>
										<td>$component_name</td>
										<td><div class='view-button ic ic-eye off'></div></td>
										<td><div class='edit-button ic ic-pencil off'></div></td>
										</tr>";
									}

								}
								$html .= "</table></div>";
								echo $html;
								?>
						</div>
				</div>
			</div>
		</div>

<?php
include('components/modals/contact/contact.php');
include('components/footer/footer.php');
?>
</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js"></script>
<script src="scripts/open-modals.js"></script>
<script src="scripts/invite-user.js"></script>

</html>
