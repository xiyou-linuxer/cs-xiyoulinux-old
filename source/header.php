<?php

include_once('init.php');
include('inc/mail.class.php');

$mail_class = new Mail($_COOKIE['uid']);
$json_str = $mail_class->get_mail_count();
$mail_count = json_decode($json_str)->unread;

$json_str     = $mail_class->get_mail_list(1);
$mail_objects = json_decode($json_str);

if (!isset($mail_objects->result)) {
    $mail_list= array();
    foreach ( $mail_objects as $mail ) {
        $item = array(
            'mid'=>$mail->mid,
            'title'=>$mail->title,
            'date'=>$mail->date,
            'fromuser_avatar'=>$mail->fromuser);
        array_push($mail_list, $item);
    }
    $tpl->assign('header_mail_list', $mail_list);
}

$username = '林达意';

$tpl->assign('header_mail_count', $mail_count);
$tpl->assign('header_username', $username);

?>
