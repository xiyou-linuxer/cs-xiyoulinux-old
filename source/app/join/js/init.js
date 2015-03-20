var judge_link = $("#judge_link");
$privilege = judge_link.data("privilege");
judge_link.click(function() {
	if ($privilege != "1") {
		alert("对不起，您的权限不足！");
		return false;
	}
});