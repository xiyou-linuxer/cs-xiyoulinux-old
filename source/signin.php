<?php
    session_start();
    include('smarty.php');

    $referer_uri = ($_SERVER["HTTP_REFERER"]) ? $_SERVER["HTTP_REFERER"] : "index.php";
    if(isset($_SESSION['uid']) ) {
        header('location: ' . $referer_uri);
        exit;
    }

    $smarty->assign('referer_uri', $referer_uri);
    $smarty->display('signin.tpl');
?>