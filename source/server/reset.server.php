<?php
require_once(dirname(dirname(__FILE__)) . '/config.php');
require_once(BASE_PATH . "/inc/conn.php");
//require_once("init.php");
/*
$token = trim($_GET["token"]);
$uid = trim($_GET["uid"]);
$time = trim($_GET["time"]);

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
	$tpl->display('reset.html');
	} else {
		print 'false2';
		exit;
	}
} else {
	print 'false3';
	exit;
}
*/

//获取新密码和姓名验证

$name = $_POST["name"];
$passwd = $_POST["passwd"];
$time = $_POST["time"];
$verify = $_POST["verify"];
$time = (string)$time;
$conn = new Csdb();
//再次确认是否已修改密码
$sql = "select * from cs_user where name='$name';";
$result = $conn->query($sql);
if($result->num_rows){
	$userinfo = $result->fetch_assoc();
}
else{
	echo "修改失败";
}

$token = md5($userinfo['uid'].$userinfo['password'].$time);
if($verify == $token){
	$key = md5($passwd);
	$result = change_key($key,$name);
	if($result){
		echo "修改成功";
		
	}
	else {
		echo "修改失败";
		
	}
}
else {
	echo '<meta  charset="utf-8">验证失败，该连接无效!';
}

function change_key($key,$name){
	$conn = new Csdb;
	$sql = "update cs_user set password='$key' where name='$name';";
	if($result = $conn->query($sql)){
		return $result;
	}
}	
?>
