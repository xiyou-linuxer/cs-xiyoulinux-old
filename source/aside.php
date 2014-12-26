<?php
$user_class = new User();
$privilege = $user_class->get_privilege($_SESSION['uid']);

$tpl->assign('aside_privilege', $privilege);

$plugin_class = new Plugin();
$app_array = $plugin_class->get_app_list();
    
global $unread_mail_count;

if ($app_array != false) {
    $app_list= array();
    foreach ( $app_array as $app ) {
        if ($app['status'] == 'off') {
	    $app_aside =$app['aside'];

            $update_status = ($app_aside['dis_number']['use'] == '1') ? 'true' : 'false';
            $update_number= ($update_status == 'true') ? $app_aside['dis_number']['number'] : '0';
            $item = array('app_name'=>$app_aside['dis_name'],
                'app_home'=>$app_aside['load_file'],
                'app_icon'=>$app_aside['icon'],
                'update_status'=>$update_status,
                'update_number'=>$update_number
            );
            array_push($app_list, $item);
        }
    }
    $tpl->assign('aside_app_list', $app_list);
    $tpl->assign('aside_unread_count',$unread_mail_count);
}
?>
