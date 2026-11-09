<?php

// get url of a file
function base_url($file) {
	if ($file[0] == '/') {
		$url = $file;
	} else {
		$url = assets_directory(View::$url) . $file;
	}

	return $url;
}

function client_url($file) {
	$url = CLIENT_ROOT . file_time(base_url($file));

	return $url;
}

function server_url($file) {
	$url = SERVER_ROOT . base_url($file);

	return $url;
}

function public_server_url($file) {
	$root = defined('PUBLIC_SERVER_ROOT') ? PUBLIC_SERVER_ROOT : SERVER_ROOT;

	$url = $root . base_url($file);

	return $url;
}

// avoid cache if the chached file is not up to date
function file_time($file) {
	if (!strpos($file, '?=') && file_exists($url = SERVER_ROOT . $file)) $file .= '?=' . filemtime($url);

	return $file;
}

// put the image as background image
function background_image($img) {
	return 'style="background-image: url(' . client_url($img) . ');"';
}

// put a svg as background image
function img_svg($img) {
	return 'style="mask: url(' . client_url($img) . '); -webkit-mask: url(' . client_url($img) . ') center;"';
}

// get the raw url of an icon
function icon_url_raw($file) {
	$file = $file . '.svg';

	if ($file[0] == '/') $urlRaw = $file;
	else if (file_exists(SERVER_ROOT . $path = assets_directory(View::$url) . $file)) $urlRaw = $path;
	else if (file_exists(SERVER_ROOT . $path = APP_ICONS_DIR . $file)) $urlRaw = $path;
	else $urlRaw = ICONS_DIR . $file;

	return $urlRaw;
}

// get the client url of an icon
function icon_url($file) {
	$urlRaw = icon_url_raw($file);
	$url = CLIENT_ROOT . file_time($urlRaw);

	return $url;
}

// get an embedded icon
function icon_embed($file) {
	$url = SERVER_ROOT . icon_url_raw($file);
	$icon = file_get_contents($url);

	$icon = str_replace('<svg', '<svg class="icon-embed"', $icon);

	return $icon;
}

// put an icon as background image
function icon_css($icon) {
	return 'style="background-image: url(' . icon_url($icon) . ');"';
}

// put a svg icon as background image
function icon_svg($icon) {
	return 'style="mask: url(' . icon_url($icon) . '); -webkit-mask: url(' . icon_url($icon) . ') center;"';
}

// html url
function client_link($parcialUrl = '') {
	$url = isset($parcialUrl[0]) && $parcialUrl[0] == '/' ?	$parcialUrl : CLIENT_ROOT . '/' . $parcialUrl;
	return $url;
}

function html_public_link($url = '') {
	if (defined('PUBLIC_CLIENT_URL')) $link = PUBLIC_CLIENT_URL . '/' . $url;
	else $link = client_link($url);

	return $link;
}

// get the url of a page's image folder 
function assets_directory($page_url) {
	$url = substr($page_url, strpos($page_url, 'pages') - 1);
	$url = str_replace(['/views/', '.php'], ['/assets/', '/'], $url);

	return $url;
}

// parse a url from server url to client url
function parse_html($url, $full = true) {
	$url = str_replace("\\", "/", $url);

	if (strpos($url, SERVER_ROOT) !== false) $url = $full ? CLIENT_ROOT . '/' . substr($url, strlen(SERVER_ROOT) + 1) : '/' . substr($url, strlen(SERVER_ROOT) + 1);

	return $url;
}

// parse a url from client url to server url
function parse_server_path($url) {
	if (strpos($url, CLIENT_ROOT) !== false) $url = SERVER_ROOT . explode(CLIENT_ROOT, $url)[1];
	return $url;
}

// get all files in a folder
function scan($path, $ext = '*') {
	$files = [];

	if (strpos($path, SERVER_ROOT) === false) $path = SERVER_ROOT . $path;

	foreach (glob($path . '/*.' . $ext) as $file) $files[] = $file;

	return $files;
}

// get all files in the subfolders of a folder
function scans($path, $ext = '*') {
	$files = [];

	foreach (glob(SERVER_ROOT . $path . '/*', GLOB_ONLYDIR) as $dir) array_push($files, ...scan($dir, $ext));

	return $files;
}

// get the server root
function server_root() {
	return defined('PUBLIC_SERVER_ROOT') ? PUBLIC_SERVER_ROOT : SERVER_ROOT;
}
