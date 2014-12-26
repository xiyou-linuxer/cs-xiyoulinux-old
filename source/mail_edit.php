<?php

include_once('init.php');
include('header.php');
include('aside.php');
include('chat.php');
include('footer.php');

if (isset($_GET['mid'])) {
	$mid = $_GET['mid'];
	$mail_class = new Mail($_COOKIE['uid']);
	$json_str   = $mail_class->get_mail_info($mid);
	$mail_info  = json_decode($json_str);
	if ($mail_info[0]->isdraft == 'true') {
	    $tpl->assign('mail_title', $mail_info[0]->title);
	    $tpl->assign('mail_touser', $mail_info[0]->touser);
	    $tpl->assign('mail_content', $mail_info[0]->content);
	}
} else if (isset($_GET['touid'])) {
	$touid = $_GET['touid'];
	$user_class = new User();
	$json_str = $user_class->get_userinfo($touid);
	$user_obj = json_decode($json_str);
	
	$tpl->assign('mail_touser', $user_obj[0]->name);
}

$tpl->display('mail_edit.tpl');
?>
