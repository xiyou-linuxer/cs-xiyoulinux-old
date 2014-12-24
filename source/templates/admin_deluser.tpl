<{include file="header.tpl"}>
<link rel="stylesheet" href="js/chosen/chosen.css" type="text/css" />
<{include file="header_nav.tpl"}>
<{include file="aside.tpl"}>
<!-- /.aside -->
<section id="content">
    <section class="hbox stretch">
        <section class="vbox">
            <section class="scrollable wrapper-lg" id="bjax-target"> 
<!-- 管理员删除用户界面 -->
<div class="row">
	<section class="panel panel-default">
		<div class="panel-body">
			<form class="form-horizontal" method="post" action="server/admin_deluser.php">
				<h4 class="m-t-none">删除用户</h4>
				<div class="line line-dashed b-b line-lg pull-in"></div>
				<div class="panel-body">
					<form class="form-inline" role="form">
						<div class="form-group">
							<label class="col-sm-2 control-label">选择级别</label>
							<div class="col-sm-4">
								<select style="width:260px" class="chosen-select">
									<optgroup label="2004 - 2020">
										<option value="04">2004级</option>
										<option value="05">2005级</option>
										<option value="06">2006级</option>
										<option value="07">2007级</option>
										<option value="08">2008级</option>
										<option value="09">2009级</option>
										<option value="10">2010级</option>
										<option value="11">2011级</option>
										<option value="12">2012级</option>
										<option value="13">2013级</option>
										<option value="14">2014级</option>
										<option value="15">2015级</option>
										<option value="16">2016级</option>
										<option value="17">2017级</option>
										<option value="18">2018级</option>
										<option value="19">2019级</option>
										<option value="20">2020级</option>
									</optgroup>
								</select>
							</div>
							<label class="col-sm-2 control-label">选择成员</label>
							<div class="col-sm-4">
								<select style="width:260px" class="chosen-select">
									<optgroup label="04级成员">
										<option value="CT">王聪</option>
										<option value="CT">孔建军</option>
										<option value="CT">辛龙</option>
									</optgroup>
								</select>
							</div>
						</div>
						<div class="line line-dashed b-b line-lg pull-in"></div>

						<div class="form-group">
							<div class="col-sm-6"></div>
							<div class="col-sm-4 col-sm-offset-2">
								<button type="submit" class="btn btn-danger">确认删除</button>
							</div>
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
<{include file="footer.tpl"}>