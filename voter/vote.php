<?php include "template/header.php"; 
//include "init.php";?>
<h3>Voting</h3>
<form action='vote_processor.php' method='post' id="voting-form">
<?php
//Render the form for vote
	$pos_query = "SELECT * FROM position";
	$result = mysql_query($pos_query)or die ("Could not Query <BR>".mysql_error());
		while($row = mysql_fetch_array($result)){
			extract($row);
			
			echo "<div class='position' id='position$positionID'>
				  <strong>$position</strong><br/>";
			
			$asp_query = "SELECT C.contestantID, V.name, V.gender, C.avatar FROM voter V, position P, contestant C 
			WHERE V.IDNo = C.IDNo AND C.positionID = P.positionID AND P.positionID=$positionID";			
			$result1 = mysql_query($asp_query)or die ("Could not Query <BR>".mysql_error());
			while($row1 = mysql_fetch_array($result1)){
				extract($row1);
				if($avatar != NULL){
					//echo "Photo here";
					$imageSrc = "load_image.php?aspirant_id=$contestantID";
				}else{
					if($gender == "Male"){
						$imageSrc = "../images/userM.png";
					}else{
						$imageSrc = "../images/userF.png";
					}
				}
				echo "<label >
							<div class='aspirant' id='$contestantID'>
							<img src='$imageSrc' height='75' width='75'><br/>	
							<input type='radio' value='$contestantID' name='$positionID'><br/>$name
							</div>
					</label>";
			}
			echo "</div><div class='clearFloat'></div>";
		}
?>
<input type='reset' value='Cancel' class='poll-button'>
<input type='submit' value='Vote' class='poll-button'>
</form>
<script type="text/javascript">	
$('#voting-form').submit(function(){
    var all_answered = true;
	$("input:radio").each(function(){
	  	var name = $(this).attr("name");
	  	if($("input:radio[name="+name+"]:checked").length == 0){all_answered = false;}
	});
	if(!all_answered){
		alert("Please select candidate for each position before submitting your vote!")
		return false
	}else{
		var conf = confirm("Are you sure you want to vote in the selected Candidates?")
		if(!conf){
			return false
		}
	}

});
$('input:radio').change(function() {
   $('input[name="' + this.name + '"]').parent().removeClass('tick').find(':checked').parent().addClass('tick');
});

</script>
<?php include "template/footer.php"; ?>
