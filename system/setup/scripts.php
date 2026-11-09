<?php

//load all the scripts to the page
function scripts() {

	global $view;

	//load system scripts
	$files = array_map('parse_html', glob(SERVER_ROOT . '/system/scripts/*.js', GLOB_BRACE));
	foreach ($files as $file) load_script($file);

	//load app scripts
	$files = array_map('parse_html', glob(SERVER_ROOT . '/app/scripts/*.js', GLOB_BRACE));
	foreach ($files as $file) load_script($file);

	//load view script
	foreach ($view->scripts as $file) load_script($file);

	$files = array_map('parse_html', glob(SERVER_ROOT . '/views/js/' . $view->name . '/*.js', GLOB_BRACE));
	foreach ($files as $file) load_script($file);
}

//load a specific script
function load_script($file) {

	$file .= '?v=' . filemtime(SERVER_ROOT . $file);

	echo '<script src="' . $file . '"></script>
	';
}
