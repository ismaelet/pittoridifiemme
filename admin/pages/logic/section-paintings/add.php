<?php

$id = $_GET['id'] ?? null;
$queryConfig['table'] = 'images';
$queryConfig['index-field'] = 'ID';
$queryConfig['title-field'] = 'ID';

$inputs = [
	[
		['type' => 'lbl', 'text' => 'Arista che lo ha realizzato'],
		[
			'type' => 'select',
			'name' => 'artID',
			'query' => 'ID, CONCAT(lname, " ", fname) AS name FROM artists ORDER BY ID ASC',
			'field-name' => 'ID',
			'field-show' => 'name',
		],
	],
];

if ($id) {
	$inputs[] =
		[
			[
				'type' => 'cbx',
				'name' => 'main',
				'value' => 1,
				'text' => 'È l\'immagine di copertina',
			],
		];
} else {
	$inputs[] =
		[
			['type' => 'lbl', 'text' => 'immagini'],
			[
				'type' => 'file',
				'name' => 'file[]',
				'multiple' => true
			]
		];
}

// add entry
function _expand_add($table, $inputs) {
	foreach ($_FILES['file']['tmp_name'] as $key => $_looping) {
		$artistId = $_POST['artID'];

		$imgId = form_db_add($table, $inputs);

		if (!DB::exists('images WHERE artID = ? AND main = 1', [$artistId])) {
			DB::update('images SET main = 1 WHERE ID = ?', [$imgId]);
		}

		$imageData = [
			'size' => 1920,
			'quality' => 90,
			'key' => $key,
			'url' => public_server_url('/uploads/pics/' . $imgId . '_l.jpg'),
		];

		upload_img($imageData);

		$imageData = [
			'size' => 600,
			'quality' => 80,
			'key' => $key,
			'url' => public_server_url('/uploads/pics/' . $imgId . '_m.jpg'),
		];

		upload_img($imageData);
	}
}

function _expand_edit($table, $inputs, $indexFiled, $id) {
	$artistId = $_POST['artID'];
	$mainImage = isset($_POST['main']) ? 1 : 0;

	form_db_update($table, $inputs, $indexFiled, $id);

	if ($mainImage) {
		DB::update('images SET main = 0 WHERE artID = ? AND ID <> ?', [$artistId, $id]);
	} else if (!DB::exists('images WHERE artID = ? AND main = 1', [$artistId])) {
		DB::update('images SET main = 1 WHERE artID = ? ORDER BY ID ASC LIMIT 1', [$artistId]);
	}
}
