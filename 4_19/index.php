<form action="index.php" method="post">
	<p>StudentID:<input name="stuid" type="text" ></p>
	<p> PassWord:<input name="passwd" type="password" > </p>
	<p> <input type="submit" name="Button" value="Submit" id="Button" /> </p>
</form>

<?php
	include "CheckCourse.php"; //use to check course not passed
	include_once "jwbManager.php"; //use to login jwb and fetch course
	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8">'."\n";
		$chose1 = $_POST['stuid'];
		$chose2 = $_POST['passwd'];
		$jwb = new jwbManager();
		$ckcs = new CheckCourse();
		try{
			$jwb->login($chose1, $chose2);
			session_start();
			$_SESSION["username"] = $chose1;
			//header('location: index_w.php');
			//jump
			$ckcs->check($chose1);
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

		}catch(Exception $e){
			echo 'Message: '.$e->getMessage();
			session_start();
			session_unset();
			session_destroy();	
		}
	}
?>	
