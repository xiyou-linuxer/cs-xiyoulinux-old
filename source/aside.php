<?php

global $unread_mail_count;

$user_class = new User();
$privilege = $user_class->get_privilege($_SESSION['uid']);

$tpl->assign('aside_privilege', $privilege);

$plugin_class = new Plugin();
$app_array = $plugin_class->get_app_list();

    
if (is_array($app_array)) {
    $app_list= array();
    foreach ( $app_array as $app ) {
	$app_name = $app['name'];
	$json_str = $app['attr'];
	$app_attr = json_decode($json_str);
       	$app_aside = $app_attr->aside;
        
        //$update_status = 'false';
        $update_status = ($app_aside->dis_number == '1') ? 'true' : 'false';
        $item = array('app_name'=>$app_aside->dis_name,
                'app_home'=>$app_aside->load_file,
                'app_icon'=>$app_aside->icon,
                'app_icon_color'=>$app_aside->icon_color,
                'update_status'=>$update_status,
                'app_function'=>'/app/'.$app_name.'/function.php'
            );
            array_push($app_list, $item);
    }
    $tpl->assign('aside_app_list', $app_list);
    $tpl->assign('aside_unread_count',$unread_mail_count);
}
?>
