<{extends file="../../../templates/frame.tpl"}>

<{block name="stylesheet" append}>
<link rel="stylesheet" href="http://dev.xiyoulinux.org/zyj/js/chosen/chosen.css" type="text/css" />
<link rel="stylesheet" href="http://dev.xiyoulinux.org/zyj/js/datatables/datatables.css" type="text/css" />
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
			<div class="well">
				<legend>
					共有0个查询结果
				</legend>
				<table class="table table-striped m-b-none" data-ride="datatables">
                    <thead>
						<tr>
							<th>
								编号
							</th>
							<th>
								学号
							</th>
							<th>
								姓名
							</th>
							<th>
								专业
							</th>
							<th>
								电话
							</th>
							<th>
								状态
							</th>
						</tr>
                    </thead>
                    <tbody>                    	
                    	<{section name=n loop=$record_list}>
						<tr>
							<td><{$record_list[n]["uid"]}></td>
							<td><{$record_list[n]["sno"]}></td>
							<td><{$record_list[n]["name"]}></td>
							<td><{$record_list[n]["class"]}></td>
							<td><{$record_list[n]["mobile"]}></td>
							<td>
							<{if $record_list[n]["status"] == 0}>
								面试结果待定
							<{elseif $record_list[n]["status"] == 1}>
								报名成功，等待一面
							<{elseif $record_list[n]["status"] == -1}>
								一面未通过
							<{elseif $record_list[n]["status"] == 2}>
								一面通过，等待二面
							<{elseif $record_list[n]["status"] == -2}>
								二面未通过
							<{elseif $record_list[n]["status"] == 3}>
								二面通过，等待三面
							<{elseif $record_list[n]["status"] == -3}>
								三面未通过
							<{elseif $record_list[n]["status"] == 4}>
								三面通过，面试完成
							<{/if}>
							</td>
						</tr>
						<{/section}>
                    </tbody>
                </table>

				<ul class="pager">
				</ul>
			</div>
		</div>
	</div>
<{/block}>

<{block name="scripts" append}>
<script type="text/javascript" src="js/init.js"></script>
<script type="text/javascript" src="http://dev.xiyoulinux.org/zyj/js/chosen/chosen.jquery.min.js"></script>
<script type="text/javascript" src="http://dev.xiyoulinux.org/zyj/js/datatables/jquery.dataTables.min.js"></script>
<script type="text/javascript">
(function(){
  // datatable
 	$('[data-ride="datatables"]').each(function() {
		var oTable = $(this).dataTable({
			"bProcessing": true,
			"sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'><'col-sm-6'p>>",
			"sPaginationType": "full_numbers",
			"oLanguage": {
				"sProcessing": "正在加载中......",
				"sLengthMenu": "每页显示 _MENU_ 条记录",
				"sZeroRecords": "对不起，查询不到相关数据！",
				"sEmptyTable": "没有查询到报名记录！",
				"sInfo": "当前显示 _START_ 到 _END_ 条，共 _TOTAL_ 条记录",
				"sInfoFiltered": "数据表中共为 _MAX_ 条记录",
				"sSearch": "搜索",
				"oPaginate": {
					"sFirst": "首页",
					"sPrevious": "上一页",
					"sNext": "下一页",
					"sLast": "末页"
				}
			}
		});
	});
})();
</script>

<{/block}>
