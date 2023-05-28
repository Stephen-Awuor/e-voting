$(document).ready(function() {
	var p = 1;
	postResults(p);
});

$('#reg_no').keyup(function(){
	//alert("Key Up");
	var p = 1;
	postResults(p);
});

$('#id_no').keyup(function(){
	//alert("Key Up");
	var p = 1;
	postResults(p);
});

$('#voter_name').keyup(function(){
	//alert("Key Up");
	var p = 1;
	postResults(p);
});

$('#resultNav a').click(function(e) {
var page = parseInt($(this).attr('href'));
e.preventDefault();
//alert(page+1);
postResults(page);
});

function postResults(page){
	//alert(page);
	var reg_no = $('#reg_no').val();
	var id_no = $('#id_no').val();
	var voter_name = $('#voter_name').val();	
	$.post('search_voters.php',{reg_no:reg_no, id_no:id_no, voter_name:voter_name, page:page},function(result){
		$('#voter_list').html(result); 
	});
}



