<?php
function insertCourse($stu, $CoCodeList){
	foreach($CoCodeList as $h => $v){
		$query = "insert into StuCourse values ('$stu','$v');";

		require('../../mysqli_connect.php');
		$r = @mysqli_query($dbc, $query);
	}
	
}

function selectCourse($stu){
	$query = "select * from StuCourse where stuid = $stu;";
	require('../../mysqli_connect.php');
	$r = @mysqli_query($dbc, $query);
	$courseArr = array();
	while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) 
		array_push($courseArr, $row['cocode']);	
	mysqli_free_result($r);
	return $courseArr;
}
?>

