<?php

// homepage
Route::add('/', function () {
	View::setPage('home')
		->show();
});

// artist page
Route::add('/artist', function () {
	View::setPage('artist')
		->show();
});
