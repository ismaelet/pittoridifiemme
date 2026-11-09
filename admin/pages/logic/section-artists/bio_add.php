<?php

//page data
$tbl = 'artists';
$index = 'ID';
$title = 'lname';
$error = 'false';

$exists = file_exists(__DROOT__.'/uploads/documents/'.$id.'.pdf');
$bio = DB::find('bio FROM artists WHERE ID=?', $id);

//submit
if (isset($_POST['edit_url'])) {

	//get inputs data
	$url = strtolower(trim($_POST['url']));

	if (empty($url) || substr($url, 0, 4) == 'http') {
	
		DB::update('artists SET bio=? WHERE ID=?', [$url, $id]);

		if (file_exists($file = __DROOT__.'/uploads/documents/'.$id.'.pdf')) unlink($file);

		redirect($return);

	} else $error = 'not_url';
}

if (isset($_POST['upload_pdf'])) {

	if (mime_content_type($_FILES['file']['tmp_name']) == 'application/pdf') {
	
		upload_file('/uploads/documents/'.$id.'.pdf');
		
		DB::update('artists SET bio="" WHERE ID=?', [$id]);

		redirect($return);

	} else $error = 'wrong_type';

}