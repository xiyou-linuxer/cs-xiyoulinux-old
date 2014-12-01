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
		if($('#info-btn').length > 0)
			uid = $('#info-btn').attr('href').substr(20);
		else 
			uid = getCookie('uid');

		viewH = $(this).height();
		contentH = $(this).get(0).scrollHeight;
		scrollTop = $(this).scrollTop();
		if ((contentH - viewH - scrollTop <= 100) || (contentH - viewH < scrollTop)){
			times++;
			if(times == 1)
			{
			$.post('server/profile.fresh.php',
				{
					uid:uid,
					mid:$('.comment-item:last').attr('mid')
				},
				function(data){
					if (data.substr(0,5) != 'false'){
					$('.comment-item:last').after(data);
					$('.comment-item:last').hide();
					$('.comment-item:last').prev().hide();
					$('.comment-item:last').prev().prev().hide();
					$('.comment-item:last').slideDown();
					$('.comment-item:last').prev().slideDown();
					$('.comment-item:last').prev().prev().slideDown();
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
