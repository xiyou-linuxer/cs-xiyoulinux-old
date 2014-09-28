$(document).ready(function(){
	$.post("deleteuser.php",
		{
			func:"get_year"
		},
		function(years)
		{
			for(year in years)
			{
				$("#delete_year").append("<option>" + year + "</option>");
			}
		});
	$.post("deleteuser.php",
		{
			func:"get_name",
			year:$("#delete_year option:selected").val()
		},
		function(names)
		{
			for(name in names)
			{
				$("#delete_name").append("<option>" + name + "</option>");
			}
		}
		);
	$("#delete").click(function(){
		$.post("deleteuser.php",
			{
				func:"delete_user",
				year:$("#delete_year option:selected").val(),
				name:$("#delete_name option:selected").val()
			},
			function(data){
				alert(""+ data);
			}
			);
	});
});
