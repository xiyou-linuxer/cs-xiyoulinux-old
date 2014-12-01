$(document).ready(function(){
	$('#btn-login').click(function(){
        var param = {
            action: 'login',
            name: $('[name=username]').val(),
            password: $('[name=password]').val(),
            checknum: $('[name=checknum]').val()
        };
		$.post('server/login.server.php', param, function(data){
				if(data.substring(0,4) == 'true' ){
					$.get("server/online.server.php?uid="+data.substring(5)+"&time="+(Math.ceil((new Date().getTime())/1000)),function(){});
					var last_page = get_cookie('last_page');
					if (last_page == undefined) {
						location.href = 'index.php';
					} else {
						location.href = last_page;
					}
				}else{
					if(data.substring(5,6) == '1'){
				//		wrongCode();
						data = data.substring(6);
					}
					switch(data.substring(5,6)){
					case '2':
						alert('用户和密码都不可为空 !!');
						break;
					case '3':
						alert('用户不存在 !!');
						break;
					case '4':
						alert('验证码错误 !!');
						//$('img').attr('src','checknum.php');
						break;
					case '5':
						alert('密码错误 !!');
						break;
					default:
						break;
					}
				}
			});

        return false;
	});

    $('#btn-logout').click(function(){
        var param = {
            action: 'logout'
        };
	$.get("server/online.server.php?uid="+get_cookie('uid')+"&time="+(Math.ceil((new Date().getTime())/1000)-600),function(){});
        $.post('server/login.server.php', param, function() {
			location.href = 'index.php';
        });
    });
});

var show_code = false;

function wrongCode(){
	if(!show_code){
		$('.text-center').before("<p class='input-group'><span class='input-group-addon' style='font-size:20px;color:#24d1af;'>验证码</span><input type='text' class='form-control input-lg' name='checknum' placeholder='请输入验证码'/></p><img src='checknum.php' width=100 style='margin-top: 30px; text-align:center;' title='单击更换验证码' onclick='this.src=this.src'></img>");
		show_code = true;
	}
}
