<?php
    include(dirname(dirname(__FILE__)) . '/config.php');
    include(BASE_PATH . '/includes/online.class.php');
    $onlineObj = new OnlineClass();
    
    $uid=$_GET['uid'];
    $logout=$_GET['logout'];
    
    if ($logout != null && $logout == 'true') {
        $time = time()-600;
    }
    else {
        $time = time();
    }
    $result = $onlineObj->select_online($uid, $time);
    if ($result == "false") {
        $onlineObj->insert_online($uid, $time);
    }
    else {
        $onlineObj->update_online($uid, $time);
    }
?>
