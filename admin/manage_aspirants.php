<?php include "template/header.php";?>
<h2>Aspiring Candidates</h2>
<table border='1' width='80%' cellpadding='2'style="border-collapse:collapse;" class="fancy_table">
<?php 
$pos_query = "SELECT * FROM position";
	$result = mysql_query($pos_query)or die ("Could not Query <BR>".mysql_error());
		while($row = mysql_fetch_array($result)){
			extract($row);			
			echo "<tr><th colspan='7'><span style='font-weight:bold; font-size:17px; color:white; '><u>$position</u></span></th></tr>";
			
			$asp_query = "SELECT C.contestantID, VR.RegNo, VR.Name, VR.Gender
			FROM contestant C, voter VR
			WHERE VR.IDNo = C.IDNo
			AND positionID = $positionID 
			AND c.deleted = 0";	
			
			$results = mysql_query($asp_query)or die ("Could not Query <BR>".mysql_error());
			while($row1 = mysql_fetch_array($results)){
				extract($row1);
				echo "<tr>
					<td>$RegNo</td>
					<td>$Name</td>
					<td>$Gender</td>
					<td><a href='edit_aspirant.php?action=edit&aspirant_id=$contestantID'>Edit</a></td>";
				if($_SESSION['SU'] > 0) echo "<td><a href='edit_aspirant.php?action=delete&aspirant_id=$contestantID' id='delete_item'>Remove Aspirant</a></td>";
				echo "</tr>";
			}			
		}
?>
</table>
<script type="text/javascript">
$('#delete_item').live('click',function(event){	
	var allow = confirm("Are you sure you want to delete item?")
	if(allow == true){
		var url = $(this).attr('href')
		$('#shadow').fadeIn("normal")
		$('#popup-inner').fadeIn("normal")
		$('#popup-inner').children('#popup_content').load(url)
		//location.reload();
	}
	return false;
});
</script>
<?php include "template/footer.php";?>