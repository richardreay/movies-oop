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
//$database->query('SELECT fname, lname, dob, image FROM actors WHERE actors_id = :id');
//$database->bind(':id', '1');
//$row = $database->single();
//echo "<pre>";
//print_r($row);
//echo "</pre>";


// select multiple rows
//$database->query('SELECT actors.fname, actors.lname, actors.gender, actors.dob, actors.image, countries.name FROM actors INNER JOIN countries ON actors.nationality=countries.country_id WHERE fname = :fname');
//$database->bind(':fname', 'Tim');
//$rows = $database->resultSet();
//echo "<pre>";
//print_r($rows);
//echo "</pre>";
//echo $database->rowCount();

// use form post data to add single record to database
// $movies->AddToDB('actors');

?>

<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>not IMDB</title>
	<link href="css/styles.css" rel="stylesheet" type="text/css" />
</head>
<body>
	<div id="divWrapper">
		<header class="clear">
			<div id="divLogo"><a href="index.php" title="return to the homepage"><img src="img/logo.png" alt="not IMDB" /></a></div>
			<div id="divSearch">
				<form action="index.php" method="post">
					<input type="text" name="search" placeholder="Search for movie, actor etc" />
				</form>
			</div>
		</header>
		<div id="divContent">
			<p>Some text on the page goes here and looks like this bro.</p>
			<form action="index.php" method="post">
				<fieldset>
					<label for="fname">First Name:</label>
					<input type="text" id="fname" name="fname" placeholder="First Name" /><br />

					<label for="lname">Last Name:</label>
					<input type="text" id="lname" name="lname" placeholder="Last Name" /><br />
					
					<label for="gender">Gender:</label>
					<input type="text" id="gender" name="gender" placeholder="Gender" /><br />

					<label for="dob">DOB:</label>
					<input type="text" id="dob" name="dob" placeholder="YYYY-MM-DD" /><br />

					<label for="nationality">Nationality:</label>
					<input type="text" id="nationality" name="nationality" placeholder="Nationality" /><br />

					<label for="image">Image:</label>
					<input type="text" id="image" name="image" placeholder="Image Name" /><br />
					
					<input type="submit" value="Submit" />
					
				</fieldset>
			</form>
		</div><!-- end of divContent -->
		<footer>
			<p>This is the footer!</p>
		</footer>
	</div><!-- end of divWrapper -->
	
</body>
</html>