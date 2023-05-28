<?php
include "template/header.php";
//Processing the vote
$voterID = $_SESSION['voter_id']; //for testing session variables will be used - DONE
//TODO:Check if voter has voted - DONE
$errors = array();
if(hasVoted($voterID)){
	$errors[] = "You have already voted. You are not allowed to vote twice
	<p>Voter's Name: <b>".$_SESSION['voter_name']."</b>";
}

if(!empty($errors)){
		echo "<p><p><p>
		<h2>Error!</h2>";
		display_errors($errors);
}else{
	//Record votes
	foreach ($_POST as $field => $value)
	{
		mysql_query("INSERT INTO vote VALUES ('',$voterID,$field,$value)")or die("Could not query".mysql_error());
		//echo "$field: $value<br>";
	}
	mark_as_voted($voterID);
	echo "<p><p><p>
		<h2>Thank you for Voting!</h2>
		Congratulations, <b>".$_SESSION['voter_name']."</b>, you have successfully voted.		
		";
			
}
include "template/footer.php";		
?>