<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-02-05 02:48:24
         compiled from "/usr/local/lnmp/nginx/html/cs/app/feedback/templates/bug_info.tpl" */ ?>
<?php /*%%SmartyHeaderCode:17966191754d2d9f8ee7555-30303258%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '366b74362e431656df076e446b8614e46e51a535' => 
    array (
      0 => '/usr/local/lnmp/nginx/html/cs/app/feedback/templates/bug_info.tpl',
      1 => 1423091892,
      2 => 'file',
    ),
    'b99ea5a7a885f9799f00187968a1238bc34eaf11' => 
    array (
      0 => '/usr/local/lnmp/nginx/html/cs/templates/frame.tpl',
      1 => 1423091892,
      2 => 'file',
    ),
    '83252c767b89fb45cda5781f3c9e564ac80e1f64' => 
    array (
      0 => '/usr/local/lnmp/nginx/html/cs/templates/base.tpl',
      1 => 1423091892,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '17966191754d2d9f8ee7555-30303258',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_54d2d9f930dce3_72660249',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54d2d9f930dce3_72660249')) {function content_54d2d9f930dce3_72660249($_smarty_tpl) {?><?php  $_config = new Smarty_Internal_Config("base.conf", $_smarty_tpl->smarty, $_smarty_tpl);$_config->loadConfigVars(null, 'local'); ?>
<!DOCTYPE html>

<html lang="en" class="app">

<head>

    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>

    <title>Linux兴趣小组 | CS平台</title>

    <meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />



    <link rel="stylesheet" href="<?php echo $_smarty_tpl->getConfigVariable('SiteDomain');?>
/css/bootstrap.css" type="text/css" />

    <link rel="stylesheet" href="<?php echo $_smarty_tpl->getConfigVariable('SiteDomain');?>
/css/animate.css" type="text/css" />

    <link rel="stylesheet" href="<?php echo $_smarty_tpl->getConfigVariable('SiteDomain');?>
/css/font-awesome.min.css" type="text/css" />

    <link rel="stylesheet" href="<?php echo $_smarty_tpl->getConfigVariable('SiteDomain');?>
/css/simple-line-icons.css" type="text/css" />

    <link rel="stylesheet" href="<?php echo $_smarty_tpl->getConfigVariable('SiteDomain');?>
/css/font.css" type="text/css" />

    <link rel="stylesheet" href="<?php echo $_smarty_tpl->getConfigVariable('SiteDomain');?>
/css/app.css" type="text/css" />
	
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

                <a href="<?php echo $_smarty_tpl->getConfigVariable('SiteDomain');?>
/index.php" class="navbar-brand text-lt">

                    <i class="icon-screen-desktop"></i>

                    <span class="hidden-nav-xs m-l-sm">西邮Linux CS</span>

                </a>

                <a class="btn btn-link visible-xs" data-toggle="dropdown" data-target=".user">

                    <i class="icon-settings"></i>

                </a>

            </div>

            <ul class="nav navbar-nav hidden-xs">

                <li>

                    <a href="#nav,.navbar-header" data-toggle="class:nav-xs,nav-xs" class="text-muted">

                        <i class="fa fa-indent text"></i>

                        <i class="fa fa-dedent text-active"></i>

                    </a>

                </li>

            </ul>

            <form class="navbar-form navbar-left input-s-box m-t m-l-n-xs hidden-xs" role="search" action="search.php" method="get">

                <div class="form-group">

                    <div class="input-group">

                        <span class="input-group-btn">

                          <button type="submit" id="bt_search" class="btn btn-sm bg-white btn-icon rounded"><i class="fa fa-search"></i></button>

                        </span>

                        <input name="wd" type="text" id="search_inf" class="form-control input-sm no-border rounded" placeholder="搜索项目、问答、招聘、活动等应用内容...">

                    </div>

                </div>

            </form>

            <form class="navbar-form navbar-left input-s-box m-t m-l-n-xs hidden-xs" role="search" action="<?php echo $_smarty_tpl->getConfigVariable('SiteDomain');?>
/server/activity.server.php" method="post">

                <div class="form-group">

                    <div class="input-group">

                        <span class="input-group-btn">

                          <button type="submit" id="btn_new_activity" class="btn btn-sm bg-white btn-icon rounded"><i class="fa fa-edit"></i></button>

                        </span>

                        <input name="activity_text" type="text" id="activity_text" class="form-control input-sm no-border rounded" placeholder="发表一条新动态...">

                    </div>

                </div>

            </form>

            <div class="navbar-right ">



                <ul class="nav navbar-nav m-n hidden-xs nav-user user">

                    <li class="hidden-xs">

                        <a href="#" class="dropdown-toggle lt" data-toggle="dropdown">

                            <i class="icon-bell"></i>
                            <?php if ($_smarty_tpl->tpl_vars['nav_unread_mail_count']->value>0) {?>
                            <span class="badge badge-sm up bg-danger count"><?php echo $_smarty_tpl->tpl_vars['nav_unread_mail_count']->value;?>
</span>
                            <?php }?>
                        </a>

                        <section class="dropdown-menu aside-xl animated fadeInUp">

                            <section class="panel bg-white">

                                <div class="panel-heading b-light bg-light">

                                    <strong>你有 <span class="count"><?php echo $_smarty_tpl->tpl_vars['nav_unread_mail_count']->value;?>
</span> 条站内信</strong>

                                </div>

                                <div class="list-group list-group-alt">

                                    <?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['nav_unread_mail_list'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['nav_unread_mail_list']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['nav_unread_mail_list']['name'] = 'nav_unread_mail_list';
$_smarty_tpl->tpl_vars['smarty']->value['section']['nav_unread_mail_list']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['nav_unread_mail_list']->value) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['nav_unread_mail_list']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['nav_unread_mail_list']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['nav_unread_mail_list']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['nav_unread_mail_list']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['nav_unread_mail_list']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['nav_unread_mail_list']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['nav_unread_mail_list']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['nav_unread_mail_list']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['nav_unread_mail_list']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['nav_unread_mail_list']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['nav_unread_mail_list']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['nav_unread_mail_list']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['nav_unread_mail_list']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['nav_unread_mail_list']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['nav_unread_mail_list']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['nav_unread_mail_list']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['nav_unread_mail_list']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['nav_unread_mail_list']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['nav_unread_mail_list']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['nav_unread_mail_list']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['nav_unread_mail_list']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['nav_unread_mail_list']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['nav_unread_mail_list']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['nav_unread_mail_list']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['nav_unread_mail_list']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['nav_unread_mail_list']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['nav_unread_mail_list']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['nav_unread_mail_list']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['nav_unread_mail_list']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['nav_unread_mail_list']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['nav_unread_mail_list']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['nav_unread_mail_list']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['nav_unread_mail_list']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['nav_unread_mail_list']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['nav_unread_mail_list']['total']);
?>
                                    <a href="<?php echo $_smarty_tpl->getConfigVariable('SiteDomain');?>
/mail_view.php?mid=<?php echo $_smarty_tpl->tpl_vars['nav_unread_mail_list']->value[$_smarty_tpl->getVariable('smarty')->value['section']['nav_unread_mail_list']['index']]['mid'];?>
" class="media list-group-item">

                                        <span class="pull-left thumb-sm">

                                            <img src="<?php echo $_smarty_tpl->tpl_vars['nav_unread_mail_list']->value[$_smarty_tpl->getVariable('smarty')->value['section']['nav_unread_mail_list']['index']]['fromuser_avatar'];?>
" alt="头像" class="img-circle">

                                        </span>

                                        <span class="media-body block m-b-none">

                                            <?php echo $_smarty_tpl->tpl_vars['nav_unread_mail_list']->value[$_smarty_tpl->getVariable('smarty')->value['section']['nav_unread_mail_list']['index']]['title'];?>
<br>

                                            <small class="text-muted"><?php echo $_smarty_tpl->tpl_vars['nav_unread_mail_list']->value[$_smarty_tpl->getVariable('smarty')->value['section']['nav_unread_mail_list']['index']]['date'];?>
</small>

                                        </span>

                                    </a>
                                    <?php endfor; else: ?>
                                    <a href="<?php echo $_smarty_tpl->getConfigVariable('SiteDomain');?>
/mail_unread.php" class="media list-group-item">
                                        <span class="media-body block m-b-none">

                                            暂时没有任何未读站内信

                                        </span>

                                    </a>
                                    <?php endif; ?>
                                </div>

                                <div class="panel-footer text-sm">

                                    <a href="<?php echo $_smarty_tpl->getConfigVariable('SiteDomain');?>
/mail_all.php" class="pull-right"><i class="fa fa-cog"></i></a>

                                    <a href="<?php echo $_smarty_tpl->getConfigVariable('SiteDomain');?>
/mail_all.php">查看所有站内信</a>

                                </div>

                            </section>

                        </section>

                    </li>

                    <li class="dropdown">

                        <a href="#" class="dropdown-toggle bg clear" data-toggle="dropdown">

                          <span class="thumb-sm avatar pull-right m-t-n-sm m-b-n-sm m-l-sm">

                              <img src="<?php echo $_smarty_tpl->tpl_vars['nav_profile_avatar']->value;?>
" alt="加载中">

                          </span>

                          <?php echo $_smarty_tpl->tpl_vars['nav_profile_username']->value;?>
<b class="caret"></b>

                        </a>

                        <ul class="dropdown-menu animated fadeInRight">
                            <li>

                                <a href="<?php echo $_smarty_tpl->getConfigVariable('SiteDomain');?>
/profile.php?id=<?php echo $_smarty_tpl->tpl_vars['nav_profile_uid']->value;?>
">个人中心</a>

                            </li>

                            <li>

                                <a href="<?php echo $_smarty_tpl->getConfigVariable('SiteDomain');?>
/mail_all.php">

                                    <?php if ($_smarty_tpl->tpl_vars['nav_unread_mail_count']->value>0) {?>
                                    <span class="badge bg-danger pull-right"><?php echo $_smarty_tpl->tpl_vars['nav_unread_mail_count']->value;?>
</span>
                                    <?php }?>
                                    站内信

                                </a>

                            </li>



                            <li class="divider"></li>

                            <li>

                                <a id="btn-logout" data-toggle="ajaxModal">退出</a>

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

        <section>

            <section class="hbox stretch">

                <!-- .aside -->

                <aside class="bg-black dk aside hidden-print" id="nav">

                    <section class="vbox">

                        <section class="scrollable">

                            <div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="10px" data-railOpacity="0.2">

                                <!-- nav -->

                                <nav class="nav-primary hidden-xs">

                                    <ul class="nav bg clearfix">

                                        <li class="hidden-nav-xs padder m-t m-b-sm text-xs text-muted">应用</li>

                                        <li>

                                            <a href="<?php echo $_smarty_tpl->getConfigVariable('SiteDomain');?>
/index.php">

                                                <i class="icon-home"></i>

                                                     <!--<b class="badge bg-info pull-right">10</b>-->

                                                <span class="font-bold">主页</span>

                                            </a>

                                        </li>
                                        <?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['laside_app_list'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['laside_app_list']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['laside_app_list']['name'] = 'laside_app_list';
$_smarty_tpl->tpl_vars['smarty']->value['section']['laside_app_list']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['laside_app_list']->value) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['laside_app_list']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['laside_app_list']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['laside_app_list']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['laside_app_list']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['laside_app_list']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['laside_app_list']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['laside_app_list']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['laside_app_list']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['laside_app_list']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['laside_app_list']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['laside_app_list']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['laside_app_list']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['laside_app_list']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['laside_app_list']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['laside_app_list']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['laside_app_list']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['laside_app_list']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['laside_app_list']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['laside_app_list']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['laside_app_list']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['laside_app_list']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['laside_app_list']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['laside_app_list']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['laside_app_list']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['laside_app_list']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['laside_app_list']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['laside_app_list']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['laside_app_list']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['laside_app_list']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['laside_app_list']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['laside_app_list']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['laside_app_list']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['laside_app_list']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['laside_app_list']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['laside_app_list']['total']);
?>
                                        <li>

                                            <a href="<?php echo $_smarty_tpl->getConfigVariable('SiteDomain');?>
/app/<?php echo $_smarty_tpl->tpl_vars['laside_app_list']->value[$_smarty_tpl->getVariable('smarty')->value['section']['laside_app_list']['index']]['app_home'];?>
">

                                                <i class="<?php echo $_smarty_tpl->tpl_vars['laside_app_list']->value[$_smarty_tpl->getVariable('smarty')->value['section']['laside_app_list']['index']]['app_icon'];?>
 icon text-success"></i>

                                                <?php if ($_smarty_tpl->tpl_vars['laside_app_list']->value[$_smarty_tpl->getVariable('smarty')->value['section']['laside_app_list']['index']]['update_status']=='true') {?>
                                                <b class="badge bg-info pull-right"><?php echo $_smarty_tpl->tpl_vars['laside_app_list']->value[$_smarty_tpl->getVariable('smarty')->value['section']['laside_app_list']['index']]['update_number'];?>
</b>
                                                <?php }?>
                                                <span class="font-bold"><?php echo $_smarty_tpl->tpl_vars['laside_app_list']->value[$_smarty_tpl->getVariable('smarty')->value['section']['laside_app_list']['index']]['app_name'];?>
</span>

                                            </a>

                                        </li>
                                        <?php endfor; endif; ?>
                                        <li class="m-b hidden-nav-xs"></li>

                                    </ul>

                                    <ul class="nav" data-ride="collapse">

                                        <li class="hidden-nav-xs padder m-t m-b-sm text-xs text-muted">管理</li>

                                        <li>

                                            <a href="<?php echo $_smarty_tpl->getConfigVariable('SiteDomain');?>
/profile.php">

                                                <i class="icon-user icon"></i>

                                                <span>个人中心</span>

                                            </a>

                                        </li>

                                        <li >

                                            <a href="#" class="auto">

                                                            <span class="pull-right text-muted">

                                                              <i class="fa fa-angle-left text"></i>

                                                              <i class="fa fa-angle-down text-active"></i>

                                                            </span>

                                                <i class="icon-notebook icon"></i>

                                                
                                                <span>站内信</span>
                                                <?php if ($_smarty_tpl->tpl_vars['laside_unread_mail_count']->value>0) {?>
                                                <b class="badge bg-info" style="margin-left:1em;"><?php echo $_smarty_tpl->tpl_vars['laside_unread_mail_count']->value;?>
</b>
                                                <?php }?>
                                            </a>

                                            <ul class="nav dk text-sm">

                                                <li >

                                                    <a href="<?php echo $_smarty_tpl->getConfigVariable('SiteDomain');?>
/mail_edit.php" class="auto">

                                                        <i class="fa fa-angle-right text-xs"></i>

                                                        <span>写信</span>

                                                    </a>

                                                </li>

                                                <li >

                                                    <a href="<?php echo $_smarty_tpl->getConfigVariable('SiteDomain');?>
/mail_all.php" class="auto">

                                                        <i class="fa fa-angle-right text-xs"></i>

                                                        <span>全部</span>

                                                    </a>

                                                </li>
                                                <li >

                                                    <a href="<?php echo $_smarty_tpl->getConfigVariable('SiteDomain');?>
/mail_send.php" class="auto">

                                                        <i class="fa fa-angle-right text-xs"></i>

                                                        <span>已发</span>

                                                    </a>

                                                </li>
                                                <li >

                                                    <a href="<?php echo $_smarty_tpl->getConfigVariable('SiteDomain');?>
/mail_read.php" class="auto">

                                                        <i class="fa fa-angle-right text-xs"></i>

                                                        <span>已读</span>

                                                    </a>

                                                </li>

                                                <li >

                                                    <a href="<?php echo $_smarty_tpl->getConfigVariable('SiteDomain');?>
/mail_unread.php" class="auto">

                                                        <i class="fa fa-angle-right text-xs"></i>

                                                        <span>未读</span>

                                                        <?php if ($_smarty_tpl->tpl_vars['aside_unread_count']->value>0) {?>
                                                        <b class="badge bg-info" style="margin-left:2em;"><?php echo $_smarty_tpl->tpl_vars['laside_unread_mail_count']->value;?>
</b>
                                                        <?php }?>

                                                    </a>

                                                </li>

                                                <li >

                                                    <a href="<?php echo $_smarty_tpl->getConfigVariable('SiteDomain');?>
/mail_draft.php" class="auto">

                                                        <i class="fa fa-angle-right text-xs"></i>

                                                        <span>草稿</span>

                                                    </a>

                                                </li>

                                            </ul>

                                        </li>

                                        <!--  小组负责人管理权限  -->
                                        <?php if ($_smarty_tpl->tpl_vars['laside_user_privilege']->value=='1') {?>
                                        <li >

                                            <a href="#" class="auto">

                                                <span class="pull-right text-muted">

                                                    <i class="fa fa-angle-left text"></i>

                                                    <i class="fa fa-angle-down text-active"></i>

                                                </span>

                                                <i class="icon-settings icon">

                                                </i>

                                                <span>管理</span>

                                            </a>

                                            <ul class="nav dk text-sm">

                                                <li>
                                                    <a href="<?php echo $_smarty_tpl->getConfigVariable('SiteDomain');?>
/admin_adduser.php"> <i class="icon-plus icon text-success"></i>
                                                        <span class="font-bold">添加用户</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo $_smarty_tpl->getConfigVariable('SiteDomain');?>
/admin_deluser.php"> <i class="fa fa-trash-o icon text-danger"></i>
                                                        <span class="font-bold">删除用户</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo $_smarty_tpl->getConfigVariable('SiteDomain');?>
/admin_deliver.php">
                                                        <i class="icon-refresh icon text-info"></i>
                                                        <span class="font-bold">权限移交</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo $_smarty_tpl->getConfigVariable('SiteDomain');?>
/admin_appmanager.php">
                                                        <i class="icon-grid icon text-primary-lter"></i>
                                                        <span class="font-bold">应用管理</span>
                                                    </a>
                                                </li>
                                            </ul>

                                        </li>
                                        <?php }?>

                                    </ul>

                                </nav>

                                <!-- / nav -->

                            </div>

                        </section>

                    </section>

                </aside>

                <!-- /.aside -->

                <section id="content">

                    <section class="hbox stretch">

                        <section class="vbox">

                            <section class="scrollable wrapper-lg" id="bjax-target">   

								  
                
	<div class="panel panel-info" id="mail-reader-view">
		<div class="panel-heading">
			<div class="panel-title">
				<h4 class="text-center" id="mail-reader-title"><?php echo $_smarty_tpl->tpl_vars['bug']->value['title'];?>
</h4>
			</div>
		</div> 

		<ul class="list-group">
			<li class="list-group-item">
				<span>提交作者：<?php echo $_smarty_tpl->tpl_vars['bug']->value['author'];?>
</span>
				<span style="margin-left: 150px">bug状态：
					<?php if ($_smarty_tpl->tpl_vars['bug']->value['status']=="0") {?>新发布<?php }?>
					<?php if ($_smarty_tpl->tpl_vars['bug']->value['status']=="1") {?>修复中<?php }?>
					<?php if ($_smarty_tpl->tpl_vars['bug']->value['status']=="2") {?>已修复<?php }?>
					<?php if ($_smarty_tpl->tpl_vars['bug']->value['status']=="3") {?>已关闭<?php }?>
				</span>
				<span style="margin-left: 150px">bug修改时间：<?php echo $_smarty_tpl->tpl_vars['bug']->value['modifytime'];?>
</span>
			</li>
		</ul> 
		<article class="media">
			<h4><span style="margin-left: 15px;font-weight:700">bug描述:</span></h4>
			<div class="media-body">
				<h5><span style="margin-left: 45px"><?php echo $_smarty_tpl->tpl_vars['bug']->value['content'];?>
</span></h5>
			</div>
		</article>
		<div class="line pull-in"></div>
		<article class="media">
			<h4><span style="margin-left: 15px;font-weight:700">bug复现方法:</span></h4>
			<div class="media-body">
				<h5><span style="margin-left: 45px"><?php echo $_smarty_tpl->tpl_vars['bug']->value['method'];?>
</span></h5>
			</div>
		</article>
	</div>


                            </section>

                        </section>


                        <aside class="aside-md bg-light dk" id="sidebar">

                            <section class="vbox animated fadeInRight">

                                <section class="scrollable hover">

                                    <nav class="nav-primary hidden-xs">

                                        <h4 class="font-thin m-l-md m-t hidden-nav-xs">用户列表</h4>

                                        <ul class="nav list-group no-bg no-borders auto m-t-n-xxs">

                                            <?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['raside_user_list'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['raside_user_list']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['raside_user_list']['name'] = 'raside_user_list';
$_smarty_tpl->tpl_vars['smarty']->value['section']['raside_user_list']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['raside_user_list']->value) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['raside_user_list']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['raside_user_list']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['raside_user_list']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['raside_user_list']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['raside_user_list']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['raside_user_list']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['raside_user_list']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['raside_user_list']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['raside_user_list']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['raside_user_list']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['raside_user_list']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['raside_user_list']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['raside_user_list']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['raside_user_list']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['raside_user_list']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['raside_user_list']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['raside_user_list']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['raside_user_list']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['raside_user_list']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['raside_user_list']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['raside_user_list']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['raside_user_list']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['raside_user_list']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['raside_user_list']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['raside_user_list']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['raside_user_list']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['raside_user_list']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['raside_user_list']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['raside_user_list']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['raside_user_list']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['raside_user_list']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['raside_user_list']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['raside_user_list']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['raside_user_list']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['raside_user_list']['total']);
?>
                                            <li class="list-group-item">

                                                <span class="pull-left thumb-xs m-t-xs avatar m-l-xs m-r-sm" >

                                                    <img src="<?php echo $_smarty_tpl->tpl_vars['raside_user_list']->value[$_smarty_tpl->getVariable('smarty')->value['section']['raside_user_list']['index']]['avatar'];?>
" alt="..." class="img-circle"> <i class="<?php echo $_smarty_tpl->tpl_vars['raside_user_list']->value[$_smarty_tpl->getVariable('smarty')->value['section']['raside_user_list']['index']]['status'];?>
"></i>

                                                </span>

                                                <div class="clear">

                                                    <div class="hidden-nav-xs">
                                                        
                                                        <a href="<?php echo $_smarty_tpl->getConfigVariable('SiteDomain');?>
/profile.php?uid=<?php echo $_smarty_tpl->tpl_vars['raside_user_list']->value[$_smarty_tpl->getVariable('smarty')->value['section']['raside_user_list']['index']]['uid'];?>
"><?php echo $_smarty_tpl->tpl_vars['raside_user_list']->value[$_smarty_tpl->getVariable('smarty')->value['section']['raside_user_list']['index']]['name'];?>
</a>

                                                    </div>

                                                    <div class="visible-nav-xs">

                                                        <a href="#">占格</a>

                                                    </div>

                                                    <small class="text-muted hidden-nav-xs"><?php echo $_smarty_tpl->tpl_vars['raside_user_list']->value[$_smarty_tpl->getVariable('smarty')->value['section']['raside_user_list']['index']]['workplace'];?>
</small>
                                                      
                                                </div>

                                            </li>
                                            <?php endfor; endif; ?>

                                        </ul>

                                    </nav>

                                </section>

                            </section>

                        </aside>

                    </section><!--hbox stretch-->

                    <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen,open" data-target="#nav,html"></a>
                
                </section><!--content-->

            </section><!--hbox stretch-->

        </section>

    </section>





    <?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->getConfigVariable('SiteDomain');?>
/js/jquery.min.js"><?php echo '</script'; ?>
>

    <!-- Bootstrap -->
    <?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->getConfigVariable('SiteDomain');?>
/js/bootstrap.js"><?php echo '</script'; ?>
>

    <!-- App -->
    <?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->getConfigVariable('SiteDomain');?>
/js/app.js"><?php echo '</script'; ?>
>

    <?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->getConfigVariable('SiteDomain');?>
/js/slimscroll/jquery.slimscroll.min.js"><?php echo '</script'; ?>
>

    <?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->getConfigVariable('SiteDomain');?>
/js/app.plugin.js"><?php echo '</script'; ?>
>

    <?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->getConfigVariable('SiteDomain');?>
/js/cookie.js"><?php echo '</script'; ?>
>



    <?php echo '<script'; ?>
 type="text/javascript">
        $(document).ready(function() {
            //online
            $.get("<?php echo $_smarty_tpl->getConfigVariable('SiteDomain');?>
/server/online.server.php?uid="+get_cookie('uid')+"&logout=false",function(){});
            setInterval(function() {
                $.ajax({
                    url: "<?php echo $_smarty_tpl->getConfigVariable('SiteDomain');?>
/server/online.server.php",
                    type: "GET",
                    dataType: "JSON",
                    data: {
                        "uid": get_cookie('uid'),
                    },
                    success: function(data){
                        console.log(data);
                    }
                });            
            }, 60000);

            $('.update-num').each(function() {
                var elem = $(this);
                var func_url = elem.data('funcurl') + '?func=cal_num';
                $.get(func_url, function(data) {
                    if (data == '0') {
                        elem.remove();
                    } else {
                        elem.html(data);
                    }
                });
            });

            //登出按钮事件
            $('#btn-logout').click(function(){
                var param = {
                    action: 'logout'
                };
                $.get("<?php echo $_smarty_tpl->getConfigVariable('SiteDomain');?>
/server/online.server.php?uid="+get_cookie('uid')+"&logout=true",function(){});
                $.post('server/login.server.php', param, function() {
                    location.href = 'signin.php';
                });
            });
        });
    <?php echo '</script'; ?>
>



</body>

</html>
<?php }} ?>
