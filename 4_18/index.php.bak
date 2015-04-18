<form action="index.php" method="post">
	<p>StudentID:<input name="stuid" type="text" ></p>
	<p> PassWord:<input name="passwd" type="password" > </p>
	<p> <input type="submit" name="Button" value="Submit" id="Button" /> </p>
</form>

<?php
	include "jwbManager.php";
	if ($_SERVER['REQUEST_METHOD'] == 'POST' ){
		echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8">'."\n";
		$chose1 = $_POST['stuid'];
		$chose2 = $_POST['passwd'];
		$jwb = new jwbManager();
		$jwb->init($chose1, $chose2);
		$jwb->getCources();
		$CourseId = $jwb->getCourseCode();
		$CourseName = $jwb->getCourseName();
		if ($CourseId==null) echo "ID or Password is wrong";
		foreach ($CourseId as $h=>$v){
			echo $CourseId[$h]." ".$CourseName[$h]."<br/>";
		}
	}
?>	