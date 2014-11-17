<?php

include_once('init.php');
include('header.php');
include('aside.php');
include('footer.php');

$style_list = array (
    'css/mail.css',
    'plugin/wysihtml5/css/bootstrap-wysihtml5-0.0.2.css'
);
$tpl->assign('style_list', $style_list);

$script_list = array (
    'plugin/typeahead/js/bootstrap-typeahead.js',
    'plugin/wysihtml5/js/bootstrap-wysihtml5-0.0.2.js',
    'plugin/wysihtml5/js/wysihtml5-0.3.0.js',
    'js/mail.js'
);
$tpl->assign('script_list', $script_list);

$tpl->display('header.html');
$tpl->display('aside.html');
$tpl->display('mail-edit.html');
$tpl->display('footer.html');
?>
