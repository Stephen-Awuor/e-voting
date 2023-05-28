<?php 
include "../init.php"; 
$voterID = $_GET['voter_id'];
mark_as_voted($voterID);
header("Location: offline_vote.php");
?>