<?php
session_start();

$_session['uid'] = 1000;

include('config.php');
include('inc/mail.php');
require_once('inc/function.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>个人中心</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="cs,xiyoulinux">
    <link href="./css/bootstrap.css" rel="stylesheet">
    <link href="./css/mail.css" rel="stylesheet">
    <script src="./jquery/jquery.min.js"></script>
    <script src="./js/bootstrap.js"></script>
    <script src="./js/mail.js"></script>
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
	    <li class="active"><a href="mail.php"><span class="glyphicon glyphicon-envelope"></span><strong> 站内信<span class="badge">
<?php
/************************************************新站内信数目提醒************************************************
嵌入内容:新站内信数目（未读站内信数目），比如有5份未读邮件则显示：5
*****************************************************************************************************************/

?>

</span></strong></a></li>
	    </ul>

<?php
/************************************************导航栏链接************************************************
根据用户登录状态，按顺序依次嵌入以下代码：

    登录页面跳转链接（未登录）
        <script language="javascript" type="text/javascript">window.location.href="login.php";</script>

    注销链接代码(普通用户)：
	<p class="navbar-text navbar-right">
            <a href="user.php?action=logout" class="navbar-link">注销</a>
	</p>

    管理后台链接代码(管理员)：
	<p class="navbar-text navbar-right">
            <a href="admin/" class="navbar-link">管理后台</a>
	</p>


    个人中心链接代码（普通用户）：
        <p class="navbar-text navbar-right">
            <a href="user.php" class="navbar-link">个人中心</a>
	</p>
    
***********************************************************************************************************/
$mail = new Mail(1001);

if (isset($_SESSION['uid'])) {
    echo <<<EOF
	<p class="navbar-text navbar-right">
            <a href="user.php?action=logout" class="navbar-link">注销</a>
	</p>
EOF;

    if (1 == 1) {
        echo <<<EOF
	<p class="navbar-text navbar-right">
            <a href="admin/" class="navbar-link">管理后台</a>
	</p>
EOF;
    }

    echo <<<EOF
        <p class="navbar-text navbar-right">
            <a href="user.php" class="navbar-link">个人中心</a>
	</p>
EOF;
}
?>

    </div>
</nav>
    <div clas="main-container">
        <div class="left-bar">
            <p><a href="?select=write" class="btn btn-default btn-block">写站内信</a></p>
            <p><a href="?select=all" class="btn btn-primary btn-block">全部显示</a></p>
            <p><a href="?select=unread" class="btn btn-danger btn-block">未读邮件</a></p>
            <p><a href="?select=read" class="btn btn-success btn-block">已读邮件</a></p>
            <p><a href="?select=draft" class="btn btn-warning btn-block">草稿</a></p>
	</div>
        <div class="mail-container" >
	    
            <table class="table mail-table" id="mail-table">
                <tr class="row-header">
                    <th>标题</th>
                    <th>时间</th>
                    <th>发送者</th>
                    <th>状态</th>
		    <th>预览</th>
		</tr>
<?php
/************************************************站内信列表************************************************
根据GET请求分别显示全部(?select=all)、未读(?select=unread)、已读(?select=read)、草稿(?select=draft)站内信	
    嵌入代码（用大括号括起来的内容需要用动态读取的相应内容进行替换）:
    <tr onclick="OnClick(this,{站内信id});">
	<td>{站内信标题}</td>
        <td>{站内信发送时间}</td>
        <td>{站内信发信人姓名}</td>
        <td>{站内信读取状态：显示为已读，未读，或草稿}</td>
	<td>{站内信内容预览}</td>
    </tr>
***********************************************************************************************************/
$mail = new Mail(1001);

$mid_json = $mail->cs_get_recvmids(0);

$mid_decode = json_decode($mid_json, true);

//$length = count($mid_decode, 0);

//var_dump($mid_decode);

//echo $length;

foreach ($mid_decode as $mid_row) {
    $mail_json = $mail->cs_get_mail($mid_row['mid']);
    $mail_decode = json_decode($mail_json, true);
  
    foreach ($mail_decode as $row) {
    //    $row['sdate'] = date('Y-m-d', $row['sdate']);
        $date = explode(' ', $row['sdate']);
        $row['sdate'] = $date['0'];
        echo "<tr onclick=\"OnMailClick(this, $mid_row[mid]);\">
                  <td>$row[title]</td>
                  <td>$row[sdate]</td>
                  <td>$row[fromuid]</td>
                  <td>$row[status]</td>
                  <td>$row[content]</td>
		  </tr>";
  }
}

?>
            </table>
        </div>
    </div><!--row-fluid-->
</body>
</html>
