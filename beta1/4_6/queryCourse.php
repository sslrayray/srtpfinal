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

function getAllSelCourse($username){
	//get selective courses of a student
	require('../../mysqli_connect.php');
	$SelCoArr = array();

	$query = "select code from SelCourseDetail where not exists (select * from StuCourse where StuCourse.stuid = '$username' and StuCourse.cocode = SelCourseDetail.code)";
	$r = @mysqli_query($dbc, $query);
	while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)){
		array_push($SelCoArr, $row['code']);
//	echo $row['code'].'<br>';
	}
	mysqli_free_result($r);
	return $SelCoArr;
}

function getIdPassedCo($course){
	require('../../mysqli_connect.php');
	$SelCoArr = array();
	$query = "select stuid from SelCourseDetail join StuCourse where StuCourse.cocode = SelCourseDetail.code and code = '$course'";
	$r = @mysqli_query($dbc, $query);
	while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)){
		array_push($SelCoArr, $row['stuid']);
//	echo $row['code'].'<br>';
	}
	mysqli_free_result($r);
	return $SelCoArr;
}

function getRecomCourse($uid, $topN = 10){
	require('../../mysqli_connect.php');
	$allSelCourse = getAllSelCourse($uid);
	$resultCourse = array();
	foreach ($allSelCourse as $selCourse){
		$selIds = getIdPassedCo($selCourse);
		//print $uid.'<br>';
//		print $selCourse.'<br>';
		$query = "select sum(simi) as sum from StuSimilar where stu1 = '$uid' and ( ";
		foreach ($selIds as $name){
			$query = $query."stu2 = '$name' or ";
		//	print $name.'<br>';
		}
		$query = $query.'0 )';
		$r = @mysqli_query($dbc, $query);
		$ResultSum = array();
		while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)){
			array_push($ResultSum, $row['sum']);
		}
		mysqli_free_result($r);
	 	$resultCourse[$selCourse] = $ResultSum[0];
	//	print $ResultSum[0].'<br>';

	//	break;
	}
	arsort($resultCourse);
	//the result with courseID and similarity
	$resultCourse = array_slice($resultCourse, 0, $topN, true);
	//the result with CourseID
	$resultCourse = array_keys($resultCourse);
	return $resultCourse;
}
?>

