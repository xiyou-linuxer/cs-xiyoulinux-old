<?php

	require_once("inc/conn.php");
	require_once("inc/function.php");	
	

	date_default_timezone_set('PRC');
	//$logfile = fopen("register.log", "a");
	//fwrite($logfile, date('Y-m-d H:i:s') . "\t" . getIP() . "\t");	

	$conn = new Csdb();

	$func = $_POST["func"];
	switch($func){
	case 'add_user':
	//	fwrite($logfile,"add_user\r\n");
		check_user();
		add_user();
		break;
	case 'del_user':
	//	fwrite($logfile,"del_user\r\n");
		check_user();
		del_user();
		break;
	case 'get_userinfo':
	//	fwrite($logfile,"get_userinfo\r\n");
		check_user();
		get_userinfo();
		break;
	case 'update_userinfo':
	//	fwrite($logfile,"update_userinfo\r\n");
		check_user();
		update_userinfo();
		break;
	case 'get_privilege':
	//	fwrite($logfile,"get_privilege\r\n");
		check_user();
		get_privilege();
		break;
	case 'deliver_privilege':
	//	fwrite($logfile,"deliver_privilege\r\n");
		check_user();
		deliver_privilege();
		break;
	case 'get_avatar':
	//	fwrite($logfile,"get_avatar\r\n");
		check_user();
		get_avatar();
		break;
	case 'check_user':
	//	fwrite($logfile,"get_avatar\r\n");
		check_user();
		print 'true';
		break;
	}

	//fclose($logfile);

?>

<?php

function add_user(){
    $name = $_POST["name"];	
	$permisson = 0;
    $password = $_POST["password"];
	$sex = $_POST["sex"];
	$phone = $_POST["phone"];
    $mail = $_POST["mail"];
    $qq = $_POST["qq"];	
    $wechat = $_POST["wechat"];
    $blog = $_POST["blog"];
    $github = $_POST["github"];
    $native = $_POST["native"];
    $grade = $_POST["grade"];
    $major = $_POST["major"];
	$workplace = $_POST["workplace"];
	$job = $_POST["job"];
	if( empty($name) || empty($password) || $sex=="" || empty($mail) || empty($grade) || empty($major) ){
		echo 'false';
		exit;
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
		exit;
	}

	global $conn;
	$query_str = "SELECT * FROM `cs_user` where name='$name';";
	$result = $conn->query($query_str);
	if( $result->num_rows > 0 ){
		echo 'false';
		if( is_object($result) )
			$result->close();
		exit;
	}
	$query_str = "INSERT INTO `cs_user`(`name`,`permisson`,`password`,`sex`,`phone`,`mail`,`qq`,`wechat`,`blog`,`github`,`native`,`grade`,`major`,`workplace`,`job`) VALUES ('$name','$permisson','$password','$sex','$phone','$mail','$qq','$wechat','$blog','$github','$native','$grade','$major','$workplace','$job');";
	
	if( $conn->query($query_str) )
		echo 'true';
	else
		echo 'false';

	if( is_object($result) )
		$result->close();
}

function del_user(){
	$uid = $_POST['uid'];

	if( !checkStr('digit',$uid) ){
		echo 'false';
		exit;
	}
	
	global $conn;
	$query_str = "SELECT * FROM `cs_user` WHERE uid='$uid';";
	$result = $conn->query($query_str);
	if( $result->num_rows <= 0 ){
		echo 'false';
		if( is_object($result) )
			$result->close();
		exit;
	}

	$query_str = "DELETE FROM `cs_user` WHERE uid='$uid';";
	
	if( $conn->query($query_str) )
		echo 'true';
	else
		echo 'false';
	
	if( is_object($result) )
		$result->close();
}

function get_userinfo(){
	$uid = $_COOKIE['uid'];

	if( !checkStr('digit',$uid) ){
		echo 'false';
		exit;
	}	
	
	global $conn;
	$query_str = "SELECT * FROM `cs_user` WHERE uid='$uid';";
	$result = $conn->query($query_str);
	if( $result->num_rows <= 0 ){
		echo 'false';
		if( is_object($result) )
			$result->close();
		exit;
	}
	while( $row = $result->fetch_assoc() ){
		$com[] = $row;
	}
	unset($com[0]['password']);
	if( is_object($result) )
		$result->close();
	echo json_encode($com);
}

function update_userinfo(){
    $password = $_POST["password"];
	$phone = $_POST["phone"];
    $mail = $_POST["mail"];
    $qq = $_POST["qq"];	
    $wechat = $_POST["wechat"];
    $blog = $_POST["blog"];
    $github = $_POST["github"];
    $native = $_POST["native"];
    $major = $_POST["major"];
	$workplace = $_POST["workplace"];
	$job = $_POST["job"];
	$uid = $_COOKIE["uid"];
	
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
		exit;
	}
	
	global $conn;
	$query_str = "SELECT * FROM `cs_user` where uid='$uid';";
	$result = $conn->query($query_str);
	if( $result->num_rows <= 0 ){
		echo 'false';
		if( is_object($result) )
			$result->close();
		exit;
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
				exit;
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

function get_privilege(){
	$uid = $_POST['uid'];

	if( !checkStr('digit',$uid) ){
		echo 'false';
		exit;
	}
	
	global $conn;
	$query_str = "SELECT * FROM `cs_user` WHERE uid=$uid;";
	$result = $conn->query($query_str);
	if( $result->num_rows <= 0 ){
		echo 'false';
		if( is_object($result) )
			$result->close();
		exit;
	}
    $row = $result->fetch_assoc();
    echo $row['permisson'];
	
	if( is_object($result) )
		$result->close();	
}

function deliver_privilege(){
	$uid_now = $_POST['uid_now'];
	$uid_next = $_POST['uid_next'];
	
	if( !checkStr('digit',$uid_now) || !checkStr('digit',$uid_next) ){
		echo 'false';
		exit;
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
    $row1 = $result1->fetch_assoc();
    $row2 = $result2->fetch_assoc();
    if($row1['permisson'] != '1' ||$row2['permisson'] != '0'){
		echo 'false';
		exit;
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

function get_avatar(){
	$uid = $_POST['uid'];

	global $conn;
	$query = "SELECT `mail` FROM `cs_user` WHERE `uid`=$uid;";
	$result = $conn->query($query);
	if( $result->num_rows <= 0){
		print 'false';
		exit;
	}
	$row = $result->fetch_assoc();
	$mail = $row['mail'];
	$default = "http://xdth.sinaapp.com/img/man.jpg";
	$size = 150;
	$grav_url = "http://www.gravatar.com/avatar/" .md5(strtolower(trim($mail))) .
		"?d=" .urlencode($default) . "&s=" . $size;
	print $grav_url;
}

function check_user(){
	if (checkUser() == false){
		print 'false';
		exit;
	}
}

?>
