<?php

include('includes/config.php');
include('includes/database.class.php');
include('includes/table.class.php');

//$movies = new Table();
$database = new Database();

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
$database->query('SELECT fname, lname, dob, image FROM actors WHERE actors_id = :id');
$database->bind(':id', '1');
$row = $database->single();
echo "<pre>";
print_r($row);
echo "</pre>";


// select multiple rows
$database->query('SELECT actors.fname, actors.lname, actors.gender, actors.dob, actors.image, countries.name FROM actors INNER JOIN countries ON actors.nationality=countries.country_id WHERE fname = :fname');
$database->bind(':fname', 'Tim');
$rows = $database->resultSet();
echo "<pre>";
print_r($rows);
echo "</pre>";
echo $database->rowCount();

// use form post data to add single record to database
// $movies->AddToDB('actors');

?>

<!doctype html>
<html>
<head>
	<title></title>
</head>
<body>
	<div id="divWrapper">
		<form action="index.php" method="post">
			<input type="text" name="fname" placeholder="First Name" /><br />
			<input type="text" name="lname" placeholder="Last Name" /><br />
			<input type="text" name="gender" placeholder="Gender" /><br />
			<input type="text" name="dob" placeholder="YYYY-MM-DD" /><br />
			<input type="text" name="nationality" placeholder="Nationality" /><br />
			<input type="text" name="image" placeholder="Image Name" /><br />
			<input type="submit" value="Add Actor" />
		</form>
	</div>
</body>
</html>