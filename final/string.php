<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
function my_sort($a,$b)
	{
		$order = array("一"=>"1","二"=>"2","三"=>"3","四"=>"4","五"=>"5","六"=>"6","日"=>"7");
		return $order[$a] > $order[$b];
	}
class Course
{
	protected $time = array();
	public function __construct()
	{

	}
	public function AnalyzeCourseTime($courseTime,$className,$choice)
	{
		$this->time[$choice] = array();
		$courseTime = "X" . $courseTime; //add "X" to make the first $pos to not be 0
		$pos = strpos($courseTime,"周");
		while($pos)
		{
			$courseTime = substr($courseTime, $pos+3);  //remove all characters before '周' (and it)
			//to judge if or not the next character is "}". if is, then there is {双周|单周},just disregard it
			$next = substr($courseTime,0,1);  
			if($next == "}") 
			{
				$pos = strpos($courseTime,"周");
				continue;
			}
			else   // class time
			{	
				$day = substr($courseTime,0,3);  //get which day it is
				if(!isset($this->time[$choice][$day]))   //if the day has been met before, do not clear the content in time_temp!
					$time_temp = array();
				$courseTime = substr($courseTime, 6);     //remove all characters before '第' (and it)
				$pos1 = strpos($courseTime,"节");
				$current = 0;
				while($current <= $pos1)
				{
					if("," == substr($courseTime,$current+2,1) || $current + 2 == $pos1) //class time is XX(10,11,12,13)
					{
						$class_no = substr($courseTime,$current,2);
						$time_temp[$class_no] = $className;
						$current = $current + 3;
					}
					else   //class time is X(1~9)
					{
						$class_no = substr($courseTime,$current,1);
						$time_temp[$class_no] = $className;
						$current = $current + 2;
					}
				}
				$this->time[$choice][$day] = $time_temp;  #add all this class time of the day to $time
				$pos = strpos($courseTime,"周");  #find next "周"
			}
		}
	}
	public function setCourseTime($timelist,$className)
	{
		foreach($timelist as $choice => $courseTime)
		{
			$this->AnalyzeCourseTime($courseTime,$className,$choice);
		}
	}
	public function printCourseTime()
	{
		foreach ($this->time as $choice => $timelist) 
		{
			echo "<h2>第" . $choice . "种时间段： </h2><br/>";
			foreach($timelist as $day => $courseTime)
			{
				echo "周" . $day .": " . "<br/>";
				foreach($courseTime as $class_no => $className)
					echo $class_no . "=>" . $className . "<br/>";
			}
		}
	}
}
class CourseTable extends Course
{
	private $MinClassNum =  4;
	private $now = 0;
	private $compulsory = 0;
	private $total = 0;
	public $done=false;
	public $result;
	public function addCourse(Course $a, $choice)
	{
		foreach($a->time[$choice] as $day => $allcourses)
		{
			if(isset($this->time[$day]))
				$this->time[$day] = $this->time[$day] + $allcourses;
			else
				$this->time[$day] = $allcourses;
		}
	}
	public function removeCourse(Course $a, $choice)
	{
		foreach($a->time[$choice] as $day => $allcourses)
		{
			foreach($allcourses as $class_no => $className)
				unset($this->time[$day][$class_no]);
			if(empty($this->time[$day]))
				unset($this->time[$day]);
		}
	}
	public function matchCourse(Course $a, $choice) //if can add to CourseTable, return true and add course to course table
	{
		foreach ($a->time[$choice] as $day => $allcourses) {
			if(!isset($this->time[$day]))
				continue;
			else
			{
				foreach($allcourses as $class_no => $className)
				{
					if(isset($this->time[$day][$class_no]))
						return false;
				}
			}
		}
		return true;
	}
	
	public function sortByKey()
	{
		foreach($this->time as &$allcourses)
			ksort($allcourses);
		uksort($this->time, "my_sort");
	}
	public function printCourseTable()
	{
		$this->sortByKey();
		foreach($this->time as $day => $allcourses)
		{
			echo "周" . $day .": " . "<br/>";
			foreach($allcourses as $class_no => $className)
				echo $class_no . "=>" . $className . "<br/>";
		}
	}
	public function SetCondition($compulsory,$total,$atleast)
	{
		$this->compulsory = $compulsory;
		$this->total = $total;
		$this->MinClassNum = $atleast;
	}
	public function ArrangeCourse($CourseArray,$n)
	{
		if($this->now >= $this->MinClassNum)
		{
			$this->done = true;
			$this->result = $this;
			return;
		}
		if($this->now < $this->compulsory && $n >= $this->compulsory)
			return;
		else 
		{
			$kinds = count($CourseArray[$n]->time);
			for($i = 1;$i <= $kinds; $i++)
			{
				if($this->matchCourse($CourseArray[$n],$i))
				{
					$this->addCourse($CourseArray[$n],$i);
					$this->now++;
					$this->ArrangeCourse($CourseArray,$n+1);
					if($this->done == true)
						return;
					else
					{
						$this->now--;
						$this->removeCourse($CourseArray[$n],$i);
					}
					
				}
			}
		}
	}
	public function showAsTimeTable()
	{
		$this->sortByKey();
		echo '<table width="1000" height="100" border="1" rules="all" cellspacing="0" style="font-size:13px"
				bordercolor="#c1d8f0" class="Tag">
			<tbody>
			<tr>
				<td width="2%" rowspan="2" colspan="2">时间</td>
				<td width="14%" align="Center" colspan="2">星期一</td>
				<td width="14%" align="Center" colspan="2">星期二</td>
				<td width="14%" align="Center" colspan="2">星期三</td>
				<td width="14%" align="Center" colspan="2">星期四</td>
				<td width="14%" align="Center" colspan="2">星期五</td>
				<td width="14%" align="Center" colspan="2">星期六</td>
				<td width="14%" align="Center" colspan="2">星期日</td>
			</tr>';
			echo '<tr>';
		    for($i = 1; $i <= 7; $i++)
		    {
		    	echo '<td width="7%" align="Center">单</td>';
		    	echo '<td width="7%" align="Center">双</td>';
		    }
			echo '</tr>';
			$mark = array("一"=>"0","二"=>"0","三"=>"0","四"=>"0","五"=>"0","六"=>"0","日"=>"0");
			for($i=1;$i<=13;$i++)
			{
				if($i==1)
				{
					echo '<td width="1%" rowspan="6">上午</td>';
				}
				if($i==6)
					echo '<td width="1%" rowspan="6">下午</td>';
				if($i==11)
					echo '<td width="1%" rowspan="4">晚间</td>';
				echo '<tr>';
				echo '<td width="1%">'.$i.'节</td>';
				$alldays = array('一', '二', '三', '四', '五', '六', '日');
	//			foreach($this->time as $day => $allcourses)
				foreach($alldays as $day)
				{
					if(isset($this->time[$day]))
					{
						if($mark[$day] > 1)
							$mark[$day] --;
						else if(isset($this->time[$day][$i]))
						{
							$mark[$day]=1;
							$j = $i;
							while(isset($this->time[$day][$j+1]) && $this->time[$day][$j+1] == $this->time[$day][$j])
							{
								$mark[$day]++;
								$j++;
							}
							echo '<td width="7%" align="center" rowspan=' . $mark[$day] .'  colspan = "2">'.$this->time[$day][$i].'</td>';
						}
						else
						{
							echo '<td width="7%" align="center" colspan="2">&nbsp</td>';
						}
					}
					else
						echo '<td width="7%" align="center" colspan="2">&nbsp</td>';
				}
				echo '</tr>';
			}	
	}
}
	/*$class1[1] = "周六第7,8,9,10节|周二第9,10节";
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

	$class8[3] = "周一第7,8节|周三第3,4,5节";
	$class8[2] = "周一第11,12节|周一第6,7,8节";
	$class8[1] = "周五第3,4节|周三第3,4,5节";
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
	$table = new CourseTable();
	$table->SetCondition(8,11,11);
	$table->ArrangeCourse($CourseArray,0);
	$a = $table->result;
	$a->printCourseTable();*/
?>
