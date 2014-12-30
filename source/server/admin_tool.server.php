<?php
/**
 * admin_xxxx js操作直接关联的php文件
 * Created by PhpStorm.
 * User: andrew
 * Date: 14-12-27
 * Time: 下午5:35
 */

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
    case 'addUser':
        if (!isset($_POST['name']) || !isset($_POST['sex']) || !isset($_POST['mail']) || !isset($_POST['grade']) || !isset($_POST['major']) || !isset($_POST['native']) || !isset($_POST['tel'])){
            echo false;
        }else{
            $name = $_POST['name'];
            $sex = $_POST['sex'];
            $mail = $_POST['mail'];
            $grade = $_POST['grade'];
            $major = $_POST['major'];
            $tel = $_POST['tel'];
            $native = $_POST['native'];
            $qq = $_POST['qq'];
        }
        if (addUser($name, $sex, $mail, $grade, $major, $tel, $native, $qq)){
            echo true;
        }else
            echo false;
        break;
    case 'reflash':
        if (!isset($_POST['now_uid']) || !isset($_POST['next_uid'])){
            echo false;
        }else{
            $now_uid = $_POST['now_uid'];
            $next_uid = $_POST['next_uid'];
        }
        echo $user->deliver_privilege($now_uid, $next_uid);
        break;
    default :
        break;
}

//var_dump(addUser("测试测",1,"2342422247@qq.com", 2014, "计算科学与技术", '', '', ''));

/**
 * 新添用户接口,对user.class.php里的add_user进行再封装
 * @param $name 姓名 必填
 * @param $sex 性别 必填
 * @param $mail 邮箱 必填 不允许重复
 * @param $grade 届别 必填
 * @param $major 专业 必填
 * @param $phone 手机号 选填 不允许重复
 * @param $native 籍贯 选填
 * @param $qq qq号 选填
 */
function addUser($name, $sex, $mail, $grade, $major, $phone, $native, $qq){
    $user = new User();
    return $user->add_user($name, '000000', $sex, $phone, $mail, $qq, '', '', '',
        $native, $grade, $major, '', '');
}
?>