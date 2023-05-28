<?php include "template/header.php"; 
//include "../init.php"; 
?>
	<form action="#" method="post" >
		<table style="text-align: left;" cellpadding='5' cellspacing='3' class="input-table">			
			<thead><tr><th colspan="2"><h2>Candidate Registration</h2></th></tr></thead>
			<tr><th>Registration Number </th><td><input type='text' name="reg_no" placeholder="Reg. Number" required></td></tr>
			<tr><th>National ID Number</th>	<td><input type='text' name="id_no" required></td></tr>
			<tr><th>Position Vying</th>	
				<td>
				<select name='position' placeholder='Select position'>
					<?php 
						$select_query = "SELECT positionid, position FROM position";
						$result = mysql_query($select_query)or die ("Could not Query <BR>".mysql_error()); 
						while($row = mysql_fetch_array($result)){
							extract($row);
							echo "<option value='$positionid'>$position</option>"; //Place the positions in combo box
						}
					?>
				</select>
				</td>
			</tr>
			<tfoot><tr><td><input type='submit' value="Submit" class="poll-button"></td>	<td><input type='reset' value="Cancel" class="poll-button"></td></tr></tfoot>
		</table>
	</form>
	<?php //Process Contestant registration
		if(isset($_POST['reg_no'],$_POST['id_no'],$_POST['position'])){
			$reg_no = $_POST['reg_no'];
			$id_no = $_POST['id_no'];
			$position = $_POST['position'];
			$errors = array();
			if(empty($reg_no) || empty($position)){
				$errors[] = "Please Fill in all the required Fields";
			} else{
				//Contestant must exist in the voter Register
				if(voter_exists($reg_no,$id_no)){
					if(!is_valid_voter($reg_no,$id_no)){
						$errors[] = "Invalid Voter! Registration Number and ID Number do not match.";
					}else{
						//Contestant already in contestants Register?
						if (contestant_exists($reg_no,$id_no)){
						$errors[] = "The Contestant is already registered.<br /> You are not allowed to vie for more than one position.";
						}
					}
				} else{
					$errors[] = "The Contestant does not appear in the voters register.<br> Please register as voter first.";
				}					
			}
			
			if(!empty($errors)){
				display_errors($errors);
			}else{
				register_contestant($reg_no,$id_no,$position);
				$pos = getPosition($position);
				$action = "Registered Candidate";
				$action_desc = "Reg. No. $reg_no. Vying for position $pos";
				$id = $_SESSION['admin_id'];
				record_action($id, $action, $action_desc);
				echo "<p>New aspirant has been Registred";
			}			
		}
	?>
<?php include "template/footer.php"; ?>