<?php
include_once('init.php');
require_once('inc/conn.php');
//require_once('index_content.php');
require_once('inc/user.class.php');

$_COOKIE['uid'] = "1001";
$current_uid = $_COOKIE['uid'];
if(isset($_GET['uid']))
    $infouid = $GET["uid"];
else
    $infouid = $current_uid;
//$infouid = '1002';
$user = new User();
$json_info = $user->get_userinfo($infouid);
$infos = json_decode($json_info, true);
$info = $infos[0];
$info["issame"] = ($infouid == $current_uid);

$link = new Csdb();

$Dynamics_array = array(
    array( "name" => "林达意", "action" => "提问", "time" => "1小时前", "contents" => "挖掘机到底哪家强？" ),
    array( "name" => "李翔", "action" => "回答", "time" => "1小时前","contents" => "挖掘机到底哪家强?</br>皇家西邮！" ),
    array( "name" => "林达意", "action" => "发表", "time" => "1小时前", "contents" => "《浅谈挖掘机技术》</br>咱就是实打实的学本领，不玩虚的，你学挖掘机就把地挖好，你学厨师就把菜做好，你学裁缝就把衣服做好。咱们蓝翔如果不踏踏实实学本事，那跟清华北大还有什么区别呢？" )
);


$tpl->assign( "Dynamics_array", $Dynamics_array );
$tpl->assign('info', $info);
$tpl->display('profile.html');
?>
