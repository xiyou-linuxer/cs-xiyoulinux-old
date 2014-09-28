$(document).ready(function(){
	$.post("appmanager.php",
		{
			func:"get_app_name"
		},
		function(names)
		{
			for(name in names)
			{
				$("#app_name").append("<option>" + name + "</option>");
			}
		}
		);
	$.post("appmanager.php",
		{
			func:"get_status",
			name:$("#app_name option:selected").val()
		},
		function(status)
		{
			if (status == 1)
				$("#app").text("点击下线");
			if (status == 0)
				$("#app").text("点击上线");
		},
		);
	$.post("appmanager.php",
			{
				func:"change_status",
				$("#app_name option:selected").val()
			},
			function($data)
			{
				alert("" + data);
			}
			);
});
