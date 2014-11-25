$(document).ready(function(){
    getWorkplace();
    $("#submit-info").click(function(){
        $.post(
            'server/user.server.php',
            {
                func:'update_userinfo',
                uid:getCookie('uid'),
                phone:$("#phone").val(),
                mail:$("#mail").val(),
                workplace:$("#workplace-btn").text(),
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
