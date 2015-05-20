<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<html>
<head>
<style type="text/css">
.Tag td
{
	border-collapse: collapse;
	border:solid 1px #c1d8f0;
}
</style>
</head>
<body style="background-image:url(./586542.jpg)">
<div style="margin-left:50px;margin-top:20px">
<h1>推荐课表(1)：</h1>
<?php
include "string.php";
/*
	$class1[1] = "周六第7,8,9,10节|周二第9,10节";
	$class1[2] = "周日第7,8,9,10节|周二第9,10节";
	$class1[3] = "周六第2,3,4,5节|周二第9,10节";
	$course1 = new Course();
	$course1->setCourseTime($class1,"数据库系统设计");

	$class2[1] = "周四第9,10节{双周}|周五第1,2节";
	$class2[2] = "周四第1,2节|周四第3,4节{双周}";
	$course2 = new Course();
	$course2->setCourseTime($class2,"数据库系统原理");

	$class3[1] = "周四第3,4,5节";
	$class3[2] = "周二第3,4,5节";
	$class3[3] = "周三第6,7,8节";
	$course3 = new Course();
	$course3->setCourseTime($class3,"操作系统原理");

	$class4[1] = "周二第7,8节|周四第9,10节";
	$course4 = new Course();
	$course4->setCourseTime($class4,"计算机视觉");

	$class5[1] = "周日第2,3,4,5节|周二第1,2节";
	$class5[2] = "周日第7,8,9,10节|周二第9,10节";
	$class5[3] = "周六第2,3,4,5节|周一第7,8节";
	$class5[4] = "周三第7,8,9,10节|周二第9,10节";
	$course5 = new Course();
	$course5->setCourseTime($class5,"操作系统分析及实验");

	$class6[1] = "周一第3,4节";
	$class6[2] = "周五第3,4节";
	$course6 = new Course();
	$course6->setCourseTime($class6,"计算理论");

	$class7[1] = "周日第11,12节{双周}|周一第1,2节";
	$class7[2] = "周日第11,12节{单周}|周三第1,2节";
	$course7 = new Course();
	$course7->setCourseTime($class7,"Java应用技术");

	$class8[1] = "周一第7,8节|周三第3,4,5节";
	$class8[2] = "周一第11,12节|周一第6,7,8节";
	$class8[3] = "周五第3,4节|周三第3,4,5节";
	$class8[4] = "周三第9,10节|周一第6,7,8节";
	$class8[5] = "周四第11,12节|周一第6,7,8节";
	$class8[6] = "周四第7,8节|周一第6,7,8节";
	$course8 = new Course();
	$course8->setCourseTime($class8,"逻辑与计算机设计基础");

	$class9[1] = "周六第11,12节|周一第11,12节|周五第11,12节";
	$course9 = new Course();
	$course9->setCourseTime($class9,"密码学");

	$class10[1] = "周一第9,10节|周一第3,4节|周三第3,4节";
	$course10 = new Course();
	$course10->setCourseTime($class10,"计算机游戏程序设计");

	$class11[1] = "周六第3,4节{双周}|周三第7,8节";
	$class11[2] = "周二第1,2节|周四第11,12节{单周}";
	$course11 = new Course();
	$course11->setCourseTime($class11,"面向对象程序设计");

	$CourseArray = array($course1,$course2,$course3,$course4,$course5,$course6,
		$course7,$course8,$course9,$course10,$course11);
		*/
	$class1[1] = "周六第7,8,9,10节|周二第9,10节";
	$class1[2] = "周日第7,8,9,10节|周二第9,10节";
	$class1[3] = "周六第2,3,4,5节|周二第9,10节";
	$course1 = new Course();
	$course1->setCourseTime($class1,"面向对象程序设计");

	$CourseArray = array($course1);

	$table = new CourseTable();
	$table->SetCondition(1,1,1);
	$table->ArrangeCourse($CourseArray,0);
	if($table->done == true)
	{
		$a = $table->result;
		$a->showAsTimeTable();
	}
	else
		echo '<h1>必修课时间冲突，请调整！</h1>';
	
?>
</div>
</body>
</html>
