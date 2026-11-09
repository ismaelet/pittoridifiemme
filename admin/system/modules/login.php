<?php

function login($username, $password, $url = false) {

	global $user, $is_root;
	
	//create session
	$row = DB::row('ID, security FROM users WHERE (username=? || email=?) AND password=MD5(?)', [$username, $username, $password]);

	$id = $row['ID'];

	if ($id) {

		//set redirect location
		if (!$url) $url = sysVar('logged_page');

		//login
		$_SESSION['userID'] = $id;

		if ($is_root) {
			$key = empty($row['security']) ? random_string(32) : $row['security'];
			
			setcookie('user_id', $id, time() + 60*60*24*30);
			setcookie('user_key', $key, time() + 60*60*24*30);

			DB::update('users SET security=? WHERE ID=?', [$key, $id]);
		}

		redirect($url);

	} else {

		sleep(1);

		return 'error_wrong';
	}
}