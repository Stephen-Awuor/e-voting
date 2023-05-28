<?php include "template/header.php";?>
<h2>Candidates</h2>
<table border='1' width='95%' cellpadding='2'style="border-collapse:collapse;" class="fancy_table">
<?php 

$pos_query = "SELECT * FROM position";
if(!empty($_GET['positionID'])){
	$posID = $_GET['positionID'];
	$pos_query .= " WHERE positionID = $posID";
}
	$result = mysql_query($pos_query)or die ("Could not Query <BR>".mysql_error());
		while($row = mysql_fetch_array($result)){
			extract($row);			
			echo "<tr><td colspan='7'><span style='font-weight:bold; font-size:17px; color: '><u>$position</u></span></td></tr>";
			
			$asp_query = "SELECT C.contestantID, VR.RegNo, VR.Name, VR.Gender, C.avatar, C.bio
			FROM contestant C, voter VR
			WHERE VR.IDNo = C.IDNo
			AND positionID = $positionID";	
			
			$results = mysql_query($asp_query)or die ("Could not Query <BR>".mysql_error());
			while($row1 = mysql_fetch_array($results)){
				extract($row1);
				//Set images
				if($avatar != NULL){
					//echo "Photo here";
					$imageSrc = "load_image.php?aspirant_id=$contestantID";
				}else{
					if($Gender == "Male"){
						$imageSrc = "../images/userM.png";
					}else{
						$imageSrc = "../images/userF.png";
					}
				}
				echo "<tr>					
					<td><img src='$imageSrc' width='100' height='100' class='poll-lightbox'><br/>$Name</td>
					<td>$bio</td>";
				echo "</tr>";
			}			
		}
?>
</table>
<?php include "template/footer.php";?>