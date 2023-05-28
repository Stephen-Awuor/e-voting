<?php require "template/header.php";?>
<h2>Offline Voting</h2>
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
		
		
		$select_query = "SELECT voterID,regNo, IDNo, Name, Gender 
		FROM voter WHERE voted = 0 ";
		$rowCount = mysql_num_rows(mysql_query($select_query ));
		$pages = ceil($rowCount/$limit);
		
		$select_query .= "LIMIT $start,$limit";
		$result = mysql_query($select_query )or die ("Could not Query <BR>".mysql_error());
		echo "<table width='95%' cellpadding='5' id='tblList' class='tablesorter'>
			<thead>
			<tr><th>Reg Number</th><th>ID Number</th><th>Name</th><th>Gender</th>
			<th></th></tr>
			</thead>";
		while($row = mysql_fetch_array($result)){
			extract($row);
			echo "<tr><td>$regNo</td><td>$IDNo</td><td>$Name</td><td>$Gender</td>
			<td> <a href='set_voted.php?voter_id=$voterID'>Mark as Voted</a></td></tr>";
		}		
		
		echo "<tfoot>
			<tr>
			<td colspan='5'>
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
<script type="text/javascript" src="../js/jquery-1.7.1.min.js" ></script>
<script type="text/javascript" src="../js/jquery.tablesorter.js"></script>
<script type="text/javascript">
	$(document).ready(function() {		
		$('#tblList').tablesorter();
		//alert("Ready");
	});
</script>
<?php require "template/footer.php";?>
