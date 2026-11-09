<?php

//setup page
include_once(__ROOT__.'/app/modules/seller_area.php');

//add header and footer
include_once(__ROOT__.'/app/templates/php/header.php');
include_once(__ROOT__.'/app/templates/php/footer.php');

//setup navigation bar
$this_path = str_replace('manage/', '', $this->name);
$this_cat = substr($this_path, 0, strpos($this_path, '/'));
$this_page = substr($this_path, strpos($this_path, '/') + 1);

$nav_categories = [
	[
		'title' => 'Impostazioni',
		'category' => 'settings',
	],
	[
		'title' => 'Lavori',
		'category' => 'portfolio',
	],
	[
		'title' => 'Vendite',
		'category' => 'sales',
	],
	[
		'title' => 'Foto clienti',
		'category' => 'pics',
	],
];

$nav_settings = [
	[
		'title' => 'Generali',
		'file' => 'general',
		'file_show' => '',
	],
];

$nav_portfolio = [
	[
		'title' => 'Lista lavori',
		'file' => 'list',
		'file_show' => '',
	],
	[
		'title' => 'Carica lavoro',
		'file' => 'add',
	],
];


$nav_sales = [
	[
		'title' => 'Lista vendite',
		'file' => 'list',
		'file_show' => '',
	],
	[
		'title' => 'Modifica prezzi',
		'file' => 'prices',
	],
];

$nav_pics = [
	[
		'title' => 'Lista foto',
		'file' => 'list',
		'file_show' => '',
	],
	[
		'title' => 'Carica una foto',
		'file' => 'add',
	],
];