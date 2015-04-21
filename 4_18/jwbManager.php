<?php
include 'changeImg.php';
include('insertCourse.php');

class jwbManager{
	//init($studentid, $password) to connect to jwb
	//getCourse() to get CourseName and CourseCode
	//getCourseCode() to get CourseCode Array
	//get getCourseName() to get CourseName Array

	public function init($u, $p){
		//set id and password
		$this->stuid = $u;
		$this->course_code = array();
		$this->course_name = array();
		//get cookie
		$this->cookie_jar = dirname(__FILE__)."/temp/$u"."pic.cookie";
		//get checkcode gif to filename
		$url = 'http://jwbinfosys.zju.edu.cn/CheckCode.aspx';
		$filename = dirname(__FILE__)."/temp/$u"."ck.gif";
		$fp = fopen($filename, "wb");
		$cl = curl_init();
		curl_setopt($cl, CURLOPT_URL, $url);
		curl_setopt($cl, CURLOPT_FILE, $fp);
		curl_setopt($cl, CURLOPT_HEADER, 0);
		curl_setopt($cl, CURLOPT_TIMEOUT, 60);
		curl_setopt($cl, CURLOPT_COOKIEJAR, $this->cookie_jar);
		curl_exec($cl);
		curl_close($cl);
		fclose($fp);
		//use changeImg.php decode checkcode gif file
		$ckcode = getImgCode($filename);
		//use checkcode and passwd to login
		$curl = curl_init();
		//set login Form
		$FormVal = array(
				'__EVENTTARGET'=>'Button1',
				'__EVENTARGUMENT'=>'',
				'__VIEWSTATE'=>'dDwxNTc0MzA5MTU4Ozs+RGE82+DpWCQpVjFtEpHZ1UJYg8w=',
				'TextBox1'=>$this->stuid,
				'TextBox2'=>$p,
				'RadioButtonList1=ѧ��',
				'Text1'=>'',
				'Textbox3'=>$ckcode
		);
		curl_setopt($curl, CURLOPT_URL, 'http://jwbinfosys.zju.edu.cn/default2.aspx');
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_COOKIEFILE, $this->cookie_jar);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $FormVal);
		curl_setopt($curl, CURLOPT_HEADER, 0);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		//execute curl
		$data =curl_exec($curl);
		$iferr = strstr($data, 'script');
		if ($iferr)
			throw new Exception('User or Password is wrong!!');

		curl_close($curl);

	}

	public function getCourses($stu){
		$curl = curl_init();
		//set the search course Form
		$FormVal = array(
				'__VIEWSTATE' => 'dDw0NzAzMzE4ODg7dDw7bDxpPDE+Oz47bDx0PDtsPGk8Mj47aTw1PjtpPDI1PjtpPDI3PjtpPDI5PjtpPDMxPjtpPDMzPjtpPDM1PjtpPDM3PjtpPDM5PjtpPDQxPjtpPDQzPjtpPDQ1PjtpPDQ3PjtpPDQ4Pjs+O2w8dDx0PDt0PGk8MTY+O0A8XGU7MjAwMS0yMDAyOzIwMDItMjAwMzsyMDAzLTIwMDQ7MjAwNC0yMDA1OzIwMDUtMjAwNjsyMDA2LTIwMDc7MjAwNy0yMDA4OzIwMDgtMjAwOTsyMDA5LTIwMTA7MjAxMC0yMDExOzIwMTEtMjAxMjsyMDEyLTIwMTM7MjAxMy0yMDE0OzIwMTQtMjAxNTsyMDE1LTIwMTY7PjtAPFxlOzIwMDEtMjAwMjsyMDAyLTIwMDM7MjAwMy0yMDA0OzIwMDQtMjAwNTsyMDA1LTIwMDY7MjAwNi0yMDA3OzIwMDctMjAwODsyMDA4LTIwMDk7MjAwOS0yMDEwOzIwMTAtMjAxMTsyMDExLTIwMTI7MjAxMi0yMDEzOzIwMTMtMjAxNDsyMDE0LTIwMTU7MjAxNS0yMDE2Oz4+Oz47Oz47dDx0PHA8cDxsPERhdGFUZXh0RmllbGQ7RGF0YVZhbHVlRmllbGQ7PjtsPHh4cTt4cTE7Pj47Pjt0PGk8OD47QDxcZTvmmKU75aSPO+efrTvnp4s75YasO+efrTvmmpE7PjtAPFxlOzJ85pilOzJ85aSPOzJ855+tOzF856eLOzF85YasOzF855+tOzF85pqROz4+Oz47Oz47dDxwPDtwPGw8b25jbGljazs+O2w8d2luZG93LnByaW50KClcOzs+Pj47Oz47dDxwPDtwPGw8b25jbGljazs+O2w8d2luZG93LmNsb3NlKClcOzs+Pj47Oz47dDxwPHA8bDxUZXh0Oz47bDzlnKjmoKHlrabkuaDmiJDnu6k7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPOWtpuWPt++8mjMxMjAwMDA0MDg7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPOWnk+WQje+8mumbt+Wuhzs+Pjs+Ozs+O3Q8cDxwPGw8VGV4dDs+O2w85a2m6Zmi77ya6K6h566X5py656eR5a2m5LiO5oqA5pyv5a2m6ZmiOz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDznsbso5LiT5LiaKe+8muiuoeeul+acuuenkeWtpuS4juaKgOacrzs+Pjs+Ozs+O3Q8cDxwPGw8VGV4dDs+O2w86KGM5pS/54+t77ya6K6h566X5py656eR5a2m5LiO5oqA5pyvMTIwMjs+Pjs+Ozs+O3Q8QDA8cDxwPGw8UGFnZUNvdW50O18hSXRlbUNvdW50O18hRGF0YVNvdXJjZUl0ZW1Db3VudDtEYXRhS2V5czs+O2w8aTwxPjtpPDY1PjtpPDY1PjtsPD47Pj47Pjs7Ozs7Ozs7Ozs+O2w8aTwwPjs+O2w8dDw7bDxpPDE+O2k8Mj47aTwzPjtpPDQ+O2k8NT47aTw2PjtpPDc+O2k8OD47aTw5PjtpPDEwPjtpPDExPjtpPDEyPjtpPDEzPjtpPDE0PjtpPDE1PjtpPDE2PjtpPDE3PjtpPDE4PjtpPDE5PjtpPDIwPjtpPDIxPjtpPDIyPjtpPDIzPjtpPDI0PjtpPDI1PjtpPDI2PjtpPDI3PjtpPDI4PjtpPDI5PjtpPDMwPjtpPDMxPjtpPDMyPjtpPDMzPjtpPDM0PjtpPDM1PjtpPDM2PjtpPDM3PjtpPDM4PjtpPDM5PjtpPDQwPjtpPDQxPjtpPDQyPjtpPDQzPjtpPDQ0PjtpPDQ1PjtpPDQ2PjtpPDQ3PjtpPDQ4PjtpPDQ5PjtpPDUwPjtpPDUxPjtpPDUyPjtpPDUzPjtpPDU0PjtpPDU1PjtpPDU2PjtpPDU3PjtpPDU4PjtpPDU5PjtpPDYwPjtpPDYxPjtpPDYyPjtpPDYzPjtpPDY0PjtpPDY1Pjs+O2w8dDw7bDxpPDA+O2k8MT47aTwyPjtpPDM+O2k8ND47aTw1Pjs+O2w8dDxwPHA8bDxUZXh0Oz47bDwoMjAxMS0yMDEyLTIpLTA2MUIwMjAwLTAwMDMxMzctMTs+Pjs+Ozs+O3Q8cDxwPGw8VGV4dDs+O2w857q/5oCn5Luj5pWwOz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDw3OTs+Pjs+Ozs+O3Q8cDxwPGw8VGV4dDs+O2w8Mi41Oz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDwzLjQwOz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDwmbmJzcFw7Oz4+Oz47Oz47Pj47dDw7bDxpPDA+O2k8MT47aTwyPjtpPDM+O2k8ND47aTw1Pjs+O2w8dDxwPHA8bDxUZXh0Oz47bDwoMjAxMS0yMDEyLTIpLTIxMUcwMDYwLTAwODIxMzMtMTs+Pjs+Ozs+O3Q8cDxwPGw8VGV4dDs+O2w85aSn5a2m6K6h566X5py65Z+656GAOz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDw4Mjs+Pjs+Ozs+O3Q8cDxwPGw8VGV4dDs+O2w8Mi4wOz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDwzLjcwOz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDwmbmJzcFw7Oz4+Oz47Oz47Pj47dDw7bDxpPDA+O2k8MT47aTwyPjtpPDM+O2k8ND47aTw1Pjs+O2w8dDxwPHA8bDxUZXh0Oz47bDwoMjAxMi0yMDEzLTEpLTAyMUUwMDEwLTAwMDUxOTQtMTs+Pjs+Ozs+O3Q8cDxwPGw8VGV4dDs+O2w85oCd5oOz6YGT5b635L+u5YW75LiO5rOV5b6L5Z+656GAOz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDw3Njs+Pjs+Ozs+O3Q8cDxwPGw8VGV4dDs+O2w8Mi41Oz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDwzLjEwOz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDwmbmJzcFw7Oz4+Oz47Oz47Pj47dDw7bDxpPDA+O2k8MT47aTwyPjtpPDM+O2k8ND47aTw1Pjs+O2w8dDxwPHA8bDxUZXh0Oz47bDwoMjAxMi0yMDEzLTEpLTAyMUUwMDIwLTAwOTcxOTQtNDs+Pjs+Ozs+O3Q8cDxwPGw8VGV4dDs+O2w85Lit5Zu96L+R546w5Luj5Y+y57qy6KaBOz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDw4ODs+Pjs+Ozs+O3Q8cDxwPGw8VGV4dDs+O2w8Mi41Oz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDw0LjMwOz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDwmbmJzcFw7Oz4+Oz47Oz47Pj47dDw7bDxpPDA+O2k8MT47aTwyPjtpPDM+O2k8ND47aTw1Pjs+O2w8dDxwPHA8bDxUZXh0Oz47bDwoMjAxMi0yMDEzLTEpLTAzMTEwMDI1LTAwMTI0MTEtMTs+Pjs+Ozs+O3Q8cDxwPGw8VGV4dDs+O2w85Yab6K6tOz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDw5Mjs+Pjs+Ozs+O3Q8cDxwPGw8VGV4dDs+O2w8Mi4wOz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDw0LjcwOz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDwmbmJzcFw7Oz4+Oz47Oz47Pj47dDw7bDxpPDA+O2k8MT47aTwyPjtpPDM+O2k8ND47aTw1Pjs+O2w8dDxwPHA8bDxUZXh0Oz47bDwoMjAxMi0yMDEzLTEpLTAzMUUwMDEwLTAwODYwMjctMTs+Pjs+Ozs+O3Q8cDxwPGw8VGV4dDs+O2w85Yab5LqL55CG6K66Oz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDw4Mjs+Pjs+Ozs+O3Q8cDxwPGw8VGV4dDs+O2w8MS41Oz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDwzLjcwOz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDwmbmJzcFw7Oz4+Oz47Oz47Pj47dDw7bDxpPDA+O2k8MT47aTwyPjtpPDM+O2k8ND47aTw1Pjs+O2w8dDxwPHA8bDxUZXh0Oz47bDwoMjAxMi0yMDEzLTEpLTA0MUgwMDMwLTAwODUzOTYtMTs+Pjs+Ozs+O3Q8cDxwPGw8VGV4dDs+O2w85Lyg57uf5paH5YyW5LiO546w5Luj5Lit5Zu9Oz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDw3Mjs+Pjs+Ozs+O3Q8cDxwPGw8VGV4dDs+O2w8MS41Oz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDwyLjcwOz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDwmbmJzcFw7Oz4+Oz47Oz47Pj47dDw7bDxpPDA+O2k8MT47aTwyPjtpPDM+O2k8ND47aTw1Pjs+O2w8dDxwPHA8bDxUZXh0Oz47bDwoMjAxMi0yMDEzLTEpLTA1MUYwMDIwLTAwMDMyMjMtMTs+Pjs+Ozs+O3Q8cDxwPGw8VGV4dDs+O2w85aSn5a2m6Iux6K+t4oWiOz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDw3Nzs+Pjs+Ozs+O3Q8cDxwPGw8VGV4dDs+O2w8My4wOz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDwzLjIwOz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDwmbmJzcFw7Oz4+Oz47Oz47Pj47dDw7bDxpPDA+O2k8MT47aTwyPjtpPDM+O2k8ND47aTw1Pjs+O2w8dDxwPHA8bDxUZXh0Oz47bDwoMjAxMi0yMDEzLTEpLTA2MUIwMTcwLTAwMDc0MDUtMTs+Pjs+Ozs+O3Q8cDxwPGw8VGV4dDs+O2w85b6u56ev5YiG4oWgOz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDw4NTs+Pjs+Ozs+O3Q8cDxwPGw8VGV4dDs+O2w8NC41Oz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDw0Oz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDwmbmJzcFw7Oz4+Oz47Oz47Pj47dDw7bDxpPDA+O2k8MT47aTwyPjtpPDM+O2k8ND47aTw1Pjs+O2w8dDxwPHA8bDxUZXh0Oz47bDwoMjAxMi0yMDEzLTEpLTA2MUswMTIwLTAwODIzMTEtMzs+Pjs+Ozs+O3Q8cDxwPGw8VGV4dDs+O2w854mp55CG5LiO5Lq657G75paH5piOOz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDw4Mjs+Pjs+Ozs+O3Q8cDxwPGw8VGV4dDs+O2w8Mi4wOz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDwzLjcwOz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDwmbmJzcFw7Oz4+Oz47Oz47Pj47dDw7bDxpPDA+O2k8MT47aTwyPjtpPDM+O2k8ND47aTw1Pjs+O2w8dDxwPHA8bDxUZXh0Oz47bDwoMjAxMi0yMDEzLTEpLTA4MUMwMTMwLTAwMDg0MDMtMjs+Pjs+Ozs+O3Q8cDxwPGw8VGV4dDs+O2w85bel56iL5Zu+5a2mOz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDw4Mzs+Pjs+Ozs+O3Q8cDxwPGw8VGV4dDs+O2w8Mi41Oz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDwzLjgwOz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDwmbmJzcFw7Oz4+Oz47Oz47Pj47dDw7bDxpPDA+O2k8MT47aTwyPjtpPDM+O2k8ND47aTw1Pjs+O2w8dDxwPHA8bDxUZXh0Oz47bDwoMjAxMi0yMDEzLTEpLTE2MUkwMDEwLTAwODUyMDItMTs+Pjs+Ozs+O3Q8cDxwPGw8VGV4dDs+O2w85o+S6Iqx6Im65pyv5LiO55uG5pmvOz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDw4Mjs+Pjs+Ozs+O3Q8cDxwPGw8VGV4dDs+O2w8MS41Oz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDwzLjcwOz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDwmbmJzcFw7Oz4+Oz47Oz47Pj47dDw7bDxpPDA+O2k8MT47aTwyPjtpPDM+O2k8ND47aTw1Pjs+O2w8dDxwPHA8bDxUZXh0Oz47bDwoMjAxMi0yMDEzLTEpLTIxMTg2MDIwLTAwODcyMDItMTs+Pjs+Ozs+O3Q8cDxwPGw8VGV4dDs+O2w856iL5bqP6K6+6K6h5Z+656GA5Y+K5a6e6aqMOz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDw4Nzs+Pjs+Ozs+O3Q8cDxwPGw8VGV4dDs+O2w8NC4wOz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDw0LjIwOz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDwmbmJzcFw7Oz4+Oz47Oz47Pj47dDw7bDxpPDA+O2k8MT47aTwyPjtpPDM+O2k8ND47aTw1Pjs+O2w8dDxwPHA8bDxUZXh0Oz47bDwoMjAxMi0yMDEzLTEpLTM2MUowMDEwLTAwOTU1MjItMTs+Pjs+Ozs+O3Q8cDxwPGw8VGV4dDs+O2w86IGM5Lia55Sf5rav6KeE5YiSOz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDw4Njs+Pjs+Ozs+O3Q8cDxwPGw8VGV4dDs+O2w8MS41Oz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDw0LjEwOz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDwmbmJzcFw7Oz4+Oz47Oz47Pj47dDw7bDxpPDA+O2k8MT47aTwyPjtpPDM+O2k8ND47aTw1Pjs+O2w8dDxwPHA8bDxUZXh0Oz47bDwoMjAxMi0yMDEzLTEpLTQwMTAwMzAwLTAwOTkxODgtMTs+Pjs+Ozs+O3Q8cDxwPGw8VGV4dDs+O2w86Laz55CDKOWInee6p+ePre+8iTs+Pjs+Ozs+O3Q8cDxwPGw8VGV4dDs+O2w8ODA7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPDEuMDs+Pjs+Ozs+O3Q8cDxwPGw8VGV4dDs+O2w8My41MDs+Pjs+Ozs+O3Q8cDxwPGw8VGV4dDs+O2w8Jm5ic3BcOzs+Pjs+Ozs+Oz4+O3Q8O2w8aTwwPjtpPDE+O2k8Mj47aTwzPjtpPDQ+O2k8NT47PjtsPHQ8cDxwPGw8VGV4dDs+O2w8KDIwMTItMjAxMy0yKS0wMjFFMDA0MC0wMDg3MTY5LTE7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPOmprOWFi+aAneS4u+S5ieWfuuacrOWOn+eQhuamguiuujs+Pjs+Ozs+O3Q8cDxwPGw8VGV4dDs+O2w8Nzg7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPDIuNTs+Pjs+Ozs+O3Q8cDxwPGw8VGV4dDs+O2w8My4zMDs+Pjs+Ozs+O3Q8cDxwPGw8VGV4dDs+O2w8Jm5ic3BcOzs+Pjs+Ozs+Oz4+O3Q8O2w8aTwwPjtpPDE+O2k8Mj47aTwzPjtpPDQ+O2k8NT47PjtsPHQ8cDxwPGw8VGV4dDs+O2w8KDIwMTItMjAxMy0yKS0wMzFFMDAzMS0wMDk1NDIyLTE7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPOavm+azveS4nOaAneaDs+WSjOS4reWbveeJueiJsuekvuS8muS4u+S5ieeQhuiuuuS9k+ezu+amguiuujs+Pjs+Ozs+O3Q8cDxwPGw8VGV4dDs+O2w8ODU7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPDQuMDs+Pjs+Ozs+O3Q8cDxwPGw8VGV4dDs+O2w8NDs+Pjs+Ozs+O3Q8cDxwPGw8VGV4dDs+O2w8Jm5ic3BcOzs+Pjs+Ozs+Oz4+O3Q8O2w8aTwwPjtpPDE+O2k8Mj47aTwzPjtpPDQ+O2k8NT47PjtsPHQ8cDxwPGw8VGV4dDs+O2w8KDIwMTItMjAxMy0yKS0wNDFJMDU1MC0wMDA3MzM2LTQ7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPOS4reWbveW9k+S7o+awkeaXj+mfs+S5kOi1j+aekDs+Pjs+Ozs+O3Q8cDxwPGw8VGV4dDs+O2w8Nzk7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPDEuMDs+Pjs+Ozs+O3Q8cDxwPGw8VGV4dDs+O2w8My40MDs+Pjs+Ozs+O3Q8cDxwPGw8VGV4dDs+O2w8Jm5ic3BcOzs+Pjs+Ozs+Oz4+O3Q8O2w8aTwwPjtpPDE+O2k8Mj47aTwzPjtpPDQ+O2k8NT47PjtsPHQ8cDxwPGw8VGV4dDs+O2w8KDIwMTItMjAxMy0yKS0wNTFGMDAzMC0wMDkzMDE4LTM7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPOWkp+WtpuiLseivreKFozs+Pjs+Ozs+O3Q8cDxwPGw8VGV4dDs+O2w8NzQ7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPDMuMDs+Pjs+Ozs+O3Q8cDxwPGw8VGV4dDs+O2w8Mi45MDs+Pjs+Ozs+O3Q8cDxwPGw8VGV4dDs+O2w8Jm5ic3BcOzs+Pjs+Ozs+Oz4+O3Q8O2w8aTwwPjtpPDE+O2k8Mj47aTwzPjtpPDQ+O2k8NT47PjtsPHQ8cDxwPGw8VGV4dDs+O2w8KDIwMTItMjAxMy0yKS0wNjFCMDAxMC0wMDgyMTU4LTI7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPOW4uOW+ruWIhuaWueeoizs+Pjs+Ozs+O3Q8cDxwPGw8VGV4dDs+O2w8NzY7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPDEuMDs+Pjs+Ozs+O3Q8cDxwPGw8VGV4dDs+O2w8My4xMDs+Pjs+Ozs+O3Q8cDxwPGw8VGV4dDs+O2w8Jm5ic3BcOzs+Pjs+Ozs+Oz4+O3Q8O2w8aTwwPjtpPDE+O2k8Mj47aTwzPjtpPDQ+O2k8NT47PjtsPHQ8cDxwPGw8VGV4dDs+O2w8KDIwMTItMjAxMy0yKS0wNjFCMDE4MC0wMDkxMzExLTE7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPOW+ruenr+WIhuKFoTs+Pjs+Ozs+O3Q8cDxwPGw8VGV4dDs+O2w8ODk7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPDIuMDs+Pjs+Ozs+O3Q8cDxwPGw8VGV4dDs+O2w8NC40MDs+Pjs+Ozs+O3Q8cDxwPGw8VGV4dDs+O2w8Jm5ic3BcOzs+Pjs+Ozs+Oz4+O3Q8O2w8aTwwPjtpPDE+O2k8Mj47aTwzPjtpPDQ+O2k8NT47PjtsPHQ8cDxwPGw8VGV4dDs+O2w8KDIwMTItMjAxMy0yKS0wNjFCMDE5MC0wMDkzMTY5LTQ7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPOW+ruenr+WIhuKFojs+Pjs+Ozs+O3Q8cDxwPGw8VGV4dDs+O2w8NjM7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPDEuNTs+Pjs+Ozs+O3Q8cDxwPGw8VGV4dDs+O2w8MS44MDs+Pjs+Ozs+O3Q8cDxwPGw8VGV4dDs+O2w8Jm5ic3BcOzs+Pjs+Ozs+Oz4+O3Q8O2w8aTwwPjtpPDE+O2k8Mj47aTwzPjtpPDQ+O2k8NT47PjtsPHQ8cDxwPGw8VGV4dDs+O2w8KDIwMTItMjAxMy0yKS0wNjFCMDIxMS0wMDgyMzgyLTE7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPOWkp+WtpueJqeeQhu+8iOeUsu+8ieKFoDs+Pjs+Ozs+O3Q8cDxwPGw8VGV4dDs+O2w8NzQ7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPDQuMDs+Pjs+Ozs+O3Q8cDxwPGw8VGV4dDs+O2w8Mi45MDs+Pjs+Ozs+O3Q8cDxwPGw8VGV4dDs+O2w8Jm5ic3BcOzs+Pjs+Ozs+Oz4+O3Q8O2w8aTwwPjtpPDE+O2k8Mj47aTwzPjtpPDQ+O2k8NT47PjtsPHQ8cDxwPGw8VGV4dDs+O2w8KDIwMTItMjAxMy0yKS0yMTEyMDQyMC0wMDkxMzQwLTE7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPOeoi+W6j+iuvuiuoee7vOWQiOWunumqjDs+Pjs+Ozs+O3Q8cDxwPGw8VGV4dDs+O2w8ODg7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPDEuMDs+Pjs+Ozs+O3Q8cDxwPGw8VGV4dDs+O2w8NC4zMDs+Pjs+Ozs+O3Q8cDxwPGw8VGV4dDs+O2w8Jm5ic3BcOzs+Pjs+Ozs+Oz4+O3Q8O2w8aTwwPjtpPDE+O2k8Mj47aTwzPjtpPDQ+O2k8NT47PjtsPHQ8cDxwPGw8VGV4dDs+O2w8KDIwMTItMjAxMy0yKS0yMTFCMDAxMC0wMDA5MjI3LTI7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPOemu+aVo+aVsOWtpuWPiuWFtuW6lOeUqDs+Pjs+Ozs+O3Q8cDxwPGw8VGV4dDs+O2w8OTA7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPDQuMDs+Pjs+Ozs+O3Q8cDxwPGw8VGV4dDs+O2w8NC41MDs+Pjs+Ozs+O3Q8cDxwPGw8VGV4dDs+O2w8Jm5ic3BcOzs+Pjs+Ozs+Oz4+O3Q8O2w8aTwwPjtpPDE+O2k8Mj47aTwzPjtpPDQ+O2k8NT47PjtsPHQ8cDxwPGw8VGV4dDs+O2w8KDIwMTItMjAxMy0yKS0yMTFNMDAxMC0wMDAzMzQ3LTE7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPOS6uuW3peaZuuiDveWIneatpTs+Pjs+Ozs+O3Q8cDxwPGw8VGV4dDs+O2w8NzU7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPDIuMDs+Pjs+Ozs+O3Q8cDxwPGw8VGV4dDs+O2w8Mzs+Pjs+Ozs+O3Q8cDxwPGw8VGV4dDs+O2w8Jm5ic3BcOzs+Pjs+Ozs+Oz4+O3Q8O2w8aTwwPjtpPDE+O2k8Mj47aTwzPjtpPDQ+O2k8NT47PjtsPHQ8cDxwPGw8VGV4dDs+O2w8KDIwMTItMjAxMy0yKS0zNzFFMDAxMC0wMDk2MTQyLTE7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPOW9ouWKv+S4juaUv+etluKFoDs+Pjs+Ozs+O3Q8cDxwPGw8VGV4dDs+O2w8ODQ7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPDEuMDs+Pjs+Ozs+O3Q8cDxwPGw8VGV4dDs+O2w8My45MDs+Pjs+Ozs+O3Q8cDxwPGw8VGV4dDs+O2w8Jm5ic3BcOzs+Pjs+Ozs+Oz4+O3Q8O2w8aTwwPjtpPDE+O2k8Mj47aTwzPjtpPDQ+O2k8NT47PjtsPHQ8cDxwPGw8VGV4dDs+O2w8KDIwMTItMjAxMy0yKS00MDEwMDIyMi0wMDk4MDIxLTI7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPOahpeeJjCjliJ3nuqfnj63vvIk7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPDg0Oz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDwxLjA7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPDMuOTA7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPCZuYnNwXDs7Pj47Pjs7Pjs+Pjt0PDtsPGk8MD47aTwxPjtpPDI+O2k8Mz47aTw0PjtpPDU+Oz47bDx0PHA8cDxsPFRleHQ7PjtsPCgyMDEzLTIwMTQtMSktMDExTDAwMzAtMDA5NjA2NS0xOz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDznu4/mtY7lrabln7rnoYA7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPDY4Oz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDwxLjU7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPDIuMzA7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPCZuYnNwXDs7Pj47Pjs7Pjs+Pjt0PDtsPGk8MD47aTwxPjtpPDI+O2k8Mz47aTw0PjtpPDU+Oz47bDx0PHA8cDxsPFRleHQ7PjtsPCgyMDEzLTIwMTQtMSktMDYxQjAxOTAtMDA4MzA0Ny0xOz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDzlvq7np6/liIbihaI7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPDc4Oz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDwxLjU7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPDMuMzA7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPCZuYnNwXDs7Pj47Pjs7Pjs+Pjt0PDtsPGk8MD47aTwxPjtpPDI+O2k8Mz47aTw0PjtpPDU+Oz47bDx0PHA8cDxsPFRleHQ7PjtsPCgyMDEzLTIwMTQtMSktMDYxQjAyMTEtMDA5MjExNy0xOz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDzlpKflrabniannkIbvvIjnlLLvvInihaA7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPDc3Oz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDw0LjA7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPDMuMjA7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPCZuYnNwXDs7Pj47Pjs7Pjs+Pjt0PDtsPGk8MD47aTwxPjtpPDI+O2k8Mz47aTw0PjtpPDU+Oz47bDx0PHA8cDxsPFRleHQ7PjtsPCgyMDEzLTIwMTQtMSktMDYxQjAyMjEtMDA4MzI0Ny0xOz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDzlpKflrabniannkIbvvIjnlLLvvInihaE7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPDY2Oz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDw0LjA7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPDIuMTA7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPCZuYnNwXDs7Pj47Pjs7Pjs+Pjt0PDtsPGk8MD47aTwxPjtpPDI+O2k8Mz47aTw0PjtpPDU+Oz47bDx0PHA8cDxsPFRleHQ7PjtsPCgyMDEzLTIwMTQtMSktMDYxQjAyNDAtMDA5NTE5MS0zOz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDzlpKflrabniannkIblrp7pqow7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPDgxOz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDwxLjU7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPDMuNjA7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPCZuYnNwXDs7Pj47Pjs7Pjs+Pjt0PDtsPGk8MD47aTwxPjtpPDI+O2k8Mz47aTw0PjtpPDU+Oz47bDx0PHA8cDxsPFRleHQ7PjtsPCgyMDEzLTIwMTQtMSktMDYxQjkwOTAtMDA4NjIxMS0yOz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDzmpoLnjoforrrkuI7mlbDnkIbnu5/orqE7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPDcwOz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDwyLjU7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPDIuNTA7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPCZuYnNwXDs7Pj47Pjs7Pjs+Pjt0PDtsPGk8MD47aTwxPjtpPDI+O2k8Mz47aTw0PjtpPDU+Oz47bDx0PHA8cDxsPFRleHQ7PjtsPCgyMDEzLTIwMTQtMSktMDgxQzAyNTEtMDA4OTA5OC0xMDs+Pjs+Ozs+O3Q8cDxwPGw8VGV4dDs+O2w85bel56iL6K6t57uDOz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDw3NTs+Pjs+Ozs+O3Q8cDxwPGw8VGV4dDs+O2w8MS41Oz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDwzOz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDwmbmJzcFw7Oz4+Oz47Oz47Pj47dDw7bDxpPDA+O2k8MT47aTwyPjtpPDM+O2k8ND47aTw1Pjs+O2w8dDxwPHA8bDxUZXh0Oz47bDwoMjAxMy0yMDE0LTEpLTIxMTIwNDkwLTAwOTcyMDQtMTs+Pjs+Ozs+O3Q8cDxwPGw8VGV4dDs+O2w86auY57qn5pWw5o2u57uT5p6E5LiO566X5rOV5YiG5p6QOz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDw5MDs+Pjs+Ozs+O3Q8cDxwPGw8VGV4dDs+O2w8MS41Oz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDw0LjUwOz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDwmbmJzcFw7Oz4+Oz47Oz47Pj47dDw7bDxpPDA+O2k8MT47aTwyPjtpPDM+O2k8ND47aTw1Pjs+O2w8dDxwPHA8bDxUZXh0Oz47bDwoMjAxMy0yMDE0LTEpLTIxMUMwMDIwLTAwOTYyMDUtMTs+Pjs+Ozs+O3Q8cDxwPGw8VGV4dDs+O2w85pWw5o2u57uT5p6E5Z+656GAOz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDw4ODs+Pjs+Ozs+O3Q8cDxwPGw8VGV4dDs+O2w8Mi41Oz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDw0LjMwOz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDwmbmJzcFw7Oz4+Oz47Oz47Pj47dDw7bDxpPDA+O2k8MT47aTwyPjtpPDM+O2k8ND47aTw1Pjs+O2w8dDxwPHA8bDxUZXh0Oz47bDwoMjAxMy0yMDE0LTEpLTIxMUMwMDQxLTAwMDkxMDAtMTs+Pjs+Ozs+O3Q8cDxwPGw8VGV4dDs+O2w86YC76L6R5LiO6K6h566X5py66K6+6K6h5Z+656GAOz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDw3Mjs+Pjs+Ozs+O3Q8cDxwPGw8VGV4dDs+O2w8NC4wOz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDwyLjcwOz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDwmbmJzcFw7Oz4+Oz47Oz47Pj47dDw7bDxpPDA+O2k8MT47aTwyPjtpPDM+O2k8ND47aTw1Pjs+O2w8dDxwPHA8bDxUZXh0Oz47bDwoMjAxMy0yMDE0LTEpLTIyMTg4MDMwLTAwOTczNDItMTs+Pjs+Ozs+O3Q8cDxwPGw8VGV4dDs+O2w86K++56iL57u85ZCI5a6e6Le14oWgOz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDw2ODs+Pjs+Ozs+O3Q8cDxwPGw8VGV4dDs+O2w8Mi4wOz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDwyLjMwOz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDwmbmJzcFw7Oz4+Oz47Oz47Pj47dDw7bDxpPDA+O2k8MT47aTwyPjtpPDM+O2k8ND47aTw1Pjs+O2w8dDxwPHA8bDxUZXh0Oz47bDwoMjAxMy0yMDE0LTEpLTI0MVMwMDQwLTAwMDMzMjAtMTs+Pjs+Ozs+O3Q8cDxwPGw8VGV4dDs+O2w85Lq657G75a2m5a+86K66Oz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDzkuK3nrYk7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPDQuMDs+Pjs+Ozs+O3Q8cDxwPGw8VGV4dDs+O2w8Mi41MDs+Pjs+Ozs+O3Q8cDxwPGw8VGV4dDs+O2w8Jm5ic3BcOzs+Pjs+Ozs+Oz4+O3Q8O2w8aTwwPjtpPDE+O2k8Mj47aTwzPjtpPDQ+O2k8NT47PjtsPHQ8cDxwPGw8VGV4dDs+O2w8KDIwMTMtMjAxNC0xKS00MDEwMDMwMC0wMDk5MTg4LTE7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPOi2s+eQgyjliJ3nuqfnj63vvIk7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPDg2Oz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDwxLjA7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPDQuMTA7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPCZuYnNwXDs7Pj47Pjs7Pjs+Pjt0PDtsPGk8MD47aTwxPjtpPDI+O2k8Mz47aTw0PjtpPDU+Oz47bDx0PHA8cDxsPFRleHQ7PjtsPCgyMDEzLTIwMTQtMiktMDIxTDAwMjAtMDA5MjU1OS0xOz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDzms5Xlrabln7rnoYA7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPDg0Oz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDwxLjU7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPDMuOTA7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPCZuYnNwXDs7Pj47Pjs7Pjs+Pjt0PDtsPGk8MD47aTwxPjtpPDI+O2k8Mz47aTw0PjtpPDU+Oz47bDx0PHA8cDxsPFRleHQ7PjtsPCgyMDEzLTIwMTQtMiktMDYxQjAxNjAtMDA5MTMxMC0xOz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDzpmo/mnLrov4fnqIs7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPDg3Oz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDwxLjU7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPDQuMjA7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPCZuYnNwXDs7Pj47Pjs7Pjs+Pjt0PDtsPGk8MD47aTwxPjtpPDI+O2k8Mz47aTw0PjtpPDU+Oz47bDx0PHA8cDxsPFRleHQ7PjtsPCgyMDEzLTIwMTQtMiktMDkxSzAwMzAtMDA4NjE5Mi0xOz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDznurPnsbPnp5HlrabmioDmnK/mpoLorro7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPDg4Oz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDwxLjU7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPDQuMzA7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPCZuYnNwXDs7Pj47Pjs7Pjs+Pjt0PDtsPGk8MD47aTwxPjtpPDI+O2k8Mz47aTw0PjtpPDU+Oz47bDx0PHA8cDxsPFRleHQ7PjtsPCgyMDEzLTIwMTQtMiktMTExTTAxMDAtMDA4NTMwNi0xOz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDzmlbDlrZfnlLXop4bln7rnoYDkuI7mo4DmtYs7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPDg5Oz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDwxLjU7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPDQuNDA7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPCZuYnNwXDs7Pj47Pjs7Pjs+Pjt0PDtsPGk8MD47aTwxPjtpPDI+O2k8Mz47aTw0PjtpPDU+Oz47bDx0PHA8cDxsPFRleHQ7PjtsPCgyMDEzLTIwMTQtMiktMTMxSzAwMjAtMDAxMDE0MS0xOz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDznjrDku6Ppo5/lk4Hlronlhajnp5HlraY7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPDg2Oz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDwxLjU7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPDQuMTA7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPCZuYnNwXDs7Pj47Pjs7Pjs+Pjt0PDtsPGk8MD47aTwxPjtpPDI+O2k8Mz47aTw0PjtpPDU+Oz47bDx0PHA8cDxsPFRleHQ7PjtsPCgyMDEzLTIwMTQtMiktMTYxSzAwNDAtMDA4MjAwNS0xOz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDznjrDku6PpgZfkvKDlrabmpoLorro7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPDg4Oz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDwxLjU7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPDQuMzA7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPCZuYnNwXDs7Pj47Pjs7Pjs+Pjt0PDtsPGk8MD47aTwxPjtpPDI+O2k8Mz47aTw0PjtpPDU+Oz47bDx0PHA8cDxsPFRleHQ7PjtsPCgyMDEzLTIwMTQtMiktMjExODYwMzMtMDA5NzM0Mi0xOz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDzorqHnrpfmnLrnu4TmiJA7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPDg0Oz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDw0LjU7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPDMuOTA7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPCZuYnNwXDs7Pj47Pjs7Pjs+Pjt0PDtsPGk8MD47aTwxPjtpPDI+O2k8Mz47aTw0PjtpPDU+Oz47bDx0PHA8cDxsPFRleHQ7PjtsPCgyMDEzLTIwMTQtMiktMjExQzAwMTAtMDA5NTEyNC0xOz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDzpnaLlkJHlr7nosaHnqIvluo/orr7orqE7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPDg3Oz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDwyLjU7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPDQuMjA7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPCZuYnNwXDs7Pj47Pjs7Pjs+Pjt0PDtsPGk8MD47aTwxPjtpPDI+O2k8Mz47aTw0PjtpPDU+Oz47bDx0PHA8cDxsPFRleHQ7PjtsPCgyMDEzLTIwMTQtMiktMjExQzAwMzAtMDA5NTA0NC0xOz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDzmlbDmja7lupPns7vnu5/ljp/nkIY7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPDkzOz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDwyLjU7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPDQuODA7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPCZuYnNwXDs7Pj47Pjs7Pjs+Pjt0PDtsPGk8MD47aTwxPjtpPDI+O2k8Mz47aTw0PjtpPDU+Oz47bDx0PHA8cDxsPFRleHQ7PjtsPCgyMDEzLTIwMTQtMiktMjExRzAwODAtMDA5MTM0MC0xOz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDzmsYfnvJbor63oqIDnqIvluo/orr7orqHln7rnoYA7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPDkwOz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDwyLjA7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPDQuNTA7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPCZuYnNwXDs7Pj47Pjs7Pjs+Pjt0PDtsPGk8MD47aTwxPjtpPDI+O2k8Mz47aTw0PjtpPDU+Oz47bDx0PHA8cDxsPFRleHQ7PjtsPCgyMDEzLTIwMTQtMiktNDAxMDA0MDAtMDA5ODI4Ni0xOz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDznvZHnkIPvvIjliJ3nuqfnj63vvIk7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPDg3Oz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDwxLjA7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPDQuMjA7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPCZuYnNwXDs7Pj47Pjs7Pjs+Pjt0PDtsPGk8MD47aTwxPjtpPDI+O2k8Mz47aTw0PjtpPDU+Oz47bDx0PHA8cDxsPFRleHQ7PjtsPCgyMDE0LTIwMTUtMSktMjExMjAwNTAtMDA5MjAzMS0xOz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDzmk43kvZzns7vnu5/ljp/nkIY7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPDc3Oz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDwzLjA7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPDMuMjA7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPCZuYnNwXDs7Pj47Pjs7Pjs+Pjt0PDtsPGk8MD47aTwxPjtpPDI+O2k8Mz47aTw0PjtpPDU+Oz47bDx0PHA8cDxsPFRleHQ7PjtsPCgyMDE0LTIwMTUtMSktMjExMjAzMDItMDA5ODExMi0xOz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDzmlbDmja7lupPns7vnu5/orr7orqE7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPDgwOz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDwyLjA7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPDMuNTA7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPCZuYnNwXDs7Pj47Pjs7Pjs+Pjt0PDtsPGk8MD47aTwxPjtpPDI+O2k8Mz47aTw0PjtpPDU+Oz47bDx0PHA8cDxsPFRleHQ7PjtsPCgyMDE0LTIwMTUtMSktMjExMjAzNjAtMDA4NjM5Mi0yOz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDzmk43kvZzns7vnu5/liIbmnpDlj4rlrp7pqow7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPDg2Oz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDwyLjA7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPDQuMTA7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPCZuYnNwXDs7Pj47Pjs7Pjs+Pjt0PDtsPGk8MD47aTwxPjtpPDI+O2k8Mz47aTw0PjtpPDU+Oz47bDx0PHA8cDxsPFRleHQ7PjtsPCgyMDE0LTIwMTUtMSktMjExMjA1MDEtMDA4OTIyNS0xOz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDzmsYfnvJbkuI7mjqXlj6M7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPDc5Oz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDwzLjA7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPDMuNDA7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPCZuYnNwXDs7Pj47Pjs7Pjs+Pjt0PDtsPGk8MD47aTwxPjtpPDI+O2k8Mz47aTw0PjtpPDU+Oz47bDx0PHA8cDxsPFRleHQ7PjtsPCgyMDE0LTIwMTUtMSktMjExMjA1MTAtMDAwMzQxNS0xOz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDzorqHnrpfmnLrlm77lvaLlraY7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPDkwOz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDwyLjU7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPDQuNTA7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPCZuYnNwXDs7Pj47Pjs7Pjs+Pjt0PDtsPGk8MD47aTwxPjtpPDI+O2k8Mz47aTw0PjtpPDU+Oz47bDx0PHA8cDxsPFRleHQ7PjtsPCgyMDE0LTIwMTUtMSktMjExMjA1MjAtMDA5NjM2NC0xOz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDzorqHnrpfnkIborro7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPDg1Oz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDwyLjA7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPDQ7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPCZuYnNwXDs7Pj47Pjs7Pjs+Pjt0PDtsPGk8MD47aTwxPjtpPDI+O2k8Mz47aTw0PjtpPDU+Oz47bDx0PHA8cDxsPFRleHQ7PjtsPCgyMDE0LTIwMTUtMSktMjExMjExNjAtMDA5NzM0Mi0xOz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDxKYXZh5bqU55So5oqA5pyvOz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDw3Njs+Pjs+Ozs+O3Q8cDxwPGw8VGV4dDs+O2w8Mi41Oz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDwzLjEwOz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDwmbmJzcFw7Oz4+Oz47Oz47Pj47dDw7bDxpPDA+O2k8MT47aTwyPjtpPDM+O2k8ND47aTw1Pjs+O2w8dDxwPHA8bDxUZXh0Oz47bDwoMjAxNC0yMDE1LTEpLTIxMTIxMTkwLTAwMDQyMDItMTs+Pjs+Ozs+O3Q8cDxwPGw8VGV4dDs+O2w855S15a2Q5ZWG5Yqh57O757uf57uT5p6EOz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDw2Nzs+Pjs+Ozs+O3Q8cDxwPGw8VGV4dDs+O2w8Mi41Oz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDwyLjIwOz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDwmbmJzcFw7Oz4+Oz47Oz47Pj47dDw7bDxpPDA+O2k8MT47aTwyPjtpPDM+O2k8ND47aTw1Pjs+O2w8dDxwPHA8bDxUZXh0Oz47bDwoMjAxNC0yMDE1LTEpLTIxMTIxMjMwLTAwMDYyOTItMTs+Pjs+Ozs+O3Q8cDxwPGw8VGV4dDs+O2w85pm66IO957uI56uv6L2v5Lu25byA5Y+ROz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDw4Nzs+Pjs+Ozs+O3Q8cDxwPGw8VGV4dDs+O2w8Mi4wOz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDw0LjIwOz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDwmbmJzcFw7Oz4+Oz47Oz47Pj47dDw7bDxpPDA+O2k8MT47aTwyPjtpPDM+O2k8ND47aTw1Pjs+O2w8dDxwPHA8bDxUZXh0Oz47bDwoMjAxNC0yMDE1LTEpLTIxMTkwMTYwLTAwOTczNDItMTs+Pjs+Ozs+O3Q8cDxwPGw8VGV4dDs+O2w85L+h5oGv57O757uf5a6J5YWoOz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDw4ODs+Pjs+Ozs+O3Q8cDxwPGw8VGV4dDs+O2w8Mi41Oz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDw0LjMwOz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDwmbmJzcFw7Oz4+Oz47Oz47Pj47dDw7bDxpPDA+O2k8MT47aTwyPjtpPDM+O2k8ND47aTw1Pjs+O2w8dDxwPHA8bDxUZXh0Oz47bDwoMjAxNC0yMDE1LTEpLTIxMTkxMDgwLTAwOTUzNTUtMTs+Pjs+Ozs+O3Q8cDxwPGw8VGV4dDs+O2w85o6l5Y+j5a6e6aqMOz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDw4ODs+Pjs+Ozs+O3Q8cDxwPGw8VGV4dDs+O2w8MS41Oz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDw0LjMwOz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDwmbmJzcFw7Oz4+Oz47Oz47Pj47dDw7bDxpPDA+O2k8MT47aTwyPjtpPDM+O2k8ND47aTw1Pjs+O2w8dDxwPHA8bDxUZXh0Oz47bDwoMjAxNC0yMDE1LTEpLTIxMTkxNDgwLTAwMDQyOTItMTs+Pjs+Ozs+O3Q8cDxwPGw8VGV4dDs+O2w8546w5Luj5a2Y5YKo5oqA5pyv5Z+656GAOz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDw5MTs+Pjs+Ozs+O3Q8cDxwPGw8VGV4dDs+O2w8MS41Oz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDw0LjYwOz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDwmbmJzcFw7Oz4+Oz47Oz47Pj47dDw7bDxpPDA+O2k8MT47aTwyPjtpPDM+O2k8ND47aTw1Pjs+O2w8dDxwPHA8bDxUZXh0Oz47bDwoMjAxNC0yMDE1LTEpLTIyMTg4MDQwLTAwODYzOTItMTs+Pjs+Ozs+O3Q8cDxwPGw8VGV4dDs+O2w86K++56iL57u85ZCI5a6e6Le14oWhOz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDw5MDs+Pjs+Ozs+O3Q8cDxwPGw8VGV4dDs+O2w8Mi4wOz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDw0LjUwOz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDwmbmJzcFw7Oz4+Oz47Oz47Pj47Pj47Pj47dDxAMDw7Ozs7Ozs7Ozs7Pjs7Pjt0PEAwPDs7Ozs7Ozs7Ozs+Ozs+O3Q8cDxwPGw8VGV4dDs+O2w8WkpEWDs+Pjs+Ozs+O3Q8cDxwPGw8SW1hZ2VVcmw7PjtsPC4vdHBtbC85NzA1MjcuanBnOz4+Oz47Oz47Pj47Pj47PlyjjYN+VvvNFM73axYSDofkInIO',
				'ddlXN'=>'',
				'ddlXQ'=>'',
				'txtQSCJ'=>'',
				'txtZZCJ'=>'',
				'Button2'=>'��Уѧϰ�ɼ���ѯ'
						);
		curl_setopt($curl, CURLOPT_URL, 'http://jwbinfosys.zju.edu.cn/xscj.aspx?xh='.$this->stuid);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_COOKIEFILE, $this->cookie_jar);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $FormVal);
		curl_setopt($curl, CURLOPT_HEADER, 0);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		$data = curl_exec($curl);
		curl_close($curl);
		$iferr = strstr($data, 'Object');
		if ($iferr)
			throw new Exception('User or Password is wrong');
		$data = preg_split('/\r\n/', $data);
		$data = preg_grep("/\(20/i", $data);

		foreach ($data as $h=>$v){
			//change the code from gbk to utf-8
			$v =  iconv('gbk', 'utf-8', $v);
				
			preg_match_all('/(?:<td>).*?<\/td>/i', $v, $ans2);
			//get course grade
			$grade = $ans2[0][2];
			$grade = preg_replace('/<td>/', '', $grade);
			$grade = preg_replace('/<\/td>/', '', $grade);
			if ($grade == iconv('gbk','utf-8','����')) $grade = '90';
			else if ($grade == iconv('gbk','utf-8','����')) $grade = '80';
			else if ($grade == iconv('gbk','utf-8','�е�')) $grade = '70';
			else if ($grade == iconv('gbk','utf-8','����')) $grade = '60';
			else if ($grade == iconv('gbk','utf-8','������')) $grade = '0';
			if (intval($grade)<60) continue;
			//echo $grade;
			//course name
			$course = $ans2[0][1];
			$course = preg_replace('/<td>/', '', $course);
			$course = preg_replace('/<\/td>/', '', $course);
			//echo $course;
			array_push($this->course_name, $course);
			//course id
			preg_match('/\w{8}/i', $v, $ans);
			//echo $ans[0];
			array_push($this->course_code, $ans[0]);
		}
		insertCourse($stu, $this->course_code);
	}

	public function getCourseCode(){
		return $this->course_code;
	}

	public function getCourseName(){
		return $this->course_name;
	}
	private $stuid;
	private $cookie_jar;
	private $course_name;
	private $course_code;
}
?>