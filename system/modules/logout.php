<?php

function logout() {

	global $user;

	setcookie('user_id', null, -1, "/");
	setcookie('user_key', null, -1, "/");
	unset($_COOKIE['user_id']);
	unset($_COOKIE['user_key']);

	session_destroy();
	
	redirect('/');
}