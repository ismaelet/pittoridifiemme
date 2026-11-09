<?php

global $sysConfig;

$sysConfig = array(
	'migrate' => true,
	'timezone' => 'Europe/Rome',

	'name' => 'Pittori di Fiemme',
	'name_full' => 'Pittori di Fiemme',
	'desc_it' => '',
	'desc_shr_it' => '',
	'desc_en' => '',
	'desc_shr_en' => '',
	'desc_pt' => '',
	'desc_shr_pt' => '',

	'lang' => 'it',
	'multi_lang' => false,

	'logo' => '/app/resources/logo/logo.jpg',
	'VAT' => '',

	'cont_fb' => '',
	'cont_inst' => '',
	'cont_yt' => '',
	'cont_sp' => '',
	'cont_tw' => '',
	'cont_mail' => 'pittoridifiemme@libero.it',
	'cont_mail_link' => 'mailto:pittoridifiemme@libero.it',
	'cont_tel' => '',
	'cont_whats' => '',
	'cont_tele' => '',
	'cont_pin' => '',
	'cont_pin_link' => '',

	'google_analytics' => true,

	'logged_page' => '/admin',
);

if (in_array($_SERVER['REMOTE_ADDR'], ['127.0.0.1', '::1'])) {
	// local server settings
	$sysConfig['hostname'] = 'localhost';
	$sysConfig['database'] = 'hostinger_pittoridifiemme';
	$sysConfig['username'] = 'root';
	$sysConfig['password'] = '';
} else {
	// live server settings
	$sysConfig['hostname'] = 'localhost';
	$sysConfig['database'] = 'u907921565_pittoridif';
	$sysConfig['username'] = 'u907921565_pittoridif';
	$sysConfig['password'] = '4Nv]O^ut=nx';
}
