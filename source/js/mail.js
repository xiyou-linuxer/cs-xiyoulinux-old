function init_page() {
    set_cookie('uid', 1001);
    var menu = get_cookie('menu');
    var view = get_cookie('view');

    //设置左侧导航菜单
    toggle_menu(menu);

    //设置当前视图
    set_mail_num();
    switch (view) {
    case 'editor':
        clear_editor();
        toggle_view('editor');
        break;
    case 'reader':
        set_mail_info(get_cookie('mid'));
        //toggle_view('reader');
    case 'draft':
        set_draft_info(get_cookie('mid'));
        //toggle_view('draft');
        break;
    default:
        set_mail_list(menu);
        //toggle_view('list');
        break;
    }
    
    //初始化按钮单击事件
    $('#menu-mail-editor').click(function() {
        clear_editor();//清空表单
        toggle_menu('edit');
        toggle_view('editor');
        set_cookie('menu', 'edit');
        set_cookie('view', 'editor');
    });
    $('#menu-mail-all').click(function() {
        set_mail_list('all');
        toggle_menu('all');
        //toggle_view('list');
        set_cookie('menu', 'all');
        set_cookie('view', 'list');
    });
    $('#menu-mail-unread').click(function() {
        set_mail_list('unread');
        toggle_menu('unread');
        //toggle_view('list');
        set_cookie('menu', 'unread');
        set_cookie('view', 'list');
    });    
    $('#menu-mail-read').click(function() {
        set_mail_list('read');
        toggle_menu('read');
        //toggle_view('list');
        set_cookie('menu', 'read');
        set_cookie('view', 'list');
    });
    $('#menu-mail-draft').click(function() {
        set_mail_list('draft');
        toggle_menu('draft');
        //toggle_view('list');
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
        toggle_view('editor');
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

    //收件人输入框自动完成功能
    $('#mail-editor-touser').typeahead({
        source: function(query, process) {//匹配最后一个逗号之后的内容
            var pname = query.split(',');
            var pname = pname[pname.length - 1];

            var param = {func: 'get_name_match', json: pname};
            $.post('mail.php', param, function (data) {
                var objs = eval(data);
                var name = new Array();
                for (var i = 0; i < objs.length; i++) {
                    name.push(objs[i].username);
                }
                process(name);
            });
        },
        highlighter: function (item) {
            var query = this.query.replace(/[\-\[\]{}()*+?., \\\^$|#\s]/g, '\\$&');
            return item.replace(new RegExp('(' + query + ')', 'ig'), function ($1, match) {
                return '<font style="color:#00ffff">' + match + '</font>';//高亮显示匹配字符
            });
        },
        matcher: function (item) {
            var name = this.query.replace(/\s/ig, '').split(',');//除去多余的空格，匹配最后一个都好之后的内容
            var query = name[name.length - 1];
            return ~item.indexOf(query);
        },
        updater: function (item) {
            var name = this.query.replace(/\s/ig, '').split(',');//去除多余空格
            var result = '';
            for (var i = 0; i < name.length - 1; i++) {
                result += name[i] + ',';
            }
            result += item + ',';
            return result;
        }
    });
    //失去焦点时，移除多余的空格和逗号
    $('#mail-editor-touser').blur(function () {
        var name = $('#mail-editor-touser').val().replace(/\s/ig, '').split(','); 
        var result = '';
        for (var i = 0; i < name.length; i++) {
            if (name[i] != '') {
                result += name[i] + ',';
            }
        }
        result = result.substr(0, result.length - 1);
        $('#mail-editor-touser').val(result);
    });
}

function toggle_menu(menu) {
    var menu_id;
    switch (menu) {
    case 'edit':
        menu_id = '#menu-mail-editor';
        break;
    case 'unread':
        menu_id = '#menu-mail-unread';
        break;
    case 'read':
        menu_id = '#menu-mail-read';
        break;
    case 'draft':
        menu_id = '#menu-mail-draft';
        break;
    default:
        menu_id = '#menu-mail-all';
        break;
    }

    $(menu_id).attr('class', 'list-group-item active');
    $(menu_id).siblings().attr('class', 'list-group-item');

    if (menu_id == '#menu-mail-draft') {
        $('#list-column-user').html('收信人');
    } else {
        $('#list-column-user').html('发信人');
    }
}            

function toggle_view(view) {
    var view_id;
    switch (view) {
    case 'editor':
        view_id = '#mail-editor-view';
        break;
    case 'reader': 
        view_id = '#mail-reader-view';
        break;
    case 'draft':
        view_id = '#mail-draft-view';
        break;
    default:
        view_id = '#mail-list-view';
        break;
    }

    $(view_id).css({'display':'block'});
    $(view_id).siblings().css({'display':'none'});
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

function set_mail_list(menu) {
    var ptag;
    switch (menu) {
    case 'unread': 
        ptag = 1;
        break;
    case 'read':
        ptag = 2;
        break;
    case 'draft':
        ptag = 4;
        break;
    default:
        ptag = 0;
        break;
    }

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
    alert(data);
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
                innerhtml += '<td>' + obj[i].content + '</td></tr>';
                break;
            case '已读':
                innerhtml += '<tr onclick=set_mail_info(' + obj[i].mid + ');><td>' + obj[i].title + '</td>';
                innerhtml += '<td class="text-center">' + obj[i].date + '</td>';
                innerhtml += '<td class="text-center">' + obj[i].fromuser + '</td>';
                innerhtml += '<td class="text-center">';
                innerhtml += '<span class="badge badge-success">' + obj[i].status + '</span></td>';
                innerhtml += '<td>' + obj[i].content + '</td></tr>';
                break;
            default:
                innerhtml += '<tr onclick=set_draft_info(' + obj[i].mid + ');><td>' + obj[i].title + '</td>';
                innerhtml += '<td class="text-center">' + obj[i].date + '</td>';
                innerhtml += '<td class="text-center">' + obj[i].touser + '</td>';
                innerhtml += '<td class="text-center">';
                innerhtml += '<span class="badge">' + obj[i].status + '</span></td>';
                innerhtml += '<td>' + obj[i].content + '</td></tr>';
                break;
            }
        }
        $('#mail-list-body').html(innerhtml); 
    } 
    toggle_view('list');
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
    
    $('#btn-modal-close').click(function() {
        set_mail_num();
    });

    show_tips_modal('发送状态');
}

//call back save draft
function callbk_save_draft(data, status) {
    var obj = eval('(' + data + ')');
    if (obj.result == 'true') {
        set_tips_modal('保存成功');
        $('#btn-modal-close').click(function() {
            set_mail_num();
        });
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
            set_mail_num();
            set_mail_list(get_cookie('menu'));
            toggle_view('list');
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
        toggle_view('editor');
    });
    
    toggle_view('reader');
    set_cookie('mid', obj[0].mid);
    set_cookie('view', 'reader');
    set_mail_num();
}

// call back read draft
function callbk_draft_info(data, status) {
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
        toggle_view('editor');
    });
    
    toggle_view('draft');
    set_cookie('mid', obj[0].mid);
    set_cookie('view', 'draft');
    set_mail_num();
}
