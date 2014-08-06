<?php
// 防止用户直接通过url访问本页面。
// 需要在包含改文件的页面中定义该常量

if (!defined('INCLUDE_WRITE_MAIL_PHP')) {
    exit;
}

$mailClass = new Mail($_SESSION['uid']);

$user_json = cs_get_userinfo($mail_obj->fromuid);
$user_obj = json_decode($user_json);
?>
<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title">
                    <h3 class="text-center">写站内信</h3>
                </div>
            </div> <!--END PANEL HEADING-->
            <form class="form">
            <ul class="list-group list-bottom-no-margin">
                <li class="list-group-item">
                    <div class="input-group">
                        <span class="input-group-addon" >收件人</span> 
                        <input type="text" name="touser" class="form-control" 
value ="<?php if(isset($_GET['touser'])) echo $_GET['touser'];?>" 
<?php if(isset($_GET['touser'])) echo 'disabled';?> 
placeholder="请输入收件人姓名"></input>
                    </div>
                </li>
                <li class="list-group-item">
                    <textarea class="form-control textarea-custom" rows=10 ></textarea>
                </li>
                <li class="list-group-item text-right">
                    <button class="btn btn-success">回复信息</button>
                </li>
            </ul> <!--END PANEL BODY-->
            </form>
        </div>
    </div>
</div>
