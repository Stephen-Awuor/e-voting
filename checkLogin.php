<?php 
	session_start();
	if(isset($_SESSION['user_name'])){
		$response = "T";
	}else{
		$response = "F";
	}
	echo json_encode($response)
?>