<?php

require_once("inc/conn.php");	
require_once("init.php");

$token = trim($_GET['token']);
$uid = trim($_GET['uid']);
$time = trim($_GET['time']);

if(empty($token) || empty($mail)){
	print 'false1';
	exit;
}

$conn = new Csdb;
$sql = "select * from cs_user where uid='$uid';";
$result = $conn->query($sql);
if($result->num_rows){
	$userinfo = mysql_fetch_array($result);
}

$verify	 = md5($userinfo['uid'].$userinfo['password'].$time);
if($token == $verrify){
	$nowtime = time();
	if($nowtime < $time){
	$tpl->display('signup.html');
	} else {
		print 'false2';
		exit;
	}
} else {
	print 'false3';
	exit;
}


//获取新密码和姓名验证

$name = $_post['name'];
$passwd = $_post['passwd'];

//再次确认是否已修改密码
$sql = "select * from cs_user where uid='$uid';";
$result = $conn->query($sql);
if($result->num_rows){
	$userinfo_2 = mysql_fetch_array($result);
}
if($verify == md5($userinfo_2['uid'].$userinfo_2['password'.$time])){

	$key = md5($passwd);

	$sql = "update cs_user set passwd='$key' where name='$name';";
	if(false !== $conn->query($sql)){
		echo "成功";
		header("index.html");
		exit;
	}
}	
?>
