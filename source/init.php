<?php
    session_start();
    include('config.php');
    include(SMARTY_HOME_PATH . '/Smarty.class.php');
    
    $tpl = new Smarty();
    $tpl->template_dir = BASE_PATH . '/templates/';
    $tpl->compile_dir = BASE_PATH . '/templates_c/';
    $tpl->config_dir = BASE_PATH . '/configs/';
    $tpl->cache_dir = BASE_PATH . '/cache/';
    $tpl->left_delimiter = '<{';
    $tpl->right_delimiter = '}>';

    if(!isset($_SESSION['uid']) ) {
        $tpl->display('signin.tpl');
        exit;
    }
    
    setcookie('uid', $_SESSION['uid'], time()+3600);

    $tpl->assign('SITE_DOMAIN', SITE_DOMAIN);
//    $last_page = basename($_SERVER['SCRIPT_FILENAME']);
//    if ($last_page != 'mail-view.php') {
//        setcookie('last_page',$last_page, time()+3600);
//    }
?>
