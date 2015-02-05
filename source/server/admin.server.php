<?php
/**
 * admin_xxxx js操作直接关联的php文件
 * Created by PhpStorm.
 * User: andrew
 * Date: 14-12-27
 * Time: 下午5:35
 */

require_once(dirname(dirname(__FILE__)) . '/config.php');
require_once(BASE_PATH . '/includes/admin.class.php');
require_once(BASE_PATH . '/includes/user.class.php');
require_once(BASE_PATH . '/includes/plugin.class.php');
require_once(BASE_PATH . '/includes/functions.php');

$adminObj = new AdminClass();
$userObj = new UserClass();

if (isset($_POST['action'])){
    $action = $_POST['action'];
}
if (isset($_POST['grade'])){
    $grade = $_POST['grade'];
}
if (isset($_POST['uid'])){
    $uid = $_POST['uid'];
}

if (isset($action)){
    switch($action){
        case 'getAllGrade':
            echo $adminObj->get_all_grade();
            break;
        case 'getMemberByGrade':
            echo get_member_by_grade($grade);
            break;
        case 'deleteUser':
            echo delete_user($uid);
            break;
        case 'addUser':
            echo add_user();
            break;
        case 'deliver_privilege':
            echo deliver_privilege();
            break;
        case 'checkMailCanUse':
            echo check_mail_can_use();
            break;
        case 'checkPhoneCanUse':
            echo check_phone_can_use();
            break;
        case 'getAppList':
            echo get_app_list();
            break;
        case 'changeAppStatus':
            echo change_app_status();
            break;
        case 'flush':
            echo flush_app_list();
            break;
        default :
            break;
    }
}

/*
 * 刷新应用
 * @return int 成功返回1  其余返回0
 * */
function flush_app_list(){
        $pluginObj = new PluginClass();
        if ($pluginObj = $pluginObj->flush_app_list()){
                return 1;
        }
        return 0;
}

/**
 * 获取应用列表
 * @return string
 */
function get_app_list(){
    $pluginObj = new PluginClass();
    $list = $pluginObj->get_all_app_list();

    foreach($list as $row){
        $json = json_decode($row['attr'], true);

        if ($row['status'] == '1'){
            $onlineapp[] = array('dis_name'=>$json['aside']['dis_name'], 'name'=>$row['name']);
        }else{
            $offlineapp[] = array('dis_name'=>$json['aside']['dis_name'], 'name'=>$row['name']);
        }
   }
    $result = array("online"=>$onlineapp, "offline"=>$offlineapp);
    return json_encode($result);
}

/**
 * @return int 返回 1:代表成功 其余失败
 */
function change_app_status(){
    if (!isset($_POST['name']) || !isset($_POST['status'])){
        return 0;
    }
    $name = $_POST['name'];
    $status = $_POST['status'];
    $pluginObj = new PluginClass();
    if ($pluginObj->change_app($name, $status)){
        return 1;
    }
    return 0;
}

/**
 * 对Admin的getMemberNameByGrade进行在封装,有利于本文件内的调用
 * @param $grade 届别
 * @return int|string 失败 null 成功返回json
 */
function get_member_by_grade($grade){
    if (!isset($grade))
        return ;
    $adminObj = new AdminClass();
    $result = $adminObj->get_member_name_by_grade($grade);
    if (is_bool($result)){
        return ;
    }
    return $result;
}

/**
 * 删除用户
 * @param $uid
 * @return int 成功返回1， 其他返回0
 */
function delete_user($uid){
    if (!isset($uid)){
        return 0;
    }
    $userObj = new UserClass();
    return boolean2Num($userObj->del_user($uid));
}

/**
 * 添加用户
 * @return int 成功返回1 其余返回0
 */
function add_user(){
    if (!isset($_POST['name']) || !isset($_POST['sex']) || !isset($_POST['mail']) || !isset($_POST['grade']) || !isset($_POST['major']) || !isset($_POST['native']) || !isset($_POST['tel'])){
        return 0;
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
    return boolean2Num(add_packing_user($name, $sex, $mail, $grade, $major, $tel, $native, $qq));

}

/**
 * 移交权限
 * @return bool|int 成功返回1 其余返回0
 */
function deliver_privilege(){
    if (!isset($_POST['now_uid']) || !isset($_POST['next_uid'])){
        return 0;
    }else{
        $now_uid = $_POST['now_uid'];
        $next_uid = $_POST['next_uid'];
    }
    $userObj = new UserClass();
    return $userObj->deliver_privilege($now_uid, $next_uid);
}

/**
 * 检查邮箱是否能够使用
 * @return int 能够使用返回1 其余返回0
 */
function check_mail_can_use(){
    if (!isset($_POST['mail'])){
        return 0;
    }else{
        $mail = $_POST['mail'];
    }

    if (is_null($mail) || $mail == ''){
            return 1;
    }

    if (!checkStr('mail', $mail)){
        return 0;
    }

    $userObj = new UserClass();
    return boolean2Num(!$userObj->check_data($mail, 'mail'));
}

/**
 * 检查手机号是否可用
 * @return int 可用返回 1  其余返回0
 */
function check_phone_can_use(){
    if (!isset($_POST['phone'])){
        return 0;
    }else{
        $phone = $_POST['phone'];
    }

    if (is_null($phone) || ($phone == '')){
            return 1;
    }

    if (!checkStr('phone', $phone)){
        return 1;
    }

    $userObj = new UserClass();
    return boolean2Num(!$userObj->check_data($phone, 'phone'));
}
 
//var_dump(addPackingUser("测试测是",1,"qasdasd23@qq.com", 2014, "计算科学与技术", '', '', ''));

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
function add_packing_user($name, $sex, $mail, $grade, $major, $phone, $native, $qq){
    $userObj = new UserClass();
    return $userObj->add_user($name, '000000', $sex, $phone, $mail, $qq, '', '', '',
        $native, $grade, $major, '', '');
}

/**
 * 将boolean值转化为数字
 * @param $boolean
 * @return int 返回 0:值为false  1:代表值为true 2:传入值非boolean类型
 */
function boolean2Num($boolean){
    if (!is_bool($boolean)){
        return 2;
    }
    if ($boolean){
        return 1;
    }
    return 0;
}
?>
