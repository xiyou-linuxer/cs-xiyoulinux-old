<?php

require_once(dirname(dirname(dirname(__FILE__))) . '/init.php');
require_once('bug.class.php');

$get_display = $_GET['bug_name'];
$bug = new Bug();
$tag = 'bugid';
$result = $bug->bug_info($get_display,$tag);
$conseq = $result[0];
$bug_info = array("title"=>$conseq['title'],"author"=>$conseq['name'],"modifytime"=>$conseq['modifytime'],"content"=>$conseq['content'],"method"=>$conseq['method'],"status"=>$conseq['status']);
//$smarty->assign('bug_title',"个人中心无法插入信息");
//$bug_info = array( "title" => "bug标题", “author” => "lili", "status" => "1", "modifytime" => "2014/1/1" , "content" => "content", "method" => "method"  );
$smarty->assign('bug', $bug_info);

$smarty->display(dirname(__FILE__) . '/templates/bug_info.tpl');
?>
