
<?php
$user_agent = $_SERVER['HTTP_USER_AGENT'];
if (strpos($user_agent, 'MicroMessenger') === false){
    header("Content-type: text/html; charset=utf-8");
    echo '请扫下方二维码，关注西邮Linux微信平台，通过右下角菜单“其他功能”→“纳新报名”进行报名。感谢您的支持！<br />';
	echo '<img src="http://222.24.19.63/getqrcode.jpg">';
	date_default_timezone_set('PRC');
	$logfile = fopen("./illegal.log", "a");
	fwrite($logfile, date('Y-m-d H:i:s')."\t".$_SERVER["REMOTE_ADDR"]."\tILLEGAL\n");
	fclose($logfile);
    die();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>西邮Linux纳新报名</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <link rel="stylesheet" href="http://cs.xiyoulinux.org/css/font-awesome.min.css" type="text/css" />
    <style type="text/css">
        * {
            margin: 0;
            padding: 0;
            -webkit-appearance: none;
            -webkit-tap-highlight-color:rgba(0,0,0,0);
        }
        body {
        	font-family: "微软雅黑";
        	background-color: #304d73
        }

        hr {
            margin-top: 5px;
            margin-bottom: 5px;
        }
        ul.block-list {
            margin-left: 20px;
        }
        ul.block-list>li {
            margin-top: 5px;
            margin-bottom: 5px;
        }
        ul.inline-list {
            list-style: none;
        }
        ul.inline-list:after {
            width: 0;
            height: 0;
            content: " ";
            display: block;
            visibility: hidden;
            clear: both;
        }
        ul.inline-list>li {
            float: left;
        }
        .text-center {
            text-align: center;
        }
        .text-italian {
            font-style: italic;
        }
        .bg-warning {
        	background-color: #ff8c8c !important;
        }
        .bg-success {
        	background-color: #006400 !important;
        }
        .btn {
            height: 40px;
            display: block;
            font-size: 1.1rem;
            line-height: 40px;
            text-align: center;
            color: #fff;
            background-color: #78beee;
            border: 0;
            outline: none;
            cursor: pointer;
        }
        .tabview {
        }
        .tabview .menu-wrapper {
        	height: 40px;
        	border-bottom: 2px solid #78beee;
            background-color: rgba(40,44,42,0.05);
        }
        .tabview .menu-wrapper>li {
            width: 33.33%;
        	height: 40px;
      		line-height: 40px;
      		text-align: center;
      		color: #fff;
        	background-color: transparent;
        }
        .tabview .menu-wrapper>li.active {
            background-color: #78beee;
        }
        .tabview .cont-wrapper>li {
            width: 100%;
        	position: absolute;
        	display: block;
        	box-sizing: border-box;
            padding: 20px;
        }
        .panel {
        	padding: 20px;
            color: #fff;
        	background-color: #6b86ab;
        	margin-bottom: 20px;
        }
        input {
            width: 100%;
            height: 40px;
            display: block;
            padding-left: 10px;
            padding-right: 10px;
            margin-bottom: 20px;
            box-sizing: border-box;
            border: 0;
            outline: none;
            border-bottom: 1px solid rgba(255, 255, 255, 0.7);
            border-radius: 0;
            font-size: 1.05rem;
            color: #fff;
            background-color: transparent;
        }
        :-ms-input-placeholder {
        	font-family: "微软雅黑";
        	color: rgba(255, 255, 255, 0.7);
        }
        ::-moz-placeholder {
        	font-family: "微软雅黑";
        	color: rgba(255, 255, 255, 0.7);
        }
        ::-webkit-input-placeholder {
        	font-family: "微软雅黑";
        	color: rgba(255, 255, 255, 0.7);
        }
        .input-group {
        	position: relative;
        }
        .input-group i {
        	position: absolute;
        	color: #fff;
        	font-size: 1.3rem;
        	line-height: 40px;
        }
        .input-group input {
        	padding-left: 2.5rem;
        }
        #msg_panel {
        	color: #fff;
        	width: 100%;
        	height: 50px;
        	padding: 0;
        	padding-left: 20px;
        	padding-right: 40px;
        	box-sizing: border-box;
        	position: fixed;
        	top: -50px;
        	opacity: 0.8;
        	line-height: 50px;
        }
        #msg_panel .close {
			position: absolute;
			right: 20px;
			line-height: 50px;
        }
    </style>
</head>
<body>
    <div class="tabview">
        <ul class="menu-wrapper inline-list">
            <li class="active">说明</li>
            <li>报名</li>
            <li>查询</li>
        </ul>
        <ul class="cont-wrapper">
            <li>
            	<div class="panel">
    	            <h3 class="text-center">西邮Linux兴趣小组纳新说明</h3>
    	            <hr>
    	            <ul class="block-list">
    	                <li>您可以在<strong>“报名”</strong>标签页内，通过教务管理系统帐号及密码进行报名；在<strong>“查询”</strong>标签页内，随时查询自己的信息与面试状态。</li>
    	                <li>若个人信息填写有误或需要更新，请以相同学号再次报名。您原有个人信息将直接更新，报名编号不变。</li>
    	                <li>我们承诺，仅使用您的教务管理系统帐号与密码进行实名验证，不在纳新系统服务器保存您的教务系统密码等任何隐私信息。</li>
    	                <li>您的所有面试记录将在纳新结束后被彻底清除。除非征得您的同意，您的所有信息不会以任何形式对外透露。</li>
    	            </ul>
    	            <hr><span class="text-italian">“要想成为狮子，就要和狮群呆在一起”</span><p>立即报名，开启大学生活的崭新征程！</p>
    	        </div>
            </li>
            <li>
            	<div class="panel">
            		<div class="input-group">
            			<i class="fa fa-bars"></i>
    	            	<input type="tel" id="reg_sno" placeholder="学号" />
    	            </div>
    	            <div class="input-group">
            			<i class="fa fa-key"></i>
    	            	<input type="password" id="reg_password" placeholder="教务系统密码" />
    	            </div>
            		<div class="input-group">
            			<i class="fa fa-user"></i>
           	            <input type="text" id="reg_username" placeholder="姓名" />
           	        </div>
            		<div class="input-group">
            			<i class="fa fa-home"></i>
    	            	<input type="text" id="reg_class" placeholder="专业班级" />
    	            </div>
            		<div class="input-group">
            			<i class="fa fa-phone"></i>
    	            	<input type="tel" id="reg_tel" placeholder="手机号码" />
    	            </div>
    	            <input type="button" id="reg_submit" class="btn" value="注册" />
    	        </div>
            </li>
            <li>
            	<div class="panel">
            		<div class="input-group">
            			<i class="fa fa-bars"></i>
    	            	<input type="tel" id="query_sno" placeholder="学号" />
    	            </div>
    	            <div class="input-group">
            			<i class="fa fa-key"></i>
    	            	<input type="password" id="query_password" placeholder="教务系统密码" />
    	            </div>
    	            <input type="button" id="query_submit" class="btn" value="查询" />
    	        </div>
            </li>
            <li id="info_panel">
            	<div class="panel">
    	            <h3 id="title" class="text-center"></h3>
    	            <hr>
    	            <ul id= "content" class="block-list data-list">
    	            </ul>
    	        </div>
            </li>
        </ul>
    </div>

    <div id="msg_panel" class="panel">
    	<i class="fa fa-times close"></i>
    	<i class="fa fa-exclamation-circle icon"></i>
    	<span class="msg"></span>
    </div>

    <script type="text/javascript" src="http://cs.xiyoulinux.org/js/jquery.js"></script>
    <script type="text/javascript" src="./js/jquery.tabview.js"></script>
    <script type="text/javascript">
        $(".tabview").tabview({
            toggleEvent : "click",
            toggleStyle : "fade",
            direction : "left"
        });
        function showMsg(msg) {
            $("#msg_panel").find(".icon").removeClass("fa-exclamation-circle").addClass("fa-info-circle");
            $("#msg_panel").find(".msg").html(msg);
            $("#msg_panel").removeClass("bg-warning").addClass("bg-success").animate({"top": "0px"}).delay(2000).animate({"top":"-50px"});
        }
        function showError(msg) {
            $("#msg_panel").find(".icon").removeClass("fa-info-circle").addClass("fa-exclamation-circle");
            $("#msg_panel").find(".msg").html(msg);
            $("#msg_panel").removeClass("bg-success").addClass("bg-warning").animate({"top": "0px"}).delay(2000).animate({"top":"-50px"});
        }

        $("#msg_panel .close").click(function () {
            $("#msg_panel").animate({"top": "-50px"}, function () {
                $("#msg_panel").removeClass("bg-warning").removeClass("bg-success")
            });
        });

        function showInfo(title, data) {
            var panel = $("#info_panel");
            panel.find("#title").html(title);
            panel.find("#content").html(data);
            panel.fadeIn().siblings().css("display", "none");
        }

        //注册帐号
        $("#reg_submit").click(function() {
            var reg_sno = $("#reg_sno").val(),
                reg_pwd = $("#reg_password").val(),
                reg_name = $("#reg_username").val(),
                reg_class = $("#reg_class").val(),
                reg_tel = $("#reg_tel").val();

            if (!reg_sno) {
        		showError("请输入学号！");
                return false;
            }
            if (!reg_pwd) {
        		showError("请输入密码！");
                return false;
            }
            if (!reg_name) {
        		showError("请输入姓名！");
                return false;
            }
            if (!reg_class) {
                showError("请输入专业班级！");
                return false;
            }
            if (!reg_tel) {
                showError("请输入手机号码！");
                return false;
            }

            var param = {
                action: "register",
                schoolnum: reg_sno,
                password: reg_pwd,
                name: reg_name,
                class: reg_class,
                tel: reg_tel
            };
			
            $("#reg_submit").attr("disabled", "disabled");
            $.post("./async.php", param, function(data) {
                //-1 : 学号和密码验证失败
                // 0 : 学号已注册
                //json : 注册信息
                if (data == "-1") {
                    showError("学号或密码错误！");
                } else if (data == "0") {
                    showMsg("您的信息已更新，报名编号不变！");
                } else {
                    var info = JSON.parse(data);

                    var msg = "<li>编号：" + info.uid + "</li>";
                    msg += "<li>学号：" + info.sno + "</li>";
                    msg += "<li>姓名：" + info.name + "</li>";
                    msg += "<li>班级：" + info.class + "</li>";
                    msg += "<li>手机：" + info.mobile + "</li>";
                    msg += "<li>状态：" + parseStatus(info.status) + "</li>";

                    showInfo("报名成功！", msg);
                    alert(msg);
                }
                $("#reg_submit").removeAttr("disabled");
            });
        });

        $("#query_submit").on("click", function(event) {
            var query_sno = $("#query_sno").val(),
                query_pwd = $("#query_password").val();

            if (!query_sno) {
                showError("请输入学号！");
                return false;
            }
            if (!query_pwd) {
                showError("请输入密码！");
                return false;
            }

            var param = {
                action: "check",
                schoolnum: query_sno,
                password: query_pwd
            };

			$("#query_submit").attr("disabled", "disabled");
            $.post("./async.php", param, function (data) {
                //check
                //-1: 验证失败
                //-2: 不存在这条记录
                
                if (data == "-1") {
                    showError("学号或密码错误！");
                } else if (data == "-2") {
                    showError("您尚未报名，请先报名！");
                } else {
                    var info = JSON.parse(data);

                    var msg = "<li>编号：" + info.uid + "</li>";
                    msg += "<li>学号：" + info.sno + "</li>";
                    msg += "<li>姓名：" + info.name + "</li>";
                    msg += "<li>班级：" + info.class + "</li>";
                    msg += "<li>手机：" + info.mobile + "</li>";
                    msg += "<li>状态：" + parseStatus(info.status) + "</li>";

                    showInfo("您的报名信息如下:", msg);
                }
                $("#query_submit").removeAttr("disabled");
            });
        });

        function parseStatus(status) {
            switch (status) {
                case "0": return "面试结果待定";
                case "1": return "报名成功，等待一面";
                case "-1": return "一面未通过";
                case "2": return "一面通过，等待二面";
                case "-2": return "二面未通过";
                case "3": return "二面通过，等待三面";
                case "-3": return "三面未通过";
                case "4": return "三面通过，面试完成";
            }
        }

    </script>
</body>
</html>
