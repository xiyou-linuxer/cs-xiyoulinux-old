<?php
require_once('../inc/user.class.php');

if (!isset($_POST['name']) || !isset($_POST['sex']) || !isset($_POST['mail']) || !isset($_POST['grade']) || !isset($_POST['major']) || !isset($_POST['native']))
{
    echo "缺少必要信息";
    return ;
}

$name = $_POST['name'];
$sex = $_POST['sex'];
$mail = $_POST['mail'];
$grade = $_POST['grade'];
$major = $_POST['major'];
$tel = $_POST['tel'];
$native = $_POST['native'];
$qq = $_POST['qq'];


$user = new User();
$result = $user->add_user($name, '000000', $sex,$tel, $mail, $qq, '', '','',$native,$grade,$major, '','');
//$result = $user->add_user('测试', '000000', '1','11111', '1212321@213.com', '11111111111', '', '','','西安', 14, '及试卷及', '','');
if ($result){
    echo '插入成功';
    return ;
}else {
    echo '插入失败';
    return;
}
?>
