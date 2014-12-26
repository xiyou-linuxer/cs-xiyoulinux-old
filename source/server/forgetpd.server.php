<?php
require_once(dirname(dirname(__FILE__)) . '/config.php');
require_once(BASE_PATH . "/inc/smtp.class.php");
require_once(BASE_PATH . "/inc/conn.php");


$conn = new Csdb();
$name = $_POST["name"];
$mail = $_POST["email"];

$sql = "select mail,name,uid, password from cs_user where name='$name' and mail='$mail';";
$result = $conn->query($sql);
if($result->num_rows == 0){
	print "该邮箱还没注册";
	exit;
}

//$userinfo = mysql_fetch_array($result);
$userinfo = $result->fetch_assoc();
$getpasstime = time()+24*3600;
$str_time = (string)$getpasstime;
$str = $userinfo['uid'].$userinfo['password'].$str_time;
$token = md5($str);
$url = "http://cs.xiyoulinux.org/reset_key.php?uid=".$userinfo['uid'] . "&token=".$token."&time=".$str_time;
$time = date('Y-m-d H:i');

$smtpserver = "smtp.exmail.qq.com";
$smtpserverport = 25;
$smtpusermail = "fatty_liao@xiyoulinux.org";
$smtpemailto = $userinfo['mail'];
$smtpuser = "fatty_liao@xiyoulinux.org";
$smtppass = "Niangnan1022";

$mailsubject = "找回密码";
$mailbody =  "亲爱的".$name."：\n\n您在".$time."提交了找回密码请求。请点击下面的链接重置密码
（链接24小时内有效）。\n".$url."\n如果您确认您没有进行此操作，请忽略此邮件内容。\n本邮件为系统自动发送,请勿直接回复。"; 
$mailtype = "html";
$smtp = new smtp($smtpserver, $smtpserverport, true, $smtpuser, $smtppass);
//$smtp->debug = TRUE;
$info = $smtp->sendmail($smtpemailto, $smtpusermail, $mailsubject, $mailbody, $mailtype);
if($info == 1){
print "发送成功,请注意查收你的邮件,24小时有效!";
} else {
print "发送失败";
}

?>
