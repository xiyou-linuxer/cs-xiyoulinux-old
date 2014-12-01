<?php

include_once('init.php');
include('header.php');
include('aside.php');
include('chat.php');
include('footer.php');

$style_list = array (
    'css/mail.css'
);
$tpl->assign('style_list', $style_list);

$mail = new Mail($_COOKIE['uid']);

$json = $mail->get_mail_list(1);
$mail_objects = json_decode($json);

if (!isset($mail_objects->result)) {
    $mail_list= array();
    foreach ( $mail_objects as $mail ) {
        $item = array(
            'mid'=>$mail->mid,
            'title'=>$mail->title,
            'date'=>$mail->date,
            'fromuser'=>$mail->fromuser,
            'status'=>$mail->status);
        array_push($mail_list, $item);
    }
    $tpl->assign('mail_list', $mail_list);
}

$last_page = basename($_SERVER['SCRIPT_FILENAME']);
setcookie('last_page',$last_page, time()+3600);
setcookie('mail_type','unread', time()+3600);

$tpl->display('header.html');
$tpl->display('aside.html');
$tpl->display('mail-list.html');
$tpl->display('chat.html');
$tpl->display('footer.html');
?>
