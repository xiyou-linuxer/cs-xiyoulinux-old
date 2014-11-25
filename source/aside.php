<?php
$user_class = new User();
$privilege = $user_class->get_privilege($_SESSION['uid']);

$tpl->assign('aside_privilege', $privilege);

$plugin_class = new Plugin();
$app_objs = $plugin_class->get_app_list();
/*
if ($app_objs != false) {
    $app_list= array();
    foreach ( $app_objects as $app ) {
        if ($app->status == '已启用') {
            $item = array('title'=>$app->title);
            array_push($app_list, $item);
        }
    }
    $tpl->assign('aside_app_list', $app_list);
}
*/
?>
