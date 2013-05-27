<?php

include('includes/config.php');
include('includes/database.class.php');
include('includes/auth.class.php');

$auth = new Auth();

//$movies = new Table();
//$database = new Database();

// write query with placeholders
//$database->query('INSERT INTO actors (fname, lname, dob, image) VALUES (:fname, :lname, :dob, :image)');
// bind data to placeholders
//$database->bind(':fname', 'Richy');
//$database->bind(':lname', 'Reay');
//$database->bind(':dob', '1982-09-16');
//$database->bind(':image', 'richreay.jpg');
// run the statement
//$database->execute();


// insert multiple records using a transaction
// $database->beginTransaction();
// $database->query('INSERT INTO actors (fname, lname, dob, image) VALUES (:fname, :lname, :dob, :image)');
// $database->bind(':fname', 'Richard');
// $database->bind(':lname', 'Reay');
// $database->bind(':dob', '1982-09-16');
// $database->bind(':image', 'richardreay.jpg');
// $database->execute();
// $database->bind(':fname', 'Lily');
// $database->bind(':lname', 'Reay');
// $database->bind(':dob', '1984-05-09');
// $database->bind(':image', 'lilyreay.jpg');
// $database->execute();
// $database->endTransaction();


// select a single row
// $database->query('SELECT fname, lname, dob, image FROM actors WHERE actors_id = :id');
// $database->bind(':id', '1');
// $row = $database->single();
// echo "<pre>";
// print_r($row);
// echo "</pre>";


// select multiple rows
// $database->query('SELECT actors.fname, actors.lname, actors.gender, actors.dob, actors.image, countries.name FROM actors INNER JOIN countries ON actors.nationality=countries.country_id WHERE fname = :fname');
// $database->bind(':fname', 'Tim');
// $rows = $database->resultSet();
// echo "<pre>";
// print_r($rows);
// echo "</pre>";
// echo $database->rowCount();

// use form post data to add single record to database
// $movies->AddToDB('actors');
$registered = '';
if (isset($_POST['email']) && isset($_POST['password'])) {
	$userCreated = $auth->createUser($_POST['email'], $_POST['password'], 0);
	if ($userCreated) {
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