$(document).ready(function(){
	$.post("changeuser.php",
		{
			func:"get_year"
		},
		function(years)
		{
			for(year in years)
			{
				$("#change_year").append("<option>" + year + "</option>");
			}
		});
	$.post("changeuser.php",
		{
			func:"get_name",
			year:$("#change_year option:selected").val()
		},
		function(names)
		{
			for(name in names)
			{
				$("#change_name").append("<option>" + name + "</option>");
			}
		}
		);
	$("#change").click(function(){
		$.post("changeuser.php",
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
