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
			if( $('[name=sex]').val() == '0' )
				$('[name=sex]').val('男');
			else
				$('[name=sex]').val('女');
		}
	});
	$.ajax({
		url: 'user.php',
		type: 'post',	
		data: 'func=get_avatar&uid='+getCookie('uid'),
		success: function(data){
			$("#tx").attr('src',data);
		}
	});
	$("[type=button]").click(function(){
		var phone = $("[name=phone]").val();
		var mail = $("[name=mail]").val();
		var qq = $("[name=qq]").val();
		var wechat = $("[name=wechat]").val();
		var blog = $("[name=blog]").val();
		var github = $("[name=github]").val();
		var workplace = $("[name=workplace]").val();
		var job = $("[name=job]").val();
		$.ajax({
			url: 'user.php',
			type: 'post',	
			data: 'func=update_userinfo&uid='+getCookie('uid')+'&phone='+phone+
				'&mail='+mail+'&qq='+qq+'&wechat='+wechat+'&blog='+blog+
				'&github='+github+'&workplace='+workplace+'&job='+job,
			success: function(data){
				if(data.substring(0,4) == 'true'){
					alert('修改成功');
					$.ajax({
						url: 'user.php',
						type: 'post',	
						data: 'func=get_avatar&uid='+getCookie('uid'),
						success: function(data){
							$("#tx").attr('src',data);
						}
					});
				}
				else
					alert('修改失败');
			}
		});
	});
});

function getCookie(str){
	var start = document.cookie.indexOf(str + "=");
	var	len	= start + str.length + 1;
	
	if( !start && str != document.cookie.substr(0,str.length) )
		return null;
	if(start == -1)
		return null;
	var end = document.cookie.indexOf(";",len);
	if(end == -1)
		end = document.cookie.length;
	return decodeURI( document.cookie.substring(len,end) );
}
