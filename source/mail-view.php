<?php

include_once('init.php');
include('header.php');
include('aside.php');
include('footer.php');

$script_list = array (
    'js/mail.js'
);
$tpl->assign('script_list', $script_list);

$mid = $_GET['mid'];
setcookie('mid',$mid,time()+3600);
$mail_class = new Mail($_COOKIE['uid']);
$json_str   = $mail_class->get_mail_info($mid);
$mail_info  = json_decode($json_str);

$tpl->assign('mail_title', $mail_info[0]->title);
$tpl->assign('mail_fromuser', $mail_info[0]->fromuser);
$tpl->assign('mail_date', $mail_info[0]->date);
$tpl->assign('mail_content', $mail_info[0]->content);

$tpl->display('header.html');
$tpl->display('aside.html');
$tpl->display('mail-view.html');
$tpl->display('footer.html');
?>
