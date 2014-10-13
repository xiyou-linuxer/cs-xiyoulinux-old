$(document).ready(function(){
	$.post("appmanager.php",
		{
			func:"get_app_name"
		},
		function(info)
		{
			var names = info.split(".");
		
			$("app_name").empty();
			for(index in names)
			{
				if (index == 0)
					continue;
				$("#app_name").append("<option>" + names[index] + "</option>");
			}
		
			//$("#app").addClass("autofocus");
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
		}
		);
		}
		);
	$("#app_name").change(function()
	{
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
		}
		);
	});


	$("#app").click(function(){
		$.post("appmanager.php",
		{
			func:"change_status",
			name:$("#app_name option:selected").val()
		},
		function(data)
		{
			alert("" + data);
		}
		);
});



});
