<?php
	include('../inc/online.class.php');
	$online = new Online();
	
	$uid=$_GET['uid'];
	$time=$_GET['time'];
	
	$result = $online->select_online($uid, $time);
	if ($result == "false") {
		$online->insert_online($uid, $time);
	}
	else {
		$online->update_online($uid, $time);
	}
?>
