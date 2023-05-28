G<?php include "template/header.php"; 
//include "init.php";?>
<h2>Polling  Results</h2>
<center>
<table cellpadding='2' width='50%'>
<?php
$colorArray = array(1 => "#00137F", "#005DC9", "#232BFF", "#7F92FF", "#7F92FF", "#7F92FF", "#4294FF", "#164D63", "#0066cc", "#ff0099");
$colorCounter = 1;
//Render votes count
	$pos_query = "SELECT * FROM position_votes";
	$result = mysql_query($pos_query)or die ("Could not Query <BR>".mysql_error());
		while($row = mysql_fetch_array($result)){
			extract($row);
			
			echo "<tr><td colspan='3'><strong>$position</strong></td></tr>";
			
			$votes_query = "SELECT * FROM vote_count WHERE positionID = $positionID ORDER BY votes DESC";	
			
			$results = mysql_query($votes_query)or die ("Could not Query <BR>".mysql_error());
			while($row1 = mysql_fetch_array($results)){
				extract($row1);
				$percent = number_format(($votes/$sum)*100,2);
				echo "<tr ><td>$name</td><td>
				<div id='bars' style='width:$percent%; background:$colorArray[$colorCounter]; float:left; color:white; '><strong>$percent%</strong>
				</div>
				</td>
				<td><div id='votes' style='float:right; text-align:right;'>($votes votes)</div></td>
				</tr>";
				$colorCounter+=1;
			}
			echo "</div>";
		}
?>
</table>
</center>
<script type="text/javascript" src="../js/ui.js"></script>	
<?php include "template/footer.php"; ?>