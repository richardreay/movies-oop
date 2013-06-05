<?php

include_once '../includes/config.php';
include_once '../includes/database.class.php';
include_once '../includes/auth.class.php';
include_once '../includes/table.class.php';
include_once '../includes/pagination.class.php';

if (!isset($database)) $database = new Database();

// delete the requested record, then display updated paginated content
$database->query('DELETE FROM actors WHERE actors_id = :actors_id');
$database->bind(':actors_id', $_POST['deleteID']);
$database->execute();


$query = "SELECT actors.actors_id, actors.fname, actors.lname, actors.gender, actors.dob, actors.image, countries.name FROM actors INNER JOIN countries ON actors.nationality=countries.country_id";
$database->query($query);
$result = $database->resultSet();

$actorCount = $database->rowCount();

$pagination = new Pagination();
$pagination->set_pages($actorCount);

// check if page number exists in post
if (isset($_POST['page']) && !empty($_POST['page'])) {
	$pagination->current_page_number = $_POST['page'];
}

// make sure the correct offset is generated
$pagination->set_query_offset_append();

// attach the offset to the query
$query = $query . $pagination->sql_append;
$database->query($query);
$ourActors = $database->resultSet();

// start output
echo "<div id='pagination'>";

$params = array('class'=>'pagination', 'class_current'=>'pagination-current', 'function'=>'js_paginate');
$pagination->build_pagination_links($params);
echo $pagination->links;
echo "<table>";

foreach ($ourActors as $num => $actor) {
	echo "<tr>";
		echo "<td>" . $actor['fname'] . "</td>";
		echo "<td>" . $actor['lname'] . "</td>";
		echo "<td>" . $actor['gender'] . "</td>";
		echo "<td>" . $actor['dob'] . "</td>";
		echo "<td>" . $actor['image'] . "</td>";
		echo "<td>" . $actor['name'] . "</td>";
		echo "<td>" . "<a href='#' onClick='js_delete({$actor['actors_id']})'>delete</a>" . "</td>";
	echo "</tr>";
}
echo "</table>";
echo "</div>";

?>