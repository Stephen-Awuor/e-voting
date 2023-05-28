<?php 
	//echo "Nothing";
	require "init.php";
	if(isset($_POST['user'])){
		
		$user = $_POST['user'];
		$pass = $_POST['pass'];
				
		$errors = array();
		
		if(empty($user)||empty($pass)){
			$errors[] = "Please fill in all the required fields";
		}else{
			if(isRegNo($user)){
				$isAdmin = false;
				$loginAttempt = voterLogin($user, $pass);
			}else{
				$isAdmin = true;
				$loginAttempt = adminLogin($user, $pass);
			}			
			if($loginAttempt == false){
				$errors[] = "Login failed. Please enter correct Reg No and ID Number";
			}
		}
		
		if(!empty($errors)){
			foreach($errors as $error){
				echo $error . "<br/>";
			}		
		}else{
		if(!$isAdmin){
			setSession($loginAttempt);
			header('Location: voter/index.php');
			exit();
			}else{
				setAdminSession($loginAttempt);
				header('Location: admin/index.php');
				exit();
			}
		}
	}
?>