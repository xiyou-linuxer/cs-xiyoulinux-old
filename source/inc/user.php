<?php

	require_once("inc/conn.php");
	require_once("inc/function.php");	
	
	date_default_timezone_set('PRC');
	$logfile = fopen("register.log", "a");
	fwrite($logfile, date('Y-m-d H:i:s') . "\t" . getIP() . "\t");	

	$conn = new Csdb();

	$func = $_GET["func"];
	switch($func){
	case 'cs_add_user':
		fwrite($logfile,"add_user\r\n");
		cs_add_user();
		break;
	case 'cs_del_user':
		fwrite($logfile,"del_user\r\n");
		cs_del_user();
		break;
	case 'cs_get_userinfo':
		fwrite($logfile,"get_userinfo\r\n");
		cs_get_userinfo();
		break;
	case 'cs_update_userinfo':
		fwrite($logfile,"update_userinfo\r\n");
		cs_update_userinfo();
		break;
	case 'cs_get_privilege':
		fwrite($logfile,"get_privilege\r\n");
		cs_get_privilege();
		break;
	case 'cs_deliver_privilege':
		fwrite($logfile,"deliver_privilege\r\n");
		cs_deliver_privilege();
		break;
	}

	fclose($logfile);

?>

<?php

function cs_add_user(){
    $name = $_GET["name"];	
	$permisson = 0;
    $password = $_GET["password"];
	$sex = $_GET["sex"];
	$phone = $_GET["phone"];
    $mail = $_GET["mail"];
    $qq = $_GET["qq"];	
    $wechat = $_GET["wechat"];
    $blog = $_GET["blog"];
    $github = $_GET["github"];
    $native = $_GET["native"];
    $grade = $_GET["grade"];
    $major = $_GET["major"];
	$workplace = $_GET["workplace"];
	$job = $_GET["job"];
	if( empty($name) || empty($password) || $sex=="" || empty($mail) || empty($grade) || empty($major) ){
		echo 'false';
		return;
	}
	$password = md5($password);
	
	$checkArr = array(
		"$name" => "chinese",
		"$password" => 'normal',
		"$sex" => 'digit',
		"$phone"	=> 'phone',
		"$mail" => 'mail',
		"$qq" => 'normal',
		"$wechat" => 'normal',
		"$blog" => 'site',
		"$github" => 'site',
		"$native" => 'chinese',
		"$grade" => 'chinese',
		"$major" => 'chinese',
		"$workplace" => 'chinese',
		"$job"  => 'chinese'
	);
	if( !checkArr($checkArr) ){
		echo 'false';
		return;
	}

	global $conn;
	$query_str = "SELECT * FROM `cs_user` where name='$name';";
	$result = $conn->query($query_str);
	if( $result->num_rows > 0 ){
		echo 'false';
		if( is_object($result) )
			$result->close();
		return;
	}
	$query_str = "INSERT INTO `cs_user`(`name`,`permisson`,`password`,`sex`,`phone`,`mail`,`qq`,`wechat`,`blog`,`github`,`native`,`grade`,`major`,`workplace`,`job`) VALUES ('$name','$permisson','$password','$sex','$phone','$mail','$qq','$wechat','$blog','$github','$native','$grade','$major','$workplace','$job');";
	
	if( $conn->query($query_str) )
		echo 'true';
	else
		echo 'false';

	if( is_object($result) )
		$result->close();
}

function cs_del_user(){
	$uid = $_GET['uid'];

	if( !checkStr('digit',$uid) ){
		echo 'false';
		return;
	}
	
	global $conn;
	$query_str = "SELECT * FROM `cs_user` WHERE uid='$uid';";
	$result = $conn->query($query_str);
	if( $result->num_rows <= 0 ){
		echo 'false';
		if( is_object($result) )
			$result->close();
		return;
	}

	$query_str = "DELETE FROM `cs_user` WHERE uid='$uid';";
	
	if( $conn->query($query_str) )
		echo 'true';
	else
		echo 'false';
	
	if( is_object($result) )
		$result->close();
}

function cs_get_userinfo(){
	$uid = $_GET['uid'];

	if( !checkStr('digit',$uid) ){
		echo 'false';
		return;
	}	
	
	global $conn;
	$query_str = "SELECT * FROM `cs_user` WHERE uid='$uid';";
	$result = $conn->query($query_str);
	if( $result->num_rows <= 0 ){
		echo 'false';
		if( is_object($result) )
			$result->close();
		return;
	}
	while( $row = $result->fetch_array(MYSQLI_ASSOC) ){
		$com[] = $row;
	}
	if( is_object($result) )
		$result->close();
	echo json_encode($com);
}

function cs_update_userinfo(){
    $password = $_GET["password"];
	$phone = $_GET["phone"];
    $mail = $_GET["mail"];
    $qq = $_GET["qq"];	
    $wechat = $_GET["wechat"];
    $blog = $_GET["blog"];
    $github = $_GET["github"];
    $native = $_GET["native"];
    $major = $_GET["major"];
	$workplace = $_GET["workplace"];
	$job = $_GET["job"];
	$uid = $_GET["uid"];
	
	$checkArr = array(
		"$uid" => 'digit', 
		"$password" => 'normal',
		"$phone" => 'phone',
		"$mail" => 'mail',
		"$qq" => 'normal',
		"$wechat" => 'normal',
		"$blog" => 'site',
		"$github" => 'site',
		"$native" => 'chinese',
		"$major" => 'chinese',
		"$workplace" => 'chinese',
		"$job"  => 'chinese'
	);
	if( !checkArr($checkArr) ){
		echo 'false';
		return;
	}
	
	global $conn;
	$query_str = "SELECT * FROM `cs_user` where uid='$uid';";
	$result = $conn->query($query_str);
	if( $result->num_rows <= 0 ){
		echo 'false';
		if( is_object($result) )
			$result->close();
		return;
	}	
	
	$infoArr = array(
		'password' => "'$password'",
		'phone'	=> "'$phone'",
		'mail' => "'$mail'",
		'qq' => "'$qq'",
		'wechat' => "'$wechat'",
		'blog' => "'$blog'",
		'github' => "'$github'",
		'native' => "'$native'",
		'major' => "'$major'",
		'workplace' => "'$workplace'",
		'job' => "'$job'"
	);

	$flag = false;
	while( $value = current($infoArr) ){
		if( $value != "''" ){
			$query_str = "UPDATE `cs_user` set `".key($infoArr)."`=$value;";
			if( !$conn->query($query_str) ){
				echo 'false';
				return;
			}else
				$flag = true;
		}
		next($infoArr);
	}

	if($flag)
		echo 'true';
	else
		echo 'false';

	if( is_object($result) )
		$result->close();
}

function cs_get_privilege(){
	$uid = $_GET['uid'];

	if( !checkStr('digit',$uid) ){
		echo 'false';
		return;
	}
	
	global $conn;
	$query_str = "SELECT * FROM `cs_user` WHERE uid=$uid;";
	$result = $conn->query($query_str);
	if( $result->num_rows <= 0 ){
		echo 'false';
		if( is_object($result) )
			$result->close();
		return;
	}
	echo $result->fetch_array(MYSQLI_ASSOC)['permisson'];
	
	if( is_object($result) )
		$result->close();	
}

function cs_deliver_privilege(){
	$uid_now = $_GET['uid_now'];
	$uid_next = $_GET['uid_next'];
	
	if( !checkStr('digit',$uid_now) || !checkStr('digit',$uid_next) ){
		echo 'false';
		return;
	}
	
	global $conn;
	$query_str1 = "SELECT * FROM `cs_user` WHERE uid=$uid_now;";
	$query_str2 = "SELECT * FROM `cs_user` WHERE uid=$uid_next;";
	$result1 = $conn->query($query_str1);
	$result2 = $conn->query($query_str2);	
	if( $result1->num_rows <= 0 || $result2->num_rows <= 0){
		echo 'false';
		if( is_object($result1) )
			$result1->close();
		if( is_object($result2) )
			$result2->close();
		exit;
	}
	if($result1->fetch_array(MYSQLI_ASSOC)['permisson'] != '1' || $result2->fetch_array(MYSQLI_ASSOC)['permisson'] != '0'){
		echo 'false';
		return;
	}
	$query_str1 = "UPDATE `cs_user` SET permisson=0 WHERE uid=$uid_now;";
	$query_str2 = "UPDATE `cs_user` SET permisson=1 WHERE uid=$uid_next;";	
	$conn->query($query_str1);
	$conn->query($query_str2);
	echo 'true';
	
	if( is_object($result1) )
		$result1->close();
	if( is_object($result2) )
		$result2->close();
}

?>
