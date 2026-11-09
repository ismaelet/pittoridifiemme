<?php

// ajax calls
Route::add('/ajax/*', function ($path) {
	$ajaxFile = null;
	$ajaxRequest = explode('ajax/', $path)[1] ?? null;
	$ajaxModule = explode('?', $ajaxRequest)[0] ?? null;

	if (file_exists($file = SERVER_ROOT . '/app/functions/ajax/' . $ajaxModule . '.php')) $ajaxFile = $file;
	else if (file_exists($file = SERVER_ROOT . '/system/functions/ajax/' . $ajaxModule . '.php')) $ajaxFile = $file;

	if ($ajaxFile) include_once($ajaxFile);
	else echo 'Error: invalid requested file';
});

// api calls
Route::add('/api/*', function () {
	include_once(SERVER_ROOT . '/system/setup/api.php');
});

// favicon
Route::add('/favicon.ico', function () {
	include(SERVER_ROOT . '/app/assets/favicon/favicon.ico');
});
