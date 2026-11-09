<?php

//select table
$tbl = 'artists';
$fieldS = 'name';
$orderDir = 'asc';

//handle search
$searchSQL = "fname LIKE CONCAT('%',?,'%') OR lname LIKE CONCAT('%',?,'%') OR fname2 LIKE CONCAT('%',?,'%') OR lname2 LIKE CONCAT('%',?,'%')";
$query = '*, CONCAT (lname, " ", fname) as name';

//select fields
$inputs = [
	['type' => 'hidden', 'field' => 'ID'],

	['title' => 'Nome', 'field' => 'name', 'size' => 3],
	['title' => 'URL Biografia', 'field' => 'bio', 'size' => 3],
	['title' => 'Biografia in PDF', 'size' => 3],

	['type' => 'btn'],
];

$buttons = [
	['arch' => 'edit'],
];