<?php
/**
 * admin_xxxx js操作直接关联的php文件
 * Created by PhpStorm.
 * User: andrew
 * Date: 14-12-27
 * Time: 下午5:35
 */
error_reporting(E_ALL^E_NOTICE^E_WARNING);

require_once('../inc/admin.class.php');
require_once('../inc/user.class.php');

$admin = new Admin();
$user = new User();

if (isset($_POST['func'])){
    $func = $_POST['func'];
}
if (isset($_POST['grade'])){
    $grade = $_POST['grade'];
}
if (isset($_POST['uid'])){
    $uid = $_POST['uid'];
}

switch($func){
    case 'getAllGrade':
        echo $admin->getAllGrade();
        break;
    case 'getMemberByGrade':
        if (!isset($grade))
            echo false;
        echo $admin->getMemberNameByGrade($grade);
        break;
    case 'deleteUser':
        if (!isset($name)){
            echo false;
        }
        echo $user->del_user(uid);
        break;
    default :
        break;
}
?>