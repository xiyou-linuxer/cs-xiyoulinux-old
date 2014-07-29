jQuery.extend({
    pageInit:function() {
        switch(localStorage.tag) {
        case 'edit':
            $.toggleMenu('#menu-edit-mail');
            break;
        case 'all':
            $.getMailList(0);
            $.toggleMenu('#menu-list-all');
            break;
        case 'unread':
            $.getMailList(1);
            $.toggleMenu('#menu-list-unread');
            break;
        case 'read':
            $.getMailList(2);
            $.toggleMenu('#menu-list-read');
            break;
        case 'draft':
            $.getMailList(4);
            $.toggleMenu('#menu-list-draft');
            break;
        case 'view-mail':
          //  $.viewMail(0);
            break;
        default:
            $.getMailList(0);
            $.toggleMenu('#menu-list-all');
            break;
        }

        $('#menu-edit-mail').click(function() {
            $.toggleMenu('#menu-edit-mail');
            localStorage.tag='edit';
        });

        $('#menu-list-all').click(function() {
            $.getMailList(0);
            $.toggleMenu('#menu-list-all');
            localStorage.tag='all';
        });
        $('#menu-list-unread').click(function() {
            $.getMailList(1);
            $.toggleMenu('#menu-list-unread');
            localStorage.tag='unread';
        });
        
        $('#menu-list-read').click(function() {
            $.getMailList(2);
            $.toggleMenu('#menu-list-read');
            localStorage.tag='read';
        });
        $('#menu-list-draft').click(function() {
            $.getMailList(4);
            $.toggleMenu('#menu-list-draft');
            localStorage.tag='draft';
        });
    }
}); 

jQuery.extend({
    toggleMenu:function(menu_id) {
        var container_id = '#mail-list';
        if(menu_id == '#menu-edit-mail') {
            container_id = '#mail-editor';
        }
        
        $(menu_id).attr('class', 'list-group-item active');
        $(menu_id).siblings().attr('class', 'list-group-item');
        $(container_id).css({'display':'block'});
        $(container_id).siblings().css({'display':'none'});
    }            
});

jQuery.extend({
    viewMail:function(mail_id) {
        $('#mail-content').css({'display':'block'});
        $('#mail-content').siblings().css({'display':'none'});
        localStorage.tag='view-mail';
        $.post("mail.php",
            {
                func:"get_mail_info",
                mid:7
            },
            function(data, status) {
                var obj = eval(data);
                var innerhtml = '';

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
                var obj = eval(data);
                var innerhtml = "";
                if (obj == null) {
                    $('#mail-table-body').html('没有可显示的数据');
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

