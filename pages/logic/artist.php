<?php

global $con;

$loc = 'artist';

$ID = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$imgID = isset($_GET['imgID']) ? (int) $_GET['imgID'] : 0;

//get artist
$res_art = mysqli_query($con, "SELECT * FROM artists WHERE ID=$ID");
if (!mysqli_num_rows($res_art)) {
	header('Location: /');
	exit();
}
$row_art = mysqli_fetch_assoc($res_art);

//title
$name_full = $name = $row_art['lname'] . ' ' . $row_art['fname'];
$name_full .= (empty($row_art['fname2']) || empty($row_art['lname2'])) ? '' : ' - ' . $row_art['lname2'] . ' ' . $row_art['fname2'];
$date = empty($row_art['date']) ? '' : ' ' . $row_art['date'];
$place = $row_art['place'];
$data = (empty($date) && empty($place)) ? '' : $row_art['place'] . $date;

View::setTitle($name_full);

//get image
$res_img = mysqli_query($con, "SELECT * FROM images WHERE ID=$imgID");
if (!mysqli_num_rows($res_img)) $res_img = mysqli_query($con, "SELECT * FROM images WHERE artID=$ID ORDER BY main DESC, ID ASC LIMIT 1");
$row_img = mysqli_fetch_assoc($res_img);
$imgID = (int) $row_img['ID'];

//get position
$i = 1;
$imgM = array();
$res_imgM = mysqli_query($con, "SELECT ID FROM images WHERE artID=$ID ORDER BY main DESC, ID ASC");

while ($row_imgM = mysqli_fetch_assoc($res_imgM)) {
	$imgM[$i] = $row_imgM['ID'];
	$i++;
}

$imgN = sizeof($imgM);
$pos = array_search($imgID, $imgM);
$pre = $pos > 1 ? $imgM[$pos - 1] : $imgM[$imgN];
$nex = $pos < $imgN ? $imgM[$pos + 1] : $imgM[1];

//get more images
$res_imgM = mysqli_query($con, "SELECT ID FROM images WHERE artID=$ID ORDER BY main DESC, ID ASC");
