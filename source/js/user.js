$(document).ready(function(){
	$.ajax({
		url: 'user.php',
		type: 'post',	
		data: 'func=get_userinfo&uid=1001',
		success: function(data){
			obj = eval(data)[0];
			for(var o in obj){
				$("[name="+o+"]").val(obj[o]);
			}
			$("[name=name]").text(obj['name']);
		}
	});
	$.ajax({
		url: 'user.php',
		type: 'post',	
		data: 'func=get_avatar&uid=1001',
		success: function(data){
			$("#tx").attr('src',data);
		}
	});
});
