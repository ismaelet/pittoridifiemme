<?php

$public = true;

if (DB::exists('system WHERE name=? AND value=0', ['public'])) $public = false;

if (!$public && !admin()) redirect('/offline');