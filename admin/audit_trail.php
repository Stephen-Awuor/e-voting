<?php require "template/header.php";?>
<h2>Audit Trail</h2>
<?php
//include "../init.php";
	$limit = 15;	
	if (empty($_GET['page'])){
		$page = 1;
		$start = 0;
	}else{
		$page = $_GET['page'];
		$start = ($page*$limit)-$limit;
	}
	$curr_page = $page;
		
		
		$select_query = "SELECT AD.Surname, AD.otherNames, AU.action, AU.description, AU.action_time FROM audit AU, admin AD WHERE AD.admin_id = AU.admin_id";
		$rowCount = mysql_num_rows(mysql_query($select_query ));
		$pages = ceil($rowCount/$limit);
		
		$select_query .= " LIMIT $start,$limit";
		$result = mysql_query($select_query )or die ("Could not Query <BR>".mysql_error().$select_query);
		echo "<table width='95%' cellpadding='5' id='tblList' class='fancy_table'>
		<thead><tr><th>Date/Time</th><th>Admin</th><th>Action</th><th>Action Description</th></tr></thead>";
		
		while($row = mysql_fetch_array($result)){
			extract($row);
			echo "<tr><td>$action_time</td><td>$Surname $otherNames</td><td>$action</td><td>$description</td></tr>";
		}		
		
		echo "<tfoot>
			<tr>
			<td colspan='4'>
			<div id='resultNav'> Page $curr_page of $pages ($rowCount items)";
			for($i=1;$i<=$pages;$i++){
				if($i==$curr_page){
					echo "&nbsp <strong>".$i."</strong>";
				}else{				
					echo "&nbsp <a href='offline_vote.php?page=$i'>".$i."</a>";
				}
			}
		echo "</div></td></tr></tfoot></table>";
	
?>
<?php require "template/footer.php";?>