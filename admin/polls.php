<?php include_once("template/header.php");?>
<link rel="stylesheet" href="../css/jqbar.css" media="screen">
<div class='column'>
	<h5>Select Position to get Poll results</h5>
	<hr>
	<select name="position" id="select-pos" size="10">
	<?php 
		$select_query = "SELECT positionid, position FROM position";
		$result = mysql_query($select_query)or die ("Could not Query <BR>".mysql_error()); 
		while($row = mysql_fetch_array($result)){
			extract($row);
			echo "<option value='$positionid'>$position</option>"; //Place the positions in combo box
		}
			?>
	</select>
</div>
<div id="results" class='column'></div>
<script type="text/javascript" src="../js/jqbar.js"></script>
<script type="text/javascript">
	var pos

	$(function(){
		$('#select-pos').find('option').first().prop('selected', true)
		pos = $('#select-pos').val()
		postResults(pos)

		$("div[id^='bar-']").each(function(){
			alert($(this).find('#value').val())
		});
	});

	$("#select-pos").change(function(){
		pos = $(this).val()
		postResults(pos)
	});

	function postResults(pos){
		$.ajax({
			url: "data/getResults.php",
			type: "post",
			data: {position:pos},
			success: function(data){
				$("#results").html(data)
				setTimeout('checkChanges()', 2000)
			}
		});
	}

	function checkChanges(){
		
	}
</script>
<?php include_once("template/footer.php");?>