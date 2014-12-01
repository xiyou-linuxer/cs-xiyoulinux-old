<?php
require_once("inc/conn.php");

    include('/usr/local/lib/php/smarty/Smarty.class.php');

    $tpl = new Smarty();
    $tpl->template_dir = './templates/';
    $tpl->compile_dir = './templates_c/';
    $tpl->config_dir = './configs/';
    $tpl->cache_dir = './cache/';
    $tpl->left_delimiter = '<{';
    $tpl->right_delimiter = '}>';


$token = trim($_GET["token"]);
$uid = trim($_GET["uid"]);
$time = trim($_GET["time"]);
/*
if(empty($token) || empty($mail)){
	print 'false1';
	exit;
}*/

$conn = new Csdb;
$sql = "select * from cs_user where uid='$uid';";
$result = $conn->query($sql);
if($result->num_rows){
	$userinfo = $result->fetch_assoc();
}
$str = $userinfo["uid"].$userinfo["password"].$time;
$verify  = md5($str);
if($token == $verify){
	$nowtime = time();
	if($nowtime < $time){
		$tpl->assign('verify',$verify);
		$tpl->assign('time',$time);
		$tpl->display('templates/reset.html');
//	include('templates/reset.html');
	} else {
		print 'false2';
		exit;
	}
}else {
	echo '<meta charset="utf-8">连接无效,校验不匹配!';
	exit;
}


?>
