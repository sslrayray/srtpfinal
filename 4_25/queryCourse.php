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

function getAllCourse($codeArr){

	$CoAttrArr = array();
	foreach($codeArr as $h => $v){
	require('../../mysqli_connect.php');

		$query = 'select * from CourseInfo where kcdm = \''.$v.'\';';
		$r = @mysqli_query($dbc, $query);
		//if (!$r){
	//		echo mysqli_error($dbc).'<br>';
//		}
		require_once('CourseManager.php');
		$t = new CourseManager();
		while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)){
			$t->name = $row['kcmc'];
			$t->push_unit($row['sksj'], $row['jsxm']);
		}
		array_push($CoAttrArr, $t);
		mysqli_free_result($r);
	}
	return $CoAttrArr;
}

function getSelCourse($username){
	//get selective courses of a student
	require('../../mysqli_connect.php');
	$SelCoArr = array();
	$query = "select code from SelCourseDetail join StuCourse where StuCourse.cocode = SelCourseDetail.code and stuid = '$username'";
	$r = @mysqli_query($dbc, $query);
	while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)){
		array_push($SelCoArr, $row['code']);
		echo $row['code'].'<br>';
	}
	mysqli_free_result($r);
	return $SelCoArr;
}
?>

