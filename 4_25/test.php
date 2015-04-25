<?php

echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
$t1 = '周一';
$t2 = '周二';
$t3 = '周一';
$ar = array();
$ar[$t1] = 1;
$ar[$t2] = 1;
$ar[$t3] = 1;
foreach ($ar as $h => $v){
	echo $h;
}

?>
