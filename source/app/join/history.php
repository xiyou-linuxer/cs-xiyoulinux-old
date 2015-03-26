<?php
require_once('./preprocess.php');

$sql = "SELECT app_join_info.uid AS uid, name, class, basic_skill, extra_skill, overall, grade, time, round FROM app_join_record, app_join_info WHERE interviewer = ".$login_uid." AND app_join_record.uid = app_join_info.uid ORDER BY time DESC";
$result = $dbObj->query($sql);
while($com = $result->fetch_assoc())
{
    $record["uid"] = $com["uid"];
    $record["name"] = $com["name"];
    $record["class"] = $com["class"];
    $record["basic"] = $com["basic_skill"];
    $record["extra"] = $com["extra_skill"];
    $record["overall"] = $com["overall"];
    $record["grade"] = $com["grade"];
    $record["time"] = $com["time"];
    $record["round"] = $com["round"];
    $records[] = $record;
}

$smarty->assign("records", $records);

$smarty->display(dirname(__FILE__) . '/templates/history.tpl');
?>