jQuery.extend({
    pageInit:function() {
        switch(localStorage.tag) {
        case 'edit-mail':
            $.toggleMenu('#menu-edit-mail');
            break;
        case 'list-all':
            $.getMailList(0);
            $.toggleMenu('#menu-list-all');
            break;
        case 'list-unread':
            $.getMailList(1);
            $.toggleMenu('#menu-list-unread');
            break;
        case 'list-read':
            $.getMailList(2);
            $.toggleMenu('#menu-list-read');
            break;
        case 'list-draft':
            $.getMailList(4);
            $.toggleMenu('#menu-list-draft');
            break;
        case 'view-mail':
            $.viewMail(localStorage.mid);
            break;
        default:
            $.getMailList(0);
            $.toggleMenu('#menu-list-all');
            break;
        }

        $('#menu-edit-mail').click(function() {
            $.toggleMenu('#menu-edit-mail');
            localStorage.tag='edit-mail';
        });

        $('#menu-list-all').click(function() {
            $.getMailList(0);
            $.toggleMenu('#menu-list-all');
            localStorage.tag='list-all';
        });
        $('#menu-list-unread').click(function() {
            $.getMailList(1);
            $.toggleMenu('#menu-list-unread');
            localStorage.tag='list-unread';
        });
        
        $('#menu-list-read').click(function() {
            $.getMailList(2);
            $.toggleMenu('#menu-list-read');
            localStorage.tag='list-read';
        });
        $('#menu-list-draft').click(function() {
            $.getMailList(4);
            $.toggleMenu('#menu-list-draft');
            localStorage.tag='list-draft';
        });
    }
}); 

jQuery.extend({
    toggleMenu:function(menu) {
        var container = '#mail-list';
        if(menu == '#menu-edit-mail') {
            container = '#mail-editor';
        }
        
        $(menu).attr('class', 'list-group-item active');
        $(menu).siblings().attr('class', 'list-group-item');
        $(container).css({'display':'block'});
        $(container).siblings().css({'display':'none'});
    }            
});

jQuery.extend({
    sendMail:function() {
        $('#mail-editor').css({'display':'block'});
        $('#mail-editor').siblings().css({'display':'none'});
       

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
        $('#mail-viewer').css({'display':'block'});
        $('#mail-viewer').siblings().css({'display':'none'});
        localStorage.tag='view-mail';
        localStorage.mid=mail_id;
        $.post("mail.php",
            {
                func:"get_mail_info",
                mid:mail_id
            },
            function(data, status) {
                var obj = eval(data);
                var innerhtml = '<h3 class="text-center">' + obj[0].title + '</h3>';
                $('#mail-title').html(innerhtml);
                
                innerhtml = '<h4>消息来自: ' + obj[0].fromuser + '</h4>';
                $('#mail-fromuser').html(innerhtml);
                
                innerhtml = '<h4>' + obj[0].content + '</h4>';
                $('#mail-contentd').html(innerhtml);
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

