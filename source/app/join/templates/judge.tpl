<{extends file="../../../templates/frame.tpl"}>

<{block name="stylesheet" append}>
<link rel="stylesheet" href="<{#SiteDomain#}>/js/datatables/datatables.css" type="text/css" />
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
						<li class="nav-list-item active">
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
					<legend>结果筛选</legend>
					<div class="alert alert-block alert-info">
						<h3>
							当前进度：
							<select id="select_round">
								<option value="1">第一轮面试</option>
								<option value="0" <{if $current_status == 0}>selected<{/if}>>加面面试</option>
								<option value="2" <{if $current_status == 2}>selected<{/if}>>第二轮面试</option>
								<option value="3" <{if $current_status == 3}>selected<{/if}>>第三轮面试</option>
							</select> 
						</h3>
						<div class="progress progress-striped active">
							<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 
								<{if $current_status == 1}> 25%
								<{elseif $current_status == 0}> 50%
								<{elseif $current_status == 2}> 75%
								<{elseif $current_status == 3}> 100%
								<{/if}>">
							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
								<a data-type="button" data-action="passa" class="btn btn-large btn-block btn-success btn-judge">自动通过全A评价</a>
							</div>
							<div class="col-md-4">
								<a data-type="button" data-action="dropc" class="btn btn-large btn-block btn-danger btn-judge">自动淘汰全C评价</a>
							</div>
							<div class="col-md-4">
								<a href="judge_manual.php" class="btn btn-large btn-block btn-primary btn-judge">手动决策</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="tabbable">
					  <ul class="nav nav-tabs">
						<li class="active"><a href="#tab1" data-toggle="tab">本轮待决策名单</a></li>
						<li class><a href="#tab2" data-toggle="tab">本轮已通过名单</a></li>
						<li class><a href="#tab3" data-toggle="tab">本轮已淘汰名单</a></li>
						<li class><a href="#tab4" data-toggle="tab">本轮待定名单</a></li>
					  </ul>
					  <div class="tab-content">
						<div class="tab-pane active" id="tab1">
							<div class="table-responsive">
								<table class="table table-striped m-b-none" data-ride="datatables">
									<thead><tr>
										<th>编号</th>
										<th>学号</th>
										<th>姓名</th>
										<th>专业班级</th>
										<th>电话</th>
										<th>评价1</th>
										<th>评价2</th>
										<th>操作</th>
									</tr></thead>
									<tbody>
				                    	<{section name=n loop=$ready_decide}>
				                    		<tr>
				                    			<td><{$ready_decide[n]["uid"]}></td>
				                    			<td><{$ready_decide[n]["sno"]}></td>
				                    			<td><{$ready_decide[n]["name"]}></td>
				                    			<td><{$ready_decide[n]["class"]}></td>
				                    			<td><{$ready_decide[n]["mobile"]}></td>
				                    			<td>
				                    			<span class="badge bg-info">
				                    			<{if $ready_decide[n]["grade1"] == 5}> S
				                    			<{elseif $ready_decide[n]["grade1"] == 4}> A+
				                    			<{elseif $ready_decide[n]["grade1"] == 3}> A-
				                    			<{elseif $ready_decide[n]["grade1"] == 2}> B
				                    			<{elseif $ready_decide[n]["grade1"] == 1}> C
				                    			<{/if}>
				                    			</span>
				                    			<{$ready_decide[n]["interviewer1"]}>
				                    			</td>
				                    			<td>
				                    			<span class="badge bg-info">
				                    			<{if $ready_decide[n]["grade2"] == 5}> S
				                    			<{elseif $ready_decide[n]["grade2"] == 4}> A+
				                    			<{elseif $ready_decide[n]["grade2"] == 3}> A-
				                    			<{elseif $ready_decide[n]["grade2"] == 2}> B
				                    			<{elseif $ready_decide[n]["grade2"] == 1}> C
				                    			<{/if}> 
				                    			</span>
				                    			<{$ready_decide[n]["interviewer2"]}>
				                    			</td>
				                    			<td>
				                    				<a href='judge_manual.php?uid=<{$ready_decide[n]["uid"]}>' class="btn btn-xs btn-danger">手动决策</a>
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
									<thead><tr>
										<th>编号</th>
										<th>学号</th>
										<th>姓名</th>
										<th>专业班级</th>
										<th>电话</th>
										<th>评价1</th>
										<th>评价2</th>
										<th>操作</th>
									</tr></thead>
									<tbody>
				                    	<{section name=n loop=$pass}>
				                    		<tr>
				                    			<td><{$pass[n]["uid"]}></td>
				                    			<td><{$pass[n]["sno"]}></td>
				                    			<td><{$pass[n]["name"]}></td>
				                    			<td><{$pass[n]["class"]}></td>
				                    			<td><{$pass[n]["mobile"]}></td>
				                    			<td>
				                    			<span class="badge bg-info">
				                    			<{if $pass[n]["grade1"] == 5}> S
				                    			<{elseif $pass[n]["grade1"] == 4}> A+
				                    			<{elseif $pass[n]["grade1"] == 3}> A-
				                    			<{elseif $pass[n]["grade1"] == 2}> B
				                    			<{elseif $pass[n]["grade1"] == 1}> C
				                    			<{/if}>
												</span>
				                    			<{$pass[n]["interviewer1"]}>
				                    			</td>
				                    			<td>
				                    			<span class="badge bg-info">
				                    			<{if $pass[n]["grade2"] == 5}> S
				                    			<{elseif $pass[n]["grade2"] == 4}> A+
				                    			<{elseif $pass[n]["grade2"] == 3}> A-
				                    			<{elseif $pass[n]["grade2"] == 2}> B
				                    			<{elseif $pass[n]["grade2"] == 1}> C
				                    			<{/if}> 
				                    			</span>
				                    			<{$pass[n]["interviewer2"]}>
				                    			</td>
				                    			<td>
				                    				<a data-type="button" data-action="resetstatus" data-uid="<{$pass[n]['uid']}>" class="btn btn-xs btn-danger">撤销决策</a>
				                    			</td>
				                    		</tr>
				                    	<{/section}>
									</tbody>
								</table>
							</div>
						</div>
						<div class="tab-pane" id="tab3">
							<div class="table-responsive">
								<table class="table table-striped m-b-none" data-ride="datatables">
									<thead><tr>
										<th>编号</th>
										<th>学号</th>
										<th>姓名</th>
										<th>专业班级</th>
										<th>电话</th>
										<th>评价1</th>
										<th>评价2</th>
										<th>操作</th>
									</tr></thead>
									<tbody>
				                    	<{section name=n loop=$drop}>
				                    		<tr>
				                    			<td><{$drop[n]["uid"]}></td>
				                    			<td><{$drop[n]["sno"]}></td>
				                    			<td><{$drop[n]["name"]}></td>
				                    			<td><{$drop[n]["class"]}></td>
				                    			<td><{$drop[n]["mobile"]}></td>
				                    			<td>
				                    			<span class="badge bg-info">
				                    			<{if $drop[n]["grade1"] == 5}> S
				                    			<{elseif $drop[n]["grade1"] == 4}> A+
				                    			<{elseif $drop[n]["grade1"] == 3}> A-
				                    			<{elseif $drop[n]["grade1"] == 2}> B
				                    			<{elseif $drop[n]["grade1"] == 1}> C
				                    			<{/if}>
				                    			</span>
				                    			<{$drop[n]["interviewer1"]}>
				                    			</td>
				                    			<td>
				                    			<span class="badge bg-info">
				                    			<{if $drop[n]["grade2"] == 5}> S
				                    			<{elseif $drop[n]["grade2"] == 4}> A+
				                    			<{elseif $drop[n]["grade2"] == 3}> A-
				                    			<{elseif $drop[n]["grade2"] == 2}> B
				                    			<{elseif $drop[n]["grade2"] == 1}> C
				                    			<{/if}>
				                    			</span>
				                    			<{$drop[n]["interviewer2"]}>
				                    			</td>
				                    			<td>
				                    				<a data-type="button" data-action="resetstatus" data-uid="<{$drop[n]['uid']}>" class="btn btn-xs btn-danger">撤销决策</a>
				                    			</td>
				                    		</tr>
				                    	<{/section}>
									</tbody>
								</table>
							</div>
						</div>
						<div class="tab-pane" id="tab4">
							<div class="table-responsive">
								<table class="table table-striped m-b-none" data-ride="datatables">
									<thead><tr>
										<th>编号</th>
										<th>学号</th>
										<th>姓名</th>
										<th>专业班级</th>
										<th>电话</th>
										<th>评价1</th>
										<th>评价2</th>
										<th>操作</th>
									</tr></thead>
									<tbody>
				                    	<{section name=n loop=$undecide}>
				                    		<tr>
				                    			<td><{$undecide[n]["uid"]}></td>
				                    			<td><{$undecide[n]["sno"]}></td>
				                    			<td><{$undecide[n]["name"]}></td>
				                    			<td><{$undecide[n]["class"]}></td>
				                    			<td><{$undecide[n]["mobile"]}></td>
				                    			<td>
				                    			<span class="badge bg-info">
				                    			<{if $undecide[n]["grade1"] == 5}> S
				                    			<{elseif $undecide[n]["grade1"] == 4}> A+
				                    			<{elseif $undecide[n]["grade1"] == 3}> A-
				                    			<{elseif $undecide[n]["grade1"] == 2}> B
				                    			<{elseif $undecide[n]["grade1"] == 1}> C
				                    			<{/if}>
				                    			</span>
				                    			<{$undecide[n]["interviewer1"]}>
				                    			</td>
				                    			<td>
				                    			<span class="badge bg-info">
				                    			<{if $undecide[n]["grade2"] == 5}> S
				                    			<{elseif $undecide[n]["grade2"] == 4}> A+
				                    			<{elseif $undecide[n]["grade2"] == 3}> A-
				                    			<{elseif $undecide[n]["grade2"] == 2}> B
				                    			<{elseif $undecide[n]["grade2"] == 1}> C
				                    			<{/if}>
				                    			</span>
				                    			<{$undecide[n]["interviewer2"]}>
				                    			</td>
				                    			<td>
				                    				<a href='judge_manual.php?uid=<{$undecide[n]["uid"]}>' class="btn btn-xs btn-danger">手动决策</a>
				                    				<a data-type="button" data-action="resetstatus" data-uid="<{$undecide[n]['uid']}>" class="btn btn-xs btn-danger">撤销决策</a>
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
<script type="text/javascript" src="<{#SiteDomain#}>/js/datatables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="js/init.js"></script>
<script type="text/javascript">
	$("#select_round").change(function() {
		var param = {
			action: "setstatus",
			status: $(this).val()
		};

		$.post('./async.php', param, function () {
			location.reload();
		});
	});
	$('[data-type="button"]').click(function() {
		var action = $(this).data("action");
		if (!action) {
			return false;
		}

		var param = {
			action: action
		}
		switch (action) {
			case "resetstatus": 
				param.uid = $(this).data("uid");
				$.post('./async.php', param, function (data) {
					location.reload();
				});
				break;
			case "passa": 
				$.post('./async.php', param, function (data) {
					alert("已自动决策" + data + "个用户！", function () {
						location.reload();
					});
				});
				break;
			case "dropc":
				$.post('./async.php', param, function (data) {
					alert("已自动决策" + data + "个用户！", function () {
						location.reload();
					});
				});
				break;
		}

		return false;
	});
</script>

<{/block}>