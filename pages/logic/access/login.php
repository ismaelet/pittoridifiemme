<?php

$error = false;

// login
if (isset($_POST['submit'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];
	$url = $_POST['url'] ?? false;

	$error = standard_login($username, $password, $url);
}
