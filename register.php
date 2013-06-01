<?php

include('includes/config.php');
include('includes/database.class.php');
include('includes/auth.class.php');

$auth = new Auth();

$registered = '';
if (isset($_POST['email']) && isset($_POST['password'])) {
	if ($auth->createUser($_POST['email'], $_POST['password'], 0)) {
		$registered = 'yes';
	} else {
		$registered = 'no';
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
		<p><?php if ($registered == 'yes') {
					echo 'Registration Successful - Please <a href="login.php" title="login">Login</a>'; 
				} elseif ($registered == 'no') {
					echo 'Registration Failed - Please try again later';
				}
			?></p>
		<form action="register.php" method="post">
			<input type="text" name="email" placeholder="Email" /><br />
			<input type="text" name="password" placeholder="Password" /><br />
			<input type="submit" value="Register" />
		</form>
	</div>
</body>
</html>