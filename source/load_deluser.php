<?php

include_once('init.php');
include('header.php');
include('aside.php');
include('chat.php');
include('footer.php');

$style_list = array (
'js/chosen/chosen.css'
);
$tpl->assign('style_list', $style_list);

$script_list = array (
'js/chosen/chosen.jquery.min.js'
);
$tpl->assign('script_list', $script_list);

$tpl->display('header.html');
$tpl->display('aside.html');
$tpl->display('admin_deluser.html');
$tpl->display('chat.html');
$tpl->display('footer.html');

?>
