 <?php
	require_once("template/header.php");
	if(isset($_REQUEST['aspirant_id'])){
	$aspirant_id = $_REQUEST['aspirant_id'];
	$action = $_REQUEST['action'];}
	
	if(isset($_POST['update']))
	{
		display_success("Candidate Record Updated successfully");
		print("<p><a href='manage_aspirants.php'>Back to Candidates</p>");
		/*$regNo = $_POST['regNo'];
		//$IDNo = $_POST['IDNo'];
		//$name = $_POST['name'];
		//$sex = $_POST['sex'];
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
			}	*/	
	}	
		
	
if(isset($_REQUEST['action']) && $_REQUEST['action'] =='edit')
  {
				$sql_select = "SELECT C.*, VR.Name, VR.Gender
			FROM contestant C, voter VR
			WHERE VR.IDNo = C.IDNo
			AND C.contestantID = $aspirant_id";
		$ds = mysql_query($sql_select) or die("Could not query ".mysql_error());
        
		while($row=mysql_fetch_array($ds))
		{		
			$reg_no=$row['RegNo'];
			$id_no=$row['IDNo'];
			$name = $row['Name'];
			$pos_id=$row['positionID'];
			$bio=$row['bio'];
			$pic = $row['avatar'];
		}	
		
?>	
<h2>Edit Candidate Info</h2>	
	
		<table style="text-align: left;"  cellpadding='5' cellspacing='3' class="input-table">
		<thead><tr><td>
		<?php 
		if($pic)
			echo "<img src='load_image.php?aspirant_id=$aspirant_id' height='150' width='150'>";	
		else
			echo "No Photo"			
		?>
		<br/>
		<form action="" enctype="multipart/form-data" method="post">
			<input type="file" name="image"/><br/>
			<input type="submit" value="Upload" name="upload"/>
			<input type="hidden" value="<?php echo $aspirant_id;?>" name="aspirant_id"/>
		</form>
		<?php
		if(isset($_POST['upload'])){
			$aspirant_id = $_POST['aspirant_id'];
			$file = $_FILES['image']['tmp_name'];
			if(!isset($file) || empty($file)){
				$errors[] = "Please Select a file.";
				display_errors($errors);
			}else{
				$image = mysql_real_escape_string(file_get_contents($_FILES['image']['tmp_name']));
				$image_size = getimagesize($_FILES['image']['tmp_name']);
				
				if($image_size != FALSE){
					if($insert = mysql_query("UPDATE contestant SET avatar = '$image' WHERE contestantID = $aspirant_id"))
						display_success("Uploaded Succeessfully");
					else{						
						$errors = "Problem uploading image";
						display_errors($errors);
					}					
				}else{	
					$errors[] = "Please Select an image.";
					display_errors($errors);
				}
			}
		}
		?>
		</td>
		<td>
			<p>Name: <strong><?php echo $name;?></strong></p>
			<p>Reg Number: <strong><?php echo $reg_no;?></strong></p>
			<p>ID Number: <strong><?php echo $id_no;?></strong></p>
		</td></tr></thead>
		<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
		<tbody><tr>		
		<th>Position Vying</th>	
				<td>
				<select name='position' placeholder='Select position'>
					<?php 
						$select_query = "SELECT positionid, position FROM position";
						$result = mysql_query($select_query)or die ("Could not Query <BR>".mysql_error()); 
						while($row = mysql_fetch_array($result)){
							extract($row);
							echo "<option value='$positionid'";
							if($positionid == $pos_id){echo "selected"; }
							echo ">$position</option>"; //Place the positions in combo box
						}
					?>
				</select>
				</td>
		</tr>
		<tr><th>Bio</th><td><textarea rows='5' cols='50' maxlength="1000"><?php echo $bio; ?></textarea></td></tr></tbody>
		<tfoot><tr><td><input type='submit' value="Save" name='update'></td>	<td><input type='reset' value="Cancel"></td></tr></tfoot>
		</form>
		</table>
	
<?php
	
}else if(isset($_REQUEST['action']) && $_REQUEST['action'] = 'delete'){
	
	$sql_select = "SELECT * FROM contestant WHERE contestantID = $aspirant_id";
	$ds = mysql_query($sql_select) or die("Could not query ".mysql_error());
        
	while($row=mysql_fetch_array($ds))
	{		
		$reg_no=$row['RegNo'];
		$id_no=$row['IDNo'];
		$pos_id=$row['positionID'];
		$bio=$row['bio'];
		$pic = $row['avatar'];
	}
	mysql_query("UPDATE contestant SET deleted = 1 WHERE contestantID = $aspirant_id")or die("Could not delete<br/>".mysql_error());
	echo "Aprirant Deleted";
	}
	require_once("template/footer.php");
?>
