<?php /* Smarty version Smarty-3.1.21-dev, created on 2014-11-13 19:07:08
         compiled from "./templates/header.html" */ ?>
<?php /*%%SmartyHeaderCode:8007864515464824a9f2826-74472607%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9e86a06ae2daf974c81252e4fd695055cdc90643' => 
    array (
      0 => './templates/header.html',
      1 => 1415876825,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8007864515464824a9f2826-74472607',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5464824aa1d5a6_63679154',
  'variables' => 
  array (
    'mail_count' => 0,
    'username' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5464824aa1d5a6_63679154')) {function content_5464824aa1d5a6_63679154($_smarty_tpl) {?><!DOCTYPE html>

<html lang="en" class="app">

<head>

    <meta charset="utf-8" />

    <title>Linux兴趣小组 | CS平台</title>

    <meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <link rel="stylesheet" href="js/jPlayer/jplayer.flat.css" type="text/css" />

    <link rel="stylesheet" href="css/bootstrap.css" type="text/css" />

    <link rel="stylesheet" href="css/animate.css" type="text/css" />

    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css" />

    <link rel="stylesheet" href="css/simple-line-icons.css" type="text/css" />

    <link rel="stylesheet" href="css/font.css" type="text/css" />

    <link rel="stylesheet" href="css/app.css" type="text/css" />

    <!--[if lt IE 9]>

    <?php echo '<script'; ?>
 src="js/ie/html5shiv.js"><?php echo '</script'; ?>
>

    <?php echo '<script'; ?>
 src="js/ie/respond.min.js"><?php echo '</script'; ?>
>

    <?php echo '<script'; ?>
 src="js/ie/excanvas.js"><?php echo '</script'; ?>
>

    <![endif]-->

</head>

<body class="">

<section class="vbox">

<header class="bg-white-only header header-md navbar navbar-fixed-top-xs">

<div class="navbar-header aside bg-info">

    <a class="btn btn-link visible-xs" data-toggle="class:nav-off-screen,open" data-target="#nav,html">

        <i class="icon-list"></i>

    </a>

    <a href="index.html" class="navbar-brand text-lt">

        <i class="icon-screen-desktop"></i>

        <span class="hidden-nav-xs m-l-sm">西邮Linux CS</span>

    </a>

    <a class="btn btn-link visible-xs" data-toggle="dropdown" data-target=".user">

        <i class="icon-settings"></i>

    </a>

</div>      <ul class="nav navbar-nav hidden-xs">

    <li>

        <a href="#nav,.navbar-header" data-toggle="class:nav-xs,nav-xs" class="text-muted">

            <i class="fa fa-indent text"></i>

            <i class="fa fa-dedent text-active"></i>

        </a>

    </li>

</ul>

<form class="navbar-form navbar-left input-s-lg m-t m-l-n-xs hidden-xs" role="search">

    <div class="form-group">

        <div class="input-group">

            <span class="input-group-btn">

              <button type="submit" class="btn btn-sm bg-white btn-icon rounded"><i class="fa fa-search"></i></button>

            </span>

            <input type="text" class="form-control input-sm no-border rounded" placeholder="搜索博客、问答或招聘...">

        </div>

    </div>

</form>



<div class="navbar-right ">



    <ul class="nav navbar-nav m-n hidden-xs nav-user user">

        <li class="hidden-xs">

            <a href="#" class="dropdown-toggle lt" data-toggle="dropdown">

                <i class="icon-bell"></i>

                <span class="badge badge-sm up bg-danger count"><?php echo $_smarty_tpl->tpl_vars['mail_count']->value;?>
</span>

            </a>

            <section class="dropdown-menu aside-xl animated fadeInUp">

                <section class="panel bg-white">

                    <div class="panel-heading b-light bg-light">

                        <strong>你有 <span class="count"><?php echo $_smarty_tpl->tpl_vars['mail_count']->value;?>
</span> 条站内信</strong>

                    </div>

                    <div class="list-group list-group-alt">

                        <a href="#" class="media list-group-item">

                    <span class="pull-left thumb-sm">

                      <img src="images/a0.png" alt="..." class="img-circle">

                    </span>

                    <span class="media-body block m-b-none">

                      益达快还钱！<br>

                      <small class="text-muted">10 分钟以前</small>

                    </span>

                        </a>

                        <a href="#" class="media list-group-item">

                    <span class="media-body block m-b-none">

                      喂喂喂，测试测试...<br>

                      <small class="text-muted">1 小时以前</small>

                    </span>

                        </a>

                    </div>

                    <div class="panel-footer text-sm">

                        <a href="#" class="pull-right"><i class="fa fa-cog"></i></a>

                        <a href="#notes" data-toggle="class:show animated fadeInRight">查看所有站内信</a>

                    </div>

                </section>

            </section>

        </li>

        <li class="dropdown">

            <a href="#" class="dropdown-toggle bg clear" data-toggle="dropdown">

              <span class="thumb-sm avatar pull-right m-t-n-sm m-b-n-sm m-l-sm">

                <img src="images/a0.png" alt="...">

              </span>

              <?php echo $_smarty_tpl->tpl_vars['username']->value;?>
<b class="caret"></b>

            </a>

            <ul class="dropdown-menu animated fadeInRight">

                <li>

                    <span class="arrow top"></span>

                    <a href="#">Settings</a>

                </li>

                <li>

                    <a href="profile.html">Profile</a>

                </li>

                <li>

                    <a href="#">

                        <span class="badge bg-danger pull-right"><?php echo $_smarty_tpl->tpl_vars['mail_count']->value;?>
</span>

                        Notifications

                    </a>

                </li>



                <li class="divider"></li>

                <li>

                    <a href="modal.lockme.html" data-toggle="ajaxModal">退出</a>

                </li>

            </ul>

        </li>

        <ul class="nav navbar-nav hidden-xs">

            <li>

                <a href="#sidebar" data-toggle="class:nav-xs,nav-xs" class="text-muted active">

                    <i class="fa fa-indent text"></i>

                    <i class="fa fa-dedent text-active"></i>

                </a>

            </li>

        </ul>

    </ul>

</div>

</header>
<?php }} ?>
