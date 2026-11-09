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

// Project root
$rootPath = dirname(__DIR__, 2);

// Load Composer dependencies
require_once $rootPath . '/vendor/autoload.php';

// Load environment variables
$dotenv = Dotenv\Dotenv::createImmutable($rootPath);
$dotenv->safeLoad();

// Database configuration
$sysConfig['hostname'] = $_ENV['DB_HOST'] ?? 'localhost';
$sysConfig['database'] = $_ENV['DB_DATABASE'] ?? '';
$sysConfig['username'] = $_ENV['DB_USERNAME'] ?? '';
$sysConfig['password'] = $_ENV['DB_PASSWORD'] ?? '';
