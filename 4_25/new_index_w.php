<?php
	session_start();
	if (!isset($_SESSION["username"])){
		header('location: login.php');
		exit;
	}	

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>课程信息</title>
<style type="text/css">
p,h2,h3{margin:0;padding:0;}
select{
	margin:5px;
	width:100px;
	height:30px;
	font-family:微软雅黑;
	font-size:15px;
}
input
{
	font-family:微软雅黑;
	font-size:15px;
}
div{margin-bottom:5px; margin-top:5px; margin-left:5px; margin-right:5px;}
#header
{
	width:700px;
	height:100px;
/*	border:thin #0F0 solid;  */
}
#main
{
	width:700px;
	height:350px;
/*	border:thin #F00 solid;  */
}
#all
{
	margin-left:100px;
	margin-top:50px;
	width:700px;
/*	background-image:url(sel-back1.jpg);  */
	background-repeat:no-repeat;
	background-size:auto;
	background-size:contain;
	background-position:center top;
}
#logo
{
	position:relative;
	left:15px;
	top:0px;
}
#usage
{
	position:relative;
	left:30px;
	top:10px;
}
.f
{
	margin:10px;
}
#Button5
{
	width:100px;
	height:30px;
	margin-left:10px;
	margin-top:15px;
}
.row1
{
	height:30px;
	background-color:#d4e3e5;
}
.row2
{
	height:30px;
}
.col
{
	text-align:center;
}
</style>
<script language="javascript">
function AddClass(obj)
{
	var rowIndex = obj.parentNode.parentNode.rowIndex;
	var tb = document.getElementById("ssjg");
	var className = tb.rows[rowIndex].cells[2].innerHTML;
	var class_no = tb.rows[rowIndex].cells[1].textContent;
	var class_add = document.getElementById("class_add");
	var total = className+ ";" + class_no + ";";
	var string = class_add.value;
	var repetition = false;
	while(string != "")
	{
		var n1 = string.indexOf(";");
		string = string.substr(n1+1);
		n1 = string.indexOf(";");
		var str2 = string.slice(0,n1);
		if(str2 == class_no)
		{
			repetition = true;
			break;
		}
	}
	if(repetition == false)
		class_add.value += total;
	else
	{
		alert("你已经添加了这门课！");
	}
}

function scrollwindow()
{
	window.scroll(0,250);
	Chose(document.getElementById('Dropdownlist1'));
	Chose( document.getElementById('Dropdownlist2'));
}

function Chose(obj)
{
	  var str=obj.id;
	 // alert(str);
	 
	
	  //alert( document.getElementById("DropDownList1").value);
	  if (str=="DropDownList1")
	  {
		  
			if ( document.getElementById("DropDownList1").value=="sksj")
			{
				document.getElementById("Db_xqj1").style.display="inline";
			}
			else
			{
				document.getElementById("Db_xqj1").style.display="none";
			}
			if ( document.getElementById("DropDownList1").value=="kclb")
			{
				document.getElementById("Db_kclb1").style.display="inline";
			}
			else
			{
				document.getElementById("Db_kclb1").style.display="none";
			}
			if ( document.getElementById("DropDownList1").value=="kcmc")
			{
				document.getElementById("Db_kcmc1").style.display="inline";
			}
			else
			{
				document.getElementById("Db_kcmc1").style.display="none";
			}				        
	  } 
	  else 
	  {
			if ( document.getElementById("DropDownList2").value=="sksj")
			{
				document.getElementById("Db_xqj2").style.display="inline";
			}
			else
			{
				document.getElementById("Db_xqj2").style.display="none";
			}
			if ( document.getElementById("DropDownList2").value=="kclb")
			{
				document.getElementById("Db_kclb2").style.display="inline";
			}
			else
			{
				document.getElementById("Db_kclb2").style.display="none";
			}
			if ( document.getElementById("DropDownList2").value=="kcmc")
			{
				document.getElementById("Db_kcmc2").style.display="inline";
			}
			else
			{
				document.getElementById("Db_kcmc2").style.display="none";
			}
	  }
	  
}
function ChoseChange(obj)
{
	  var str=obj.id;
	 // alert(str);
	 // alert( document.getElementById(str).value);
	 if ((str=="xqj1")||(str=="sjd1")||(str=="kclb1")||(str=="kcmc1"))
	 {
		if ((str=="xqj1")||(str=="kclb1")||(str=="kcmc1"))
		{
			document.getElementById("TextBox1").value=document.getElementById(str).value;
		}
		else
		{
			document.getElementById("TextBox1").value=document.getElementById("xqj1").value + document.getElementById(str).value;
		}
		
	 }
	 else
	 {
		if ((str=="xqj2")||(str=="kclb2"))
		{
			document.getElementById("TextBox2").value=document.getElementById(str).value;
		}
		else
		{
			document.getElementById("TextBox2").value=document.getElementById("xqj2").value + document.getElementById(str).value;
		}
	 }
	  
}
function altRows(id){
	if(document.getElementsByTagName){  
		
		var table = document.getElementById(id);  
		var rows = table.getElementsByTagName("tr"); 
		 
		for(i = 0; i < rows.length; i++){          
			if(i % 2 == 0){
				rows[i].className = "row1";
			}else{
				rows[i].className = "row2";
			}      
		}
	}
}
window.location.onload=function(){
	alert("yes");
	altRows('ssjg');
}
</script>
</head>
<body onload="scrollwindow()" style="background-image:url(330282.jpg);background-attachment:fixed;">
  <div id="all">
     <div id="header">
        <a href="http://jwbinfosys.zju.edu.cn/" id="logo"><img  src="icon2.png"/></a>
        <img src="text2.png" id="usage" />
     </div>
     
     <div id="main">
	    <form action="new_index_w.php" method="post" style="font-family:幼圆">
              <select name="DropDownList1" id="DropDownList1" onchange="Chose(this);" style="width:100px;" class="f">
                    <option value="kcdm">课程代码</option>
                    <option selected="selected" value="kcmc">课程名称</option>
                    <option value="jsxm">教师姓名</option>
                    <option value="kclb">课程类别</option>
                    <option value="sksj">上课时间</option>
                    <option value="skdd">上课地点</option>
                    <option value="xxq">学期</option>
              </select>
           <select name="Dropdownlist_gx1" id="Dropdownlist_gx1" style="width:100px;" class="f">
                    <option value=""></option>
                    <option selected="selected" value="like">包含</option>
                    <option value="notlike">不包含</option>
                    <option value="=">等于</option>
                    <option value="<>">不等于</option>
                    <option value="leftlike">始于</option>
                    <option value="notleftlike">并非起始于</option>
                    <option value="rightlike">止于</option>
                    <option value="notrightlike">并非结束于</option>
			</select>
            <input name="TextBox1" type="text" id="TextBox1" style="width:150px; line-height:25px;" 
             <?php
             	if(!empty($_POST['TextBox1']))
             		echo "value=\"" . $_POST['TextBox1'] . "\" />";
             	else
             		echo " />"; 
             ?>
            <div id="Db_xqj1" style="DISPLAY:none; width:100px;">
                <SELECT id="xqj1" onchange="ChoseChange(this);" class="f">
                    <OPTION selected></OPTION>
                    <OPTION value="星期一">星期一</OPTION>
                    <OPTION value="星期二">星期二</OPTION>
                    <OPTION value="星期三">星期三</OPTION>
                    <OPTION value="星期四">星期四</OPTION>
                    <OPTION value="星期五">星期五</OPTION>
                    <OPTION value="星期六">星期六</OPTION>
                    <OPTION value="星期日">星期日</OPTION>
                </SELECT>
                <SELECT id="sjd1" onchange="ChoseChange(this);" class="f">
                    <OPTION selected></OPTION>
                    <OPTION value="第1,2节">第1,2节</OPTION>
                    <OPTION value="第3,4,5节">第3,4,5节</OPTION>
                    <OPTION value="第6,7,8节">第6,7,8节</OPTION>
                    <OPTION value="第7,8节">第7,8节</OPTION>
                    <OPTION value="第9,10节">第9,10节</OPTION>
                    <OPTION value="第11,12,13节">第11,12,13节</OPTION>
                </SELECT>
           </div>
           <div id="Db_kclb1" style="DISPLAY:none; width:100px;">
                <SELECT id="kclb1" onchange="ChoseChange(this);" class="f">
                    <OPTION selected></OPTION>
                    <OPTION value="通识">通识</OPTION>
                    <OPTION value="大类">大类</OPTION>
                    <OPTION value="大类中的人文社科类">大类中的人文社科类</OPTION>
                    <OPTION value="大类中的自然科学类">大类中的自然科学类</OPTION>
                    <OPTION value="大类中的工程技术类">大类中的工程技术类</OPTION>
                    <OPTION value="大类中的艺术设计类">大类中的艺术设计类</OPTION>
                    <OPTION value="通识中的思政类\军体类">通识中的思政类\军体类</OPTION>
                    <OPTION value="通识中的外语类">通识中的外语类</OPTION>
                    <OPTION value="通识中的计算机类">通识中的计算机类</OPTION>
                    <OPTION value="通识中的历史与文化类">通识中的历史与文化类</OPTION>
                    <OPTION value="通识中的文学与艺术类">通识中的文学与艺术类</OPTION>
                    <OPTION value="通识中的沟通与领导类">通识中的沟通与领导类</OPTION>
                    <OPTION value="通识中的科学与研究类">通识中的科学与研究类</OPTION>
                    <OPTION value="通识中的经济与社会类">通识中的经济与社会类</OPTION>
                    <OPTION value="通识中的技术与设计类">通识中的技术与设计类</OPTION>
                    <OPTION value="通识中的竺可桢学院">通识中的竺可桢学院</OPTION>
                </SELECT>
           </div>
		   <div id="Db_kcmc1" style="DISPLAY:none">
				<select name="kcmc1" id="kcmc1" onchange="ChoseChange(this);" class="f"></select>
		   </div>
           <p>
               <input id="RadioButtonList1_0" type="radio" name="RadioButtonList1" value="and" checked="checked" style="margin-left:10px; margin-top:10px; margin-bottom:10px;"/>
               <label for="RadioButtonList1_0">与</label>
               <input id="RadioButtonList1_1" type="radio" name="RadioButtonList1" value="or" />
               <label for="RadioButtonList1_1">或</label>
           </p>
           <select name="DropDownList2" id="DropDownList2" onchange="Chose(this);" style="width:100px;" class="f">
                    <option value="kcdm">课程代码</option>
                    <option selected="selected" value="kcmc">课程名称</option>
                    <option value="jsxm">教师姓名</option>
                    <option value="kclb">课程类别</option>
                    <option value="sksj">上课时间</option>
                    <option value="skdd">上课地点</option>
                    <option value="xxq">学期</option>
              </select>
           <select name="Dropdownlist_g21" id="Dropdownlist_gx2" style="width:100px;" class="f">
                    <option value=""></option>
                    <option selected="selected" value="like">包含</option>
                    <option value="notlike">不包含</option>
                    <option value="=">等于</option>
                    <option value="<>">不等于</option>
                    <option value="leftlike">始于</option>
                    <option value="notleftlike">并非起始于</option>
                    <option value="rightlike">止于</option>
                    <option value="notrightlike">并非结束于</option>
			</select>
           <input name="TextBox2" type="text" id="TextBox2" style="width:150px; line-height:25px;" 
           <?php
             	if(!empty($_POST['TextBox2']))
             		echo "value=\"" . $_POST['TextBox2'] . "\" />";
             	else
             		echo " />"; 
             ?>
           <div id="Db_xqj2" style="DISPLAY:none">
                <SELECT id="xqj2" onchange="ChoseChange(this);" class="f">
                    <OPTION selected></OPTION>
                    <OPTION value="星期一">星期一</OPTION>
                    <OPTION value="星期二">星期二</OPTION>
                    <OPTION value="星期三">星期三</OPTION>
                    <OPTION value="星期四">星期四</OPTION>
                    <OPTION value="星期五">星期五</OPTION>
                    <OPTION value="星期六">星期六</OPTION>
                    <OPTION value="星期日">星期日</OPTION>
                </SELECT>
                <SELECT id="sjd2" onchange="ChoseChange(this);" class="f">
                    <OPTION selected></OPTION>
                    <OPTION value="第1,2节">第1,2节</OPTION>
                    <OPTION value="第3,4,5节">第3,4,5节</OPTION>
                    <OPTION value="第6,7,8节">第6,7,8节</OPTION>
                    <OPTION value="第7,8节">第7,8节</OPTION>
                    <OPTION value="第9,10节">第9,10节</OPTION>
                    <OPTION value="第11,12,13节">第11,12,13节</OPTION>
                </SELECT>
            </div>
            <div id="Db_kclb2" style="DISPLAY:none">
                <SELECT id="kclb2" onchange="ChoseChange(this);" class="f">
                    <OPTION selected></OPTION>
                    <OPTION value="通识">通识</OPTION>
                    <OPTION value="大类">大类</OPTION>
                    <OPTION value="大类中的人文社科类">大类中的人文社科类</OPTION>
                    <OPTION value="大类中的自然科学类">大类中的自然科学类</OPTION>
                    <OPTION value="大类中的工程技术类">大类中的工程技术类</OPTION>
                    <OPTION value="大类中的艺术设计类">大类中的艺术设计类</OPTION>
                    <OPTION value="通识中的思政类\军体类">通识中的思政类\军体类</OPTION>
                    <OPTION value="通识中的外语类">通识中的外语类</OPTION>
                    <OPTION value="通识中的计算机类">通识中的计算机类</OPTION>
                    <OPTION value="通识中的历史与文化类">通识中的历史与文化类</OPTION>
                    <OPTION value="通识中的文学与艺术类">通识中的文学与艺术类</OPTION>
                    <OPTION value="通识中的沟通与领导类">通识中的沟通与领导类</OPTION>
                    <OPTION value="通识中的科学与研究类">通识中的科学与研究类</OPTION>
                    <OPTION value="通识中的经济与社会类">通识中的经济与社会类</OPTION>
                    <OPTION value="通识中的技术与设计类">通识中的技术与设计类</OPTION>
                    <OPTION value="通识中的竺可桢学院">通识中的竺可桢学院</OPTION>
                </SELECT>
            </div>
            <div id="Db_kcmc2" style="DISPLAY:none">
				<select name="kcmc2" id="kcmc2" onchange="ChoseChange(this);" class="f"></select>
	        </div>
           <p>
	           	<input type="submit" name="Button5" value="查询教学班" id="Button5" />
	           	&nbsp;&nbsp;
	           	<input type="submit" name="generate" value="生成推荐课表" id="generate" />
	           	&nbsp;&nbsp;
	           	<span>请先添加必选课程（可选），再点击"生成推荐课表"</span>
	           	<?php
	           	echo '<div style="margin-left:10p;width:700px;margin-top:10px" >
					  <table  width="600px" bordercolor=“#00FFFF" border="1" cellspacing="0px">
					  <thead>
					  		<tr style="background-color:#d4e3e5;">
					  			<td colspan="2" align="center">待选课程</td>
					  		</tr>
					  </thead>';
				require('CheckCourse.php');
				$ckcs = new CheckCourse();
				$uname = $_SESSION['username'];
				$ckcs->check($uname);
				
				echo '<tr  style="background-color:#d4e3e5;">
						 <td align="center">未选必修课代码</td>
						 <td align="center">课程名称</td>
					 </tr>';
				$reCoDmArr = $ckcs->getReCoDmArr();
				$reCoMcArr = $ckcs->getReCoMcArr();
				$SeLBMcArr = $ckcs->getSeLBMcArr();
				$SeXfNeedArr = $ckcs->getSeXfNeedArr();
				foreach($reCoDmArr as $h => $v){
					echo '<tr>';
					echo '<td align="center">'.$v.'</td>';
					echo '<td align="center">'.$reCoMcArr[$h].'</td>';
					echo '</tr>';
				}
				echo '<tr  style="background-color:#d4e3e5;">
						 <td align="center">培养方案模块</td>
						 <td align="center">未选课程信息</td>
					 </tr>';
				foreach ($SeLBMcArr as $h => $v){
					echo '<tr>';
					echo '<td align="center">'.$v.'</td>';
					echo '<td align="center">还差 '.$SeXfNeedArr[$h].' 分</td>';
					echo '</tr>';

				}
				echo '</table></div>'; 
				echo '<br/><br/>';
				echo '<div style="margin-left:10p;width:700px;margin-top:10px" >
					  <table  width="600px" bordercolor=“#00FFFF" border="1" cellspacing="0px">
					  <thead>
					  		<tr style="background-color:#d4e3e5;">
					  			<td colspan="2" align="center">已添加必选课程</td>
					  		</tr>
					  </thead>';
				echo '<tr style="background-color:#d4e3e5;">
						 <td align="center">课程名称</td>
						 <td align="center">课程代码</td>
					  </tr>';
				if(!empty($_POST['class_add']))
				{
					$cline = 0;
					$class_add_str = $_POST['class_add'];
					$CoCodeArr = array(); //course array to be managed
					while(!empty($class_add_str))
					{
						$n1 = strpos($class_add_str, ";");
						$str1 = substr($class_add_str, 0,$n1);
						$class_add_str = substr($class_add_str, $n1+1);
						$n1 = strpos($class_add_str,";");
						$str2 = substr($class_add_str, 0 , $n1);
						$class_add_str = substr($class_add_str, $n1+1);
						//if($cline % 2 == 0)
						//	echo '<tr class="row2">';
						//else
						//	echo '<tr class="row1">';
						echo '<tr>';
						echo '<td class="col">' . $str1 . '</td>';
						echo '<td class="col">' . $str2 . '</td>';
						echo '</tr>';
						array_push($CoCodeArr, $str2);
						//$cline++;
					}
					if (isset($_POST['generate'])){
						require_once('queryCourse.php');
						$allCourse = getAllCourse($CoCodeArr);
						$selCourseCode = getSelCourse($_SESSION['username']);
						$selCourse = getAllCourse($selCourseCode);
						print_r($allCourse);
						echo '<br>';
						print_r($selCourse);

						exit;
					}
				}
			    echo '</table></div>';
	           	?>
           </p>
 
           <?php
 //          include "CheckCourse.php";
		if ($_SERVER['REQUEST_METHOD'] == 'POST' ){
			if (!empty($_POST['TextBox1'])){
				require('../../mysqli_connect.php');
				$chose1 = $_POST['DropDownList1'];
				$chose2 = $_POST['DropDownList2'];
				if (empty($chose2))
					$q2 = ' 1 = 1 ';
				else{
					$safe_query = mysqli_real_escape_string($dbc, $_POST['TextBox2']);
					$q2 = "$chose2 like '%{$safe_query}%'";
				}
				if (empty($chose1))
					$q1 = ' 1 = 1 ';
				else{
					
					$safe_query = mysqli_real_escape_string($dbc, $_POST['TextBox1']);
					$q1 = "$chose1 like '%{$safe_query}%'";
				}
				$q = "SELECT * FROM CourseInfo WHERE $q1 and $q2 ;";
				$r = @mysqli_query ($dbc, $q);
				if ($r){
					echo '<div style="width:1000px; margin-left:-50px;">';
					echo '<br />';
					echo '<br  />';
					echo '<table border="1px" cellspacing="0" bordercolor="#6699FF" id="ssjg" style="font-family:微软雅黑;">';
					echo '<tr class="row1" style="font-weight:bold; background-color:#c3dde0;">
						<td class="col" width="80px">' . '教师姓名' . '</td>
						<td class="col" width="80px">' . '课程代码' . '</td>
						<td class="col" width="200px">' . '课程名称' . '</td>
						<td class="col" width="100px">' . '课程类别' . '</td>
						<td class="col" width="50px">' . '周学时' . '</td>
						<td class="col" width="50px">' . '学分' . '</td>
						<td class="col" width="150px">' . '上课时间' . '</td>
						<td class="col" width="200px">' . '上课地点' . '</td>
						<td class="col" width="50px">' . '学期' . '</td>
						<td class="col" width =100px">' . '添加' . '</td>
						</tr>';
					$line = 1;
					while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)){
						if ($line % 2 == 0)
							echo '<tr class="row1">';
						else echo '<tr class="row2">';
						$line = $line +1;
						echo '
						<td class="col">' . $row['jsxm'] . '</td>
						<td class="col">' . $row['kcdm'] . '</td>
						<td class="col">' . $row['kcmc'] . '</td>
						<td class="col">' . $row['kclb'] . '</td>
						<td class="col">' . $row['zxs'] . '</td>
						<td class="col">' . $row['xf'] . '</td>
						<td class="col">' . $row['sksj'] . '</td>
						<td class="col">' . $row['skdd'] . '</td>
						<td class="col">' . $row['xq'] . '</td>
						<td class="col">
						
								<input type="submit" name="add'. ($line-1) .'" id="add" value="添加" onclick="AddClass(this)"/>
						</td>
							
						</tr>';
					}
					echo '</table>';
					echo '</div>';
					mysqli_free_result($r);
				}
				mysqli_close($dbc);
			}else{
				echo "<h1>没有输入</h1>";
			}
		}
		echo '<input type="hidden" id="class_add" name="class_add" ';
		if(!empty($_POST['class_add']))
			echo 'value="' . $_POST['class_add'] . '" />';
		else
			echo " />";
	//	echo '<input type="hidden" id="scrollbar" name="scrollbar" ';
	?>
	</form>
     </div>
  </div>
</body>
</html>
