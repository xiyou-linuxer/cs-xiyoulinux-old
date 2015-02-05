<?php
session_start();
require_once(dirname(dirname(__FILE__)) . '/config.php');
require_once(BASE_PATH . "/includes/db.class.php");

//获取新密码和姓名验证

$name = $_POST["name"];
$passwd = $_POST["passwd"];
$time = $_POST["time"];
$verify = $_POST["verify"];
$time = (string)$time;
$dbObj = new DBClass();
//再次确认是否已修改密码
$sql = "select * from cs_user where name='$name';";
$result = $dbObj->query($sql);
if($result->num_rows){
    $userinfo = $result->fetch_assoc();
}
else{
    echo "修改失败";
}

$token = md5($userinfo['uid'].$userinfo['password'].$time);
if($verify == $token){
    $key = md5($passwd);
    $result = change_key($key,$name);
    if($result){
        unset($_SESSION['uid']);
        echo "修改成功";
    }
    else {
        echo "修改失败";
    }
}
else {
    echo '<meta  charset="utf-8">验证失败，该连接无效!';
}

function change_key($key,$name){
    $dbObj = new DBClass();
    $sql = "update cs_user set password='$key' where name='$name';";
    if($result = $dbObj->query($sql)){
        return $result;
    }
}    
?>
