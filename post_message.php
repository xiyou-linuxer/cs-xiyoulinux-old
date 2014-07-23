<meta>

</meta>
<?php
//	session_start();
//	$uid=$_session['uid'];
	$uid="1001";	
	require_once("./source/inc/conn.php");
	require_once("./source/inc/mail.php");
	
	$address=$_POST['address'];
	$title=$_POST['title'];
	$content=$_POST['content'];

	$mysql=new Csdb;
	$mail=new Mail("1001");

	$users=explode(',', $address);
	$touidArr=array();
	$failArr=array();
	for ( $index=0; $index<count($users); $index++ ) {

		$sql="SELECT uid FROM cs_user WHERE name='" . $users[$index] . "'";
		$result=$mysql->query($sql);
		$array=$result->fetch_assoc();
		if( $array['uid'] == "" ) {
			array_unshift($failArr, $users[$index]);
			continue;
		}
		array_unshift($touidArr, $array['uid']);
	}
	$message=array("fromid"=>$uid, "title"=>$title, "content"=>$content, "touid"=>$touidArr);
	$json_message=json_encode($message);
	$mail->cs_send_mail($json_message);

	if ( count($failArr) == 0 ) {
		echo "发送成功";
	}
	else {
		echo "以下站内信发送失败<br />";
		for ( $index=0; $index<count($failArr); $index++ ) {
			if ( $failArr[$index] != "" )
				echo $failArr[$index] . "<br />";
		}
	}

?>
