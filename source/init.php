<?php

session_start();

require_once(dirname(__FILE__) .'/config.php');

if(!isset($_SESSION['uid']) ) {
    $referer_uri = urlencode('http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']);
    header('location: ' . SITE_DOMAIN . '/signin.php?referer_uri=' . $referer_uri);
    exit;
}

require_once(dirname(__FILE__) .'/smarty.php');
require_once(dirname(__FILE__) .'/includes/mail.class.php');
require_once(dirname(__FILE__) . '/includes/user.class.php');
require_once(dirname(__FILE__) . '/includes/plugin.class.php');

setcookie('uid', $_SESSION['uid'], time()+3600);

$login_uid = $_SESSION['uid'];
$_COOKIE['uid'] = $login_uid;

//获取登录用户信息
$CUser = new UserClass();
//获取登录用户名
$json_str = $CUser->get_userinfo($login_uid);
$user_obj = json_decode($json_str);
$username = $user_obj[0]->name;
//获取登录用户头像
$user_avatar = $CUser->get_avatar($login_uid);
//获取登录用户权限
$user_privilege = $CUser->get_privilege($_SESSION['uid']);

//获取站内信信息
$CMail = new MailClass($login_uid);
//获取未读站内信数量
$json_str = $CMail->get_mail_count();
$result_array = json_decode($json_str);
$unread_mail_count = $result_array->unread;

//获取站内信数组
$json_str = $CMail->get_mail_list(1);
$unread_mail_array = json_decode($json_str);
$unread_mail_list= array();
if (!isset($unread_mail_array->result)) {
    foreach ( $unread_mail_array as $mail_obj ) {
        $fromuser_avatar = $CUser->get_avatar($mail_obj->fromuid);
        $item = array(
            'mid'=>$mail_obj->mid,
            'title'=>$mail_obj->title,
            'date'=>$mail_obj->date,
            'fromuser_avatar'=>$fromuser_avatar
        );

        array_push($unread_mail_list, $item);
    }
}

//获取应用信息
$CPlugin = new PluginClass();
$app_info_array = $CPlugin->get_app_list();
$app_info_list= array();
if (is_array($app_info_array)) {
    foreach ( $app_info_array as $app_obj ) {
        $app_name = $app_obj['name'];
        $json_str = $app_obj['attr'];
        $app_attr = json_decode($json_str);
        $app_aside = $app_attr->aside;
        
        //$update_status = 'false';
        $update_status = ($app_aside->dis_number == '1') ? 'true' : 'false';
        $item = array('app_name'=>$app_aside->dis_name,
            'app_home'=>$app_aside->load_file,
            'app_icon'=>$app_aside->icon,
            'icon_color'=>$app_aside->icon_color,
            'update_status'=>$update_status,
            'app_function'=>'/app/'.$app_name.'/function.php'
        );

        array_push($app_info_list, $item);
    }
}

//获取在线用户信息
$user_info_list = array();
$user_online = $CUser->get_user_list('online');
if ($user_online->num_rows) {
    while ( ($item = $user_online->fetch_assoc()) ) {
        $item['status'] = "on b-light right sm";
        $item['avatar'] = $CUser->get_avatar($item['uid']);

        array_push($user_info_list, $item);
    }
}

$user_offline = $CUser->get_user_list('offline');
if ($user_offline->num_rows) {
    while ( ($item = $user_offline->fetch_assoc()) ) {
        $item['status'] = "off b-light right sm";
        $item['avatar'] = $CUser->get_avatar($item['uid']);

        array_push($user_info_list, $item);
    }
}

$smarty->assign('site_domain', SITE_DOMAIN);
$smarty->assign('nav_unread_mail_list', $unread_mail_list);
$smarty->assign('nav_unread_mail_count', $unread_mail_count);
$smarty->assign('nav_profile_username', $username);
$smarty->assign('nav_profile_uid', $login_uid);
$smarty->assign('nav_profile_avatar', $user_avatar);

$smarty->assign('laside_user_privilege', $user_privilege);
$smarty->assign('laside_app_list', $app_info_list);
$smarty->assign('laside_unread_mail_count',$unread_mail_count);

$smarty->assign('raside_user_list',$user_info_list);
?>
