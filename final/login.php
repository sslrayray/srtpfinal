<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>注册界面</title>
<style type="text/css">
p,h2,h3,select{margin:0;padding:0;}
div{margin-bottom:10px;}
#totle
{
	width:700px;
/*	border:1px solid red;  */
	margin-left:100px; 
	margin-top:50px;
/*	background-image:url(bgimg1.jpg);  */
	background-repeat:no-repeat;
	background-position:center center;
	background-size:contain;
}
#header
{
	width:700px;
	height:100px;
/*	border:thin solid #0F0;   */
	margin-bottom:10px;
	position:relative;
}
#main
{
	
}
input
{
	margin-bottom:15px;
	width:200px;
	height:25px;
	font-size:14px;
	padding-left:4px;
}
input:focus
{
	margin-bottom:15px;
	width:200px;
	height:25px;
	font-size:14px;
	padding-left:4px;
	background-color:#eee;
}
form span
{
	line-height:25px;
/*	border:thin solid red;*/
	margin-left:5px;
	padding-left:30px;
}
select
{
	height:30px; 
	line-height:25px; 
	margin-bottom:15px;
}
select:focus
{
	height:30px; 
	line-height:25px; 
	margin-bottom:15px;
	background-color:#eee;
}
#reg
{
	width:102px;
	height:42px; 
	background-image:url(button.jpg); 
	position:relative; 
	left:100px;
	margin-top:10px;
}
#reg:hover
{
	width:102px;
	height:42px; 
	background-image:url(button-active.jpg); 
	position:relative; 
	left:100px;
	margin-top:10px;
}
#logo
{
	margin-left:30px;
	position:absolute;
	top:10px;
}
#welcome
{
	position:absolute;
	left:140px;
	top:15px;
}
</style>
</head>
<body style="background-image:url(330294.jpg);">
   <div id="totle">
       <div id="header">
          <a href="http://jwbinfosys.zju.edu.cn/default2.aspx" id="logo"><img src="icon2.png"/></a>
          <img src="text1.png" id="welcome" />
       </div>
       <div id="main">
         <form action="login.php" method="post">
             <p>
                 <span>学号：</span>
                 <input type="text" name="stu_no" id="stu_no"/>
             </p>
             <p>
             <span>专业：</span>
             <select name="专业" style="width:205px; ">
                <option value="计算机科学与技术" selected="selected">计算机科学与技术</option>
                <option value="软件工程">软件工程</option>
                <option value="信电系">信电系</option>
                <option value="控制系">控制系</option>
                <option value="光电系">光电系</option>
                <option value="生仪">生仪</option>
             </select>
             </p>
             <p>
                 <span>学年：</span>
                 <select name="年级" style="width:100px;">
                    <option value="大一">大一</option>
                    <option value="大二">大二</option>
                    <option value="大三" selected="selected">大三</option>
                    <option value="大四">大四</option>
                 </select>
                 <span style="padding-left:0;">学期：</span>
                 <select name="年级" style="width:100px;">
                    <option value="秋冬">秋冬</option>
                    <option value="春夏" selected="selected">春夏</option>
                 </select>
             </p>
             <p>	
                 <span>密码：</span>
                 <input type="password" name="password" id="password"/>
             </p>
             <input type="submit" id="reg" value="登陆"/>
          </form>
          <?php
	include_once "jwbManager.php"; //use to login jwb and fetch course
	if($_SERVER['REQUEST_METHOD'] == 'POST' )
	{
		if (!isset($_SESSION))
			session_start();

		if (!isset($_POST['stu_no']))
			echo 'fuck';
		if(empty($_POST['stu_no']))
		{
			echo '<script type="text/javascript">
					alert("请输入学号！");
				  </script>';
			exit;
		}	
		if(empty($_POST['password']))
		{
			echo '<script type="text/javascript">
					alert("请输入密码！");
				  </script>';
			exit;
		}
		$stu_no = $_POST['stu_no'];
		$passwd = $_POST['password'];
		$jwb = new jwbManager();
		try{
			$jwb->login($stu_no, $passwd);
			$_SESSION["username"] = $stu_no;
			header('location: new_index_w.php');
		}catch(Exception $e){
			echo 'Message: '.$e->getMessange();
			if (!isset($_SESSION))
				session_start();
			session_unset();
			session_destroy();
		}

	}
?>
       </div>
   </div>
</body>
</html>

