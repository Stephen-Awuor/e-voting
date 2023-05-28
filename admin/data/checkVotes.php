<?php
	require "../../init.php";
	//$_REQUEST['posId'] = 1;
	if(isset($_REQUEST['posId'])){
		$pos = $_REQUEST['posId'];
		$votes = array();
		$pos_query = "SELECT votes FROM vote_count WHERE positionID = $pos ORDER BY contestantID ASC";
		$result = mysql_query($pos_query)or die ("Could not Query <BR>".mysql_error());
		while($row = mysql_fetch_array($result)){
			$votes[] = $row[0];			
		}
		header("Cache-Control: no-cache, must-revalidate" );
		header("Pragma: no-cache" );
		header("Content-type: text/x-json");
		echo(json_encode($votes));
	}	
	
?>