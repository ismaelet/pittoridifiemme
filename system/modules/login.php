<?php

function login($username, $password, $url = false) {

	global $user;

	//create session
	$row = DB::row('ID, security FROM users WHERE (username=? || email=?) AND password=MD5(?)', [$username, $username, $password]);

	$id = $row['ID'];
	$key = empty($row['security']) ? random_string(32) : $row['security'];

	if ($id) {

		//set redirect location
		if (!$url) $url = sysVar('logged_page');

		//update cart
		if (isset($_SESSION['guestID'])) {

			$user->buyerID = $_SESSION['guestID'];
			$res_cart = DB::select('ID FROM carts WHERE buyer=? AND status=0', [$user->buyerID]);
			$res_cart_old = DB::select('ID FROM carts WHERE buyer=? AND status=0', [$id]);

			if ($res_cart->num_rows) {

				$row_cart = $res_cart->fetch_assoc();
				$cartID = $row_cart['ID'];

				//transfer old orders in new cart
				if ($res_cart_old->num_rows) {

					$row_cart_old = $res_cart_old->fetch_assoc();
					$cartID_old = $row_cart_old['ID'];

					DB::update('orders SET cartID=? WHERE cartID=?', [$cartID, $cartID_old]);
					DB::delete('carts WHERE ID=?', [$cartID_old]);
				}

				//update new cart
				DB::update('carts SET buyer=? WHERE ID=?', [$id, $cartID]);
				DB::update('orders SET buyer=? WHERE cartID=?', [$id, $cartID]);
			}

			unset($_SESSION['guestID']);
		}

		//login
		$_SESSION['userID'] = $id;

		setcookie('user_id', $id, time() + 60*60*24*30);
		setcookie('user_key', $key, time() + 60*60*24*30);

		DB::update('users SET security=? WHERE ID=?', [$key, $id]);

		redirect($url);

	} else {

		sleep(1);

		return 'error_wrong';
	}
}