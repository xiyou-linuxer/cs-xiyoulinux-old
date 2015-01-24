<{include file="header.tpl"}>
<link rel="stylesheet" href="js/chosen/chosen.css" type="text/css" />
<{include file="header_nav.tpl"}>
<{include file="aside.tpl"}>
<!-- /.aside -->
<section id="content">
    <section class="hbox stretch">
        <section class="vbox">
            <section class="scrollable wrapper-lg" id="bjax-target">   
<!-- 管理员应用管理页面 -->
<div class="row">
	<section class="panel panel-default">
		<div class="panel-body">

                <h4 class="m-t-none">
                应用管理
                <button class="btn btn-info" id="flush-btn">
                        <a href="#">刷新列表</a>
                </button>
                <h4>
                      <!--  <div class="col-sm-2">

                       		<button class="btn btn-info">
					<a href="server/admin_appscan.php">应用管理</a>
				</button>
                        </div>-->
                </div>

			<div class="line line-dashed b-b line-lg pull-in col-sm-12"></div>

			<div class="panel-body">

				<form class="form-inline col-sm-6" role="form" >
					<div class="form-group">
						<label class="col-sm-2 control-label">下线</label>
						<div class="col-sm-10">
							<select name="onlineapp" style="width:260px" class="chosen-select" id="online-select">
							<!--	<optgroup label="目前运行应用">
									<option value="CT"><{$onlineapp[times]}></option>
									<option value="CT">招聘</option>
									<option value="CT">活动</option>
								</optgroup>-->
							</select>
						</div>
					</div>
					<div class="line line-dashed b-b line-lg pull-in col-sm-12"></div>

					<div class="col-sm-offset-3">
						<button type="button" id="offline-btn" class="btn btn-danger">确认下线</button>
					</div>
				</form>

				<form class="form-inline col-sm-6" role="form" >
					<div class="form-group">
						<label class="col-sm-2 control-label">上线</label>
						<div class="col-sm-10">
							<select name="offlineapp" style="width:260px" class="chosen-select" id="offline-select">
								<!--<optgroup label="目前下线应用">
									<option value="CT">项目</option>
									<option value="CT">基金</option>
                                                                </optgroup>-->
							</select>
						</div>
					</div>
					<div class="line line-dashed b-b line-lg pull-in col-sm-12"></div>

					<div class="col-sm-3 col-sm-offset-3">
						<button type="button" id="online-btn" class="btn btn-success">确认上线</button>
					</div>

				</form>
			</div>
		</section>
	</div>

</section>
</section>
<{include file="chat.tpl"}>
<{include file="script.tpl"}>
<script type="text/javascript" src="js/chosen/chosen.jquery.min.js"></script>
<script type="text/javascript" src="js/admin_appmanager.js"></script>
<{include file="footer.tpl"}>
