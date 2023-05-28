<?php 
require "template/header.php";
$su = $_SESSION['SU'];
if($su == 0){
	header("Location: index.php");
	exit();
}else{?>
<h2>Administrator Regisration</h2>
<form action="#" method='post'>
	<table cellpadding='5' class="input-table">
	<tr><td>Surname</td><td><input type='text' name='surname' required></td></tr>
	<tr><td>Other Names</td><td><input type='text' name='o_names' required></td></tr>
	<tr><td>Email</td><td><input type='email' name='email' required></td></tr>
	<tr><td>username</td><td><input type='text' name='username' required></td></tr>
	<tr><td>Password</td><td><input type='text' name='pass' required></td></tr>
	<tr><td>Super User</td><td>
		<select name='su'>
			<option selected value='0'>No</option>
			<option  value='1'>Yes</option>
		</select>
	</td></tr>
	<tr><td><input type='submit' name='submit' value='Add' class='poll-button'></td><td><input type='reset' name='reset' value='Cancel' class='poll-button'></td></tr>
	</table>
</form>
<?php
	if(isset($_POST['submit'])){
		$surname = $_POST['surname'];
		$othernames = $_POST['o_names'];
		$email = $_POST['email'];
		$username = $_POST['username'];
		$pass = $_POST['pass'];
		$su = $_POST['su'];
				
		$errors = array();
			if(empty($surname) || empty($othernames)|| empty($email) || empty($username)|| empty($pass)){
				$errors[] = "Please Fill in all the required Fields";
			} 
			
			if(!empty($errors)){
				display_errors($errors);
			}else{
				add_admin($surname,$othernames,$email,$username,$pass,$su);
				$action = "Added New Administrator";
				$is_su = ($su == 1) ? "SuperAdmin" : "Normal Admin";
				$action_desc = " $surname $othernames added as $is_su";
				$id = $_SESSION['admin_id'];
				record_action($id, $action, $action_desc);
				echo "Administrator <strong>$username</strong> successfully added. ";
				exit();
			}			
	}
?>
<?php require "template/footer.php";}?>