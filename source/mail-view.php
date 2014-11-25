<?php

include_once('init.php');
include('header.php');
include('aside.php');
include('chat.php');
include('footer.php');

$script_list = array (
    'js/mail.js'
);
$tpl->assign('script_list', $script_list);

$type = $_COOKIE['mail_type'];
if ($type == 'draft') {
    $tpl->assign('btn_del_caption', "删除草稿");
    $tpl->assign('btn_edit_caption', "编辑草稿");
} else {
    $tpl->assign('btn_del_caption', "删除信息");
    $tpl->assign('btn_edit_caption', "回复信息");
}

$mid = $_GET['mid'];
setcookie('mid',$mid,time()+3600);
$mail_class = new Mail($_COOKIE['uid']);
$json_str   = $mail_class->get_mail_info($mid);
$mail_info  = json_decode($json_str);

$tpl->assign('mail_title', $mail_info[0]->title);
$tpl->assign('mail_content', $mail_info[0]->content);

if ($mail_info[0]->isdraft == 'true') {
    $tpl->assign('mail_isdraft', 'true');
    $tpl->assign('mail_touser', $mail_info[0]->touser);
} else {
    $tpl->assign('mail_isdraft', 'false');
    $tpl->assign('mail_fromuser', $mail_info[0]->fromuser);
    $tpl->assign('mail_date', $mail_info[0]->date);
}

$tpl->display('header.html');
$tpl->display('aside.html');
$tpl->display('mail-view.html');
$tpl->display('chat.html');
$tpl->display('footer.html');
?>
