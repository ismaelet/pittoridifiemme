<?php

function preload() {

	global $view;

	foreach ($view->preload as $file) echo '<link rel="preload" as="image" href="'.$file.'">
	';
}