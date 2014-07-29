<?php
	require_once('inc/mail_update.php');
	if ( isset($_COOKIE["uid"]) )
		$uid = $_COOKIE["uid"];
	$func = $_POST["func"];

	$mail = new Mail($uid);
	switch($func) {
		case "get_mail_list": 
			$tag = $_POST["tag"];	return($mail->get_mail_list($tag));
			break;
		case "get_mail_info":
			$mid = $_POST["mid"];	return($mial->get_mail_info($mid));
			break;
		case "get_mail_count":
			$tag = $_POST["tag"];	return($mail->get_mail_count($tag));
			break;
		case "get_name_match":
			$json = $_POST["json"];		return($mail->get_name_match($json));
			break;
		case "del_mail":
			$mid = $_POST["mid"];	return($mail->del_mail($mid));
			break;
		case "send_mail":
			return($mail->send_mail());
			break;
		case "save_draft":
			return($mail->save_draft());
			break;
		default:
			return("input error");
			break;
	}
?>
