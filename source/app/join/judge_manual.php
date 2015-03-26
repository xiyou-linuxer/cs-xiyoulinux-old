<?php
require_once('./preprocess.php');
require_once(BASE_PATH . '/privilege_ctrl.php');

if (isset($_GET["uid"])) $uid = $_GET["uid"];
else {
	$sql = "SELECT * FROM app_join_info WHERE status = ".$Current_Status;
	$result = $dbObj->query($sql);
	if($result->num_rows > 0)
	{
		$com = $result->fetch_assoc();
		$uid = $com["uid"];
	}
}
if (isset($uid))
{
	$sql = "SELECT * FROM app_join_info WHERE uid = ".$uid;
	$result = $dbObj->query($sql);
	if($result->num_rows > 0)
	{
		$com = $result->fetch_assoc();
		$info = $com;
	}
	$sql = "SELECT * FROM app_join_record WHERE uid = ".$uid." AND round = ".$Current_Status." ORDER BY time ASC";
	$graderesult = $dbObj->query($sql);
	if($g1 = $graderesult->fetch_assoc()) {
		$json_str = $CUser->get_userinfo($g1["interviewer"]);
		$user_obj = json_decode($json_str);
		$g1["interviewer"] = $user_obj[0]->name;
		$record1 = $g1;
	}
	if($g2 = $graderesult->fetch_assoc()) {
		$json_str = $CUser->get_userinfo($g2["interviewer"]);
		$user_obj = json_decode($json_str);
		$g2["interviewer"] = $user_obj[0]->name;
		$record2 = $g2;
	}
}
$smarty->assign("info", $info);
$smarty->assign("record1", $record1);
$smarty->assign("record2", $record2);

$smarty->display(dirname(__FILE__) . '/templates/judge_manual.tpl');
?>