<?php
include 'changeImg.php';
$stuid = '312xxxxx';
$passwd = 'xxxxxx';
$course = '大学';
$cookie_jar = dirname(__FILE__)."\pic.cookie";
//save cookie
$url = 'http://jwbinfosys.zju.edu.cn/CheckCode.aspx';
$filename = "ck.gif";
$fp = fopen($filename, "wb");
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_FILE, $fp);
curl_setopt($ch, CURLOPT_HEADER, 0);
//curl_setopt($ch, CURLOPT_RETURNTRANSFER, 0);
curl_setopt($ch, CURLOPT_TIMEOUT, 60);
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_jar);
curl_exec($ch);
curl_close($ch);
fclose($fp);
$fp = fopen($cookie_jar, r);
$line = fgets($fp);
$line = fgets($fp);
$line = fgets($fp);
$line = fgets($fp);
$line = fgets($fp);
echo $line;
fclose($fp);

//初始化curl对象
$curl = curl_init();
//设置需要抓取的url
$cbcode = getImgCode($filename);
echo 'img is '.$cbcode;
curl_setopt($curl, CURLOPT_URL, 'http://jwbinfosys.zju.edu.cn/default2.aspx');
//设置post方式
curl_setopt($curl, CURLOPT_POST, true);
//设置header
//$CookieVal = 'ASP.NET_SessionId=tvr1h5ypofv23b55lgj03ly0';

$FormVal = array(
	'__EVENTTARGET'=>'Button1',
	'__EVENTARGUMENT'=>'',
	'__VIEWSTATE'=>'dDwxNTc0MzA5MTU4Ozs+RGE82+DpWCQpVjFtEpHZ1UJYg8w=',
	'TextBox1'=>$stuid,
	'TextBox2'=>$passwd,
	'RadioButtonList1=学生',
	'Text1'=>'',
	'Textbox3'=>$cbcode
);

//$header[] = 'Cookie: '.$CookieVal;

//curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
curl_setopt($curl, CURLOPT_COOKIEFILE, $cookie_jar);
curl_setopt($curl, CURLOPT_POSTFIELDS, $FormVal);
curl_setopt($curl, CURLOPT_HEADER, 0);
//设置cURL参数，要求结果保存到字符串上还是输出到屏幕上
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
//运行cURL,请求网页
$data = curl_exec($curl);
//关闭请求网页
curl_close($curl);
//显示获得数据
//var_dump($data);

fclose($fp);
$fp = fopen($cookie_jar, r);
$line = fgets($fp);
$line = fgets($fp);
$line = fgets($fp);
$line = fgets($fp);
$line = fgets($fp);
echo $line;
fclose($fp);

//输出数据库内容

$curl = curl_init();
//设置需要抓取的url
curl_setopt($curl, CURLOPT_URL, 'http://jwbinfosys.zju.edu.cn/xscxbm.aspx?xh='.$stuid);
//curl_setopt($curl, CURLOPT_URL, 'http://www.baidu.com');
//设置post方式
curl_setopt($curl, CURLOPT_POST, true);
//设置header
//$CookieVal = 'ASP.NET_SessionId=tvr1h5ypofv23b55lgj03ly0';
//$FormVal = '__VIEWSTATE=dDwxOTk4MDIzMTIxOztsPENoZWNrQm94MTs%2BPosmcdALuFSBS0cze8Wo4edm8lRO&DropDownList1=kcmc&Dropdownlist_gx1=like&TextBox1=%CA%FD%BE%DD%BF%E2&RadioButtonList1=and&Dropdownlist2=kcmc&Dropdownlist_gx2=like&Textbox2=&Button5=%B2%E9%D1%AF%BD%CC%D1%A7%B0%E0';


//$FormVal = '__VIEWSTATE=dDwxOTk4MDIzMTIxOztsPENoZWNrQm94MTs%2BPosmcdALuFSBS0cze8Wo4edm8lRO&DropDownList1=kcmc&Dropdownlist_gx1=like&TextBox1=%CA%FD%BE%DD%BF%E2&RadioButtonList1=and&Dropdownlist2=kcmc&Dropdownlist_gx2=like&Textbox2=&Button5=%B2%E9%D1%AF%BD%CC%D1%A7%B0%E0';
$FormVal = array(
		'__VIEWSTATE'=>"dDwxOTk4MDIzMTIxOztsPENoZWNrQm94MTs+PosmcdALuFSBS0cze8Wo4edm8lRO",
		'DropDownList1'=>'kcmc',
		'Dropdownlist_gx1'=>'like',
		'TextBox1'=>$course,
		'RadioButtonList1'=>'and',
		'Dropdownlist2'=>'kcmc',
		'Dropdownlist_gx2'=>'like',
		'Textbox2'=>'',
		'Button5'=>'查询教学班'
);
//$header[] = 'Cookie: '.$CookieVal;

//curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
curl_setopt($curl, CURLOPT_COOKIEFILE, $cookie_jar);
curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($FormVal));
curl_setopt($curl, CURLOPT_HEADER, 0);
//设置cURL参数，要求结果保存到字符串上还是输出到屏幕上
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
//运行cURL,请求网页
$data = curl_exec($curl);
//关闭请求网页
curl_close($curl);
//显示获得数据
var_dump($data);

?>	