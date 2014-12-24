<?php

require('bug.class.php');

$content = $_POST['bugcontent'];
$uid = $_COOKIE['uid'];
$title = $_POST['bugtitle'];
$method = $_POST['bugmethod'];

if(empty($content) || empty($uid) || empty($title) || empty($method)) {
	echo 'content'.$content;
	echo 'title'.$title;
	echo 'method'.$method;
	echo  'false';
	exit;
}

$bug = new Bug();
$result = $bug->bug_send($content,$uid,$method,$title);

if($result)
	echo '发布成功!';
else
	echo false;
?>
