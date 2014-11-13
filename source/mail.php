<?php

include_once('init.php');
include('header.php');
include('aside.php');

$tpl->assign('cssfile', 'mail.css');

$tpl->display('header.html');
$tpl->display('index.html');

?>
