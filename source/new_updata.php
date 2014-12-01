<?php
	include_once("init.php");
	include_once("inc/updata.class.php");

	$msg = $_POST["updata"];
	$uid = $_SESSION["uid"];

	$updata = new Updata;
	$updata -> insert_updata($uid, 0, $msg, "bg-red", "发表动态", "", "#");

	echo "<script>window.location.href = 'index.php';</script>"
?>
