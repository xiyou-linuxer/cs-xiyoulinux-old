$(document).ready(function(){
	$("#adduser").click(function(){
        //alert($('[name=email]').val());
		$.post("server/admin_adduser.server.php",
			{
				name:$('[name=name]').val(),
				native:$('[name=native] option:selected').text(),
				major:$('[name=major] option:selected').text(),
				sex:$('[name=sex]').parent('.active').children('input').val(),
				grade:$('[name=grade] option:selected').text(),
                qq:$('[name=QQnum]').val(),
                mail:$('[name=email]').val(),
                tel:$('[name=telphone]').val()
			},
			function(data){
				alert("" + $('[name=name]').val() + '信息' +data);
			}
			);
	});
});
