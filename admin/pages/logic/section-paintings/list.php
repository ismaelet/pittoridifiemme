<?php

// select table
$queryConfig['table'] = 'images';
$queryConfig['index'] = 'ID';
$queryConfig['select'] = ['images.ID', 'images.main', 'CONCAT(lname, " ", fname) as fullName'];
$queryConfig['from'] = 'images INNER JOIN artists ON artists.ID = images.artID';
$queryConfig['where-search'] = "fname LIKE CONCAT('%',?,'%') OR lname LIKE CONCAT('%',?,'%') OR fname2 LIKE CONCAT('%',?,'%') OR lname2 LIKE CONCAT('%',?,'%')";

// select fields
$fields = [
	['title' => 'ID', 'name' => 'ID'],
	['title' => '', 'type' => 'img'],
	['title' => 'Artista', 'name' => 'fullName', 'size' => 1],
	['title' => 'È la copertina?', 'name' => 'main', 'type' => 'boolean-icon',],

	['type' => 'btn'],
];

$buttons = [
	['type' => 'edit'],
	['type' => 'delete'],
];

// set as main
if (isset($_POST['main'])) {
	$id = $_POST['id'];
	$artID = $_POST['artID'];

	DB::update('images SET main=0 WHERE artID=?', [$artID]);
	DB::update('images SET main=1 WHERE ID=?', [$id]);

	redirect('#row' . $id);
}

function _expand_results(&$entry, $field, $key, $queryRow) {
	if ($field['type'] == 'img') {
		$entry['src'] = public_client_url('/uploads/pics/' . $queryRow['ID'] . '_l.jpg');
	}
}
