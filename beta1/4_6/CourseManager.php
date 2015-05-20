<?php
//record the time array of a course 
class CourseManager{
	public function push_unit($time, $teacher){
		$this->timeArr[$time] = $teacher;
	}
	public $name = 'no_name';
	public $timeArr = array();
}
?>
