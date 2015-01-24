<?php
include_once('init.php');
include_once('inc/conn.php');
function checkPermisson(){
        $uid = $_SESSION['uid'];
        $conn = new Csdb;
        $sql = "select permisson from `cs_user` where uid = '$uid';";
        $mansql = $conn->query($sql);
        $rowi = $mansql->fetch_assoc();
        $permisson = $rowi['permisson'];
        if($permisson != '1')
        {
                echo "<script language=\"javascript\">";
                echo "document.location=\"index.php\"";
                echo "</script>";
        }
        else
                return 1;    
}
?>
