<?php
// 防止用户直接通过url访问本页面。
// 需要在包含改文件的页面中定义该常量

if (!defined('INCLUDE_READ_MAIL_PHP')) {
    exit;
}

$mid = $_GET['mid'];
$mailClass = new Mail($_SESSION['uid']);
$mail_json = $mailClass->cs_get_mail($mid, 0, 1);
$mail_obj = json_decode($mail_json);

$user_json = cs_get_userinfo($mail_obj->fromuid);
$user_obj = json_decode($user_json);
?>
<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title">
                    <h3 class="text-center"><?php echo $mail_obj->title;?></h3>
                </div>
            </div> <!--END PANEL HEADING-->
            <ul class="list-group">
                <li class="list-group-item">
                <h5>消息来自：<?php echo $user_obj->name;?> &nbsp;&nbsp;发送时间: <?php echo $mail_obj->sdate;?></h5>
                </li>
                <li class="list-group-item">
                    <h4><?php echo $mail_obj->content;?></h4>
                </li>
            </ul> <!--END PANEL BODY-->
            <div class="panel-footer text-center">
                <a href="#">回复信息</a>
            </div>
        </div>
    </div>
</div>
