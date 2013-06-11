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
		<div id="divContent" class="clear">
			<div class="twoColumn">
				<h2>Latest Movie Industry News</h2>
				<div class="newsItem clear">
					<div class="imgWrapper"><img src="img/news/kevin_spacey.jpg" alt="Kevin Spacey" class="imgReSize" /></div>
					<h3>Kevin Spacey to deliver MacTaggart lecture</h2>
					<p>Award-winning actor Kevin Spacey is to deliver the annual MacTaggart lecture as part of the 2013 Edinburgh International Television Festival. Spacey, star of the acclaimed Netflix drama, House of Cards, will discuss the "huge opportunity, innovation and creativity" in the TV industry. He added that he was "honoured" and "excited" to share his thoughts.</p>
				</div>
				<div class="newsItem clear">
					<img src="img/news/darth_vader.jpg" alt="Darth Vader" class="imgReSize" />
					<h3>Star Wars: Episode VII' director J.J. Abrams drops new hints about film</h2>
					<p>'Star Wars: Episode VII' is set to begin filming in January, according to director J.J. Abrams. He also spoke briefly about his vision for how the film will fit in to the franchise.</p>
				</div>
			</div><!-- end of twoColumn -->
			<div class="oneColumn leftMargin">
				<div class="topTenList">
					<h2>Top Ten Movies</h2>
					<ol>
						<?php
							$database->query('SELECT title FROM movies LIMIT 0, 10');
							$topTen = $database->resultSet();
							foreach ($topTen as $value) {
								echo "<li class=''>" . $value['title'] . "</li>";
							}
						?>
					</ol>
				</div>
			</div><!-- end of oneColumn -->
			
			
			
		</div><!-- end of divContent -->
		<footer>
			<p>This is the footer!</p>
		</footer>
	</div><!-- end of divWrapper -->
	
</body>
</html>