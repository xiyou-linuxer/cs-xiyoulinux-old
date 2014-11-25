<?php
include_once("inc/conn.php");
include_once('init.php');
include ('header.php');
include ('aside.php');
include ('footer.php');
include ("./inc/get_userinfo.php");

if(isset($_COOKIE['uid']))
	$uid = $_COOKIE['uid'];

$conn = new Csdb;
$time = time()-600;
$sql = "select * from 'cs_user','cs_online' where 'cs_online.uid'='cs_user.uid' and cs_online.time >'$time';";
$result = $conn->query($sql);
if($result->num_rows){
	$user_info_online = $result->fetch_array();
	
$i = 0;
$count = count($user_info_online,COUNT_NORMAL);
for($i = 0; $i < $count; $i++){
	$user_info_online[$i]['status']="text-success hidden-nav-xs";
}
$sql = "select * from 'cs_user','cs_online' where 'cs_online.uid'='cs_user.uid' and cs_online.time <'$time';";
$result1 = $conn->query($sql1);
if($result1->num_rows){
	$user_info_offline = $result->fetch_array();

$i = 0;
$count = count($user_info_offline,COUNT_NORMAL);
for($i = 0; $i < $count; $i++){
	$user_info_offline[$i]['status']="text-muted hidden-nav-xs";
	}
}
array_push($user_info_online,$user_info_offline);
$user_list = $user_info_online;
$tpl->assign('user_list',$user_list);

$tpl->display('header.html');
$tpl->display('aside.html');
$tpl->display('index_content.html');
$tpl->display('mini_aside.html');
$tpl->display('chat.html');
$tpl->display('footer.html');



?>
