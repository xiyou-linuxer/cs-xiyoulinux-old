<?php
require_once(dirname(dirname(dirname(__FILE__))) . '/init.php');
require_once(BASE_PATH . '/privilege_ctrl.php');

$smarty->display(dirname(__FILE__) . '/templates/judge_manual.tpl');
?>