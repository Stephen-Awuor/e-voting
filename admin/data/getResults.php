<?php	
	require "../../init.php";
	//$_REQUEST['position'] = 1;
	if(isset($_REQUEST['position'])){
		$pos = $_REQUEST['position'];
		$colorArray = array(1 =>  '#D64747', '#FF681F', '#ea805c', '#88bbc8', '#939393', '#3a89c9');			
		$counter = 1;
		$pos_query = "SELECT * FROM position_votes WHERE positionID = $pos";
		$result = mysql_query($pos_query)or die ("Could not Query <BR>".mysql_error());
			
		while($row = mysql_fetch_array($result)){			
			extract($row);			
			echo "<h3>Position: $position</h3>";
			$votes_query = "SELECT * FROM vote_count WHERE positionID = $pos ORDER BY votes ASC";	
			$results = mysql_query($votes_query)or die ("Could not Query <BR>".mysql_error());
			if(mysql_num_rows($results) == 0){
				echo "NO RESULTS TO DISPLAY";
			}else{
				print("<div class='columns'><div class='bars'>");
				while($row1 = mysql_fetch_array($results)){
					extract($row1);
					$percent = number_format((($votes/$sum)*100),2);			
						print("<div id='bar-".$contestantID."'>
								<input type='hidden' id='label' value='$name'>
								<input type='hidden' id='value' value='$percent'>
								<input type='hidden' id='barColor' value='".$colorArray[$counter]."'>
							</div>");
						$counter+=1;
					}					
				}	
				echo "</div></div>";			
			}
	}
?>
<script type="text/javascript" src="../js/jpollbars.js"></script>