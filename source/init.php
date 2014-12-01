<?php
    session_start();

    include('/usr/local/lib/php/smarty/Smarty.class.php');

    $tpl = new Smarty();
    $tpl->template_dir = './templates/';
    $tpl->compile_dir = './templates_c/';
    $tpl->config_dir = './configs/';
    $tpl->cache_dir = './cache/';
    $tpl->left_delimiter = '<{';
    $tpl->right_delimiter = '}>';

    if(!isset($_SESSION['uid']) ) {
        $tpl->display('signin.html');
        exit;
    }

    setcookie('uid', $_SESSION['uid'], time()+3600);

//    $last_page = basename($_SERVER['SCRIPT_FILENAME']);
//    if ($last_page != 'mail-view.php') {
//        setcookie('last_page',$last_page, time()+3600);
//    }
?>
