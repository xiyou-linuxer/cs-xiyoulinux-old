$(document).ready(function(){
	$.post("changeroot.php",
		{
			func:"get_year"
		},
		function(info)
		{
			var years = info.split(".");
			for(index in years)
			{
				if (index == 0)
					continue;
				$("#change_year").append("<option>" + years[index] + "</option>");	

			}
			
		$.post("changeroot.php",
		{
			func:"get_name",
			year:$("#change_year option:selected").val()
		},
		function(info)
		{
			$("#change_name").empty();
			var names = info.split(".");
			for(index in names)
			{
				if (index == 0)
					continue;
				$("#change_name").append("<option>" + names[index] + "</option>");
			}
		}
		);

		}
		);
	$("#change_year").change(function(){
		$.post("changeroot.php",
		{
			func:"get_name",
			year:$("#change_year option:selected").val()
		},
		function(info)
		{
			$("#change_name").empty();
			var names = info.split(".");
			for(index in names)
			{
				if (index == 0)
					continue;
				$("#change_name").append("<option>" + names[index] + "</option>");
			}
		}
		);
		});
	$("#change").click(function(){
		$.post("changeroot.php",
			{
				func:"change_user",
				year:$("#change_year option:selected").val(),
				name:$("#change_name option:selected").val()
			},
			function(data){
				alert(""+ data);	
			}
			);
	});
});
