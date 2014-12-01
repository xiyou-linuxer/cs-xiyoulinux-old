<?php

include_once('init.php');
include_once("inc/conn.php");
include_once('inc/user.class.php');
//include ('header.php');
//include ('aside.php');
//include ('footer.php');

if(isset($_COOKIE['uid']))
	$uid = $_COOKIE['uid'];

$conn = new Csdb;
$user = new User;
$time = time()-600;
$sql = "select cs_user.name,cs_user.uid,cs_user.workplace,cs_online.time from cs_user,cs_online where cs_online.uid=cs_user.uid and cs_online.time >".$time.";";
$result = $conn->query($sql) or die(mysql_error());

if($result->num_rows){
	while( ($row = $result->fetch_assoc()) ){
		$row['status'] = "on b-light right sm";
		$row['avatar'] = $user->get_avatar($row['uid']);
		$user_list[] = $row;
	}
}
$sql1 = "select cs_user.name,cs_user.uid,cs_user.workplace,cs_online.time from cs_user,cs_online where cs_online.uid=cs_user.uid and cs_online.time <".$time.";";
$result1 = $conn->query($sql1);

if($result1->num_rows){
	while( ($row1 = $result1->fetch_assoc()) ){
		$row1['status'] = "off b-light right sm";
		$row1['avatar'] = $user->get_avatar($row1['uid']);
	$user_list[]=$row1;
	}
}
//var_dump($user_list);
$tpl->assign('user_list',$user_list);
?>
