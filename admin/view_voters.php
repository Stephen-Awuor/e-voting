<?php include "./template/header.php"; 
//include "./init.php";?>
<h2>Voters Register</h2>
<!--<input type='text' id='reg_no' />
<DIV id='voter_list'></DIV>-->
<center>
<table width='90%' id='tblVoters' border='-5' class="tablesorter">
	<thead>
		<tr><th>Registration Number</th><th>National ID Number</th><th>Name</th><th rowspan='2'>Gender</th><th rowspan='2'>Action</th></tr>
		<tr><td><input type='text' id='reg_no' name='reg_no' size='16' placeholder="Search by Reg No"/></td>
		<td><input type='text' id='id_no' name='id_no' size='12' placeholder="Search by ID No"/></td>
		<td><input type='text' id='voter_name' name='voter_name' placeholder="Search by Name"/></td></tr>
	</thead>
	<tbody id='voter_list'>	
	</tbody>	
</table>
</center>
<script type="text/javascript" src="../js/jquery-1.7.1.min.js" ></script>
<script type="text/javascript" src="../js/search_voters.js"></script>
<?php include "./template/footer.php"; ?>