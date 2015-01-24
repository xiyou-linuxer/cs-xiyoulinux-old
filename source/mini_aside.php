<?php
include_once( 'init.php' );
include_once("inc/plugin.class.php");

$app = new Plugin();
$result = $app->get_app_list();

$mini_aside_array = array();

foreach($result as $r)
{
	$json = json_decode($r['attr']);
        if ($json->plugin_use == '1')
        {
                array_push($mini_aside_array, '/app/'.$r['name'].'/function.php');
        }
}

$tpl->assign('mini_aside_array', $mini_aside_array);

?>
