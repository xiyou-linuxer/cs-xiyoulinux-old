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
						<li class="nav-list-item active">
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
				<div class="panel-body bg-primary">
					<div class="app-info">
						<div class="logo"></div>
						<h2 class="text-white text-center">西邮Linux纳新面试系统</h2>
						<p class=" text-center">
							<a href="record.php" class="btn btn-default btn-large" style="margin: 10px; font-size: 18px; padding 10px;">报名记录</a> 
							<a href="queue.php" class="btn btn-danger btn-large" style="margin: 10px; font-size: 18px; padding 10px;"> 等待队列 </a> 
							<a href="start.php" class="btn btn-info btn-large" style="margin: 10px; font-size: 18px; padding 10px;"> 开始面试 </a> 
						</p>
					</div>
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-body">
					<legend>本轮已完成：<{$status["current"]}> / <{$status["current_total"]}></legend>
					<div class="progress progress-striped active">
						<div class="progress-bar progress-bar-success" role="progressbar" style="width: <{if $status["current_total"] == 0}>0<{else}><{$status["current"] * 100 / $status["current_total"]}><{/if}>%">
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
    </script>
<{/block}>