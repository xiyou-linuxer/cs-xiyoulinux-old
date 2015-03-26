<?php
require_once(dirname(dirname(dirname(__FILE__))) . '/init.php');
require_once(dirname(dirname(dirname(__FILE__))) . '/includes/db.class.php');

include_once("./config.php");

$dbObj = new DBClass();

$sql = "SELECT COUNT(1) FROM app_join_info";
$result = $dbObj->query($sql);
if(is_object($result)){
    $com = $result->fetch_assoc();
    $status[1] = $com["COUNT(1)"];
}
else {
    $status[1] = -1;
}

$sql = "SELECT COUNT(1) FROM app_join_info WHERE status = 0";
$result = $dbObj->query($sql);
if(is_object($result)){
    $com = $result->fetch_assoc();
    $status[0] = $com["COUNT(1)"];
}
else {
    $status[0] = -1;
}

$sql = "SELECT COUNT(1) FROM app_join_info WHERE status >= 2";
$result = $dbObj->query($sql);
if(is_object($result)){
    $com = $result->fetch_assoc();
    $status[2] = $com["COUNT(1)"];
}
else {
    $status[2] = -1;
}

$sql = "SELECT COUNT(1) FROM app_join_info WHERE status >= 3";
$result = $dbObj->query($sql);
if(is_object($result)){
    $com = $result->fetch_assoc();
    $status[3] = $com["COUNT(1)"];
}
else {
    $status[3] = -1;
}

$sql = "SELECT COUNT(DISTINCT uid) AS count FROM app_join_record WHERE round = ".$Current_Status;
$result = $dbObj->query($sql);
if(is_object($result)){
    $com = $result->fetch_assoc();
    $current = $com["count"];
}
else {
    $current = -1;
}

$round = array("current"=>$current, "round1"=>$status[1], "round2"=>$status[0], "round3"=>$status[2], "round4"=>$status[3], "current_total"=>$status[$Current_Status]);

$smarty->assign("status", $round);
?>
