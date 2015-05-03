<{extends file="../../../templates/frame.tpl"}>

<{block name="stylesheet" append}>
<link rel="stylesheet" href="http://cs.xiyoulinux.org/js/chosen/chosen.css" type="text/css" />
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
						<li class="nav-list-item">
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
			<div class="panel panel-default">
				<div class="panel-body">
					<legend>用户信息<div id="interview_time"></div></legend>
					<ul class="user-info">
						<li class="col-md-2 text-center">No.<{$info["uid"]}></li>
						<li class="col-md-2 text-center"><{$info["sno"]}></li>
						<li class="col-md-2 text-center"><{$info["name"]}></li>
						<li class="col-md-3 text-center"><{$info["class"]}></li>
						<li class="col-md-3 text-center"><{$info["mobile"]}></li>
					</ul>
				</div>
			</div>
			<div class="row">
				<div class="col-md-7">
					<div class="panel panel-default">
						<div class="panel-body">
							<legend>面试评价</legend>
							<input type="hidden" name="profileid" value="".$row["profileid"]."" />
							<input type="hidden" name="judger" value="".$_SESSION["judger"]."" />
							<input type="hidden" name="status" value="".$row["status"]."" />
							<input type="hidden" name="action" value="save" />
							<div class="control-group">
								<label>基础技能</label>
								<textarea class="form-control" id="input_basic" rows="5" placeholder="C语言，计算机基础等" required /></textarea>
							</div>
							<div class="control-group">
								<label>加分技能</label>
								<textarea class="form-control" id="input_extra" rows="5" placeholder="数据结构，算法，Linux等" required /></textarea>
							</div>
							<div class="control-group">
								<label>总体评价</label>
								<textarea class="form-control" id="input_overall" rows="5" placeholder="总体水平评价，面试官主观看法等" required /></textarea>
							</div>
							<div class="row">
								<div class="col-md-8">
									<select id="select_grade" class="chosen-select">
										<option value="-1">评级</option>
										<option value="5">S  — 非常棒，极力推荐</option>
										<option value="4">A+ — 很不错，通过</option>
										<option value="3">A- — 还可以，通过</option>
										<option value="2">B  — 一般，待定</option>
										<option value="1">C  — 较差，淘汰</option>
									</select>
								</div>
								<div class="col-md-4">
									<a data-type="button" data-default="true" data-action="save" class="btn btn-primary btn-block margin-bottom">保存评价</a>
								</div>
								<!--
								<div class="col-md-4">
									<a class="btn btn-info btn-block margin-bottom" href="interview.php">更换对象</a>
								</div>
								-->
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-5">
					<div class="panel panel-default">
						<div class="panel-body">
							<legend>面试记录</legend>
							<ul class="record-list">
								<{section name=n loop=$records}>
								<li class="record-list-item">
									<ul class="meta">
										<li>
											<strong>环节：</strong> <{if $records[n]["round"] == 0}>加<{else}><{$records[n]["round"]}><{/if}>面
										</li>
										<li>
											<strong>等级：</strong> 
											<{if $records[n]["grade"] == 5}> S
											<{elseif $records[n]["grade"] == 4}> A+
											<{elseif $records[n]["grade"] == 3}> A-
											<{elseif $records[n]["grade"] == 2}> B
											<{elseif $records[n]["grade"] == 1}> C
											<{/if}>
										</li>
										<li>
											<strong>面试官：</strong> <{$records[n]["interviewer"]}>
										</li>
										<li>
											<strong>时间：</strong> <{$records[n]["time"]}>
										</li>
									</ul>
									<label class="label bg-info">基础技能</label>
									<p><{$records[n]["basic"]}></p>
									<label class="label bg-info">加分技能</label>
									<p><{$records[n]["extra"]}></p>
									<label class="label bg-info">总体评价</label>
									<p><{$records[n]["overall"]}></p>
									</p>
								</li>
								<{/section}>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<{/block}>

<{block name="scripts" append}>
<script type="text/javascript" src="js/init.js"></script>
<script type="text/javascript" src="http://cs.xiyoulinux.org/js/chosen/chosen.jquery.min.js"></script>

<script type="text/javascript">
(function() {
	var second=0;
	var minute=0;
	var hour=0;

	function interval()
	{
		second++;
		if(second==60)
		{
		second=0;minute+=1;
		}
		if(minute==60)
		{
		minute=0;hour+=1;
		}
		$("#interview_time").html("面试已持续："+hour+"时"+minute+"分"+second+"秒");

		window.setTimeout(interval,1000);
	}

	setTimeout(interval,1000);
})();

$('[data-action="save"]').click(function() {
	var param = {
		action: "save",
		uid: "<{$info["uid"]}>",
		interviewer: "<{$nav_profile_uid}>",
		basic : $("#input_basic").val(),
		extra : $("#input_extra").val(),
		overall : $("#input_overall").val(),
		grade : $("#select_grade").val()
	};

	if (param.basic == "") {
		alert("请输入基础技能！");
		return false;
	}
	if (param.extra == "") {
		alert("请输入加分技能！");
		return false;
	}
	if (param.overall == "") {
		alert("请输入总体评价！");
		return false;
	}
	if (param.grade == "-1") {
		alert("请选择等级！");
		return false;
	}

	console.log(param);
	$.post("./async.php", param, function(data) {
		if (data == "1") {
			alert("保存成功！");
			location.href = "start.php";
		} else {
			alert("保存失败！");
			return false;
		}
	});

	return false;
});
</script>
<{/block}>
