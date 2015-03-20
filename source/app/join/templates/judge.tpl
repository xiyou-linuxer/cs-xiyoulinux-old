<{extends file="../../../templates/frame.tpl"}>

<{block name="stylesheet" append}>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<{/block}>

<{block name="content"}> 
	<div class="row page-content">
		<div class="col-md-4">
			<div class="well">
				<ul class="nav nav-list">
					<li class="nav-header">
						概览
					</li>
					<li>
						<a href="index.php"><i class="fa fa-home"></i> 管理面板</a>
					</li>
					<li>
						<a href="record.php"><i class="fa fa-list"></i> 报名记录
							<span class="badge badge-info"><{$status["round1"]}></span>
                        </a>
					</li>
					<li class="nav-header">
						面试
					</li>
					<li>
						<a href="start.php"><i class="fa fa-pencil"></i> 面试评价</a>
					</li>
					<li>
						<a href="history.php"><i class="fa fa-edit"></i> 评价记录</a>
					</li>
					</li>
					<li class="nav-header">
						决策
					</li>
					<li class="active">
						<a href="judge.php"><i class="fa fa-check"></i> 结果筛选</a>
					</li>
				</ul>
			</div>
			<div class="well summary">
				<legend>人数统计</legend>
				<ul>
					<li>
						<a href="record.php"><h3 class="count text-dark"><{$status["round1"]}></h3> 报名/一面</a>
					</li>
					<li>
						<h3 class="count text-info"><{$status["round2"]}></h3> 加面
					</li>
					<li>
						<h3 class="count text-primary"><{$status["round3"]}></h3> 二面
					</li>
					<li class="last">
						<h3 class="count text-success"><{$status["round4"]}></h3> 三面
					</li>
				</ul>
			</div>
		</div>
		<div class="col-md-8">
			<div class=" well">
				<legend>结果筛选</legend>
				<div class="alert alert-block alert-info">
					<h3>当前进度： 第<{$config->round }>轮面试</h3>
					<br />
					<div class="progress progress-striped active">
						<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: <{$config->round *25}>%">
							<span class="sr-only">40%</span>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<a href="judge-a.php" class="btn btn-large btn-block btn-success btn-judge">自动通过全A评价</a>
						</div>
						<div class="col-md-4">
							<a href="judge-c.php" class="btn btn-large btn-block btn-danger btn-judge">自动淘汰全C评价</a>
						</div>
						<div class="col-md-4">
							<a href="judge_manual.php" class="btn btn-large btn-block btn-primary btn-judge">手动决策</a>
						</div>
					</div>
				</div>
			</div>
			<div class="well">
				<div class="tabbable">
				  <ul class="nav nav-tabs">
					<li class="active"><a href="#tab1" data-toggle="tab">本轮待决策名单</a></li>
					<li class><a href="#tab2" data-toggle="tab">本轮已通过名单</a></li>
					<li class><a href="#tab3" data-toggle="tab">本轮已淘汰名单</a></li>
				  </ul>
				  <div class="tab-content">
					<div class="tab-pane active" id="tab1">
					  <table class="table table-hover table-striped table-bordered">
						<thead>
							<tr>
								<th>编号</th><th>姓名</th><th>专业班级</th><th>电话</th><th>评价1</th><th>评价2</th>
							</tr>
						</thead>
						<tbody>
						<{section name=reg loop=$reg_list}>
							<tr>
								<td><{$reg_list[reg]["uid"]}></td>
								<td><{$reg_list[reg]["sno"]}></td>
								<td><{$reg_list[reg]["name"]}></td>
								<td><{$reg_list[reg]["major"]}></td>
								<td><{$reg_list[reg]["phone"]}></td>
								<td><{0}></td>
							</tr>
						<{/section}>
						</tbody>
					  </table>
					</div>
					<div class="tab-pane" id="tab2">
					  <table class="table table-hover table-striped table-bordered">
						<thead>
							<tr>
								<th>编号</th><th>姓名</th><th>专业班级</th><th>电话</th><th>评价1</th><th>评价2</th><th>操作</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					  </table>
					</div>
					<div class="tab-pane" id="tab3">
					  <table class="table table-hover table-striped table-bordered">
						<thead>
							<tr>
								<th>编号</th><th>姓名</th><th>专业班级</th><th>电话</th><th>评价1</th><th>评价2</th><th>操作</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					  </table>
					</div>
				  </div>
				</div>
			</div>
		</div>
	</div>
<{/block}>

<{block name="scripts" append}>

    <script type="text/javascript">

    </script>

<{/block}>