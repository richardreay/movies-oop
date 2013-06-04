<?php

include('../includes/config.php');
include('../includes/database.class.php');
include('../includes/auth.class.php');

session_start();

$auth = new Auth();
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

?>

<!doctype html>
<html>
<head>
	<title></title>
</head>
<body>
	<div id="divWrapper">
		<h1>Welcome to the admin section</h1>
		<p><a href="actors.php">actors</a></p>
	</div>
</body>
</html>