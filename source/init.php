<?php

    include('/usr/local/lib/php/smarty/Smarty.class.php');
    $tpl = new Smarty();
    $tpl->template_dir = './templates/';
    $tpl->compile_dir = './templates_c/';
    $tpl->config_dir = './configs/';
    $tpl->cache_dir = './cache/';
    $tpl->left_delimiter = '<{';
    $tpl->right_delimiter = '}>';

    include_once("conn.php");

	session_start();
    
    if( !isset($_SESSION['userid']) ) {
        //$tpl->display('signin.html');
        //exit;
	}
    
?>
