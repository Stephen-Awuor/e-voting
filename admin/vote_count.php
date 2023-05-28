<?php include "template/header.php"; 
include "../init.php"?>
<?php
//Render votes count
	$pos_query = "SELECT * FROM position_votes";
	$result = mysql_query($pos_query)or die ("Could not Query <BR>".mysql_error());
		while($row = mysql_fetch_array($result)){
			extract($row);
			
			echo "<div class='position' style='clear:both'>
			<strong>$position</strong><br/>";
			
			$votes_query = "SELECT * FROM vote_count WHERE positionID = $positionID ORDER BY votes DESC";	
			
			$results = mysql_query($votes_query)or die ("Could not Query <BR>".mysql_error());
			while($row1 = mysql_fetch_array($results)){
				extract($row1);
				$percent = number_format(($votes/$sum)*100,2);
				echo "<a href=''>
						<div class='aspirant'>
						<img src='./images/aspirant.png' height='85' width='85'><br/>	
						$name<br/>
						<strong>$votes</strong>  Votes of $sum<br>($percent%)<br/>
						
						</div>
						</a>
					";
			}
			echo "</div>";
		}
?>
<?php include "template/footer.php"; ?>