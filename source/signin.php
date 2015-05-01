<?php
    session_start();
    include('smarty.php');

    $referer_uri = (!empty($_GET['referer_uri'])) ? $_GET['referer_uri'] : "index.php";
    if(isset($_SESSION['uid']) ) {
        header('location: ' . $referer_uri);
        exit;
    }

    $smarty->assign('referer_uri', $referer_uri);
    $smarty->display('signin.tpl');
?>
