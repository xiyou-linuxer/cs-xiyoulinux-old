<?php
require_once("inc/inject.php");
require_once("inc/conn.php");

//接收html的填写数据
$name = $_POST["name"];
$native = $_POST["native"];
$major = $_POST["major"];
$grade = $_POST["grade"];
$sex = $_POST["sex"];

//过滤
$inject = new Inject;
$name = $inject->jundge($name, "zh");
$native = $inject->jundge($native, "zh");
$major = $inject->jundge($major, "zh");
$sex = $inject->jundge($sex, "zh");
$grade = $inject->jundge($grade, "num");

//判断是否有违法字符串
 function jundge($name, $native, $major, $sex, $grade)
 {
	 if (!$name)
		 exit("输入中文名");
	 if (!$native)
		 exit("输入中文的民族名");
	 if (!$major)
		 exit("输入中文专业名");
	 if (!$sex)
		 exit("输入中文性别名");
	 if (!$grade)
		 exit("输入数字级别");
 }
jundge($name, $native, $major, $sex, $grade);

//连接数据库
$link = new Csdb;
//插入记录
if ($sex = "女")
	$sex = 0;
else 
	$sex = 1;
$sql = "insert into cs_user(name,password,sex,mail,grade,major) value($name,"000000",$sex,$mail,$grade,$major);";
$result = $link->query($sql);
//判断返回结果
if (!$result)
	return("数据插入错误");
return ("数据插入正确");

?>
