<?php
include_once('init.php');
include_once('inc/mail.class.php');
include_once('inc/user.class.php');
include_once('inc/plugin.class.php');

$_COOKIE['uid'] = $_SESSION['uid'];
$mail_class = new Mail($_COOKIE['uid']);
$json_str = $mail_class->get_mail_count();
$unread_mail_count = json_decode($json_str)->unread;

$json_str     = $mail_class->get_mail_list(1);
$mail_objects = json_decode($json_str);

$user_class = new User();
$json_str = $user_class->get_userinfo($_SESSION['uid']);
$user_obj = json_decode($json_str);
$username = $user_obj[0]->name;

$user_avatar = $user_class->get_avatar($_SESSION['uid']);

if (!isset($mail_objects->result)) {
    $mail_list= array();
    foreach ( $mail_objects as $mail ) {
	$fromuser_avatar = $user_class->get_avatar($mail->fromuid);
        $item = array(
            'mid'=>$mail->mid,
            'title'=>$mail->title,
            'date'=>$mail->date,
            'fromuser_avatar'=>$fromuser_avatar);
        array_push($mail_list, $item);
    }
    $tpl->assign('header_mail_list', $mail_list);
}

$tpl->assign('SITE_DOMAIN', SITE_DOMAIN);
$tpl->assign('header_mail_count', $unread_mail_count);
$tpl->assign('header_username', $username);
$tpl->assign('header_user_id', $_COOKIE['uid']);
$tpl->assign('header_user_avatar', $user_avatar);

?>
