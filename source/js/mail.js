jQuery.extend({
    pageInit:function() {
        switch(localStorage.index) {
        case 'mail-editor':
            $.toggleMenu('#menu-mail-editor');
            break;
        case 'mail-all':
            $.getMailList(0);
            $.toggleMenu('#menu-mail-all');
            break;
        case 'mail-unread':
            $.getMailList(1);
            $.toggleMenu('#menu-mail-unread');
            break;
        case 'mail-read':
            $.getMailList(2);
            $.toggleMenu('#menu-mail-read');
            break;
        case 'mail-draft':
            $.getMailList(4);
            $.toggleMenu('#menu-mail-draft');
            break;
        case 'mail-viewer':
            $.viewMail(localStorage.mid);
            break;
        default:
            $.getMailList(0);
            $.toggleMenu('#menu-mail-all');
            break;
        }

        $('#menu-mail-editor').click(function() {
            $.toggleMenu('#menu-mail-editor');
            localStorage.tag='mail-editor';
        });

        $('#menu-mail-all').click(function() {
            $.getMailList(0);
            $.toggleMenu('#menu-mail-all');
            localStorage.tag='mail-all';
        });
        $('#menu-mail-unread').click(function() {
            $.getMailList(1);
            $.toggleMenu('#menu-mail-unread');
            localStorage.tag='mail-unread';
        });
        
        $('#menu-mail-read').click(function() {
            $.getMailList(2);
            $.toggleMenu('#menu-mail-read');
            localStorage.tag='mail-read';
        });
        $('#menu-mail-draft').click(function() {
            $.getMailList(4);
            $.toggleMenu('#menu-mail-draft');
            localStorage.tag='mail-draft';
        });
        $('#btn-send-mail').click(function() {
            return $.sendMail();            
        });
        $('#btn-reply-mail').click(function() {
            $('#send-mail-touser').val($('#view-mail-fromuser').html());
            $('#send-mail-title').val('');
            $('#send-mail-content').val('');
            $('#mail-editor-container').css({'display':'block'});
            $('#mail-editor-container').siblings().css({'display':'none'});
        });
    }
}); 

jQuery.extend({
    toggleMenu:function(menu) {
        var container = '#mail-list-container';
        if(menu == '#menu-mail-editor') {
            container = '#mail-editor-container';
        }
        
        $(menu).attr('class', 'list-group-item active');
        $(menu).siblings().attr('class', 'list-group-item');
        $(container).css({'display':'block'});
        $(container).siblings().css({'display':'none'});
    }            
});

jQuery.extend({
    sendMail:function() {
        $('#mail-editor-container').css({'display':'block'});
        $('#mail-editor-container').siblings().css({'display':'none'});
       

        $.post("mail.php",
            {
                func:"send_mail",
                title:$("#send-mail-title").val(),
                touser:$('#send-mail-touser').val(),
                content:$('#send-mail-content').val()
            },
            function(data, status) {
                var obj = eval("(" + data + ")");
                $('.modal-title').html('发送状态');
                if (obj.result == 'true') {
                    $('.modal-body').html('发送成功');
                } else {
                    $('.modal-body').html('失败列表：' + obj.result);
                }
                $('#tipsModal').modal({keyboard:true});
            }
        );
        return false;
    }
}); 

jQuery.extend({
    viewMail:function(mail_id) {
        $('#mail-viewer-container').css({'display':'block'});
        $('#mail-viewer-container').siblings().css({'display':'none'});
        localStorage.tag='mail-view';
        localStorage.mid=mail_id;
        $.post("mail.php",
            {
                func:"get_mail_info",
                mid:mail_id
            },
            function(data, status) {
                var obj = eval(data);
                $('#view-mail-title').html(obj[0].title);
                $('#view-mail-fromuser').html(obj[0].fromuser);
                $('#view-mail-content').html(obj[0].content);
            }
        );
    }
}); 

jQuery.extend({
    getMailList:function(tag) {
        $.post('mail.php',
            {
                func:"get_mail_list",
                tag:tag
            },
            function(data, status) {
                var obj = eval('(' + data + ')');
                var innerhtml = '';
                if (obj.result == 'false') {
                    $('#mail-table-body').html('');
                } else {
                    for (var i = 0; i < obj.length; i++) {
                        //var touser = eval(obj.touser);
                        innerhtml += "<tr onclick=$.viewMail(" + obj[i].mid + ");><td>" + obj[i].title + "</td>";
                        innerhtml += "<td class='text-center'>" + obj[i].date + "</td>";
                        innerhtml += "<td class='text-center'>" + obj[i].fromuser + "</td>";
                        innerhtml += "<td class='text-center'>" + obj[i].status + "</td>";
                        innerhtml += "<td>" + obj[i].content + "</td></tr>";
                    }
                    $('#mail-table-body').html(innerhtml); 
                } 
            }
        ); 
    }            
});

jQuery.extend({
urlGet:function() {  
var aQuery = window.location.href.split("?");//ȡ??Get????  
var aGET = new Array();  
if(aQuery.length > 1) {  
var aBuf = aQuery[1].split("&");  
for(var i=0, iLoop = aBuf.length; i<iLoop; i++) {  
var aTmp = aBuf[i].split("=");//????key??Value  
aGET[aTmp[0]] = aTmp[1];  
}
}  
return aGET;  
} 
});  

