<?php include "template/header.php"; ?>
<?php
	$voterID = $_GET['voterid'];
	$action = $_GET['action'];
	if(isset($_POST['update']))
	{
		$regNo = $_POST['regNo'];
		$IDNo = $_POST['IDNo'];
		$name = $_POST['name'];
		$sex = $_POST['sex'];
		$course=$_POST['course'];
		$faculty=$_POST['faculty'];
		
		$errors = array(); //arrays to hold errors
		
			if(empty($regNo) || empty($IDNo) || empty($name) || empty($sex) || empty($course) || empty($faculty)){
				$errors[] = "Please Fill in all the required Fields";
			}
			
			if(!empty($errors)){
				display_errors($errors);
			}else{
				update_voter($regNo,$IDNo,$name,$sex,$course,$faculty,$voterID);
				echo "Voter record successfully updated";
				//header('Location: index.php');
				exit();
			}		
	}	
		
	
	if($action=='edit')
  {
		$sql_select = "SELECT * FROM voter WHERE voterID = $voterID";
		$ds = mysql_query($sql_select) or die("Could not query ".mysql_error());
        
		while($row=mysql_fetch_array($ds))
		{		
			$reg_no=$row['RegNo'];
			$id_no=$row['IDNo'];
			$name=$row['Name'];
			$gender=$row['Gender'];
			$course=$row['Course'];
			$faculty=$row['Faculty'];
		}	
		
?>	
<h2>Update Voter Details</h2>	
	<form action="#" method="post">
		<table style="text-align: left;"  cellpadding='10' cellspacing='3' class="input-table">
		<tr><th>Reg. Number</th>	<td><input type='text' name="regNo" value="<?php echo $reg_no;?>"></td></tr>
		<tr><th>ID Number</th>	<td><input type='text' name="IDNo" value="<?php echo $id_no;?>"></td></tr>
		<tr><th>Name</th>	<td><input type='text' name="name" value="<?php echo $name;?>"></td></tr>
		<tr><th>Gender</th>	<td><select name="sex">
			<option <?php if ($gender == 'Male') echo "selected"; ?> value="Male">Male</option>
			<option <?php if ($gender == 'Female') echo "selected"; ?> value="Female">Female</option>
		</select></td></tr>
		<tr><th>Course</th>	<td><input type='text' name="course" value="<?php echo $course;?>"></td></tr>
		<tr><th>Faculty</th>	<td><input type='text' name="faculty" value="<?php echo $faculty;?>"></td></tr>
		<tfoot><tr><td><input type='submit' value='Update' name='update'></td><td><input type='reset' value='Cancel' name='reset'></td></tr></tfoot>
		</table>
	</form>
<?php
}
?>

<?php include "template/footer.php"; ?>