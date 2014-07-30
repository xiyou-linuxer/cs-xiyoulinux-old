<?php
	session_start();
	if($_SESSION['wrong_times'] >= 3){
		print 'false1';
	}

	$name = $_POST['name'];
	$password = $_POST['password'];
	if( empty($name) || empty($password) ){
		print 'false2';
		exit;
	}
	require_once("inc/conn.php");
	$conn = new Csdb();
	$query = "SELECT `uid`,`password` FROM `cs_user` WHERE `name`='$name';";
	$result = $conn->query($query);
	if( $result->num_rows <= 0 ){
		print 'false3';
		exit;
	}
	if( $_SESSION['wrong_times'] >= 3 ){
		$checknum = $_POST['checknum'];
		if( $_SESSION['checknum'] != $checknum ){
			print 'false4';
			exit;
		}
	}
	$row = $result->fetch_assoc();
	$password = md5($password);
	if($password == $row['password']){
		$_SESSION['wrong_times'] = 0;
		$_SESSION['identity'] = crypt($row['uid'],'cs_linux_2012');
		setcookie('uid',$row['uid'],time()+3600);
		print 'true';
	}else{
		print 'false5';
		if( isset($_SESSION['wrong_times']) )
			++$_SESSION['wrong_times'];
		else
			$_SESSION['wrong_times'] = 0;
	}
?>
