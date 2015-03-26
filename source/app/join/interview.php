<?php
require_once('./preprocess.php');

$uid = $_GET["uid"];
$sql = "SELECT * FROM app_join_info WHERE uid = ".$uid;
$result = $dbObj->query($sql);
if($result->num_rows > 0){
    $com = $result->fetch_assoc();
    
    if($com["status"] != $Current_Status)
    {
        header("location:index.php");
        exit;
    }
    
    $info["uid"] = $com["uid"];
    $info["sno"] = $com["sno"];
    $info["name"] = $com["name"];
    $info["class"] = $com["class"];
    $info["mobile"] = $com["mobile"];
    
    if($Current_Status != 0) $sql = "SELECT basic_skill, extra_skill, overall, grade, time, round, interviewer FROM app_join_record WHERE uid = ".$uid." AND round < ".$Current_Status." ORDER BY time DESC";
    else $sql = "SELECT basic_skill, extra_skill, overall, grade, time, round, interviewer FROM app_join_record WHERE uid = ".$uid." AND round = 1 ORDER BY time DESC";
    $result = $dbObj->query($sql);
    if($result->num_rows > 0){
        while($com = $result->fetch_assoc())
        {
            $record["basic"] = $com["basic_skill"];
            $record["extra"] = $com["extra_skill"];
            $record["overall"] = $com["overall"];
            $record["grade"] = $com["grade"];
            $record["time"] = $com["time"];
            $record["round"] = $com["round"];
            $json_str = $CUser->get_userinfo($com["interviewer"]);
            $user_obj = json_decode($json_str);
            $record["interviewer"] = $user_obj[0]->name;
            $records[] = $record;
        }
    }
}
else {
    header("location:index.php");
    exit;
}

$smarty->assign("info", $info);
$smarty->assign("records", $records);

$smarty->display(dirname(__FILE__) . '/templates/interview.tpl');
?>