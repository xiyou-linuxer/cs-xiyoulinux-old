<?php

include_once(dirname(dirname(dirname(__FILE__))) . '/config.php');
include_once(BASE_PATH . '/init.php');
include(BASE_PATH . '/header.php');
include(BASE_PATH . '/aside.php');
include(BASE_PATH . '/chat.php');
include(BASE_PATH . '/footer.php');
include('bug.class.php');
$get_display = $_GET['bug_name'];
$bug = new Bug();
$tag = 'bugid';
$result = $bug->bug_info($get_display,$tag);
$conseq = $result[0];
$bug_info = array("title"=>$conseq['title'],"author"=>$conseq['name'],"modifytime"=>$conseq['modifytime'],"content"=>$conseq['content'],"method"=>$conseq['method'],"status"=>$conseq['status']);
//$tpl->assign('bug_title',"个人中心无法插入信息");
//$bug_info = array( "title" => "bug标题", “author” => "lili", "status" => "1", "modifytime" => "2014/1/1" , "content" => "content", "method" => "method"  );
$tpl->assign('bug', $bug_info);

$tpl->display('header.tpl');
$tpl->display('aside.tpl');
$tpl->display('feedback/buginfo.tpl');
$tpl->display('chat.tpl');
$tpl->display('footer.tpl');
?>
