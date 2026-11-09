<?php

global $user;

// fetch current section
$current_section = false;

if (strpos(View::$name, '-')) {
	$current_path = explode('/', explode('section-', View::$name)[1], 2);
	$current_section = DB::row('* FROM admin_sections WHERE category=? AND slug=?', [$current_path[0], $current_path[1]]);
}

// fetch categories
$menu['categories'] = [];
$queryLevel = manager() ? '' : 'manager=0';

$res = DB::select('* FROM admin_categories ' . ($queryLevel ? 'WHERE ' . $queryLevel : '') . ' ORDER BY manager ASC, sort ASC, name ASC');

while ($row = $res->fetch_assoc()) {
	$category = [];
	$category['name'] = $row['name'];
	$category['slug'] = $row['slug'];
	$category['checked'] = $current_section && $category['slug'] == $current_section['category'];

	$res_sections = DB::select('* FROM admin_sections WHERE category=? AND hidden=0 ' . ($queryLevel ? 'AND ' . $queryLevel : '') . ' ORDER BY sort ASC, name ASC', [$category['slug']]);

	if ($res_sections->num_rows) {
		$category['count'] = $res_sections->num_rows;

		while ($row_section = $res_sections->fetch_assoc()) {
			$section = [];
			$section['name'] = $row_section['name'];
			$section['checked'] = $current_section && $category['checked'] && ($row_section['slug'] == $current_section['slug'] || ($row_section['hidden'] && str_replace('add', 'list',  $current_section['slug'])));
			$section['url'] = empty($row_section['url']) ? client_link($row_section['category'] . '/' . $row_section['slug']) : $row_section['url'];
			$category['sections'][] = $section;
		}

		$menu['categories'][] = $category;
	}
}

$navigationLogo = file_exists(SERVER_ROOT . $file = LOGO_DIR . 'logo.svg') ? $file : LOGO_DIR . 'logo.png';
