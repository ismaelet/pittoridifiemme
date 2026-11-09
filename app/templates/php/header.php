<?php

$this->add_style('/app/templates/css/header.css');

//elements
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
$i = 0; $h_link = array();

$h_link[$i] = array('Home', 'home', '/', false, 0, 0); $i++;
if (cart_count()) {$h_link[$i] = array('Carrello ('.cart_count().')', 'cart', '/cart', false, 0, 2); $i++;}
$h_link[$i] = array('Login', 'login', '/login', false, 2, 2); $i++;
if ($user->is_seller()) {$h_link[$i] = array('Mio negozio', 'artist', '/artist?id='.$user->id, 'artist', 1, 0); $i++;}
$h_link[$i] = array('Profilo', 'profile', '/profile', false, 1, 2); $i++;
$h_link[$i] = array('Prodotti', 'shop', '/shop', 'shop', 0, 0); $i++;
$h_link[$i] = array('Preferiti', 'wishlist', '/wishlist', false, 1, 2); $i++;
if (!$user->is_seller()) {$h_link[$i] = array('Vendi', 'sell', '/sell', false, 0, 0); $i++;}
//if (!$h_closed) {$h_link[$i] = array('Promozioni', 'disc', '/shop/discount', false, 0, 0); $i++;}
$h_link[$i] = array('Supporto', 'info', '/infos/faq', 'info', 0, 0); $i++;
$h_link[$i] = array('Logout', 'logout', '/logout', false, 1, 2); $i++;
$h_link[$i] = array('Gestione', 'admin', sysDB('ad'), false, 3, 2); $i++;
//$h_link[$i] = array('Contatti', 'contacts', '/infos/contact', false, 0, 0); $i++;

//dropdowns
$h_drop['shop'] = array(
	array('Abbigliamento Donna', '/shop?gender=f'),
	array('Abbigliamento Uomo', '/shop?gender=m'),
	array('Accessori', '/shop?gender=u'),
	array('Ufficiali', '/artist?id=1')
);

/*$h_drop['prof'] = array(
	array('Mio Profilo', '/profile/?page=1'),
	array('Competenze', '/profile/?page=2'),
	array('Saperi', '/profile/?page=3'),
	array('Scegliere', '/profile/?page=4')
);*/

$h_drop['info'] = array(
	array('Contatti', '/contacts'),
	array('Cambio taglia o reso', '/refund'),
	array('Sato ordine', '/order/status'),
	array('Domande frequenti', '/infos/faq')
);

$h_drop['artist'] = array(
	array('Il mio negozio', '/artist?id='.$user->id),
	array('I miei lavori', '/manage/portfolio'),
	array('Carica un lavoro', '/manage/portfolio/add'),
	array('Vendite realizzate', '/manage/sales/list'),
	array('Modifica prezzi', '/manage/sales/prices'),
	array('Gestisci', '/manage'),
);

//login bar
$h_log_out = array('Login', '/login');
//$h_log_in = array('Logout', '/logout');
if ($user->id) $h_log_in = array($user->username, '/profile');