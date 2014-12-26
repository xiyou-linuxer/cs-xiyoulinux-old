<?php
session_start();
require_once(dirname(dirname(__FILE__)) . '/config.php');
require_once(BASE_PATH . '/inc/mail.class.php');


$json_error = json_encode(array("result"=>"false"));

if ( !isset($_POST['action']) ) {
	echo $json_error;
    exit;
}

if ( !isset($_COOKIE['uid'])) {
	echo $json_error;
	exit;
}

$mail = new Mail($_COOKIE['uid']);

$action = $_POST['action'];

switch( $action ) {
	case "del_mail":
		if( isset($_POST['mid']) ) {
			echo $mail->del_mail($_POST['mid']);
			exit;
		}
		break;
	case "send_mail":	//发送邮件 当包含mid时只做更新不做插入
		$title = $_POST['title'];
		$touser = $_POST['touser'];
		$content = $_POST['content'];
		if ( isset($_POST['mid']) ) {
			echo $mail->del_mail($title, $touser, $content, $_POST['mid']);
		}
		else {
			echo $mail->send_mail($title, $touser, $content);
		}
		exit;
		break;
	case "auto_complete":	//发送邮件时根据用户输入自动匹配
		$username = $_POST['username'];
		echo $mail->get_name_match($username);
		exit;
		break;
	case "save_draft":	
		echo $mail->save_draft();
		exit;
		break;
}
?>
