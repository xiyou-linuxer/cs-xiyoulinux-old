<?php
	require_once('inc/mail.php');
	if ( isset($_COOKIE["uid"]) )
		$uid = $_COOKIE["uid"];
	$func = $_POST["func"];

	$mail = new Mail($uid);
	switch($func) {
		case "get_mail_list": 
			$tag = $_POST["tag"];    echo ($mail->get_mail_list($tag));
			break;
        case "get_mail_info":
            $mid = $_POST["mid"];    echo($mail->get_mail_info($mid));
			break;
		case "get_mail_count":
			$tag = $_POST["tag"];	echo($mail->get_mail_count($tag));
			break;
		case "get_name_match":
			$json = $_POST["json"];		echo($mail->get_name_match($json));
			break;
		case "del_mail":
			$mid = $_POST["mid"];	echo($mail->del_mail($mid));
			break;
        case "send_mail":
			echo($mail->send_mail());
			break;
		case "save_draft":
			echo($mail->save_draft());
			break;
		default:
			echo("input error");
			break;
	}
?>
