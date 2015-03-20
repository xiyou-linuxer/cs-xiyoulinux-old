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
			<legend>手动决策</legend>
			<div class="alert alert-block alert-info">
				<div class="row">
					<h4 class="col-md-6">1001 | 张永军 | 2轮面试</h4>
					<div class="col-md-2"><a href="adminjudge-manual.php?id=1" class="btn btn-success btn-block">通 过</a></div>
					<div class="col-md-2"><a href="adminjudge-manual.php?id=1" class="btn btn-danger btn-block">淘 汰</a></div>
					<div class="col-md-2"><a href="adminjudge-manual.php?id=1" class="btn btn-warning btn-block">待 定</a></div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<ul class="messages">
						<li class="well">
							<legend>C 张永军</legend>
							<p class="message">
								<label class="label bg-info">基础技能</label>
								<p>差评</p>
								<label class="label bg-info">加分技能</label>
								<p>差评</p>
								<label class="label bg-info">总体评价</label>
								<p>差评</p>
							</p>
						</li>
					</ul>
				</div>
				<div class="col-md-6">
					<ul class="messages">
						<li class="well">
							<legend>B 张永军</legend>
							<p class="message">
								<label class="label bg-info">基础技能</label>
								<p>一般</p>
								<label class="label bg-info">加分技能</label>
								<p>一般</p>
								<label class="label bg-info">总体评价</label>
								<p>一般</p>
							</p>
						</li>
					</ul>
				</div>
			</div>
		</div>

	</div>
<{/block}>

<{block name="scripts" append}>
<script type="text/javascript" src="http://dev.xiyoulinux.org/zyj/js/chosen/chosen.jquery.min.js"></script>
<script type="text/javascript">
</script>

<{/block}>
