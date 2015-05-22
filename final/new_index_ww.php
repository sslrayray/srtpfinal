<?php
	session_start();
	if (!isset($_SESSION["username"])){
		header('location: login2.php');
		exit;
	}	

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!--
        ===
        This comment should NOT be removed.

        Charisma v2.0.0

        Copyright 2012-2014 Muhammad Usman
        Licensed under the Apache License v2.0
        http://www.apache.org/licenses/LICENSE-2.0

        http://usman.it
        http://twitter.com/halalit_usman
        ===
    -->
    <meta charset="utf-8">
    <title>课程检索</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Charisma, a fully featured, responsive, HTML5, Bootstrap admin template.">
    <meta name="author" content="Muhammad Usman">

    <!-- The styles -->
    <link id="bs-css" href="css/bootstrap-cerulean.min.css" rel="stylesheet">

    <link href="css/charisma-app.css" rel="stylesheet">
    <link href='bower_components/fullcalendar/dist/fullcalendar.css' rel='stylesheet'>
    <link href='bower_components/fullcalendar/dist/fullcalendar.print.css' rel='stylesheet' media='print'>
    <link href='bower_components/chosen/chosen.min.css' rel='stylesheet'>
    <link href='bower_components/colorbox/example3/colorbox.css' rel='stylesheet'>
    <link href='bower_components/responsive-tables/responsive-tables.css' rel='stylesheet'>
    <link href='bower_components/bootstrap-tour/build/css/bootstrap-tour.min.css' rel='stylesheet'>
    <link href='css/jquery.noty.css' rel='stylesheet'>
    <link href='css/noty_theme_default.css' rel='stylesheet'>
    <link href='css/elfinder.min.css' rel='stylesheet'>
    <link href='css/elfinder.theme.css' rel='stylesheet'>
    <link href='css/jquery.iphone.toggle.css' rel='stylesheet'>
    <link href='css/uploadify.css' rel='stylesheet'>
    <link href='css/animate.min.css' rel='stylesheet'>

    <!-- jQuery -->
    <script src="bower_components/jquery/jquery.min.js"></script>
    <!-- my javascript function -->
    <script src="wangliang.js"></script>

    <!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- The fav icon -->
    <link rel="shortcut icon" href="img/favicon.ico">


</head>

<body onload="scrollwindow()">
    <!-- topbar starts -->
    <div class="navbar navbar-default" role="navigation">

        <div class="navbar-inner">
            <button type="button" class="navbar-toggle pull-left animated flip">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.html"> <img alt="Charisma Logo" src="img/logo20.png" class="hidden-xs"/>
                <span>Charisma</span></a>

            <!-- user dropdown starts -->
            <div class="btn-group pull-right">
                <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    <i class="glyphicon glyphicon-user"></i><span class="hidden-sm hidden-xs"> admin</span>
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    <li><a href="#">Profile</a></li>
                    <li class="divider"></li>
                    <li><a href="login.html">Logout</a></li>
                </ul>
            </div>
            <!-- user dropdown ends -->

            <!-- theme selector starts -->
            <div class="btn-group pull-right theme-container animated tada">
                <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    <i class="glyphicon glyphicon-tint"></i><span
                        class="hidden-sm hidden-xs"> Change Theme / Skin</span>
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" id="themes">
                    <li><a data-value="classic" href="#"><i class="whitespace"></i> Classic</a></li>
                    <li><a data-value="cerulean" href="#"><i class="whitespace"></i> Cerulean</a></li>
                    <li><a data-value="cyborg" href="#"><i class="whitespace"></i> Cyborg</a></li>
                    <li><a data-value="simplex" href="#"><i class="whitespace"></i> Simplex</a></li>
                    <li><a data-value="darkly" href="#"><i class="whitespace"></i> Darkly</a></li>
                    <li><a data-value="lumen" href="#"><i class="whitespace"></i> Lumen</a></li>
                    <li><a data-value="slate" href="#"><i class="whitespace"></i> Slate</a></li>
                    <li><a data-value="spacelab" href="#"><i class="whitespace"></i> Spacelab</a></li>
                    <li><a data-value="united" href="#"><i class="whitespace"></i> United</a></li>
                </ul>
            </div>
            <!-- theme selector ends -->

            <ul class="collapse navbar-collapse nav navbar-nav top-menu">
                <li><a href="#"><i class="glyphicon glyphicon-globe"></i> Visit Site</a></li>
                <li class="dropdown">
                    <a href="#" data-toggle="dropdown"><i class="glyphicon glyphicon-star"></i> Dropdown <span
                            class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                        <li class="divider"></li>
                        <li><a href="#">One more separated link</a></li>
                    </ul>
                </li>
         
            </ul>

        </div>
    </div>
    <!-- topbar ends -->

<div class="ch-container">
    <div class="row">

        <noscript>
            <div class="alert alert-block col-md-12">
                <h4 class="alert-heading">Warning!</h4>

                <p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a>
                    enabled to use this site.</p>
            </div>
        </noscript>

        <div id="content" class="col-lg-10 col-sm-10">
            <!-- content starts -->
                <div>
        <ul class="breadcrumb">
            <li>
                课程检索
            </li>
	    <li>
		<a href="selecttag.php">标签推荐</a>
	    </li>
        </ul>
	
    </div>
	
	<!-- -->
    <div class="row">
        <div class="box col-md-6">
            <div class="box-inner">
                <div class="box-header well" data-original-title="">
                    <h2>待选课程</h2>

                    <div class="box-icon">
                        <a href="#" class="btn btn-setting btn-round btn-default"><i
                                class="glyphicon glyphicon-cog"></i></a>
                        <a href="#" class="btn btn-minimize btn-round btn-default"><i
                                class="glyphicon glyphicon-chevron-up"></i></a>
                        <a href="#" class="btn btn-close btn-round btn-default"><i
                                class="glyphicon glyphicon-remove"></i></a>
                    </div>
                </div>
                <div class="box-content">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>未选必修课程代码</th>
                            <th>课程名称</th>
                        </tr>
                        </thead>
                        <tbody>
			<?php
				require('CheckCourse.php');
				$ckcs = new CheckCourse();
				$uname = $_SESSION['username'];
				$ckcs->check($uname);
				$reCoDmArr = $ckcs->getReCoDmArr();
				$reCoMcArr = $ckcs->getReCoMcArr();
				$SeLBMcArr = $ckcs->getSeLBMcArr();
				$SeXfNeedArr = $ckcs->getSeXfNeedArr();
				foreach($reCoDmArr as $h => $v){
					echo '<tr>'."\n";
					echo '<td>'.$v.'</td>';
					echo '<td>'.$reCoMcArr[$h].'</td>';
					echo '</tr>';
				}

                        echo '</tbody>
                    </table>
                    <ul class="pagination pagination-centered">
                        <li><a href="#">上一页</a></li>
                        <li class="active">
                            <a href="#">1</a>
                        </li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">下一页</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!--/span-->

        <div class="box col-md-6">
            <div class="box-inner">
                <div class="box-header well" data-original-title="">
                    <h2>培养方案模块</h2>

                    <div class="box-icon">
                        <a href="#" class="btn btn-setting btn-round btn-default"><i
                                class="glyphicon glyphicon-cog"></i></a>
                        <a href="#" class="btn btn-minimize btn-round btn-default"><i
                                class="glyphicon glyphicon-chevron-up"></i></a>
                        <a href="#" class="btn btn-close btn-round btn-default"><i
                                class="glyphicon glyphicon-remove"></i></a>
                    </div>
                </div>
                <div class="box-content">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>模块名称</th>
                            <th>模块缺少学分</th>
                        </tr>
                        </thead>
                        <tbody>';

				foreach ($SeLBMcArr as $h => $v){
					echo '<tr>';
					echo '<td align="center">'.$v.'</td>';
					echo '<td align="center">还差 '.$SeXfNeedArr[$h].' 分</td>';
					echo '</tr>';

				}
			?>
                        </tbody>
                    </table>
                    <ul class="pagination pagination-centered">
                        <li><a href="#">上一页</a></li>
                        <li class="active">
                            <a href="#">1</a>
                        </li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">下一页</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!--/span-->

    </div><!--/row-->

    <div class="row">
<div class="box col-md-12">
            <div class="box-inner">
                <div class="box-header well" data-original-title="">
                    <h2>推荐通识课程</h2>

                    <div class="box-icon">
                        <a href="#" class="btn btn-setting btn-round btn-default"><i
                                class="glyphicon glyphicon-cog"></i></a>
                        <a href="#" class="btn btn-minimize btn-round btn-default"><i
                                class="glyphicon glyphicon-chevron-up"></i></a>
                        <a href="#" class="btn btn-close btn-round btn-default"><i
                                class="glyphicon glyphicon-remove"></i></a>
                    </div>
                </div>
                <div class="box-content">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>课程代码</th>
                            <th>课程名称</th>
			    <th>兴趣预测值</th>
                        </tr>
                        </thead>
                        <tbody>
			<?php
				require_once('CheckCourse.php');
				require_once('queryCourse.php');
				$recomCodeArr = array();
				$istag = false;
				if (isset($_SESSION["is_new"])){
					$tagArr = $_SESSION["is_new"];
					$recomCodeArr = getRecomCourseWithTag($tagArr);
					$istag = true;
//					print_r($tt);
				}else{
					$recomCodeAndSimiArr = getRecomCourse($_SESSION['username'], 5);
					$recomCodeArr = array_keys($recomCodeAndSimiArr);
				}
				$recomCourse = getAllCourse($recomCodeArr);
				foreach($recomCodeArr as $h => $v){
					echo '<tr>'."\n";
					echo '<td>'.$v.'</td>';
					echo '<td>'.$recomCourse[$h]->name.'</td>';
					if ($istag) 
						echo '<td>标签推荐</td>';
					else
						echo '<td>'.sprintf("%.2f",$recomCodeAndSimiArr[$v]).'</td>';					
					echo '</tr>';
					
				}

                        echo '</tbody>
                    </table>
                    <ul class="pagination pagination-centered">
                        <li><a href="#">上一页</a></li>
                        <li class="active">
                            <a href="#">1</a>
                        </li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">下一页</a></li>
                    </ul>
                </div>
            </div>
        </div>';?>
    </div> <!--/row-->
    <div class="row">
    <div class="box col-md-12">
    <div class="box-inner">
    <div class="box-header well" data-original-title="">
        <h2><i class="glyphicon glyphicon-user"></i> 课程查询</h2>

        <div class="box-icon">
            <a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
            <a href="#" class="btn btn-minimize btn-round btn-default"><i
                    class="glyphicon glyphicon-chevron-up"></i></a>
            <a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
        </div>

    </div>


    <form action="new_index_ww.php" method="post">
	<?php
	echo '<input type="hidden" id="class_add" name="class_add" ';
			if(!empty($_POST['class_add']))
				echo 'value="' . $_POST['class_add'] . '" />';
			else
				echo " />";
	?>
    <div class="box-content">
    <div class="alert alert-info" style = "background-color:#3a87ad">
		<input type="text" name="TextBox" type="text" id="TextBox"  placeholder="课程名称"
		<?php
	             	if(!empty($_POST['TextBox']))
	             		echo "value=\"" . $_POST['TextBox'] . "\" />";
	             	else
	             		echo " />"; 
		?>
		&nbsp
		<button type="submit" class="btn btn-success" data-noty-options="{&quot;text&quot;:&quot;This is an error notification&quot;,&quot;layout&quot;:&quot;center&quot;,&quot;type&quot;:&quot;error&quot;}">
	                <i class="glyphicon glyphicon-zoom-in icon-white"></i>
	                查询
		</button>
		&nbsp
		<button name="generate" id="generate" type="submit" class="btn btn-danger" data-noty-options="{&quot;text&quot;:&quot;This is an error notification&quot;,&quot;layout&quot;:&quot;center&quot;,&quot;type&quot;:&quot;error&quot;}">
	                <i class="glyphicon glyphicon-zoom-in icon-white"></i>
	                生成课表
		</button>
        </a>
	</div>
    <table class="table table-striped table-bordered bootstrap-datatable datatable responsive" id = 'ssjg'>
    <thead>
    <tr>
	<!-- 教师姓名 	课程代码 	课程名称 	课程类别 	周学时 	学分 	上课时间 	上课地点 	学期 	添加-->
        <th>教师姓名</th>
        <th>课程代码</th>
        <th>课程名称</th>
        <th>课程类别</th>
	<th>周学时</th>
	<th>学分</th>
	<th>上课时间</th>
	<th>上课地点</th>
	<th>学期</th>
        <th>操作</th>
    </tr>
    </thead>
    <tbody>
    
	<?php
		if ($_SERVER['REQUEST_METHOD'] == 'POST' ){
			if (!empty($_POST['TextBox'])){
				require('../../mysqli_connect.php');
				$safe_query = mysqli_real_escape_string($dbc, $_POST['TextBox']);
				$qq = "kcmc like '%{$safe_query}%'";
				$q = "SELECT * FROM CourseInfo WHERE $qq;";
				$r = @mysqli_query ($dbc, $q);
				if ($r){
					$line = 1;
					while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)){						
						echo '<tr">';
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
						
								<button class="btn btn-info" data-noty-options="{&quot;text&quot;:&quot;This is an error notification&quot;,&quot;layout&quot;:&quot;center&quot;,&quot;type&quot;:&quot;error&quot;}" type="submit" name="add'. ($line-1) .'" id="add" onclick="AddClass(this)">
	                <i class="glyphicon glyphicon-edit icon-white"></i>
	                添加
		</button>
						</td>
							
						</tr>';
					}
					mysqli_free_result($r);
				}
				mysqli_close($dbc);
			}else{
				echo "<script>alert('无查询课程');</script>";
			}
		}

	?>
    
    </tbody>
    </table>
    </div>
    </div>
    </div>
    <!--/span-->

    </div><!--/row-->



    </form><!-- /form end-->

    <div class="row">
        <div class="box col-md-12">
            <div class="box-inner">
                <div class="box-header well" data-original-title="">
                    <h2>已添加的必选课程</h2>

                    <div class="box-icon">
                        <a href="#" class="btn btn-setting btn-round btn-default"><i
                                class="glyphicon glyphicon-cog"></i></a>
                        <a href="#" class="btn btn-minimize btn-round btn-default"><i
                                class="glyphicon glyphicon-chevron-up"></i></a>
                        <a href="#" class="btn btn-close btn-round btn-default"><i
                                class="glyphicon glyphicon-remove"></i></a>
                    </div>
                </div>
                <div class="box-content">
                    <table class="table table-bordered table-striped table-condensed">
                        <thead>
                        <tr>
                            <th>课程代码</th>
                            <th>课程名称</th>
                        </tr>
                        </thead>
                        <tbody>
			<?php
	
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
						echo '<tr>';
						echo '<td>' . $str1 . '</td>';
						echo '<td>' . $str2 . '</td>';
						echo '</tr>';
						array_push($CoCodeArr, $str2);
						//$cline++;
					}
					if (isset($_POST['generate'])){
						require_once('queryCourse.php');
						$allCourse = getAllCourse($CoCodeArr);
						$temp = array();
				$recomCodeArr = array();
				$istag = false;
				if (isset($_SESSION["is_new"])){
					$tagArr = $_SESSION["is_new"];
					$recomCodeArr = getRecomCourseWithTag($tagArr);
					$istag = true;
//					print_r($tt);
				}else{
					$recomCodeAndSimiArr = getRecomCourse($_SESSION['username'], 5);
					$recomCodeArr = array_keys($recomCodeAndSimiArr);
				}
				$recomCourse = getAllCourse($recomCodeArr);
						$temp = array_merge($temp, $recomCourse);
						$_SESSION["Array"] = serialize(array_merge( $allCourse, $temp));
						
						echo "<script> window.location.href='showtable2.php'</script>";
						exit;
					}
				}
			?>
                        </tbody>
                    </table>
                    <ul class="pagination pagination-centered">
                        <li><a href="#">上一页</a></li>
                        <li class="active">
                            <a href="#">1</a>
                        </li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">下一页</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div><!--/span-->

    <!-- content ends -->
    </div><!--/#content.col-md-0-->
</div><!--/fluid-row-->

    <hr>

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h3>Settings</h3>
                </div>
                <div class="modal-body">
                    <p>Here settings can be configured...</p>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
                    <a href="#" class="btn btn-primary" data-dismiss="modal">Save changes</a>
                </div>
            </div>
        </div>
    </div>

    <footer class="row">
        <p class="col-md-9 col-sm-9 col-xs-12 copyright">&copy; <a href="http://usman.it" target="_blank">Muhammad
                Usman</a> 2012 - 2014</p>

        <p class="col-md-3 col-sm-3 col-xs-12 powered-by">Powered by: <a
                href="http://usman.it/free-responsive-admin-template">Charisma</a></p>
    </footer>

</div><!--/.fluid-container-->

<!-- external javascript -->

<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- library for cookie management -->
<script src="js/jquery.cookie.js"></script>
<!-- calender plugin -->
<script src='bower_components/moment/min/moment.min.js'></script>
<script src='bower_components/fullcalendar/dist/fullcalendar.min.js'></script>
<!-- data table plugin -->
<script src='js/jquery.dataTables.min.js'></script>

<!-- select or dropdown enhancer -->
<script src="bower_components/chosen/chosen.jquery.min.js"></script>
<!-- plugin for gallery image view -->
<script src="bower_components/colorbox/jquery.colorbox-min.js"></script>
<!-- notification plugin -->
<script src="js/jquery.noty.js"></script>
<!-- library for making tables responsive -->
<script src="bower_components/responsive-tables/responsive-tables.js"></script>
<!-- tour plugin -->
<script src="bower_components/bootstrap-tour/build/js/bootstrap-tour.min.js"></script>
<!-- star rating plugin -->
<script src="js/jquery.raty.min.js"></script>
<!-- for iOS style toggle switch -->
<script src="js/jquery.iphone.toggle.js"></script>
<!-- autogrowing textarea plugin -->
<script src="js/jquery.autogrow-textarea.js"></script>
<!-- multiple file upload plugin -->
<script src="js/jquery.uploadify-3.1.min.js"></script>
<!-- history.js for cross-browser state change on ajax -->
<script src="js/jquery.history.js"></script>
<!-- application script for Charisma demo -->
<script src="js/charisma.js"></script>


</body>
</html>

