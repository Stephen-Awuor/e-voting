<?php
	require_once("../init.php");
	$aspirant_id = mysql_real_escape_string($_REQUEST['aspirant_id']);
	//$aspirant_id = 5;
	$image = mysql_query("SELECT * FROM contestant WHERE contestantID = $aspirant_id");
	$image = mysql_fetch_assoc($image);
	$image = $image['avatar'];
	header("Content-type: image/jpeg");
	echo $image;
?>