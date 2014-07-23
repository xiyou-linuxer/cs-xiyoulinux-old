<!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->

<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->

<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->

<!-- BEGIN HEAD -->

<?php
session_start();

require_once('inc/user.php');

$_session['uid'] = 1001;

include('inc/function.php');
if ($_GET['action'] == 'logout') {
    unset($_SESSION['uid']);
    echo "<script language=\"javascript\">document.location=\"login.php\";</script>";
    exit;
}

$user_json = cs_getuser_info();
$user_obj = json_decode($user_json);

echo "dd";
echo $user_obj->name;

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf8">
    <title>个人中心</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="cs,xiyoulinux">
    <link href="./css/bootstrap.css" rel="stylesheet">
    <link href="./css/user.css" rel="stylesheet">
    <script src="./jquery/jquery.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
</head>
<body>
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">
                    切换导航
                </span>
                <span class="icon-bar">
                </span>
                <span class="icon-bar">
                </span>
                <span class="icon-bar">
                </span>
            </button>
            <a class="navbar-brand xylinux" href="index.php">
                <strong>
                    XiyouLinux CS
                </strong>
            </a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li>
                    <a href="index.php">
                        <span class="glyphicon glyphicon-home">
                        </span>
                        <strong>
                            首页
                        </strong>
                    </a>
                </li>
                <li>
                    <a href="app/project">
                        <span class="glyphicon glyphicon-tasks">
                        </span>
                        <strong>
                            项目
                        </strong>
                    </a>
                </li>
                <li>
                    <a href="app/donate">
                        <span class="glyphicon glyphicon-usd">
                        </span>
                        <strong>
                            基金
                        </strong>
                    </a>
                </li>
                <li>
                    <a href="app/faq">
                        <span class="glyphicon glyphicon-comment">
                        </span>
                        <strong>
                            问答
                        </strong>
                    </a>
                </li>
                <li>
                    <a href="app/activity">
                        <span class="glyphicon glyphicon-certificate">
                        </span>
                        <strong>
                            活动
                        </strong>
                    </a>
                </li>
                <li>
                    <a href="mail.php">
                        <span class="glyphicon glyphicon-envelope">
                        </span>
                        <strong>
                            站内信
                        </strong>
                    </a>
                </li>
            </ul>
        <p class="navbar-text navbar-right">
                <a href="user.php?action=logout" class="navbar-link">
                    注销
                </a>
                </p>

    <p class="navbar-text navbar-right">
                    <a href="admin/" class="navbar-link">
                        管理后台
                    </a>
                    </p>
    <p class="navbar-text navbar-right">
        <a href="user.php" class="navbar-link active">
                            个人中心
        </a>
     </p>     
        </div>
    </nav>
    <ul class="breadcrumb">
        <li>
            <a href="user.php">
                个人中心
            </a>
        </li>
        <li class="active">
            资料修改
        </li>
    </ul>
    <div class="row">
        <div class="col-md-2 left-side-bar">
            .
        </div>
        <div class="col-md-10">
            <div class="row">
                <div class="col-xs-8 col-xs-offset-2 col-sm-6 col-sm-offset-3 col-md-6 col-md-offset-3">
                    <div class="container form-title-div">
                        个人资料修改
                    </div>
					<form  method="get" action="inc/user.php?fuc=cs_update_userinfo">
                        <div class="form-group has-success">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <div class="label-div">
                                        姓名
                                    </div>
								</span>
<?php
require_once('inc/get_userinfo.php');

$info = json_decode(get_userinfo(1001), true);

echo '<input type="text" class="form-control" value="'.$info["name"].'" disabled  >'
?>
                            </div>
                        </div>
                        <div class="form-group has-success">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <div class="label-div">
                                        性别
                                    </div>
                                </span>
<?php
	require_once('inc/get_userinfo.php');
$info = json_decode(get_userinfo(1001), true);
if($info["sex"] == 1)
	$sex = "男";
else $sex = "女";
echo '<input type="text" class="form-control" value="'.$sex.'" disabled>';
?>
                            </div>
                        </div>
                        <div class="form-group has-success">
                            <div class="input-group">
                                <span class="input-group-addon">
									<div class="label-div">
										电话
                                    </div>
								</span>
<?php
require_once('inc/get_userinfo.php');
$info = json_decode(get_userinfo(1001), true);
echo '<input type="text" class="form-control" value="'.$info["phone"].'" name="phone">';
?>
 
                            </div>
                        </div>
                        <div class="form-group has-warning">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <div class="label-div">
                                        邮箱
                                    </div>
                                </span>
<?php
require_once('inc/get_userinfo.php');
$info = json_decode(get_userinfo(1001), true);

echo '<input type="text" class="form-control" placeholder="必填项" value="'.$info["mail"].'" required="required" name="mail">';
?>
 
                            </div>
                        </div>
                        <div class="form-group has-success">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <div class="label-div">
                                        QQ
                                    </div>
                                </span>
<?php
require_once('inc/get_userinfo.php');
$info = json_decode(get_userinfo(1001), true);

echo '<input type="text" class="form-control" value="'.$info["qq"].'" name="qq">';
?>
 
                            </div>
                        </div>
                        <div class="form-group has-success">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <div class="label-div">
                                        微信
                                    </div>
                                </span>
<?php
require_once('inc/get_userinfo.php');
$info = json_decode(get_userinfo(1001), true);

echo '<input type="text" class="form-control" value="'.$info["wechat"].'" name="wechat">';
?>
 
                            </div>
                        </div>
                        <div class="form-group has-success">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <div class="label-div">
                                        博客
                                    </div>
                                </span>
<?php
require_once('inc/get_userinfo.php');
$info = json_decode(get_userinfo(1001), true);

echo '<input type="text" class="form-control" value="'.$info["blog"].'" name="blog">';
?>
 
                            </div>
                        </div>
                        <div class="form-group has-success">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <div class="label-div">
                                        GITHUB
                                    </div>
                                </span>
<?php
require_once('inc/get_userinfo.php');
$info = json_decode(get_userinfo(1001), true);

echo '<input type="text" class="form-control" value="'.$info["github"].'" name="github">';
?>
 
                            </div>
                        </div>
                        <div class="form-group has-success">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <div class="label-div">
                                        籍贯
                                    </div>
                                </span>
<?php
require_once('inc/get_userinfo.php');
$info = json_decode(get_userinfo(1001), true);

echo '<input type="text" class="form-control" value="'.$info["native"].'" name="native">';
?>
 
                            </div>
                        </div>
                        <div class="form-group has-success">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <div class="label-div">
                                        届别
                                    </div>
                                </span>
<?php
require_once('inc/get_userinfo.php');
$info = json_decode(get_userinfo(1001), true);

echo '<input type="text" class="form-control" value="'.$info["grade"].'" disabled name="grade">';
?>
 
                            </div>
                        </div>
                        <div class="form-group has-warning">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <div class="label-div">
                                        专业
                                    </div>
                                </span>
<?php
require_once('inc/get_userinfo.php');
$info = json_decode(get_userinfo(1001), true);

echo '<input type="text" class="form-control" placeholder="必填项" value="'.$info[major].'" name="major" required="required">';
?>
 
                            </div>
                        </div>
                        <div class="form-group has-success">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <div class="label-div">
                                        工作地点
                                    </div>
                                </span>
<?php
require_once('inc/get_userinfo.php');
$info = json_decode(get_userinfo(1001), true);

echo '<input type="text" class="form-control" value="'.$info[workplace].'" name="workplace">';
?>
 
                            </div>
                        </div>
                        <div class="form-group has-success">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <div class="label-div">
                                        工作职位
                                    </div>
                                </span>
<?php
require_once('inc/get_userinfo.php');
$info = json_decode(get_userinfo(1001), true);

echo '<input type="text" class="form-control" value="'.$json[job].'" name="job">';
?>
 
                            </div>
                        </div>
                        <button type="submit" name="submit" class="btn btn-default" value="提交">
                    提交 
                         </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
