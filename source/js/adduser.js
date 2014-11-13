$(document).ready(function(){
	$("#adduser").click(function(){
		$.post("adduser.php",
			{
				name:$('[name=name]').val(),
				native:$('[name=native]').val(),
				major:$('[name=major]').val(),
				sex:$('[name=sex]').val(),
				grade.$('[name=grade]').val()
			},
			function(data){
				alert("" + $('[name=name]').val() + "添加" + "data");
			}
			);
	});
});
