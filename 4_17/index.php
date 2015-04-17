<form action="index.php" method="post">
	<p>StudentID:<input name="stuid" type="text" ></p>
	<p> PassWord:<input name="passwd" type="password" > </p>
	<p> <input type="submit" name="Button" value="Submit" id="Button" /> </p>
</form>

<?php
	include "CheckCourse.php";
	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8">'."\n";
		$chose1 = $_POST['stuid'];
		$chose2 = $_POST['passwd'];
		$ckcs = new CheckCourse();
		$ckcs->init($chose1, $chose2);
		$temp = $ckcs->getReCoMcArr();
		print_r($temp);
		echo '<br>';
		$temp = $ckcs->getReCoDmArr();
		print_r($temp);
		echo '<br>';
		$temp = $ckcs->getSeLBMcArr();
		print_r($temp);
		echo '<br>';
		$temp = $ckcs->getSeXfNeedArr();
		print_r($temp);
		echo '<br>';
	}
?>	
