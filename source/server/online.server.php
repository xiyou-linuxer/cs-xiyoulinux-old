<?php
	include(dirname(dirname(__FILE__)) . '/config.php');
	include(BASE_PATH . '/inc/online.class.php');
	$online = new Online();
	
	$uid=$_GET['uid'];
	$logout=$_GET['logout'];
	
	if ($logout != null && $logout == 'true') {
		$time = time()-600;
	}
	else {
		$time = time();
	}
	$result = $online->select_online($uid, $time);
	if ($result == "false") {
		$online->insert_online($uid, $time);
	}
	else {
		$online->update_online($uid, $time);
	}
?>
