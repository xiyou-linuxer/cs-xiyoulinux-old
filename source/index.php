<?php

include_once('init.php');
include('header.php');
include('aside.php');
include('footer.php');

$tpl->display('header.html');
$tpl->display('aside.html');
$tpl->display('content.html');
$tpl->display('mini_aside.html');
$tpl->display('chat.html');
$tpl->display('footer.html');

?>
