<?php
include_once(dirname(dirname(dirname(__FILE__))) . '/config.php');
include_once(BASE_PATH . '/init.php');
echo 'hello';
include_once(BASE_PATH . '/header.php');
include(BASE_PATH . '/aside.php');
include(BASE_PATH . '/chat.php');
include(BASE_PATH . '/footer.php');
include('bug.class.php');

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
	
$tpl->assign('GET_SEARCH', $GET_SEARCH);

$tpl->assign('search_bug',$search_bug);
$tpl->assign('waited_bug',$waited_bug);
$tpl->assign('fixed_bug',$fixed_bug);

$tpl->assign('commited_bug',$commited_bug);

$tpl->display('header.tpl');
$tpl->display('aside.tpl');
$tpl->display('feedback/feedback.tpl');
$tpl->display('chat.tpl');
$tpl->display('footer.tpl');
?>
