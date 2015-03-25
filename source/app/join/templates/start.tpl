<{extends file="../../../templates/frame.tpl"}>

<{block name="stylesheet" append}>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<{/block}>

<{block name="content"}> 
	<div class="row page-content">
		<div class="col-md-4">
			<div class="panel panel-default">
				<div class="panel-body">
					<ul class="nav nav-list">
						<li class="nav-list-group">
							概览
						</li>
						<li class="nav-list-item">
							<a href="index.php"><i class="fa fa-home"></i> 管理面板</a>
						</li>
						<li class="nav-list-item">
							<a href="record.php"><i class="fa fa-list"></i> 报名记录
								<span class="badge bg-info"><{$status["round1"]}></span>
	                        </a>
						</li>
						<li class="nav-list-group">
							面试
						</li>
						<li class="nav-list-item active">
							<a href="start.php"><i class="fa fa-pencil"></i> 面试评价</a>
						</li>
						<li class="nav-list-item">
							<a href="history.php"><i class="fa fa-edit"></i> 评价记录</a>
						</li>
						</li>
						<li class="nav-list-group">
							决策
						</li>
						<li class="nav-list-item">
							<a id="judge_link" data-privilege="<{$laside_user_privilege}>" href="judge.php"><i class="fa fa-check"></i> 结果筛选</a>
						</li>
					</ul>
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-body">
					<legend>人数统计</legend>
					<ul class="summary-list">
						<li class="summary-list-item">
							<a href="record.php"><h3 class="count text-dark"><{$status["round1"]}></h3> 报名/一面</a>
						</li>
						<li class="summary-list-item">
							<h3 class="count text-info"><{$status["round2"]}></h3> 加面
						</li>
						<li class="summary-list-item">
							<h3 class="count text-primary"><{$status["round3"]}></h3> 二面
						</li>
						<li class="summary-list-item">
							<h3 class="count text-success"><{$status["round4"]}></h3> 三面
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="col-md-8">
			<div class="panel panel-default select-panel">
				<div class="panel-body">
					<legend>目标选择</legend>
					<div class="row form-control-wrapper">
						<div class="col-md-8 col-md-offset-2">
							<div class="input-group">
								<span class="input-group-addon">编号或学号</span>
								<input type="text" class="form-control" name ="profileid" id="input_id" value="" required />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4 col-md-offset-2">
							<a data-type="button" data-action="call" class="btn btn-block btn-success">自动叫号</a> 
						</div>
						<div class="col-md-4">
							<a data-type="button" data-default="true" data-action="start" class="btn btn-primary btn-block">开始面试</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<{/block}>

<{block name="scripts" append}>
<script type="text/javascript" src="js/init.js"></script>

<script type="text/javascript">
	$('[data-action="call"]').click(function() {
		var param = {
			action: "call",
			iid: "<{$nav_profile_uid}>"
		};
		$.post("./async.php", param, function(data) {
			if (data == "-1") {
				$("#input_id").attr("placeholder", "当前无待面试者，请稍后重试！").parent().removeClass("has-success").addClass("has-warning");
				return false;
			} 

			$("#input_id").val(data).parent().removeClass("has-warning").addClass("has-success");
			$("#btn_call").attr("disabled", "true").removeClass("btn-success").addClass("btn-dark");
		});

		return false;
	});

	$('[data-action="start"]').click(function() {
		var id_input = $("#input_id").val();
		if (id_input == "") {
			alert("请输入编号或学号");
			return false;
		}

		var param = {
			action: "getuid",
			id: id_input
		};
		$.post("./async.php", param, function(data) {
			if (data == "-1") {
				alert("学号或编号不存在！");
				return false;
			} else if (data == "-2") {
				alert("该用户未进入本轮面试！");
				return false;
			}

			location.href="interview.php?uid=" + data;
		});

		return false;
	});
</script>

<{/block}>