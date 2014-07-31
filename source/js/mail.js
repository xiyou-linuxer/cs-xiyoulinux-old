function init_page() {
    set_cookie('uid', 1001);
    var menu = get_cookie('menu');
    var view = get_cookie('view');
    var tag;

    set_mail_num();
    //设置左侧导航菜单
    switch(menu) {
    case 'edit':
        tag = -1;
        toggle_menu('#menu-mail-editor');
        break;
    case 'unread':
        tag = 1;
        toggle_menu('#menu-mail-unread');
        break;
    case 'read':
        tag = 2;
        toggle_menu('#menu-mail-read');
        break;
    case 'draft':
        tag = 4;
        toggle_menu('#menu-mail-draft');
        break;
    default:
        tag = 0;
        toggle_menu('#menu-mail-all');
        break;
    }

    //设置当前视图
    switch (view) {
    case 'editor':
        clear_editor();
        toggle_view('#mail-editor-view');
        break;
    case 'reader':
        set_mail_info(get_cookie('mid'));
        //toggle_view('#mail-reader-view');
    case 'draft':
        set_draft_info(get_cookie('mid'));
        //toggle_view('#mail-draft-view');
        break;
    default:
        set_mail_list(tag);
        //toggle_view('#mail-list-view');
        break;
    }

    //初始化按钮单击事件
    $('#menu-mail-editor').click(function() {
        clear_editor();//清空表单
        toggle_menu('#menu-mail-editor');
        toggle_view('#mail-editor-view');
        set_cookie('menu', 'edit');
        set_cookie('view', 'editor');
    });
    $('#menu-mail-all').click(function() {
        set_mail_list(0);
        toggle_menu('#menu-mail-all');
        //toggle_view('#mddail-list-view');
        set_cookie('menu', 'all');
        set_cookie('view', 'list');
    });
    $('#menu-mail-unread').click(function() {
        set_mail_list(1);
        toggle_menu('#menu-mail-unread');
        //toggle_view('#mail-list-view');
        set_cookie('menu', 'unread');
        set_cookie('view', 'list');
    });    
    $('#menu-mail-read').click(function() {
        set_mail_list(2);
        toggle_menu('#menu-mail-read');
        //toggle_view('#mail-list-view');
        set_cookie('menu', 'read');
        set_cookie('view', 'list');
    });
    $('#menu-mail-draft').click(function() {
        set_mail_list(4);
        toggle_menu('#menu-mail-draft');
        //toggle_view('#mail-list-view');
        set_cookie('menu', 'draft');
        set_cookie('view', 'list');
    });
    $('#btn-save-draft').click(function() {
        return save_draft();
    });
    $('#btn-send-mail').click(function() {
        return send_mail();            
    });
    $('#btn-reply-mail').click(function() {
        clear_editor();
        toggle_view('#mail-editor-view');
    });
    $('#btn-delete-mail').click(function() {
        var mid = get_cookie('mid');
        del_mail(mid);
        //toggle_view('#mail-list-view');
    });
    $('#btn-delete-draft').click(function() {
        var mid = get_cookie('mid');
        del_mail(mid);
        //toggle_view('#mail-list-view');
    });
    $('#mail-editor-touser').autocomplete({
        source: function(query, process) {
            $.post('mail.php', {'json':query},function(respData) {
                return process(respData);
                alert(respData);
                //return("[{'username':'张永军'},{'username':'王呵呵'}]");
            });
        },
        formatItem: function(item) {
            return item['name'];
        },
        setValue:function(item) {
            return {'data-value':item['name'], 'real-value':item['name']};
        }
    });
}

function toggle_menu(menu) {
    if (menu == '#menu-mail-draft') {
        $('#list-column-user').html('收信人');
    } else {
        $('#list-column-user').html('发信人');
    }
    $(menu).attr('class', 'list-group-item active');
    $(menu).siblings().attr('class', 'list-group-item');
}            

function toggle_view(view) {
    $(view).css({'display':'block'});
    $(view).siblings().css({'display':'none'});
}            

function clear_editor() {
    set_editor('', '', '');
}

function set_editor(touser,title, content) {
    $('#mail-editor-touser').val(touser);
    $('#mail-editor-title').val(title);
    $('#mail-editor-content').val(content);
    //toggle_view('#mail-editor-view');
}

function set_tips_modal(tips) {
    $('.modal-body').html(tips);
}

function show_tips_modal(title) {
    $('.modal-title').html(title);
    $('#tips-modal').modal({keyboard: true});
}

function save_draft() {
    var param = {
        func: 'save_draft',
        title: $('#mail-editor-title').val(),
        touser: $('#mail-editor-touser').val(),
        content: $('#mail-editor-content').val()
    };
    $.post('mail.php', param, callbk_save_draft);
    return false;
}
 
function send_mail() {
    var param = {
        func: 'send_mail',
        title: $('#mail-editor-title').val(),
        touser: $('#mail-editor-touser').val(),
        content: $('#mail-editor-content').val()
    };
    $.post('mail.php', param, callbk_send_mail);
    return false;
}

function set_mail_info(pmid) {
    var param = {func: 'get_mail_info', mid: pmid};
    $.post('mail.php', param, callbk_mail_info);
}

function set_draft_info(pmid) {
    var param = {func: 'get_mail_info', mid: pmid};
    $.post('mail.php', param, callbk_draft_info);
}

function del_mail(pmid) {
    var param = {func: 'del_mail', mid: pmid};
    $.post('mail.php', param, callbk_del_mail);
}

function set_mail_list(ptag) {
    var param = {func: 'get_mail_list', tag: ptag};
    $.post('mail.php', param, callbk_mail_list); 
}            

function set_mail_num(ptag) {
    var param = {func: 'get_mail_count', tag: ptag};
    $.post('mail.php', param, callbk_mail_num); 
}            

function callbk_mail_num(data, status) {
    if (data == '{"result":"false"}') { 
        $('#badge-all').html('0');
        $('#badge-unread').html('0');
        $('#badge-read').html('0');
        $('#badge-draft').html('0');
    } else {
        var obj = eval('(' + data + ')');
        $('#badge-all').html(obj.all);
        $('#badge-unread').html(obj.unread);
        $('#badge-read').html(obj.read);
        $('#badge-draft').html(obj.draft);
    }
}

//call ball get mail list
function callbk_mail_list(data, status) {
    if (data == '{"result":"false"}') { 
        $('#mail-list-body').html('');
    } else {
        var obj = eval(data);
        var innerhtml = '';
        for (var i = 0; i < obj.length; i++) {
            //var touser = eval(obj.touser);
            switch (obj[i].status) {
            case '未读':
                innerhtml += '<tr onclick=set_mail_info(' + obj[i].mid + ');><td>' + obj[i].title + '</td>';
                innerhtml += '<td class="text-center">' + obj[i].date + '</td>';
                innerhtml += '<td class="text-center">' + obj[i].fromuser + '</td>';
                innerhtml += '<td class="text-center">';
                innerhtml += '<span class="badge badge-warning">' + obj[i].status + '</span></td>';
                break;
            case '已读':
                innerhtml += '<tr onclick=set_mail_info(' + obj[i].mid + ');><td>' + obj[i].title + '</td>';
                innerhtml += '<td class="text-center">' + obj[i].date + '</td>';
                innerhtml += '<td class="text-center">' + obj[i].fromuser + '</td>';
                innerhtml += '<td class="text-center">';
                innerhtml += '<span class="badge badge-success">' + obj[i].status + '</span></td>';
                break;
            default:
                innerhtml += '<tr onclick=set_draft_info(' + obj[i].mid + ');><td>' + obj[i].title + '</td>';
                innerhtml += '<td class="text-center">' + obj[i].date + '</td>';
                innerhtml += '<td class="text-center">' + obj[i].touser + '</td>';
                innerhtml += '<td class="text-center">';
                innerhtml += '<span class="badge">' + obj[i].status + '</span></td>';
                break;
            }
            innerhtml += '<td>' + obj[i].content + '</td></tr>';
        }
        $('#mail-list-body').html(innerhtml); 
    } 
    toggle_view('#mail-list-view');
}

// call back send mail
function callbk_send_mail(data, status) {
    var obj = eval('(' + data + ')');
    if (obj.result == 'true') {
        set_tips_modal('发送成功');
    } else if (obj.result == 'false') {
        set_tips_modal('发送失败');                
    } else {
        set_tips_modal('失败列表：' + obj.result);
    }
    show_tips_modal('发送状态');
}

//call back save draft
function callbk_save_draft(data, status) {
    var obj = eval('(' + data + ')');
    if (obj.result == 'true') {
        set_tips_modal('保存成功');
    } else if (obj.result == 'false') {
        set_tips_modal('保存失败');
    }
    show_tips_modal('保存状态');
}

// call back del mail
function callbk_del_mail(data, status) {
    var obj = eval('(' + data + ')');
    if (obj.result == 'true') {
        set_tips_modal('删除成功');
        $('#btn-modal-close').click(function() {
            set_cookie('view', 'list');
            location.href = 'mail.html';
        });
    } else if (obj.result == 'false') {
        set_tips_modal('删除失败');
    }
    show_tips_modal('删除状态');
}

// call back read mail
function callbk_mail_info(data, status) {
    var obj = eval(data);
    $('#mail-reader-title').html(obj[0].title);
    $('#mail-reader-fromuser').html(obj[0].fromuser);
    $('#mail-reader-content').html(obj[0].content.replace(/\r\n/g, '<br>').replace(/\n/g, '<br>'));
    $('#btn-reply-mail').click(function() {
        clear_editor();
        $('#mail-editor-touser').val($('#mail-reader-fromuser').html());
        toggle_view('#mail-editor-view');
    });
    
    toggle_view('#mail-reader-view');
    set_cookie('mid', obj[0].mid);
    set_cookie('view', 'reader');
}

// call back read draft
function callbk_draft_info(data, status) {
    alert(data);
    var obj = eval(data);
    var title = (obj[0].title == '') ? '未命名草稿' : obj[0].title;
    var touser = (obj[0].touser == '') ? '未指定' : obj[0].touser;
    var content = (obj[0].content == '') ? '未填写' : obj[0].content;
    $('#mail-draft-title').html(title);
    $('#mail-draft-fromuser').html(touser);
    $('#mail-draft-content').html(content);
    $('#btn-edit-draft').click(function() {
        $('#mail-editor-title').val(obj[0].title);
        $('#mail-editor-touser').val(obj[0].fromuser);
        $('#mail-editor-content').val(obj[0].content.replace(/\r\n/g, '<br>').replace(/\n/g, '<br>'));
        toggle_view('#mail-editor-view');
    });

    toggle_view('#mail-draft-view');
    set_cookie('mid', obj[0].mid);
    set_cookie('view', 'draft');
}
