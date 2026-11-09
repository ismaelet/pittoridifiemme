<?php

//setup page
$this->title = 'Errore 404';
$this->template = 'void';

//store error
$url = $_SERVER['REQUEST_URI'] ?? false;
$src = $_SERVER['HTTP_REFERER'] ?? '';

if ($url && DB::table('errors') && DB::table('errors_whitelist')) {

	if (!DB::exists('errors_whitelist WHERE url=?', [$url])) DB::add('errors (name, details, source) VALUES (?, ?, ?)', ['404', $url, $src]);
}