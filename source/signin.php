<?php
    session_start();
    include('smarty.php');

    if(isset($_SESSION['uid']) ) {
        header('location: index.php');
        exit;
    }

    $smarty->display('signin.tpl');
?>