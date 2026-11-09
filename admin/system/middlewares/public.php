<?php

$wip = false;

if (DB::exists("system WHERE name='public' AND value=0")) $wip = true;

if ($wip && !admin()) redirect('/wip');