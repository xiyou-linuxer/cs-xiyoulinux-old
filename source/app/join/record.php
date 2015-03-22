<?php
require_once('../../init.php');
//require_once("includes/join.class.php");
require_once('includes/register.class.php');
//$CJoin = new JoinClass();
//$result = $CJoin->get_config();
//$config = json_decode($result);

$CReg = new RegisterClass();
$reg_list = $CReg->get_user_list(0);
/*
$CRegister = new RegisterClass();
$userInfo = $CRegister->get_userinfo(1001);
var_dump($userInfo);
*/
//$smarty->assign("config", $config);
$smarty->assign("reg_list", $reg_list);
$smarty->display(dirname(__FILE__) . '/templates/record.tpl');
?>