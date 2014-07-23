<?php
require_once('inc/function.php');
/***********************************************导航栏个人中心链接*******************************************
    未登录：
        <script language="javascript" type="text/javascript">window.location.href="login.php";</script>

    登出
	<p class="navbar-text navbar-right">
            <a href="user.php?action=logout" class="navbar-link">注销</a>
	</p>

    管理后台
	<p class="navbar-text navbar-right">
            <a href="admin/" class="navbar-link">管理后台</a>
	</p>


    个人中心
        <p class="navbar-text navbar-right">
            <a href="user.php" class="navbar-link">个人中心</a>
	</p>
    
***********************************************************************************************************/

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
