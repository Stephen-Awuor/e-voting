<?php
	require "../init.php";
	$TOTAL_VOTES = 0;
	$total_query = "SELECT SUM(votes) as Total FROM vote_count";
	$result = mysql_query($total_query) or die("Could not query ".mysql_error());
	while($row = mysql_fetch_array($result)){
		extract($row);
		$TOTAL_VOTES = $Total;		
	}
	echo $TOTAL_VOTES;
?>