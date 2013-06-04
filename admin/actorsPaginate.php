<?php

include_once '../includes/config.php';
include_once '../includes/database.class.php';
include_once '../includes/auth.class.php';
include_once '../includes/table.class.php';
include_once '../includes/pagination.class.php';

if (!isset($database)) $database = new Database();
$query = "SELECT * FROM actors";
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

// notice the last set of key value pairs, function is js_paginate which is the name of the js function used
$params = array('class'=>'pagination', 'class_current'=>'pagination-current', 'function'=>'js_paginate');
$pagination->build_pagination_links($params);
echo $pagination->links;
echo '<table>';

foreach ($ourActors as $num => $actor) {
	echo '<tr><td>' . $actor['fname'] . '</td></tr>';  // this looks wrong to me
}



?>
