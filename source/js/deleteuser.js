$(document).ready(function(){
	$.post("deleteuser.php",
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
				$("#delete_id").append("<option>" + years[index] + "</option>");	

			}
			$("delete_id").addClass("focus");
		}
		);
$("#delete_id").focus(function(){
	$.post("deleteuser.php",
		{
			func:"get_name",
			year:$("#delete_id option:selected").val()
		},
		function(info)
		{
			$("#delete_name").empty();
			var names = info.split(".");
			for(index in names)
			{
				if (index == 0)
					continue;
				$("#delete_name").append("<option>" + names[index] + "</option>");
			}
		}
		);
		});
	$("#delete").click(function(){
		$.post("deleteuser.php",
			{
				func:"delete_user",
				year:$("#delete_id option:selected").val(),
				name:$("#delete_name option:selected").val()
			},
			function(data){
				alert(""+ data);	
			}
			);
	});
});
