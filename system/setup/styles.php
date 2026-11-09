<?php

//load all the styles to the page
function styles() {

	global $view;

	//load system styles
	$files = array_map('parse_html', glob(SERVER_ROOT . '/system/styles/*.css', GLOB_BRACE));
	foreach ($files as $file) load_style($file);

	//load app styles
	$files = array_map('parse_html', glob(SERVER_ROOT . '/app/styles/*.css', GLOB_BRACE));
	foreach ($files as $file) load_style($file);

	//load view styles
	foreach ($view->styles as $file) load_style($file);

	$files = array_map('parse_html', glob(SERVER_ROOT . '/views/css/' . $view->name . '/*.css', GLOB_BRACE));
	foreach ($files as $file) load_style($file);
}

//load a specific style
function load_style($file) {

	$file .= '?v=' . filemtime(SERVER_ROOT . $file);

	echo '<link href="' . $file . '" rel="stylesheet" type="text/css">
	';
}
