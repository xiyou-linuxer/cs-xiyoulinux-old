<?php
session_start();

require_once('inc/user.php');
require_once('inc/mail.php');
require_once('config.php');

$_SESSION['uid'] = 1002;

if (!isset($_GET['select'])) {
    echo '<script language="javascript" type="text/javascript">window.location.href="mail.php?select=all";</script>';
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>个人中心</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="cs,xiyoulinux">
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/DT_bootstrap.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">切换导航</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand xylinux" href="index.php"><strong>XiyouLinux CS</strong></a>
    </div>
    <div class="collapse navbar-collapse">
        <ul class="nav navbar-nav">
	        <li><a href="index.php"><span class="glyphicon glyphicon-home"></span><strong> 首页</strong></a></li>
            <li><a href="app/project"><span class="glyphicon glyphicon-tasks"></span><strong> 项目</strong></a></li>
            <li><a href="app/donate"><span class="glyphicon glyphicon-usd"></span><strong> 基金</strong></a></li>
            <li><a href="app/faq"><span class="glyphicon glyphicon-comment"></span><strong> 问答</strong></a></li>
            <li><a href="app/activity"><span class="glyphicon glyphicon-certificate"></span><strong> 活动</strong></a></li>
	        <li class="active">
                <a href="mail.php">
                    <span class="glyphicon glyphicon-envelope"></span>
                    <strong> 站内信<span class="badge"><?php include_once('mail-tip.php');?></span></strong>
                </a>
            </li>
	    </ul>
        <?php include_once('nav-link.php');?>
    </div>
</nav>

<div class="page-container row">
    <!-- begin sidebar -->
    <div class="page-sidebar col-md-2">
        <!-- begin sidebar menu -->        
        <ul class="page-sidebar-menu">
            <li>
                <!-- begin sidebar toggler button -->
                <div class="sidebar-toggler hidden-phone" id="sidebar_toggler"></div>
                <!-- begin sidebar toggler button -->
            </li>
            <li>
                <form class="sidebar-search">
                    <div class="input-box">
                        <a href="javascript:;" class="remove"></a>
                        <input type="text" placeholder="search..." />
                        <input type="button" class="submit" value=" " />
                    </div>
                </form>
            </li>
            <li class="start" id="menu_write">
                <a href="index.html">
                <span style="color:#ffffff;margin:auto 3px;" class="glyphicon glyphicon-edit"></span>
                <span class="title">写站内信</span>
                <span class="selected"></span>
                </a>
            </li>

            <li class="start" id="menu_all">
                <a href="mail.php?select=all">
                <span style="color:#ffffff;margin:auto 3px;" class="glyphicon glyphicon-list-alt"></span>
                <span class="title">全部显示</span>
                <span class="selected"></span>
                </a>
            </li>

            <li class="start" id="menu_unread">
                <a href="mail.php?select=unread">
                <span style="color:#ffffff;margin:auto 3px;" class="glyphicon glyphicon-inbox"></span>
                <span class="title">未读信息</span>
                <span class="selected"></span>
                </a>
            </li>

            <li class="start" id="menu_read">
                <a href="mail.php?select=read">
                <span style="color:#ffffff;margin:auto 3px;" class="glyphicon glyphicon-bookmark"></span>
                <span class="title">已读信息</span>
                <span class="selected"></span>
                </a>
            </li>

            <li class="start" id="menu_draft">
                <a href="mail.php?select=draft">
                <span style="color:#ffffff;margin:auto 3px;" class="glyphicon glyphicon-file"></span>
                <span class="title">草稿</span>
                <span class="selected"></span>
                </a>
            </li>
            <li class="last ">
                <span class="title"></span>
            </li>
        </ul>
        <!-- end sidebar menu -->
    </div>
    <!-- END PAGE -->
    <div class="container col-md-10">
<?php
if ($_GET['action'] == 'read' && isset($_GET['mid'])) {
    include('read-mail.php');
} else {
    include('mail-list.php');
}

?>
    </div>
</div>
    <script src="js/jquery.js" type="text/javascript"></script>
    <script src="js/jquery-1.10.1.min.js" type="text/javascript"></script>
    <script src="js/bootstrap.js" type="text/javascript"></script>
    <script src="js/app.js" type="text/javascript"></script>
    <script src="js/jquery.dataTables.js" type="text/javascript"></script>
    <script src="js/DT_bootstrap.js" type="text/javascript"></script>
    <script src="js/table-managed.js" type="text/javascript"></script>
    <script src="js/jquery.urlGET.js" type="text/javascript"></script>
    <script type="text/javascript">
        function OnMailClick(mid) {
            var GET = $.urlGet();
            var select = GET['select'];
            document.location="?select="+select+"&action=read&mid="+mid;
        }

        jQuery(document).ready(function() {
            App.init();
            TableManaged.init(); 

            var GET = $.urlGet();
            var select = GET['select'];
            $("#menu_"+select).attr('class', 'start active');
        });
    </script>
</body>
</html>
