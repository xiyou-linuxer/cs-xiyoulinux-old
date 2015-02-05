<?php
require_once('init.php');

$mid = $_GET['mid'];
$login_uid = $_COOKIE['uid'];

$mailObj = new MailClass($login_uid);
$json_str   = $mailObj->get_mail_info($mid);
$mail_obj  = json_decode($json_str);

$mail_info_array = array();
$mail_info_array['isdraft'] = $mail_obj[0]->isdraft;
$mail_info_array['mid'] = $mail_obj[0]->mid;
$mail_info_array['title'] = $mail_obj[0]->title;
$mail_info_array['date'] = $mail_obj[0]->date;
$mail_info_array['fromuid'] = $mail_obj[0]->fromuid;
$mail_info_array['fromuser'] = $mail_obj[0]->fromuser;
$mail_info_array['touser'] = $mail_obj[0]->touser;
$mail_info_array['content'] = $mail_obj[0]->content;

$btn_del_caption = "删除信息";
$btn_edit_caption = "回复信息";
if ($mail_obj[0]->isdraft == 'true') {
    $btn_del_caption = "删除草稿";
    $btn_edit_caption = "编辑草稿";
} else {
    //if ( $mail_obj[0]->fromuid != $login_uid ) {
	$mailObj->set_mail_readed($mid, $login_uid);
    //}
}

$smarty->assign('mail_info', $mail_info_array);
$smarty->assign('btn_del_caption', $btn_del_caption);
$smarty->assign('btn_edit_caption', $btn_edit_caption);

$smarty->display('mail_view.tpl');
?>
