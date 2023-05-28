<div id='canvas'>
<?php
require "../init.php";
$colorArray = array(1 =>  "#005DC9", "#232BFF", "#7F92FF", "#00137F","#7F92FF", "#7F92FF", "#4294FF", "#164D63", "#0066cc", "#ff0099");
$colorCounter = 1;
//Render votes count
	/*$last_update = (isset($_POST['last_update']))?$_POST['last_update']:0;
	$total_query = "SELECT SUM(sum) as Total FROM vote_count";
	$TOTAL_VOTES = (mysql_result($total_query,0)==1)?mysql_result($total_query, 0,'Total'):0;
	if($last_update == $TOTAL_VOTES){		
	}*/	
			$pos = $_POST['pos'];			
			//Get total votes for the pos
			$pos_query = "SELECT * FROM position_votes WHERE positionID = $pos";
			$result = mysql_query($pos_query)or die ("Could not Query <BR>".mysql_error());
			
			while($row = mysql_fetch_array($result)){			
				extract($row);			
				echo "<h3>Position: $position</h3>";
				$votes_query = "SELECT * FROM vote_count WHERE positionID = $pos ORDER BY contestantID DESC";	
				$results = mysql_query($votes_query)or die ("Could not Query <BR>".mysql_error());
				if(mysql_num_rows($results) == 0){
					echo "NO RESULTS TO DISPLAY";
				}else{
					echo "<ul id='chart' title='$sum'>";
					while($row1 = mysql_fetch_array($results)){
						extract($row1);
						$percent = number_format(($votes/$sum)*100,2);				
						echo "
						<li title='$percent'>					
							<span class='bar' style='background:$colorArray[$colorCounter];'></span>
							<span class='asp'>$name</span>
							<span class='percent' title='$votes'></span>
						</li>";				
						$colorCounter+=1;
					}
					echo "</ul>";
				}				
			}	
?>
<script type="text/javascript" src="../js/ui.js"></script>
</div>	