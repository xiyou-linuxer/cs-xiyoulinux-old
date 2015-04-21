<?php
require_once(dirname(dirname(dirname(__FILE__))) . '/init.php');
require_once(dirname(__FILE__) . "/includes/lecture.class.php");

$lecture_inc = new LectureClass();

$smarty->assign('recent_lecture', $lecture_inc->get_recent_list());
$smarty->assign('pass_lecture', $lecture_inc->get_pass_list());
$smarty->assign('my_lecture', $lecture_inc->get_my_list($login_uid));

$smarty->display(dirname(__FILE__) . '/templates/index.tpl');
?>