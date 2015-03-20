<{extends file="../../../templates/frame.tpl"}>

<{block name="stylesheet" append}>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<{/block}>

<{block name="content"}> 
	<div class="row page-content">
		<div class="col-md-4">
			<div class="well">
				<form action="adminqueue.php" method="post">
					<legend>面试签到</legend>
					<div class="row">
						<div class="col-md-8">
							<div class="input-group">
								<span class="input-group-addon">编号或学号</span>
								<input type="text" class="form-control" name ="profileid" id="profileid" value="" required />
							</div>
						</div>
						<div class="col-md-4">
							<button type="submit" class="btn btn-primary btn-block">确认签到</button>
						</div>
					</div>
				</form>
				<legend>现场报名</legend>
				<p>请扫描下方二维码，关注官方微信平台，通过右下方“其他功能”->“纳新报名”完成报名。</p>
				<p style="text-align: center"><img src="http://222.24.19.63/getqrcode.jpg" width="200px/"></p>
			</div>	
		</div>
		<div class="col-md-8">
			<div class="tabbable">
				<ul class="nav nav-tabs">
					<li class="active"><a href="#tab1" data-toggle="tab">待面试队列</a></li>
					<li class=""><a href="#tab2" data-toggle="tab">已面试队列</a></li>
				</ul>
				<div class="tab-content">
				<div class="tab-pane active" id="tab1">
					<table class="table table-bordered table-striped">
						<thead><tr>
							<th>编号</th><th>学号</th><th>姓名</th><th>专业班级</th><th>状态</th><th>签到时间</th><th>面试安排</th>
						</tr></thead>
						<tbody>
						</tbody>
					</table>
				</div>
				<div class="tab-pane" id="tab2">
	                <table class="table table-bordered table-striped">
	                    <thead>
	                    	<tr>
	                            <th>编号</th>
	                            <th>学号</th>
	                            <th>姓名</th>
	                            <th>专业班级</th>
	                            <th>状态</th>
	                            <th>签到时间</th>
	                            <th>面试安排</th>
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
<{/block}>

<{block name="scripts" append}>
<script type="text/javascript">
</script>

<{/block}>
