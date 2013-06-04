<?php

include('includes/config.php');
include('includes/database.class.php');
include('includes/auth.class.php');

$auth = new Auth();
$errorMsg = 0;

if (isset($_POST['submitted'])) {
	if ($auth->login($_POST['email'], $_POST['password']) == 0) {
		// login verified - load admin page
		header('Location: admin/admin.php');
	} elseif ($auth->login($_POST['email'], $_POST['password']) == 4) {
		// email and password do not match database
		$errorMsg = 1;
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
		<p><?php if ($errorMsg == 1) { echo 'Login Failed - Your email and password do not match'; } ?></p>
		<form action="login.php" method="post">
			<input type="text" name="email" placeholder="Email" /><br />
			<input type="text" name="password" placeholder="Password" /><br />
			<input type="submit" value="Login" />
			<input type="hidden" name="submitted" value="TRUE" />
		</form>
	</div>
</body>
</html>