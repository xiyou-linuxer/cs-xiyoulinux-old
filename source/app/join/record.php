<?php
require_once('./preprocess.php');

$sql = "SELECT * FROM app_join_info";
$result = $dbObj->query($sql);
if($result->num_rows > 0){
	while($com = $result->fetch_assoc())
    $record[] = $com;
}

$smarty->assign("record_list", $record);

$smarty->display(dirname(__FILE__) . '/templates/record.tpl');
?>