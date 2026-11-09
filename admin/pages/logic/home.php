<?php

$artistCount = DB::count('artists');
$paintingCount = DB::count('images');

$panels = [
	[
		'slug' => 'artists',
		'title' => 'Lista degli artisti',
		'info' => '<span class="fw-bold">' . $artistCount . '</span class="fw-bold"> aggiunti',
		'primary-button' => [
			'label' => 'Aggiungi un artista',
			'link' => client_link('artists/add'),
		],
		'secondary-button' => [
			'label' => 'Lista degli artisti',
			'link' => client_link('artists/list'),
		],
	],

	[
		'slug' => 'paintings',
		'title' => 'Lista dei dipinti',
		'info' => '<span class="fw-bold">' . $paintingCount . '</span class="fw-bold"> aggiunti',
		'primary-button' => [
			'label' => 'Aggiungi un dipinto',
			'link' => client_link('paintings/add'),
		],
		'secondary-button' => [
			'label' => 'Lista dei dipinti',
			'link' => client_link('paintings/list'),
		],
	],
];
