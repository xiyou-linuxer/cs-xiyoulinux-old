<?php

include_once('../../init.php');
include('../../header.php');
include('../../aside.php');
include('../../chat.php');
include('../../footer.php');
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

$tpl->display('header.html');
$tpl->display('aside.html');
$tpl->display('feedback/buginfo.html');
$tpl->display('chat.html');
$tpl->display('footer.html');
?>
