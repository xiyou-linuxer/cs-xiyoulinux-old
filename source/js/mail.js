jQuery.extend({
    pageInit:function() {
        //if (getCookie("uid") == null) {
          //  alert("hehe");
       // }
        switch(localStorage.index) {
        case 'mail-editor':
            $.toggleMenu('#menu-mail-editor');
            $.toggleView('#mail-editor-view');
            break;
        case 'mail-all':
            $.getMailList(0);
            $.toggleMenu('#menu-mail-all');
            $.toggleView('#mail-list-view');
            break;
        case 'mail-unread':
            $.getMailList(1);
            $.toggleMenu('#menu-mail-unread');
            $.toggleView('#mail-list-view');
            break;
        case 'mail-read':
            $.getMailList(2);
            $.toggleMenu('#menu-mail-read');
            $.toggleView('#mail-list-view');
            break;
        case 'mail-draft':
            $.getMailList(4);
            $.toggleMenu('#menu-mail-draft');
            $.toggleView('#mail-list-view');
            break;
        case 'mail-reader':
            $.readMail(localStorage.mid);
            break;
        default:
            $.getMailList(0);
            $.toggleMenu('#menu-mail-all');
            $.toggleView('#mail-list-view');
            break;
        }

        $('#menu-mail-editor').click(function() {
            $.toggleMenu('#menu-mail-editor');
            $.toggleView('#mail-editor-view');
            localStorage.index='mail-editor';
        });

        $('#menu-mail-all').click(function() {
            $.getMailList(0);
            $.toggleMenu('#menu-mail-all');
            $.toggleView('#mail-list-view');
            localStorage.index='mail-all';
        });
        $('#menu-mail-unread').click(function() {
            $.getMailList(1);
            $.toggleMenu('#menu-mail-unread');
            $.toggleView('#mail-list-view');
            localStorage.index='mail-unread';
        });
        
        $('#menu-mail-read').click(function() {
            $.getMailList(2);
            $.toggleMenu('#menu-mail-read');
            $.toggleView('#mail-list-view');
            localStorage.index='mail-read';
        });
        $('#menu-mail-draft').click(function() {
            $.getMailList(4);
            $.toggleMenu('#menu-mail-draft');
            $.toggleView('#mail-list-view');
            localStorage.index='mail-draft';
        });
        $('#btn-save-draft').click(function() {
            return $.saveDraft();            
        });
        $('#btn-send-mail').click(function() {
            return $.sendMail();            
        });
        $('#btn-reply-mail').click(function() {
            $('#mail-editor-touser').val($('#mail-reader-fromuser').html());
            $('#mail-editor-title').val('');
            $('#mail-editor-content').val('');
            $.toggleView('#mail-editor-view');
        });
        $('#btn-delete-mail').click(function() {
            $.delMail(localStorage.mid);
        });
        $('#mail-editor-touser').autocomplete({
            source: function(query, process) {
                $.post('mail.php', {'username':query},function(respData) {
                        //return process(respData);
                    return("[{'username':'张永军'},{'username':'王呵呵'}]");
                });
            },
            formatItem:function(item) {
                return item['username'];
            },
            setValue:function(item) {
                return {'data-value':item['username'], 'real-value':item['username']};
            }
        });
    }
}); 

jQuery.extend({
    toggleMenu:function(menu) {
        $(menu).attr('class', 'list-group-item active');
        $(menu).siblings().attr('class', 'list-group-item');
    }            
});

jQuery.extend({
    toggleView:function(view) {
        $(view).css({'display':'block'});
        $(view).siblings().css({'display':'none'});
    }            
});

jQuery.extend({
    saveDraft:function() {
        $.post('mail.php',
            {
                func: 'save_draft',
                title: $('#mail-editor-title').val(),
                touser: $('#mail-editor-touser').val(),
                content: $('#mail-editor-content').val()
            },
            function(data, status) {
                var obj = eval('(' + data + ')');
                $('.modal-title').html('保存状态');
                if (obj.result == 'true') {
                    $('.modal-body').html('保存成功');
                } else if (obj.result == 'false') {
                    $('.modal-body').html('保存失败');                
                }
                $('#tipsModal').modal({keyboard: true});
            }
        );
        return false;
    }
}); 

jQuery.extend({
    sendMail:function() {
        $.post('mail.php',
            {
                func: 'send_mail',
                title: $('#mail-editor-title').val(),
                touser: $('#mail-editor-touser').val(),
                content: $('#mail-editor-content').val()
            },
            function(data, status) {
                var obj = eval('(' + data + ')');
                $('.modal-title').html('发送状态');
                if (obj.result == 'true') {
                    $('.modal-body').html('发送成功');
                } else if (obj.result == 'false') {
                    $('.modal-body').html('发送失败');                
                } else {
                    $('.modal-body').html('失败列表：' + obj.result);
                }
                $('#tipsModal').modal({keyboard: true});
            }
        );
        return false;
    }
}); 

jQuery.extend({
    readMail:function(mail_id) {
        $('#mail-reader-view').css({'display': 'block'});
        $('#mail-reader-view').siblings().css({'display': 'none'});
        localStorage.tag = 'mail-reader';
        localStorage.mid = mail_id;
        $.post('mail.php',
            {
                func: 'get_mail_info',
                mid: mail_id
            },
            function(data, status) {
                var obj = eval(data);
                $('#mail-reader-title').html(obj[0].title);
                $('#mail-reader-fromuser').html(obj[0].fromuser);
                $('#mail-reader-content').html(obj[0].content);
                localStorage.index = 'mail-reader';
            }
        );
    }
}); 

jQuery.extend({
    delMail:function(mail_id) {
        $.post('mail.php',
            {
                func: 'del_mail',
                mid: mail_id
            },
            function(data, status) {
                var obj = eval('(' + data + ')');
                $('.modal-title').html('删除状态');
                if (obj.result == 'true') {
                    $('.modal-body').html('删除成功');
                    $('#btn-modal-close').click(function() {
                        localStorage.index = 'mail-list-view';
                        location.href='mail.html';
                    });
                } else if (obj.result == 'false') {
                    $('.modal-body').html('删除失败');                
                }
                $('#tipsModal').modal({keyboard: true});
            }
        );
    }
}); 


jQuery.extend({
    getMailList:function(tag) {
        $.post('mail.php',
            {
                func: 'get_mail_list',
                tag: tag
            },
            function(data, status) {
                var obj = eval('(' + data + ')');
                var innerhtml = '';
                if (obj.result == 'false') {
                    $('#mail-list-body').html('');
                } else {
                    for (var i = 0; i < obj.length; i++) {
                        //var touser = eval(obj.touser);
                        innerhtml += '<tr onclick=$.readMail(' + obj[i].mid + ');><td>' + obj[i].title + '</td>';
                        innerhtml += '<td class="text-center">' + obj[i].date + '</td>';
                        innerhtml += '<td class="text-center">' + obj[i].fromuser + '</td>';
                        innerhtml += '<td class="text-center">' + obj[i].status + '</td>';
                        innerhtml += '<td>' + obj[i].content + '</td></tr>';
                    }
                    $('#mail-list-body').html(innerhtml); 
                } 
            }
        ); 
    }            
});
