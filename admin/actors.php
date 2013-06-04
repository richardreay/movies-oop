<?php

include_once '../includes/config.php';
include_once '../includes/database.class.php';
include_once '../includes/auth.class.php';
include_once '../includes/table.class.php';

session_start();

$auth = new Auth();
$database = new Database();
$movies = new Table();
$errorMsg = 0;

if (!isset($_SESSION['user_id'])) {
	// Not logged in, send to login page.
	header( 'Location: ../login.php' );
} else {
	// Check we have the right user
	$logged_in = $auth->checkSession();
	
	if(empty($logged_in)){
		// Bad session
		$auth->logout();
		header( 'Location: ../login.php' );
		
	} else {
		// logged in, show the page
	}
}

if (isset($_POST['addActorSubmitted'])) {
	// add form submitted
	// add in validation here
	//$movies->AddToDB('actors');

}

?>

<!doctype html>
<html>
<head>
	<title></title>
	<script src="http://code.jquery.com/jquery-1.9.0.min.js" type="text/javascript" ></script>
</head>
<body>
	<div id="divWrapper">
		<h1>Update Actors</h1>
		<p>Add an actor</p>
		<?php if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
			echo 'its ajaxing';
		} ?>
		<form action="actors.php" method="post">
			<input type="text" name="fname" placeholder="First Name" value="<?php if (isset($_POST['fname'])) echo $_POST['fname']; ?>" /><br />
			<input type="text" name="lname" placeholder="Last Name" value="<?php if (isset($_POST['lname'])) echo $_POST['lname']; ?>" /><br />
			Male<input type="radio" name="gender" placeholder="Male" value="m" <?php if (isset($_POST['gender']) && $_POST['gender'] == 'm') echo 'checked="checked"'; ?> />&nbsp;
			Female<input type="radio" name="gender" placeholder="Female" value="f" <?php if (isset($_POST['gender']) && $_POST['gender'] == 'f') echo 'checked="checked"'; ?> /><br />
			<input type="text" name="dob" placeholder="YYYY-MM-DD" value="<?php if (isset($_POST['dob'])) echo $_POST['dob']; ?>" /><br />
			<?php
			$database->query('SELECT country_id, name FROM countries');
			$rows = $database->resultSet();
			echo "<select name = 'nationality'>";
			foreach ($rows as $row) {
				echo "<option value = '{$row['name']}'";
				if (isset($_POST['addActorSubmitted']) && $_POST['nationality'] == $row['name']) echo "selected = 'selected'"; 
				echo ">{$row['name']}</option>";
			}
			echo "</select>";
			?>
			<br />
			<input type="text" name="image" placeholder="Image Name" value="<?php if (isset($_POST['image'])) echo $_POST['image']; ?>" /><br />
			<input type="submit" value="Add Actor" />
			<input type="hidden" name="addActorSubmitted" value="TRUE" />
		</form>
		
		<h2>Edit Actors</h2>
		<?php include('actorsPaginate.php'); ?>
	</div>
	<script type="text/javascript">
		function js_paginate(page) {
			$('#pagination').load( // this is the id of the div holding our cow list
				'actorsPaginate.php', // the script that handles our listing from above
				{'page':page} 
			);
		}
	</script>
</body>
</html>