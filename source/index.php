<?php
require_once('init.php');
require_once('includes/activity.class.php');
require_once("includes/plugin.class.php");

//获取动态信息
$a  = new ActivityClass();
for($i = 0; $i < 10; ++$i){
	$tmp = $a->get_activity("index", $i);
	if($tmp == false)
		break;
	$activity_array[] = $tmp;
}

foreach ($activity_array as $key => $act) {
    $activity_array[$key]['comments'] = $a->get_comments($act['mid']);
}

$appObj = new PluginClass();
$result = $appObj->get_app_list();

$mini_aside_array = array();

foreach($result as $row)
{
	$json = json_decode($row['attr']);
    if ($json->plugin_use == '1') {
    	array_push($mini_aside_array, '/app/'.$row['name'].'/function.php');
    }
}

$smarty->assign( "activity_list", $activity_array );
$smarty->assign('mini_aside_array', $mini_aside_array);

$smarty->display('index.tpl');
?>
