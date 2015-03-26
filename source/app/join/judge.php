<?php
require_once('./preprocess.php');
require_once(BASE_PATH . '/privilege_ctrl.php');

$sql = "SELECT * FROM app_join_info WHERE status = ".$Current_Status;
$result = $dbObj->query($sql);
if($result->num_rows > 0){
	while($com = $result->fetch_assoc()){
		$sql = "SELECT grade, interviewer FROM app_join_record WHERE uid = ".$com["uid"]." AND round = ".$Current_Status;
		$graderesult = $dbObj->query($sql);
		if($g1 = $graderesult->fetch_assoc()) {
			$com["grade1"] = $g1["grade"];
			$json_str = $CUser->get_userinfo($g1["interviewer"]);
			$user_obj = json_decode($json_str);
			$com["interviewer1"] = $user_obj[0]->name;
		}
		if($g2 = $graderesult->fetch_assoc()) {
			$com["grade2"] = $g2["grade"];
			$json_str = $CUser->get_userinfo($g2["interviewer"]);
			$user_obj = json_decode($json_str);
			$com["interviewer2"] = $user_obj[0]->name;
		}
		$ready_decide[] = $com;
	}
}

if($Current_Status == 0) $sql = "SELECT * FROM app_join_info WHERE status = -1";
else $sql = "SELECT * FROM app_join_info WHERE status = -".$Current_Status;
$result = $dbObj->query($sql);
if($result->num_rows > 0){
	while($com = $result->fetch_assoc()){
		$sql = "SELECT grade, interviewer FROM app_join_record WHERE uid = ".$com["uid"]." AND round = ".$Current_Status;
		$graderesult = $dbObj->query($sql);
		if($g1 = $graderesult->fetch_assoc()) {
			$com["grade1"] = $g1["grade"];
			$json_str = $CUser->get_userinfo($g1["interviewer"]);
			$user_obj = json_decode($json_str);
			$com["interviewer1"] = $user_obj[0]->name;
		}
		if($g2 = $graderesult->fetch_assoc()) {
			$com["grade2"] = $g2["grade"];
			$json_str = $CUser->get_userinfo($g2["interviewer"]);
			$user_obj = json_decode($json_str);
			$com["interviewer2"] = $user_obj[0]->name;
		}
		$drop[] = $com;
	}
}

if($Current_Status == 0) $sql = "SELECT * FROM app_join_info WHERE status > 1";
else $sql = "SELECT * FROM app_join_info WHERE status > ".$Current_Status;
$result = $dbObj->query($sql);
if($result->num_rows > 0){
	while($com = $result->fetch_assoc()){
		$sql = "SELECT grade, interviewer FROM app_join_record WHERE uid = ".$com["uid"]." AND round = ".$Current_Status;
		$graderesult = $dbObj->query($sql);
		if($g1 = $graderesult->fetch_assoc()) {
			$com["grade1"] = $g1["grade"];
			$json_str = $CUser->get_userinfo($g1["interviewer"]);
			$user_obj = json_decode($json_str);
			$com["interviewer1"] = $user_obj[0]->name;
		}
		if($g2 = $graderesult->fetch_assoc()) {
			$com["grade2"] = $g2["grade"];
			$json_str = $CUser->get_userinfo($g2["interviewer"]);
			$user_obj = json_decode($json_str);
			$com["interviewer2"] = $user_obj[0]->name;
		}
		$pass[] = $com;
	}
}

$sql = "SELECT * FROM app_join_info WHERE status = 0";
$result = $dbObj->query($sql);
if($result->num_rows > 0){
	while($com = $result->fetch_assoc()){
		$sql = "SELECT grade, interviewer FROM app_join_record WHERE uid = ".$com["uid"]." AND round = ".$Current_Status;
		$graderesult = $dbObj->query($sql);
		if($g1 = $graderesult->fetch_assoc()) {
			$com["grade1"] = $g1["grade"];
			$json_str = $CUser->get_userinfo($g1["interviewer"]);
			$user_obj = json_decode($json_str);
			$com["interviewer1"] = $user_obj[0]->name;
		}
		if($g2 = $graderesult->fetch_assoc()) {
			$com["grade2"] = $g2["grade"];
			$json_str = $CUser->get_userinfo($g2["interviewer"]);
			$user_obj = json_decode($json_str);
			$com["interviewer2"] = $user_obj[0]->name;
		}
		$undecide[] = $com;
	}
}

$smarty->assign("current_status", $Current_Status);
$smarty->assign("ready_decide", $ready_decide);
$smarty->assign("pass", $pass);
$smarty->assign("drop", $drop);
$smarty->assign("undecide", $undecide);

$smarty->display(dirname(__FILE__) . '/templates/judge.tpl');
?>