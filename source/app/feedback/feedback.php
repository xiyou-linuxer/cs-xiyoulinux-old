<?php
require_once(dirname(dirname(dirname(__FILE__))) . '/init.php');
require_once('bug.class.php');

$GET_SEARCH = $_GET['search_bug'];
$uid = $_COOKIE['uid'];
$bug = new Bug();

if(!empty($GET_SEARCH)){
	$search_result = $bug->bug_search($GET_SEARCH);
foreach($search_result as $value_search)
	$search_bug[] = array("name"=>$value_search['title'],"bugid"=>$value_search['bugid']);
}

$result_unfix = $bug->bug_status(0);
foreach($result_unfix as $value_unfix)
	$waited_bug[] = array("name"=>$value_unfix['title'],"bugid"=>$value_unfix['bugid']);	

$result_fixed = $bug->bug_status(1);
foreach($result_fixed as $value_fixed)
	$fixed_bug[] = array("name"=>$value_fixed['title'],"bugid"=>$value_fixed['bugid']);	

$result_mine = $bug->bug_mine($uid);
foreach($result_mine as $value_mine)
	$commited_bug[] = array("name"=>$value_mine['title'],"status"=>$value_mine['status'],"bugid"=>$value_mine['bugid']);
	
$smarty->assign('GET_SEARCH', $GET_SEARCH);

$smarty->assign('search_bug',$search_bug);
$smarty->assign('waited_bug',$waited_bug);
$smarty->assign('fixed_bug',$fixed_bug);
$smarty->assign('commited_bug',$commited_bug);

$smarty->display(dirname(__FILE__) . '/templates/feedback.tpl');
?>
