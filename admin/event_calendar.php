<?php require_once("template/header.php");?>
<form action="<?php $_SERVER['PHP_SELF'];?>" method="post" id="eventform">
<table class="input-table">
<h2>New Event</h2>
<tr><td>Event Date</td><td><input type="text" name="evDate" id="dtp_evDate" required></td></tr>
<tr><td>Event Type</td><td><input type="text" name="evType" required></td></tr>
<tr><td>Event Title</td><td><input type="text" name="evTitle" required></td></tr>
<tr><td>Event Description</td><td><textarea name="evDesc" required></textarea></td></tr>
<tr><td><input type="submit" name="submit" value="Submit"></td><td><input type="reset" value="Cancel"></td></tr>
</table>
</form>
<script type="text/javascript" src="../js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="../js/jquery-ui-1.8.13.custom.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('#dtp_evDate').datepicker({dateFormat:'yy-mm-dd', minDate:'date()'}).val();
});

$('#eventform').submit(function(){
	var ts = new Date($("#dtp_evDate").val()).getTime()
	$("#dtp_evDate").val(new Date(ts*1000)); 
	alert($("#dtp_evDate").val())
});
</script>
<?php
if(isset($_POST['submit'])){
foreach($_POST as $key=>$val)
	{
		$_POST['$key']=sanitize($_POST['$val']);
	}		
	extract($_POST);
	//insert into database
	$insertdt="INSERT INTO event VALUES('','$evDate','$evType','$evTitle','$evDesc')";
	$result=mysql_query($insertdt)or die(mysql_error()."<p>".$insertdt);
	if($result)
	{
		echo "Successfully added new event";
	}
	
}
?>
<?php require_once("template/footer.php");?>