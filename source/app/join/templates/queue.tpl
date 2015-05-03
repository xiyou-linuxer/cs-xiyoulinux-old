<{extends file="../../../templates/base.tpl"}>

<{block name="stylesheet" append}>
<link rel="stylesheet" href="<{$site_domain}>/js/datatables/datatables.css" type="text/css" />
<link rel="stylesheet" href="http://libs.useso.com/js/bootstrap-switch/3.0.1/css/bootstrap3/bootstrap-switch.min.css" type="text/css" />
<link rel="stylesheet" href="css/style.css" type="text/css" />
<{/block}>

<{block name="frame"}> 
	<div class="row page-content" style="margin: 20px;">
		<div class="col-md-4">
			<div class="panel panel-default">
				<div class="panel-body">
					<legend>面试签到</legend>
					<div class="row">
						<div class="col-md-8">
							<div class="input-group">
								<span class="input-group-addon">编号或学号</span>
								<input id="input_id" type="text" class="form-control" value="" required />
							</div>
						</div>
						<div class="col-md-4">
							<button id="btn_sign" class="btn btn-primary btn-block">确认签到</button>
						</div>
					</div>
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-body">
					<legend style=>现场报名</legend>
					<p>请扫描下方二维码，关注官方微信平台，通过右下方“其他功能”->“纳新报名”完成报名。</p>
					<p style="text-align: center"><img src="http://222.24.19.63/getqrcode.jpg" width="200px/"></p>
				</div>
			</div>	
		</div>
		<div class="col-md-8">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="tabbable">
						<ul class="nav nav-tabs">
							<li class="active"><a href="#tab1" data-toggle="tab">待面试队列</a></li>
							<li class=""><a href="#tab2" data-toggle="tab">已面试队列</a></li>
						</ul>
						<div style="position: absolute; top: 20px; right: 35px;">
							<input type="checkbox" name="refresh-switch" data-handle-width="50" data-label-text="刷新" data-on-text="开" data-off-text="关"  checked>
						</div>
						<div class="tab-content">
						<div class="tab-pane active" id="tab1">
							<div class="table-responsive">
								<table class="table table-striped m-b-none" data-ride="datatables">
									<thead><tr>
										<th>编号</th>
										<th>学号</th>
										<th>姓名</th>
										<th>专业班级</th>
										<th>签到时间</th>
										<th>面试安排</th>
										<th>操作</th>
									</tr></thead>
									<tbody>
				                    	<{section name=n loop=$called_list}>
				                    		<tr class="info">
				                    			<td><{$called_list[n]["uid"]}></td>
				                    			<td><{$called_list[n]["sno"]}></td>
				                    			<td><{$called_list[n]["name"]}></td>
				                    			<td><{$called_list[n]["class"]}></td>
				                    			<td><{$called_list[n]["time"]}></td>
				                    			<td>已被 <strong><{$called_list[n]["interviewer"]}></strong> 叫号</td>
				                    			<td>
				                    				<a id="btn_interview" data-qid="<{$called_list[n]['qid']}>" class="btn btn-xs btn-success">面试</a>
				                    				<a id="btn_delsign" data-qid="<{$called_list[n]['qid']}>" class="btn btn-xs btn-danger">删除</a>
				                    			</td>
				                    		</tr>
				                    	<{/section}>
				                    	<{section name=n loop=$signed_list}>
				                    		<tr>
				                    			<td><{$signed_list[n]["uid"]}></td>
				                    			<td><{$signed_list[n]["sno"]}></td>
				                    			<td><{$signed_list[n]["name"]}></td>
				                    			<td><{$signed_list[n]["class"]}></td>
				                    			<td><{$signed_list[n]["time"]}></td>
				                    			<td>待安排面试</td>
				                    			<td>
				                    				<a id="btn_delsign" data-qid="<{$signed_list[n]['qid']}>" class="btn btn-xs btn-danger">删除</a>
				                    			</td>
				                    		</tr>
				                    	<{/section}>
									</tbody>
								</table>
							</div>
						</div>
						<div class="tab-pane" id="tab2">
							<div class="table-responsive">
				                <table class="table table-striped m-b-none" data-ride="datatables">
				                    <thead>
				                    	<tr>
				                            <th>编号</th>
				                            <th>学号</th>
				                            <th>姓名</th>
				                            <th>专业班级</th>
				                            <th>签到时间</th>
				                            <th>面试安排</th>
				                            <th>操作</th>
				                    	</tr>
				                    </thead>
				                    <tbody>
				                    	<{section name=n loop=$interviewed_list}>
				                    		<tr>
				                    			<td><{$interviewed_list[n]["uid"]}></td>
				                    			<td><{$interviewed_list[n]["sno"]}></td>
				                    			<td><{$interviewed_list[n]["name"]}></td>
				                    			<td><{$interviewed_list[n]["class"]}></td>
				                    			<td><{$interviewed_list[n]["time"]}></td>
				                    			<td>已被 <strong><{$interviewed_list[n]["interviewer"]}></strong> 面试</td>
				                    			<td>
				                    				<a id="btn_reset" data-qid="<{$interviewed_list[n]['qid']}>" class="btn btn-xs btn-warning">撤销</a>
				                    			</td>
				                    		</tr>
				                    	<{/section}>
				                    </tbody>
				                </table>
				            </div>
						</div>
						</div>
					</div>
				</div>
			</div>		
		</div>
	</div>
<{/block}>

<{block name="scripts" append}>
<script type="text/javascript" src="<{$site_domain}>/js/datatables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="http://libs.useso.com/js/bootstrap-switch/3.0.1/js/bootstrap-switch.min.js"></script>
<script type="text/javascript" src="js/init.js"></script>
<script type="text/javascript">
	var t = setTimeout(function() {
		location.reload();
	}, 10000);
	$("[name='refresh-switch']").bootstrapSwitch().on('switchChange.bootstrapSwitch', function(event, state) {
		if (state == true) {
			t = setTimeout(function() {
				location.reload();
			}, 10000);	
		} else {
			clearTimeout(t);
		}
	});

	$("#btn_sign").click(function() {
		var param = {
			action: "sign",
			id: $("#input_id").val()
		}

		if (param.id == "") {
			alert("请输入学号或者编号！");
			return false;
		}

		$.post("./async.php", param, function (data) {
			if (data == "1") {
				alert("签到成功！");
				location.reload();
			}

			if (data == "0") {
				alert("签到失败，请重试！");
				return false;
			}
			if (data == "-1") {
				alert("不存在此学号或者编号，请扫码报名！");
				return false;
			}
			if (data == "-2") {
				alert("该用户未进入本轮面试！");
				return false;
			}
		});
	});
	$("#btn_delsign").click(function() {
		var param = {
			action: "delsign",
			qid: $(this).data("qid")
		}

		$.post("./async.php", param, function (data) {
			if (data == "1") {
				location.reload();
			}
		});
	});
	$("#btn_interview").click(function() {
		var param = {
			action: "intsign",
			qid: $(this).data("qid")
		}

		$.post("./async.php", param, function (data) {
			if (data == "1") {
				location.reload();
			}
		});
	});
	$("#btn_reset").click(function() {
		var param = {
			action: "resetsign",
			qid: $(this).data("qid")
		}
		console.log(param)
		$.post("./async.php", param, function (data) {
			if (data == "1") {
				location.reload();
			}
		});
	});
</script>

<{/block}>
