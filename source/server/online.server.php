<?php
    session_start();

    if (!isset($_GET['action']) || !isset($_SESSION['uid'])) {
        exit();
    }

    include(dirname(dirname(__FILE__)) . '/config.php');
    include(BASE_PATH . '/includes/online.class.php');
    $online_class = new OnlineClass();

    $uid=$_SESSION['uid'];
    $action=$_GET['action'];

    if ($action == 'logout') {
        $time = time()-600;
    } else {
        $time = time();
    }
    $result = $online_class->select_online($uid, $time);
    if ($result == "false") {
        $online_class->insert_online($uid, $time);
    }
    else {
        $online_class->update_online($uid, $time);
    }

    echo md5(time());
?>
