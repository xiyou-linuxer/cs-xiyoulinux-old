<?php
include('../inc/mail.class.php');
session_start();

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

if ( $action == 'del_mail' ) {
    if ( isset($_POST['mid']) ) {
    	echo $mail->del_mail($_POST['mid']);
    	exit;
    }

    echo $json_error;
    exit;
}

if ( $action == 'send_mail' ) {
	$title = $_POST['title'];
	$touser = $_POST['touser'];
	$content = $_POST['content'];

	echo $mail->send_mail($title, $touser, $content);
	exit;
}
?>
