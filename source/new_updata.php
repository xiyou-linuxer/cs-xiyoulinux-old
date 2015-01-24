<?php
	include_once("init.php");
	include_once("inc/updata.class.php");

	$msg = $_POST["updata"];
	$uid = $_SESSION["uid"];
	
	if($msg == "") {
		echo "<script>alert('对不起，不能发表空动态');window.location.href = 'index.php';</script>";
		exit;
	}

	$message = "话题：";
	preg_match_all('/#([^#\s]+)#/is', $msg, $topics);
	foreach($topics[1] as $topic) {
		$message = $message."<label class=\"label label-info m-l-xs\"><a href=\"search.php?wd=%23$topic%23\" style=\"color:#fff\">$topic</a></label>";
	}

	if ($message == "话题：") $message = "";
	$updata = new Updata;
	$updata -> insert_updata($uid, 0, $msg, "label-success", "发表动态", $message, "#");

	echo "<script>window.location.href = 'index.php';</script>"
?>
