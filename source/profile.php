<?php

error_reporting(E_ALL^E_NOTICE^E_WARNING);
include_once('init.php');
require_once('header.php');
require_once('aside.php');
require_once('chat.php');
require_once('footer.php');
require_once('server/fresh.server.php');

$uid = $_COOKIE['uid'];
$current_uid = $_COOKIE['uid'];
if(isset($_GET['uid']))
    $infouid = $_GET["uid"];
else
    $infouid = $current_uid;

$user = new User();

$json_info = $user->get_userinfo($infouid);
$infos = json_decode($json_info, true);
$info = $infos[0];
$info["issame"] = ($infouid == $current_uid);
$info['infouid'] = $infouid;
$avatar = $user->get_avatar($infouid);

$a  = new GetArt();
for($i = 0; $i < 5; ++$i){
    $tmp = $a->get('uid', $infouid, $i);
    if($tmp == false)
        break;
    $Dynamics_array[] = $tmp;
}

$sql = "SELECT uid,password FROM cs_user WHERE uid=".$infouid.";";
$conn = new Csdb;
$result = $conn->query($sql);
$result_info = $result->fetch_assoc();
$temp_time = (string)(time()+24*3600);
$temp_str = $result_info['uid'].$result_info['password'].$temp_time;
$token = md5($temp_str);
$modifyPasswdUrl = "reset_key.php?uid=".$result_info['uid']."&token=".$token."&time=".$temp_time;

$tpl->assign('script_list', $script_list);
$tpl->assign("avatar", $avatar);
$tpl->assign( "Dynamics_array", $Dynamics_array );
$tpl->assign('info', $info);
$tpl->assign('modifyPasswdUrl', $modifyPasswdUrl);

$tpl->display('profile.tpl');
?>


