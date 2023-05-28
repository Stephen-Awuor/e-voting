<?php 
function admin_is_su(){
	return((int)($_SESSION['SU']) > 0)?true:false;
}
function adminLogin($user, $pass){
	$user = mysql_real_escape_string(htmlentities($user)); 
	//$pass = mysql_real_escape_string(htmlentities($pass));
	$sql = "SELECT COUNT(admin_id),admin_id FROM admin WHERE userName = '$user' AND password = '".md5($pass)."'";
	$login_query = mysql_query($sql) or die("Could not Query<p>".mysql_error());		
	return (mysql_result($login_query,0)==1)?mysql_result($login_query, 0,'admin_id'):false;
}

function admin_loggedIn(){
	return isset($_SESSION['admin_id']);
}

function setAdminSession($admin_id){
	$session_query =  mysql_query("SELECT * FROM admin WHERE admin_id = $admin_id") or die("Could not Query<p>".mysql_error());
	$_SESSION['admin_id'] =  mysql_result($session_query, 0,'admin_id');
	$_SESSION['admin_name'] = mysql_result($session_query, 0,'userName');
	$_SESSION['SU'] = mysql_result($session_query, 0,'superUser');
}

function update_voter($regNo,$IDNo,$name,$sex,$course,$faculty,$voterID){
	$regNo = mysql_real_escape_string($regNo);
	$IDNo = mysql_real_escape_string($IDNo);
	$name = mysql_real_escape_string($name);
	$course = mysql_real_escape_string($course);
	$faculty = mysql_real_escape_string($faculty);
	$sql_update = "UPDATE voter
        SET
		regNo = '$regNo',
		IDNo = $IDNo,
		name = '$name',
		course = '$course',
		Gender = '$sex',
		faculty = '$faculty'
		WHERE voterID = $voterID;";
        mysql_query($sql_update) or die("Could not Update " . mysql_error());
}

function add_admin($surname,$othernames,$email,$username,$pass,$su){
	$surname = sanitize($surname);
	$othernames = sanitize($othernames);
	$email = sanitize($email);
	$username = sanitize($username);
	$sql_insert = "INSERT INTO admin(userName,password,Surname,otherNames,email,superUser) VALUES ('$username','".md5($pass)."','$surname','$othernames','$email',$su)";
	mysql_query($sql_insert) or die("Could not insert<p>".mysql_error());	
}

function record_action($admin_id, $action, $desc){
	try{
		$action = sanitize($action);
		$desc = sanitize($desc);
		//Write to File
		$actionText = "[".date("Y-m-d H:i:s")."]\tUser:$admin_id".$_SESSION['admin_name']."\tAction:".strtoupper($action)."\tDesc:".$desc;
		$fh = fopen("../admin_log.log", "a");
		fputs($fh, $actionText);
		//Write to DB
		$sql_insert = "INSERT INTO audit (admin_id,action,description,action_time) VALUES ($admin_id,'$action','$desc',now())";
		mysql_query($sql_insert) or die("Could not Record action.<p>".mysql_error()."</p>");
	}catch(Exception $e){
		print("Error Occured while recording action".$e->getMessage());
	}
	
}

function getPosition($posID){
	$query = "SELECT position FROM position WHERE positionid = $posID";
	$result = mysql_query($query);
	return (mysql_result($result,0));
}
?>