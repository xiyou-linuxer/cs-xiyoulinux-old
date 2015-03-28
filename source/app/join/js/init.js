(function(){
	var judge_link = $("#judge_link");
	$privilege = judge_link.data("privilege");
	judge_link.click(function() {
		if ($privilege != "1") {
			alert("对不起，您的权限不足！");
			return false;
		}
	});

	//阻止按钮默认事件
	$('[data-type="button"]').click(function (e) {
		e.stopPropagation();
	});

	//默认按钮事件触发
	$("body").keyup(function (event) {
		if (event.which == 13) {
			$('[data-type="button"][data-default="true"]').trigger("click");
		}
	});

	// datatable
 	$('[data-ride="datatables"]').each(function() {
		var oTable = $(this).dataTable({
			"order": [],
			"sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'><'col-sm-6'p>>",
			"sPaginationType": "full_numbers",
			"oLanguage": {
				"sProcessing": "正在加载中......",
				"sLengthMenu": "每页显示 _MENU_ 条记录",
				"sZeroRecords": "对不起，查询不到相关数据！",
				"sEmptyTable": "没有查询到任何记录！",
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