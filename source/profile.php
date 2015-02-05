<?php
error_reporting(E_ALL^E_NOTICE^E_WARNING);
require_once('init.php');
require_once('includes/activity.class.php');

$login_uid = $_COOKIE['uid'];
if(isset($_GET['uid'])) {
    $info_uid = $_GET["uid"];
} else {
    $info_uid = $login_uid;
}

$userObj = new UserClass();

$json = $userObj->get_userinfo($info_uid);
$result = json_decode($json, true);
$user_info = $result[0];
$user_info["issame"] = ($info_uid == $login_uid);
$user_info['uid'] = $info_uid;
$user_info['avatar'] = $userObj->get_avatar($info_uid);

$activityObj = new ActivityClass();
for($i = 0; $i < 10; ++$i){
    $tmp = $activityObj->get_activity('uid', $info_uid, $i);
    if($tmp == false) {
        break;
    }

    $activity_list[] = $tmp;
}

$sql = "SELECT uid, password FROM cs_user WHERE uid=" . $info_uid . ";";
$dbObj = new DBClass();
$result = $dbObj->query($sql);
$result_info = $result->fetch_assoc();
$temp_time = (string)(time()+24*3600);
$temp_str = $result_info['uid'].$result_info['password'].$temp_time;
$token = md5($temp_str);
$reset_pass_url = SITE_DOMAIN . "/resetpd.php?uid=".$result_info['uid']."&token=".$token."&time=".$temp_time;

$smarty->assign( "activity_list", $activity_list );
$smarty->assign('user_info', $user_info);
$smarty->assign('reset_pass_url', $reset_pass_url);

$smarty->display('profile.tpl');
?>


