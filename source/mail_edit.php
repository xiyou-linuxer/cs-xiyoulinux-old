<?php
require_once('init.php');

if (isset($_GET['mid'])) {
	$mid = $_GET['mid'];
	$mailObj = new MailClass($_COOKIE['uid']);
	$json_str   = $mailObj->get_mail_info($mid);
	$mail_info  = json_decode($json_str);
	if ($mail_info[0]->isdraft == 'true') {
	    $smarty->assign('mail_title', $mail_info[0]->title);
	    $smarty->assign('mail_touser', $mail_info[0]->touser);
	    $smarty->assign('mail_content', $mail_info[0]->content);
	}
} else if (isset($_GET['touid'])) {
	$touid = $_GET['touid'];
	$userObj= new UserClass();
	$json_str = $userObj->get_userinfo($touid);
	$user_obj = json_decode($json_str);
	
	$smarty->assign('mail_touser', $user_obj[0]->name);
}

$smarty->display('mail_edit.tpl');
?>
