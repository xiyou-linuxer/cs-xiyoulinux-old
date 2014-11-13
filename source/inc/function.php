<?php

function checkUser(){
	$uid = $_COOKIE['uid'];
	session_start();
	if( !isset($_SESSION['identity']) )
		return false;
	if( crypt($uid,'cs_linux_2012') != $_SESSION['identity'] )
		return false;
	return true;
}

function getIP() {		//获取IP
	if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))  
		$realip = $_SERVER['HTTP_X_FORWARDED_FOR']; 
	elseif (isset($_SERVER['HTTP_CLIENT_IP']))  
		$realip = $_SERVER['HTTP_CLIENT_IP']; 
	else
		$realip = $_SERVER['REMOTE_ADDR']; 
	return $realip; 
}

function checkArr($checkArr){	//检查对应类型，参数是数组
	//KEY-VALUE形，类似$password => 'normaol'这样构造即可
	if( !is_array($checkArr) )
		return false;
	$check_ok = true;
	while( $value = current($checkArr) ){
		$result = key($checkArr);
		if( !empty($result))
			$check_ok &= checkStr($value,$result);
		next($checkArr);
	}
	reset($checkArr);
	return $check_ok;
}

function checkStr($type,$desStr){	//看代码都懂
	$result = false;

	switch($type){
	case 'digit':
		$result = (preg_match("/^\d+$/",$desStr) > 0);
		break;
	case 'phone':
		$result = (preg_match("/^[\d-]+$/",$desStr) > 0);
		break;
	case 'mail':
		$result = (preg_match("/^\w+@\w+\.com$/",$desStr) > 0);
		break;
	case 'chinese':
		$result = (preg_match("/^[\x{4e00}-\x{9fa5}]+$/u",$desStr) > 0);
		break;
	case 'normal':
		$result = (preg_match("/^\w+$/",$desStr) > 0);
		break;
	case 'site':
		$result = (preg_match("/^\w+\.\w+$/",$desStr) > 0);
		break;
	default:
		break;
	}
	return $result;
}

function substr_utf8($string,$start,$length, $flag)  
{
    $chars = $string;  
    $i=0;
    do{
        if (preg_match ("/[0-9a-zA-Z]/", $chars[$i])){
            $m++;  
        }  
        else {
            $n++;
        } 

        $k = $n/3+$m/2;  
        $l = $n/3+$m;
        $i++;
    } while($k < $length);
    $str = mb_substr($string,$start,$l,'utf-8');
    if ($flag > 0 && strlen($str) < strlen($string)) {
        $str = $str . "...";
    }
    return $str;  
} 

?>
