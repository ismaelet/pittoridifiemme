<?php

global $con;

$header['color'] = 'dark';

$res_sel = mysqli_query($con, "SELECT * FROM artists WHERE ID IN (SELECT artID FROM images) ORDER BY lname ASC, date ASC");
