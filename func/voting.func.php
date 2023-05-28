<?php
	function hasVoted($voterID){
		$voted_query = "SELECT * FROM vote WHERE voterID = $voterID";
		$result = mysql_query($voted_query);
		if(mysql_num_rows($result)>0){
			return true;
		}else{
			return false;
		}
	}
?>