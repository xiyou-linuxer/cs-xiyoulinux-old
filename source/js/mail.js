$(document).ready(function () {
    //初始化按钮单击事件
    $('#btn-save-draft').click(function() {
        return save_draft();
    });
    $('#btn-send-mail').click(function() {
        return send_mail();            
    });
    $('#btn-reply-mail').click(function() {
        location.href = 'mail-edit.php';
    });
    $('#btn-delete-mail').click(function() {
        var mid = get_cookie('mid');
        del_mail(mid);
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

            var param = {action: 'auto_complete', username: pname};
            $.post('server/mail.server.php', param, function (data) {
                var objs = eval(data);
                var name = new Array();
                for (var i = 0; i < objs.length; i++) {
                    name.push(objs[i].username);
                }
                process(name);
            });
        },
        highlighter: function (item) {
            var name = this.query.replace(/\s/ig, '').split(',');//除去多余的空格，匹配最后一个都好之后的内容
            var query = name[name.length - 1];
            return item.replace(new RegExp('(' + query + ')', 'ig'), function ($1, match) {
                return match;//高亮显示匹配字符
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

    $('#mail-editor-content').wysihtml5();
});

function set_tips_modal(tips) {
    $('.modal-body').html(tips);
}

function show_tips_modal(title) {
    $('.modal-title').html(title);
    $('#tips-modal').modal({keyboard: true});
}

function save_draft() {
    var param = {
        action: 'save_draft',
        title: $('#mail-editor-title').val(),
        touser: $('#mail-editor-touser').val(),
        content: $('#mail-editor-content').val()
    };
    $.post('server/mail.server.php', param, callbk_save_draft);
    return false;
}
 
function send_mail() {
    var param = {
        action: 'send_mail',
        title: $('#mail-editor-title').val(),
        touser: $('#mail-editor-touser').val(),
        content: $('#mail-editor-content').val()
    };
    $.post('server/mail.server.php', param, callbk_send_mail);
    return false;
}


function del_mail(mid) {
    var param = {action: 'del_mail', mid: mid};
    $.post('server/mail.server.php', param, callbk_del_mail);
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
            var last_page = get_cookie('last_page');
            if (last_page == undefined) {
                location.href = 'index.php';
            } else {
                location.href = last_page;
            }
        });
    } else if (obj.result == 'false') {
        set_tips_modal('删除失败');
    }
    show_tips_modal('删除状态');
}
