<?php
include_once('inc/conn.php');


function check_online($uid){
        $conn = new Csdb;
	$time = time()-600;
	$sql = "select * from cs_online where uid=$uid and time>$time;";
	$result = $conn->query($sql);
	if($result->num_rows)
		return true;
	else
		return false;
}
?>
