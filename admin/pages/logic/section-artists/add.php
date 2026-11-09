<?php

/*
* Query configuration
*/
$queryConfig['table'] = 'artists';
$queryConfig['select'] = ['*', 'CONCAT(lname, " ", fname) as fullName'];
$queryConfig['index-field'] = 'ID';
$queryConfig['title-field'] = 'fullName';

// form
$inputs = [
	[
		['type' => 'lbl', 'text' => 'Nome e cognome',],
		['text' => 'Nome', 'name' => 'fname', 'size' => 2],
		['text' => 'Cognome', 'name' => 'lname', 'size' => 2],
	],
	[
		['type' => 'lbl', 'text' => 'Cognome e nome alternativi (opzionale)'],
		['text' => 'Cognome alternativo', 'name' => 'lname2', 'size' => 2],
		['text' => 'Nome alternativo', 'name' => 'fname2', 'size' => 2],
	],
	[
		['type' => 'lbl', 'text' => 'Luogo di nascita'],
		['text' => 'Lugo di nascita', 'name' => 'place'],
	],
	[
		['type' => 'lbl', 'text' => 'Data di nascita e morte'],
		['text' => 'Data di nascita e morte', 'name' => 'date'],
	]
];
