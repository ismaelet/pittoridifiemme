<?php

include_once(__ROOT__.'/app/templates/php/header.php');
include_once(__ROOT__.'/app/templates/php/footer.php');

$id = isset($_GET['id']) && admin() ? $_GET['id'] : $user->id;
$owner = $id == $user->id;

if (!DB::exists('users WHERE ID=?', $id)) redirect('/login');

$prof = new User($id);

$this->title = $prof->username;