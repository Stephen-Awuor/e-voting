<?php
function contestant_exists($reg_no,$id_no){
		$reg_no = mysql_real_escape_string($reg_no); 
		$id_no = mysql_real_escape_string($id_no); 
		$exist_query = mysql_query("SELECT COUNT(contestantID) FROM contestant WHERE RegNo = '$reg_no' OR IDNo = $id_no") 
		or die("Could not query ". mysql_error());
		return (mysql_result($exist_query,0)>=1)?true:false;
	}

function register_contestant($reg_no,$id_no,$position){
	$reg_no = mysql_real_escape_string($reg_no); 
	$id_no = mysql_real_escape_string($id_no); 
	$position = mysql_real_escape_string($position); 
	mysql_query("INSERT INTO contestant VALUES ('','$reg_no',$id_no,$position,'','',0)") or die("Could not insert " . mysql_error());
}
	
?>