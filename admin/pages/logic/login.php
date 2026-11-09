<?php

//setup variabiles
$error = false;

//load modules
load_module('login');

//login
if (isset($_POST['submit'])) {

	$username = $_POST['username'];
	$password = $_POST['password'];
	$url = $_POST['url'] ?? false;

	$error = login($username, $password, $url);
}