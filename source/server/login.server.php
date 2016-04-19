<?php
session_start();
require_once(dirname(dirname(__FILE__)) . '/config.php');
require_once(BASE_PATH . "/includes/db.class.php");

if ( !isset($_POST['action']) ) {
    return;
}

$action = $_POST['action'];
$action = htmlentities($action, ENT_QUOTES,'UTF-8');

if ( $action == 'logout' ) {
    if ( isset($_SESSION['uid']) ) {
        /*修订：2014-11-25 张永军
        最初决定使用COOKIE来验证登录，但是出于不明原因，当把该脚本放在server目录下时，客户端接收不到COOKIE，导致登录失败。
        所以改用使用SESSION来验证登录。
        但是由于各个模块都使用COOKIE来调用数据库接口，所以为了兼容起见，在init.php中使用SESSION来验证登录的同时，也设置了COOKIE。
        */
        unset($_SESSION['uid']);
        //setcookie('uid', '', time());
    }
}

if ( $action == 'login' ) {
    if($_SESSION['wrong_times'] >= 3){
        print 'false1';
    }

    $name = $_POST['name'];
    $password = $_POST['password'];
    if( empty($name) || empty($password) ){
        print 'false2';
        exit;
    }
    /*修订：2016-04-19 王博
    防止SQL注入，用户校验
    */

    $dbObj = new DBClass();
    $name = $dbObj->dhtmlspecialchars($name);
    $query = "SELECT `uid`,`password` FROM `cs_user` WHERE `name`='$name';";
    $result = $dbObj->query($query);
    if( $result->num_rows <= 0 ){
        print 'false3';
        exit;
    }
    if( $_SESSION['wrong_times'] >= 3 ){
        $checknum = $_POST['checknum'];
        if( $_SESSION['checknum'] != $checknum ){
            print 'false4';
            exit;
        }
    }
    $row = $result->fetch_assoc();
    $password = md5($password);
    if($password == $row['password']){
        $_SESSION['wrong_times'] = 0;
        $_SESSION['identity'] = crypt($row['uid'],'cs_linux_2012');
        $_SESSION['uid'] = $row['uid'];
        $sql = "SELECT * FROM cs_online WHERER uid=" . $row['uid'] . ";";
        $result = $dbObj->query($sql);
        if ( $result->num_rows ) {
            $time = time();
            $sql1 = "UPDATE cs_online SET time=" . $time . " WHERE uid=" . $row['uid'] . ";";
            $dbObj->query($sql1);
        }
        else {
            $time = time();
            $sql2 = "INSERT INTO cs_online values(" . $row['uid'] . "," . $time . ";";
            $dbObj->query($sql2);
        }
        //setcookie('uid',$row['uid'],time()+3600);
        print 'true&'.$row['uid'];
    }else{
        print 'false5';
        if( isset($_SESSION['wrong_times']) )
            ++$_SESSION['wrong_times'];
        else
            $_SESSION['wrong_times'] = 0;
    }
}
?>
