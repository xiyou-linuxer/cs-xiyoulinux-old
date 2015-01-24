<?php

include_once('init.php');
include('header.php');
include('aside.php');
include('chat.php');
include('footer.php');
include('inc/plugins.class.php');

include_once('access_ctl.php');

if (checkPermisson() == 1){
        $tpl->display('admin_appmanager.tpl');

}else{
    echo "<script languege=\"javascript\">";
    echo "document.location=\"index.php\"";
    echo "</script>";
}

?>
