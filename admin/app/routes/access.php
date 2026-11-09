<?php

// login
Route::add('/login', function () {
	View::initialize('access/login');
	View::$title = 'Login';
	View::$middlewares = ['not-admin'];
	View::$template = 'void';
	View::show();
});

// logout
Route::add('/logout', function () {
	View::initialize('access/logout');
	View::$title = 'Logout';
	View::$middlewares = ['admin'];
	View::$template = 'void';
	View::show();
});
