<?php include "template/header.php"; 
//include "../init.php";
?>
<!--Start of html Page-->
<h2>Voter Registration</h2>	
	<form action="#" method="post">
		<table style="text-align: left;"  cellpadding='5' cellspacing='3' class='input-table'>
		<tr><th>Reg. Number</th>	<td><input type='text' name="regNo"></td></tr>
		<tr><th>ID Number</th>	<td><input type='text' name="IDNo"></td></tr>
		<tr><th>Name</th>	<td><input type='text' name="name"></td></tr>
		<tr><th>Gender</th>	<td><select name="sex"><option>Male</option><option>Female</option></select></td></tr>
		<tr><th>Course</th>	<td><input type='text' name="course"></td></tr>
		<tr><th>Faculty</th>	<td><input type='text' name="faculty"></td></tr>
		<tr><th>Email</th>	<td><input type='email' name="email"></td></tr>
		<tr><td><input type='submit' value="Submit"></td>	<td><input type='reset' value="Cancel"></td></tr>
		</table>
	</form>
	<?php
	if(isset($_POST['regNo'],$_POST['IDNo'],$_POST['name'],$_POST['sex'],$_POST['course'],$_POST['faculty'])){
		$regNo = $_POST['regNo'];
		$IDNo = $_POST['IDNo'];
		$name = $_POST['name'];
		$sex = $_POST['sex'];
		$course=$_POST['course'];
		$faculty=$_POST['faculty'];
		$email = $_POST['email'];
		
		//validation on server
		$errors = array(); //arrays to hold errors
		
			if(empty($regNo) || empty($IDNo) || empty($name) || empty($sex) || empty($course) || empty($faculty)){
				$errors[] = "Please Fill in all the required Fields";
			}else{		
				if (voter_exists($regNo,$IDNo)){
					$errors[] = "The voter with Registration number <B>'$regNo'</B> is already registered.";
				}
			}
			
			if(!empty($errors)){
				display_errors($errors);
			}else{
				register_voter($regNo,$IDNo,$name,$sex,$course,$faculty,$email);
				$action = "Registered Voter";
				$action_desc = "Voter Reg No - $regNo";
				$id = $_SESSION['admin_id'];
				record_action($id, $action, $action_desc);
				echo "Voter <b>$name</b> successfully registered";
				//header('Location: index.php');
				exit();
			}		
		}	
?>
<?php include "template/footer.php"; ?>