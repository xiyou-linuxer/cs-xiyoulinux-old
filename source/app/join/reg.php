
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
    <link rel="stylesheet" href="http://dev.xiyoulinux.org/zyj/css/font-awesome.min.css" type="text/css" />
    <style type="text/css">
        * {
            margin: 0;
            padding: 0;
        }
        body {
        	font-family: "微软雅黑";
        	background-color: #304d73
        }

        @media only screen and (min-width: 960px) {

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
		.bg-disabled {
			background-color: #bebebe !important;
		}

        /*一行分12列*/
        .col-2 {
            width: 16.6%;
        }
        .col-3 {
            width: 25%;
        }
        .col-4 {
            width: 33.3%;
        }
        .col-5 {
            width: 41.7%;
        }
        .col-6 {
            width: 50%;
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
/*
        .page-wrapper {
        	width: 100%;
        	height: 100%;
        	position: fixed;;
        	overflow: scroll;
        }
        @media only screen and (min-width: 960px) {
			.page-wrapper {
				width: 480px;
				left: 50%;
				margin-left: -240px;
			}
        }
        */
        .tabview {
        }
        .tabview nav {
            box-sizing: border-box;
            background-color: rgba(40,44,42,0.05);
        }
        .tabview nav ul {
        	height: 40px;
        	border-bottom: 2px solid #78beee;
        }
        .tabview nav ul>li {
        	height: 40px;
      		line-height: 40px;
      		text-align: center;
      		color: #fff;
        	background-color: transparent;
        }
        .tabview nav ul>li.active {
            background-color: #78beee;
        }
        .tabview .tab-item {
        	width: 100%;
        	position: absolute;
        	display: block;
        	box-sizing: border-box;
            padding: 20px;
            visibility: hidden;
        	-webkit-transform:translateY(20px);
        }
        .tabview .tab-item.active {
        	visibility: visible;
        	-webkit-transform:translateY(0px);
  		    -moz-transition: all 0.3s ease-in;
		    -webkit-transition: all .3s ease-in;
		    -o-transition: all .3s ease-in;
		    transition: all .3s ease-in;
        }

        .panel {
        	padding: 20px;
            color: #fff;
        	background-color: #6b86ab;
        	margin-bottom: 20px;
        }
        @media only screen and (min-width: 960px) {
        	.panel {
				width: 360px;
				margin-left: auto;
				margin-right: auto;
        	}
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
        #form_container {
        	display: block;
        }
        #info_container {
        	display: block;
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
        	top: 0;
        	opacity: 0.8;
        	line-height: 50px;
        	-webkit-transform:translateY(-50px);
  		    -moz-transition: all 0.3s ease-in;
		    -webkit-transition: all .3s ease-in;
		    -o-transition: all .3s ease-in;
		    transition: all .3s ease-in;
        }
        #msg_panel.open {
        	-webkit-transform:translateY(0px);
        	-webkit-transform:translateY(0px);
  		    -moz-transition: all 0.3s ease-in;
		    -webkit-transition: all .3s ease-in;
		    -o-transition: all .3s ease-in;
		    transition: all .3s ease-in;
        }
        #msg_panel #btn_close {
			position: absolute;
			right: 20px;
			line-height: 50px;
        }
    </style>
</head>
<body>
    <div class="tabview">
        <nav>
            <ul class="inline-list">
                <li class="col-4 active">说明</li>
                <li class="col-4">报名</li>
                <li class="col-4">查询</li>
            </ul>
        </nav>
        <div class="tab-item active">
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
        </div>
        <div class="tab-item">
        	<div class="panel">
        		<div class="input-group">
        			<i class="fa fa-bars"></i>
	            	<input type="tel" name="reg_sno" placeholder="学号" />
	            </div>
	            <div class="input-group">
        			<i class="fa fa-key"></i>
	            	<input type="password" name="reg_password" placeholder="教务系统密码" />
	            </div>
        		<div class="input-group">
        			<i class="fa fa-user"></i>
       	            <input type="text" name="reg_username" placeholder="姓名" />
       	        </div>
        		<div class="input-group">
        			<i class="fa fa-home"></i>
	            	<input type="text" name="reg_class" placeholder="专业班级" />
	            </div>
        		<div class="input-group">
        			<i class="fa fa-phone"></i>
	            	<input type="tel" name="reg_tel" placeholder="手机号码" />
	            </div>
	            <a id="reg_submit" class="btn">注册</a>
	        </div>
        </div>
        <div class="tab-item">
        	<div class="panel">
        		<div class="input-group">
        			<i class="fa fa-bars"></i>
	            	<input type="tel" name="query_sno" placeholder="学号" />
	            </div>
	            <div class="input-group">
        			<i class="fa fa-key"></i>
	            	<input type="password" name="query_password" placeholder="教务系统密码" />
	            </div>
	            <a id="query_submit" class="btn">查询</a>
	        </div>
        </div>
        <div class="tab-item">
        	<div class="panel">
	            <h3 class="text-center">报名成功！</h3>
	            <hr>
	            <ul class="block-list data-list">
	            </ul>
	        </div>
        </div>
        <div class="tab-item">
        	<div class="panel">
	            <h3 class="text-center">报名信息如下：</h3>
	            <hr>
	            <ul class="block-list data-list">
	            </ul>
	        </div>
        </div>
    </div>
    <div id="msg_panel" class="panel">
    	<i id="btn_close" class="fa fa-times"></i>
    	<i id="msg_icon" class="fa fa-exclamation-circle"></i>
    	<span id="msg_content">密码错误！</span>
    </div>
    <script type="text/javascript">
        function hasClass(obj, cls) {
            return obj.className.match(new RegExp('(\\s|^)' + cls + '(\\s|$)'));
        }

        function addClass(obj, cls) {
            if (!this.hasClass(obj, cls)) obj.className += " " + cls;
        }

        function removeClass(obj, cls) {
            if (hasClass(obj, cls)) {
                var reg = new RegExp('(\\s|^)' + cls + '(\\s|$)');
                obj.className = obj.className.replace(reg, ' ');
            }
        }

        function toggleClass(obj, cls) {
        	if (hasClass(obj, cls)) {
        		removeClass(obj, cls);
        	} else {
        		addClass(obj, cls);
        	}
        }

        function request(req_type, req_url, param, callback) {
            var xhr = new XMLHttpRequest();

            xhr.open(req_type, req_url, true);

            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=UTF-8");
            xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");

            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4) {
                    if ((xhr.status >= 200 && xhr.status < 300) || xhr.status == 304) {
                        var data = xhr.responseText;

                        callback && callback(data);
                    }
                }
            }

            var data = "";
            for (var p in param) {
                data += p + "=" + param[p] + '&';
            }

            data = data.substr(0, data.lastIndexOf("&"));

            xhr.send(data);            
        }

        function openMsgPanel(type, msg) {
			var msg_panel = document.getElementById("msg_panel");
			var msg_content = document.getElementById("msg_content");
        	if (type == "success") {
        		removeClass(msg_panel, "bg-warning");
        		addClass(msg_panel, "bg-success");
        		removeClass(msg_icon, "fa-exclamation-circle");
        		addClass(msg_icon, "fa-info-circle");
        	} else {
        		removeClass(msg_panel, "bg-success");
        		addClass(msg_panel, "bg-warning");
        		removeClass(msg_icon, "fa-info-circle");
        		addClass(msg_icon, "fa-exclamation-circle");
        	}

        	msg_content.innerHTML = msg;
        	addClass(msg_panel, "open");
        }
        function closeMsgPanel() {
        	if (hasClass(msg_panel, "open")) {
        		removeClass(msg_panel, "open");
        		removeClass(msg_panel, "bg-warning");
        		removeClass(msg_panel, "bg-success");
        	}
        }

        function showInfoPanel(currId, targetId, data) {
        	var tab_btns = document.querySelectorAll(".tabview nav ul>li");
        	var tab_items = document.querySelectorAll(".tabview .tab-item");
        	var data_list = tab_items[targetId].querySelector(".panel .data-list");
        	data_list.innerHTML = data;

        	removeClass(tab_btns[currId], "active");
        	removeClass(tab_items[currId], "active");
        	addClass(tab_items[targetId], "active");
        }

        //注册帐号
        var reg_submit = document.getElementById("reg_submit");
        reg_submit.addEventListener("click", function(e) {
            if (hasClass(reg_submit, "bg-disabled")) {
                return false;
            }
            var reg_sno = document.getElementsByName("reg_sno")[0].value,
                reg_pwd = document.getElementsByName("reg_password")[0].value,
                reg_name = document.getElementsByName("reg_username")[0].value,
                reg_class = document.getElementsByName("reg_class")[0].value,
                reg_tel = document.getElementsByName("reg_tel")[0].value;

            if (reg_sno == "") {
        		openMsgPanel("warning", "请输入学号！");
                return false;
            }
            if (reg_pwd == "") {
        		openMsgPanel("warning", "请输入密码！");
                return false;
            }
            if (reg_name == "") {
        		openMsgPanel("warning", "请输入姓名！");
                return false;
            }
            if (reg_class == "") {
                openMsgPanel("warning", "请输入专业班级！");
                return false;
            }
            if (reg_tel == "") {
                openMsgPanel("warning", "请输入手机号码！");
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
			
			addClass(reg_submit, "bg-disabled");
            request("POST", "./async.php", param, function(data) {
                //-1 : 学号和密码验证失败
                // 0 : 学号已注册
                //json : 注册信息
                if (data == "-1") {
                    openMsgPanel("warning", "学号或密码错误！");
                } else if (data == "0") {
                    openMsgPanel("success", "您的信息已更新，报名编号不变！");
                } else {
                    var info = JSON.parse(data);

                    var msg = "<li>编号：" + info.uid + "</li>";
                    msg += "<li>学号：" + info.sno + "</li>";
                    msg += "<li>姓名：" + info.name + "</li>";
                    msg += "<li>班级：" + info.class + "</li>";
                    msg += "<li>手机：" + info.mobile + "</li>";
                    msg += "<li>状态：" + parse_status(info.status) + "</li>";

					closeMsgPanel();
                    showInfoPanel(1, 3, msg);
                }
                removeClass(reg_submit, "bg-disabled");
            });
        }, false);

        var query_submit = document.getElementById("query_submit");
        query_submit.addEventListener("click", function(event) {
            if (hasClass(query_submit, "bg-disabled")) {
                return false;
            }

            var query_sno = document.getElementsByName("query_sno")[0].value,
                query_pwd = document.getElementsByName("query_password")[0].value;

            if (query_sno == "") {
                openMsgPanel("warning", "请输入学号！");
                return false;
            }
            if (query_pwd == "") {
                openMsgPanel("warning", "请输入密码！");
                return false;
            }

            var query_data = "action=check&schoolnum=" + query_sno + "&password=" + query_pwd;
            var param = {
                action: "check",
                schoolnum: query_sno,
                password: query_pwd
            };

			addClass(query_submit, "bg-disabled");
            request("POST", "./async.php", param, function (data) {
               /*
                check
                -1: 验证失败
                -2: 不存在这条记录
                json:
                 */
                
                if (data == "-1") {
                    openMsgPanel("warning", "学号或密码错误！");
                } else if (data == "-2") {
                    openMsgPanel("warning", "您尚未报名，请先报名！");
                } else {
                    var info = JSON.parse(data);

                    var msg = "<li>编号：" + info.uid + "</li>";
                    msg += "<li>学号：" + info.sno + "</li>";
                    msg += "<li>姓名：" + info.name + "</li>";
                    msg += "<li>班级：" + info.class + "</li>";
                    msg += "<li>手机：" + info.mobile + "</li>";
                    msg += "<li>状态：" + parse_status(info.status) + "</li>";

                    closeMsgPanel();
                    showInfoPanel(2, 4, msg);
                }
                removeClass(query_submit, "bg-disabled");
            });
        }, false);

        function parse_status(status) {
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

        var btn_close = document.getElementById("btn_close");
        btn_close.addEventListener("click", function() {
        	closeMsgPanel();
        }, false);

        //tabview events
        var tabview = document.querySelector(".tabview");
        var tab_btns = tabview.querySelectorAll(".tabview nav ul>li");
        var tab_items = tabview.querySelectorAll(".tab-item");

        for (var i=0, len=tab_btns.length; i<len; i++) {
            (function(i) {
                tab_btns[i].addEventListener("click", function() {
                    for (var j=0, len1=tab_items.length; j<len1; j++) {
                    	if (tab_btns[j]) {
                        	removeClass(tab_btns[j], 'active');
                    	}
                        removeClass(tab_items[j], "active");
                    }

                    addClass(tab_btns[i], 'active');
                    addClass(tab_items[i], "active");

                }, true);
            })(i);
        }
    </script>
</body>
</html>