<?php
include_once('init.php');
include('inc/mail.class.php');
include('inc/user.class.php');
include('inc/plugin.class.php');

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

$user_class = new User();
$json_str = $user_class->get_userinfo($_SESSION['uid']);
$user_obj = json_decode($json_str)[0];
$username = $user_obj->name;

$user_avatar = $user_class->get_avatar($_SESSION['uid']);

$tpl->assign('header_mail_count', $mail_count);
$tpl->assign('header_username', $username);
$tpl->assign('header_user_avatar', $user_avatar);

?>
