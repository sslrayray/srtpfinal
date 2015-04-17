<?php
include 'jwbManager.php';
echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
$jwb = new jwbManager();
//get the Required Course from database


//Get Course you had passed
// didn't set user passwd

$u = '3120000408'; 
$p = 'RAYray17';
$jwb->init($u, $p);
$jwb->getCources();
$CCodeArr = $jwb->getCourseCode();
$grade = -intval(substr($u, 0, 3)) + 315;
if ($grade < 1 or $grade > 4){
	throw new Exception('The grade shoud between 1 and 4');
}

echo '<h4>Your grade is '.$grade.'</h4>';
switch ($grade){
	case 1:
		$query = 'select * from CourseDetail where xn = \'一\'';
		break;
	case 2:
		$query = 'select * from CourseDetail where xn = \'二\' or xn = \'一\'';
		break;
	case 3:
		$query = 'select * from CourseDetail where xn = \'三\' or xn = \'二\' or xn = \'一\'';
		break;
	case 4:
		$query = 'select * from CourseDetail where xn = \'四\' or xn = \'三\' or xn = \'二\' or xn = \'一\'';
		break;		
}

require('../../mysqli_connect.php');

$r = @mysqli_query($dbc, $query);
$kcdmarr = array();
$kcmcarr = array();
$lbarr = array();
$xfarr = array();
while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)){
	$kcdm = $row['kcdm'];
	$kcmc = $row['kcmc'];
	$lb = $row['lb'];
	$xf = $row['xf'];
	array_push($kcdmarr, $kcdm);
	array_push($kcmcarr, $kcmc);
	array_push($lbarr, $lb);
	array_push($xfarr, $xf);
} 
mysqli_free_result($r);

$mapdmlb = array();
$mapdmxf = array();
$lbxf = array();

// echo required course
echo "<h4>The required cources:</h4>";
foreach ($kcdmarr as $h1 => $v1){
	if ($lbarr[$h1] == '0'){
		$flag = false;
		foreach ($CCodeArr as $h2 => $v2){
			if ($v2 == $v1)
				$flag = true;
			
		}
		if (!$flag){
			echo "You didn't participate course ".$kcmcarr[$h1]."<br/>";
		}
	}
	//make a map from kcdm to lb
	$mapdmlb[$v1] = $lbarr[$h1];
	$mapdmxf[$v1] = $xfarr[$h1];
	
}

foreach ($CCodeArr as $h => $v){
	// if $v is any course that not in our CS course table, ignore it
	if (!isset($mapdmlb[$v]))
		continue;
	if (!isset($lbxf[$mapdmlb[$v]]))
		$lbxf[$mapdmlb[$v]] = 0.0;
	$lbxf[$mapdmlb[$v]] += floatval($mapdmxf[$v]);
}


$query = "select * from LBConstraint;";
$r = @mysqli_query($dbc, $query);
$lbarr = array();
$lbmcarr = array();
$xfxzarr = array();

while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)){
	$lb = $row['lb'];
	$lbmc = $row['lbmc'];
	$xfxz = $row['xfxz'];
	array_push($lbarr, $lb);
	array_push($lbmcarr, $lbmc);
	array_push($xfxzarr, floatval($xfxz));
} 
mysqli_free_result($r);

// echo selective cources
echo '<h4>The selective cources:</h4>';
foreach($lbarr as $h => $v){
	if ($xfxzarr[$h] > $lbxf[$lbarr[$h]]){
		echo 'constraint is: '.$xfxzarr[$h].' Yours is:'.$lbxf[$lbarr[$h]].'<br>';
		echo 'The course part: '.$lbmcarr[$h].' is not full! It need more '.($xfxzarr[$h] - $lbxf[$lbarr[$h]]).'<br>';
	}
}
?>
