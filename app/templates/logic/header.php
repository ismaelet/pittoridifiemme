<?php

global $user;

StyleLoader::add('header', 'template');

//elements
$header['color'] = 'light';
$h_comp['logo'] = false;
$h_comp['name-bar'] = false;
$h_comp['srch-bar'] = true;
$h_comp['lang-bar'] = false;
$h_comp['login'] = true;
$h_comp['force-mob'] = false;
$h_comp['privacy'] = true;
$h_comp['wishlist'] = true;

//name
$h_name = 'Shi<span class="txt-c1">pp</span>ing Dog';
$h_name_mob = 'Shi<span class="txt-c1">pp</span>ing Dog';

//links
//Structure: 0.name, 1.location, 2.url, 3.dropdown[false, drop_tag], 4.logged[0(both), 1(yes), 2(no), 3(admin)], 5.only desktop(0,1,2)
$h_link = [];

$h_link[] = array('Pittori', 'painters', client_link('#art'), false, 0, 0);
$h_link[] = array('Storia', 'history', client_link('#hist'), false, 0, 0);
