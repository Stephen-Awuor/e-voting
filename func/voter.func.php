<?php
function voter_loggedIn(){
	return isset($_SESSION['voter_id']);
}

function setSession($voter_id){
	$session_query =  mysql_query("SELECT * FROM voter WHERE voterID = $voter_id") or die("Could not Query".mysql_error());
	$_SESSION['voter_id'] = $voter_id;
	$_SESSION['reg_no'] =  mysql_result($session_query, 0,'RegNo');
	$_SESSION['id_no'] = mysql_result($session_query, 0,'IDNo');
	$_SESSION['voter_name'] = mysql_result($session_query, 0,'Name');
}

function is_valid_voter($regNo,$IDNo){
		$regNo = mysql_real_escape_string(htmlentities($regNo)); 
		$IDNo = mysql_real_escape_string($IDNo); 
		$exist_query = mysql_query("SELECT COUNT(voterID) FROM voter WHERE RegNo = '$regNo' AND IDNo = $IDNo");		
		return (mysql_result($exist_query,0)==1)?true:false;
}
function voter_exists($regNo,$IDNo){
		$regNo = mysql_real_escape_string($regNo); 
		$IDNo = mysql_real_escape_string($IDNo); 
		$exist_query = mysql_query("SELECT COUNT(voterID) FROM voter WHERE RegNo = '$regNo' OR IDNo = $IDNo");
		return (mysql_result($exist_query,0)>=1)?true:false;
	}

function register_voter($regNo,$IDNo,$name,$sex,$course,$faculty,$email){
		$regNo = mysql_real_escape_string($regNo);
		$IDNo = mysql_real_escape_string($IDNo);
		$name = mysql_real_escape_string($name);
		$course = mysql_real_escape_string($course);
		$faculty = mysql_real_escape_string($faculty);		
		mysql_query("INSERT INTO voter VALUES ('','$regNo',$IDNo,'$name','$sex','$course','$faculty','$email','')") or die("Could not register " . mysql_error());
}

function voterLogin($regNo, $IDNo){
		$regNo = mysql_real_escape_string(htmlentities($regNo)); 
		$IDNo = mysql_real_escape_string(htmlentities($IDNo));
		$login_query = mysql_query("SELECT COUNT(voterID),voterID FROM voter WHERE RegNo = '$regNo' AND IDNo = $IDNo") or die("Could not query".mysql_error());		
		return (mysql_result($login_query,0)==1)?mysql_result($login_query, 0,'voterID'):false;
	}

function mark_as_voted($voterID){
	mysql_query("UPDATE voter SET voted = 1 WHERE voterID = $voterID") or die("Could not query<p>".mysql_error());
}
?>