<?php

//select table
$queryConfig['table'] = 'artists';
$queryConfig['select'] = ['ID', 'CONCAT(lname, " ", fname) as fullName', 'IF(lname2 <> "" OR fname2 <> "", CONCAT(lname2, " ", fname2), "") as alternativeFullName', 'place', 'date'];
$queryConfig['index'] = 'ID';
$queryConfig['where-search'] = "fname LIKE CONCAT('%',?,'%') OR lname LIKE CONCAT('%',?,'%') OR fname2 LIKE CONCAT('%',?,'%') OR lname2 LIKE CONCAT('%',?,'%') OR place LIKE CONCAT('%',?,'%')";
$queryConfig['order-index'] = 'fullName';
$queryConfig['order-direction'] = 'ASC';

//select fields
$fields = [
	['title' => 'ID', 'name' => 'ID'],
	['title' => 'Nome completo', 'name' => 'fullName', 'size' => 1],
	['title' => 'Nome alternativo', 'name' => 'alternativeFullName', 'size' => 1],
	['title' => 'Luogo di nascita', 'name' => 'place'],
	['title' => 'Data di nascita', 'name' => 'date'],

	['type' => 'btn'],
];

$buttons = [
	['type' => 'edit'],
	['type' => 'delete'],
];

//delete entry
if (isset($_POST['delete'])) {

	$id = $_POST['ID'];

	DB::delete('artists WHERE ID=?', [$id]);

	$res = DB::select('ID FROM images WHERE artID=?', [$id]);

	while ($row = $res->fetch_assoc()) {

		$imgID = $row['ID'];

		if (file_exists($file = __DROOT__ . '/uploads/pics/' . $imgID . '_l.jpg')) unlink($file);
		if (file_exists($file = __DROOT__ . '/uploads/pics/' . $imgID . '_m.jpg')) unlink($file);
	}


	DB::delete('images WHERE artID=?', [$id]);

	redirect();
}
