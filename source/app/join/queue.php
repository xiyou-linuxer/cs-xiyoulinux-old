<?php
require_once('./preprocess.php');

$sql = "SELECT qid, app_join_info.uid AS uid, sno, name, class, time, interviewer FROM app_join_info, app_join_queue WHERE app_join_info.uid = app_join_queue.uid AND round = ".$Current_Status." AND app_join_queue.qstatus = 1 ORDER BY time ASC";
$result = $dbObj->query($sql);
if($result->num_rows > 0){
	while($com = $result->fetch_assoc())
	{
		$json_str = $CUser->get_userinfo($com["interviewer"]);
		$user_obj = json_decode($json_str);
		$com["interviewer"] = $user_obj[0]->name;
		$called[] = $com;
	}
}

$sql = "SELECT qid, app_join_info.uid AS uid, sno, name, class, time FROM app_join_info, app_join_queue WHERE app_join_info.uid = app_join_queue.uid AND round = ".$Current_Status." AND app_join_queue.qstatus = 0 ORDER BY time ASC";
$result = $dbObj->query($sql);
if($result->num_rows > 0){
	while($com = $result->fetch_assoc())
	{
		$signed[] = $com;
	}
}

$sql = "SELECT qid, app_join_info.uid AS uid, sno, name, class, time, interviewer FROM app_join_info, app_join_queue WHERE app_join_info.uid = app_join_queue.uid AND round = ".$Current_Status." AND app_join_queue.qstatus = 2 ORDER BY time ASC";
$result = $dbObj->query($sql);
if($result->num_rows > 0){
	while($com = $result->fetch_assoc())
	{
		$json_str = $CUser->get_userinfo($com["interviewer"]);
		$user_obj = json_decode($json_str);
		$com["interviewer"] = $user_obj[0]->name;
		$interviewed[] = $com;
	}
}

$smarty->assign("called_list", $called);
$smarty->assign("signed_list", $signed);
$smarty->assign("interviewed_list", $interviewed);

$smarty->display(dirname(__FILE__) . '/templates/queue.tpl');
?>