$(document).ready(function(){
    getWorkplace();
    scrollLoad();
    $("#submit-info").click(function(){
        //alert('grade:' + $("#grade-btn").text() +'\nuid:'+ getCookie('uid') + "\nphone" + $("#phone").val() + "\nmail:" + $("#mail").val() + "\nworkplace" + $("#workplace-btn").text() + "\njob:" + $("#job").val() + "\nmajor:" + $("#major").val() + "\nqq:" + $("#qq").val() + "\nwechat" + $("#wechat").val() + "\nblog" + $("#blog").val() + "\ngithub" + $("#github").val());
        $.post(
            'server/profile.server.php',
            {
                func:'update_userinfo',
                uid:getCookie('uid'),
                phone:$("#phone").val(),
                mail:$("#mail").val(),
                workplace:$("#workplace").val(),
                job:$("#job").val(),
                major:$("#major").val(),
                qq:$("#qq").val(),
                wechat:$("#wechat").val(),
                blog:$("#blog").val(),
                github:$("#github").val(),
                grade:$("#grade-btn").text()
            },
            function (data) {
                if (data == 1)
                    alert("修改成功");
                else
                    alert("修改失败");

            }
        );
    });
});

var getWorkplace = function(){
    $("#workplace-ul li").click(function(){
        $('#workplace-btn').html($(this).text()+ '<span class="caret"></span>');
    });

}

$("#change-password").click(function(){
    window.location.href = modifyPasswdUrl;	
});

var times = 0;
function scrollLoad(){
	$('#activity-scroll').scroll(function(){
		viewH = $(this).height();
		contentH = $(this).get(0).scrollHeight;
		scrollTop = $(this).scrollTop();
		if ((contentH - viewH - scrollTop <= 100) || (contentH - viewH < scrollTop)){
			times++;
			if(times == 1)
			{
			$.post('server/profile.fresh.php',
				{
					mid:$('#activity-ul:last').children('li').attr('mid')
				},
				function(data){
					if (data.substr(0,5) != 'false'){
					$('#activity-ul:last').children('li').after(data);
					$('#acticity-ul:last').children('li').hide();
					$('#acticity-ul:last').children('li').prev().hide();
					$('#acticity-ul:last').children('li').prev().pre().hide();
					$('#acticity-ul:last').children('li').slideDown();
					$('#acticity-ul:last').children('li').prev().slideDown();
					$('#acticity-ul:last').children('li').prev().prev().slideDown();
				}
				times = 0;
			}
			);
			}
		}	
	});
}

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
