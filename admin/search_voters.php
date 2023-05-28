<?php
include "../init.php";
	if(isset($_POST['reg_no'])){
	$limit = 20;
	
	if (empty($_POST['page'])){
		$page = 1;
		$start = 0;
	}else{
		$page = $_POST['page'];
		$start = ($page*$limit)-$limit;
	}
	$curr_page = $page;
		
		$reg_no = $_POST['reg_no']; 
		$id_no = $_POST['id_no']; 
		$voter_name = $_POST['voter_name'];
		
		$select_query = "SELECT voterID,regNo, IDNo, Name, Gender 
		FROM voter 
		WHERE regNo LIKE '%$reg_no%'
		AND IDNo LIKE '%$id_no%'
		AND name LIKE '%$voter_name%' ";
		$rowCount = mysql_numrows(mysql_query($select_query ));
		$pages = ceil($rowCount/$limit);
		
		$select_query .= "LIMIT $start,$limit";
		$result = mysql_query($select_query )or die ("Could not Query <BR>".mysql_error());		
		while($row = mysql_fetch_array($result)){
			extract($row);
			echo "<tr><td>$regNo</td><td>$IDNo</td><td>$Name</td><td>$Gender</td>
			<td><a href='edit_voter.php?action=edit&voterid=$voterID'>Edit</a> | <a href='#'>Delete</a></td></tr>";
		}		
		echo "
			<tr>
			<td colspan='5'>
			<div id='resultNav'> Page $curr_page of $pages ($rowCount items)";
			for($i=1;$i<=$pages;$i++){
				if($i==$curr_page){
					echo "&nbsp <strong>".$i."</strong>";
				}else{				
					echo "&nbsp <a href='#' onClick = 'postResults($i);'>".$i."</a>";
				}
			}
		echo "</div></td></tr>";
	}
?>
<script type="text/javascript" src="../js/jquery-1.7.1.min.js" ></script>
<script type="text/javascript" src="../js/jquery.tablesorter.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		//alert("Ready");
		$("#tblVoters").tablesorter();	
	});
</script>