<?php include "template/header.php"; 
//include "init.php";?>
<h2>Polling  Results</h2>
<p>
	POSITION: 
	<input type="hidden" id="new_update"></input>
	<select id='positionID'>		
		<option selected value='1'>Select position</option>
		<?php 
			$select_query = "SELECT positionid, position FROM position";
			$result = mysql_query($select_query)or die ("Could not Query <BR>".mysql_error()); 
			while($row = mysql_fetch_array($result)){
				extract($row);
				echo "<option value='$positionid'>$position</option>"; //Place the positions in combo box
			}
		?>
	</select>
	<hr />
	<script type="text/javascript">
		/*$(document).ready(function() {
		var p = $('#positionID').val();
		postResults(p);
		});*/
		var t1, new_update=0;
		var last_update=0;
		
		$('#positionID').change(function(){	
			var p = $(this).val();
			postResults(p);
		});
		
		function repost(p){	
			setUpdate();
			//alert(last_update+"   "+new_update)
			if(last_update != new_update){
				postResults(p);
				//last_update = new_update;
			}else{
				//alert("No Update")
				clearTimeout(t1);
				t1 = setTimeout("repost("+p+")",5000);
			}			
		}
		
		function setUpdate(){
			//URL of the above page. The time parameter is to prevent caching...
			var url = "request_votes.php?time=" + (new Date()).getTime();			
			//Make a GET request and put the response in the HTML element with id last_update
			jQuery("#new_update").load(url);
			new_update = $("#new_update").text();
			//alert(new_update)
		}
			
		function postResults(pos){	
		setUpdate();
		last_update = new_update;
		$.post('display_results.php',{pos:pos},function(result){
		$('#pollResults').html(result); 
		});
		clearTimeout(t1);
		t1 = setTimeout("repost("+pos+")",5000);		
		}	
	</script>
	<div id="pollResults">
	</div>
	<hr />
<?php include "template/footer.php"; ?>