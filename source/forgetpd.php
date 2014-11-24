<?php
require("smtp.php");
require_once("inc/conn.php");


$conn = new Csdb();
$name = $_post['name'];
$mail = $_post['mail'];

$sql = "select mail,name from cs_user where name='$name' and mail='$mail';";
$result = $conn->query($sql);

if($result->num_rows == 0){
	print "该邮箱还没注册";
	exit;
}

$userinfo = mysql_fetch_array($result);
$getpasstime = time()+24*3600;
$token = md5($userinfo['uid'].$userinfo['password'].$getpassstime);
$url = "http://www.xxx.com/xxx/xx.php?uid=".$userinfo['uid']."&token=".$token."&time=".$getpasstime;
$time = date('Y-m-d H:i');


$smtpserver = "smtp.exmail.qq.com";
$smtpserverport = 25;
$smtpusermail = "root@xiyoulinux.org";
$smtpemailto = "$userinfo['mail']";
$smtpuser = "root@xiyoulinux.org";
$smtppass = "";

$mailsubject = "找回密码";
$mailbody =  "亲爱的".$email."：<br/>您在".$time."提交了找回密码请求。请点击下面的链接重置密码
（按钮24小时内有效）。<br/><a href='".$url."'target='_blank'>".$url."</a>"; 
$mailtype = "html";
$smtp = new smtp($smtpserver, $smtpserverport, true, $smtpuser, $smtppass);
$smtp->debug = TRUE;
$info = $smtp->sendmail($smtpemailto, $smtpusermail, $mailsubject, $mailbody, $mailtype);
if($info == 1){
print "发送成功";
}

?>
