<?php

include_once('init.php');
include('header.php');
include('aside.php');
include('chat.php');
include('footer.php');

include_once("access_ctl.php");

if (checkPermisson() == 1){
        $tpl->display('admin_deluser.tpl');
}else{
        echo "<script languege=\"javascript\">";
        echo "document.location=\"index.php\"";
        echo "</script>";
}


?>
