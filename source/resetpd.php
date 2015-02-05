<?php
require_once(dirname(__FILE__) . '/smarty.php');
require_once(dirname(__FILE__) . "/includes/db.class.php");


$token = trim($_GET["token"]);
$uid = trim($_GET["uid"]);
$time = trim($_GET["time"]);

$dbObj = new DBClass();
$sql = "select * from cs_user where uid='$uid';";
$result = $dbObj->query($sql);
if($result->num_rows){
	$userinfo = $result->fetch_assoc();
}
$str = $userinfo["uid"].$userinfo["password"].$time;
$verify  = md5($str);
if($token == $verify){
	$nowtime = time();
	if($nowtime < $time){
		$smarty->assign('verify',$verify);
		$smarty->assign('time',$time);
		$smarty->display('resetpd.tpl');
	} else {
		echo '<meta charset="utf-8">链接已超时失效，请获取新的重置链接';
		exit;
	}
}else {
	echo '<meta charset="utf-8">链接无效,校验不匹配!';
	exit;
}
?>
