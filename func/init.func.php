<?php 
	function display_errors($errors){
		echo "<div style='
		border: 1px solid #FF3247; 
		min-height: 40px;
		padding: 5px;
		margin: 0 auto;
		width: 80%;
		border-radius: 5px; 
		background:#FFDAD3;'>";
		foreach($errors as $error){
				echo $error . "<BR/>";
		}
		echo "</div>";
	}
	
	function display_success($msg){
		echo "<div class='errors' style='width:80%; border:1px solid #25FF11'; background:#DBFFE6>".$msg."</div>";
	}
	function isRegNo($string){
		$student = false;
		if( preg_match("[-]",$string)){
			$student = true;
		}
		return $student;
	}
	
	function sanitize($field){
		$field = mysql_real_escape_string(htmlentities($field)); 
		return $field;
	}
?>