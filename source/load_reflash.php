<<<<<<< HEAD
<?php
include_once('init.php');
include('header.php');
include('aside.php');
include('chat.php');
include('footer.php');
$tpl->display('admin_reflash.tpl');
?>
=======
<?php

include_once('init.php');
include('header.php');
include('aside.php');
include('chat.php');
include('footer.php');

include_once('access_ctl.php');

if (checkPermisson() == 1)
        $tpl->display('admin_reflash.tpl');
else{
        echo "<script language=\"javacript\">";
        echo "document.loaction=\"index.php\"";
        echo "</script>";
}

?>
>>>>>>> f51f9654962265a55694a389a4b1781d32ccae64
