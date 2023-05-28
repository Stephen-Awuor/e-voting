<?php require "template/header.php";?>
<center>
<h2>Login</h2>
<p>
<div id='login_div'>
<form action='' method='post'>	
		<table cellpadding='5' class="input-table">
		<tr><td><label for='user'>Reg No. / User Name: </label></td><td><input type='text' name='user' placeholder="User Name"></td></tr>
		<tr><td><label for='pass'>ID No / Password: </label></td><td><input type='password' name='pass' placeholder="Password"></td></tr>
		<tr><td><input type='submit' name='submit' value='Login' class='poll-button'></td><td>
		<input type='reset' value='Cancel' class='poll-button'></td></tr>
		</table>	
</form>
</div>
<?php 
	//require "init.php";
	if(isset($_POST['submit'])){
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
				$errors[] = "Login failed!<br/> Please enter correct Reg No and ID Number.";
			}
		}
		
		if(!empty($errors)){
			display_errors($errors);	
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
</center>
<?php include "template/footer.php";?>
