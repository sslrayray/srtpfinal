<?php
function insertCourse($stu, $CoCodeList){
	foreach($CoCodeList as $h => $v){
		$query = "insert into StuCourse values ('$stu','$v');";

		require('../../mysqli_connect.php');
		$r = @mysqli_query($dbc, $query);
	}
	
}
?>

