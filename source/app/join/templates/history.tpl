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
						<a id="judge_link" data-privilege="<{$laside_user_privilege}>" href="judge.php"><i class="fa fa-check"></i> 结果筛选</a>
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
				<ul class="history-list">
					<{section name=n loop=$records}>
					<li class="history-item">
						<div class="well">
							<legend>评价记录</legend>
							<div class="row">
								<div class="col-md-6" style="border-right: 1px solid #dadada;">
									<label class="label bg-info">报名信息</label>
									<p>编号：<strong><{$records[n]["uid"]}></strong></p>
									<p>姓名：<strong><{$records[n]["name"]}></strong></p>
									<p>班级：<{$records[n]["class"]}></p>
									<label class="label bg-info">面试信息</label>
									<p>环节：<strong>
									<{if $records[n]["round"] == 0}>0<{else}><{$records[n]["round"]}><{/if}>
									</strong>面</p>
									<p>等级：<strong>A</strong></p>
									<label class="label bg-info">面试时间</label>
									<p><{$records[n]["time"]}></p>
								</div>
								<div class="col-md-6">
									<label class="label bg-info">基础技能</label>
									<p><{$records[n]["basic"]}></p>
									<label class="label bg-info">加分技能</label>
									<p><{$records[n]["extra"]}></p>
									<label class="label bg-info">总体评价</label>
									<p><{$records[n]["overall"]}></p>
								</div>
							</div>
						</div>
					</li>
					<{/section}>
				</ul>
			</div>
		</div>
	</div>
<{/block}>

<{block name="scripts" append}>
	<script type="text/javascript" src="js/init.js"></script>
    <script type="text/javascript">

    </script>

<{/block}>