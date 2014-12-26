<?php
include_once("../inint.php");
include_once("../header.php");
include_once("../aside.php");
include_once("../chat.php");
include_once("../footer.php");
include_once("../inc/plugins.php");
include_once("../inc/conn.php");

$online = $_POST["onlineapp"];
$offline = $_POST["offlineapp"];


$app = new Plugin();


if(!empty($online))
	$app->change_app($online,0);
if(!empty($offline))
	$app->change_app($offline,1);
$list = $app->get_app_list();
for($i=0;$i<count($list);$i++)
{
	$row=$list[$i];
	if($row['status']=='on')
	{
		$onlineapp = array($row['dis_name']);
	}
	else
	{
		$offlineapp = array($row['dis_name']);
	}
}
$tpl->assign('onlieapp', $onlineapp);
$tpl->assign('offlineapp',$offlineapp);
$tpl->display('header.html');
$tpl->display('aside.html');
$tpl->display('admin_appmanager.html');
$tpl->display('chat.html');
$tpl->display('footer.html');


?>
