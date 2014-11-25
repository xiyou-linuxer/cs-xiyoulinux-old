<?php
require_once('../inc/user.class.php');

$func = $_POST['func'];
$uid = $_POST['uid'];
$phone = $_POST['phone'];
$mail = $_POST['mail'];
$workplace = $_POST['workplace'];
$job = $_POST['job'];
$grade = $_POST['grade'];
$major = $_POST['major'];
$qq = $_POST['qq'];
$wechat = $_POST['wechat'];
$blog = $_POST['blog'];
$github = $_POST['github'];
$native = "西安";
$grade = trim($grade);
$workplace = trim($workplace);
$user = new User();
//var_dump($user->update_userinfo('1001','11111111','24124@111.com','123123123','123213','','',$native,'计算机科学与技术','杭州','天猫工程师'));

switch($func)
{
    case 'update_userinfo':
        echo $user->update_userinfo($uid,$phone,$mail,$qq,$wechat,$blog,$github,$native,$major,$workplace,$job);
        break;
    default :
        return ;
}
?>
