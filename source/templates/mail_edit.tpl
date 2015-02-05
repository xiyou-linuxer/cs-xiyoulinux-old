<{extends file="frame.tpl"}>

<{block name="stylesheet" append}>

    <link rel="stylesheet" href="<{#SiteDomain#}>/css/mail.css" type="text/css" />

    <link rel="stylesheet" href="<{#SiteDomain#}>/plugins/wysihtml5/css/bootstrap-wysihtml5-0.0.2.css" type="text/css" />

<{/block}>

<{block name="content"}>

    <div class="panel panel-default" id="mail-editor-view">

        <div class="panel-heading">
          
            <div class="panel-title">

                <h3 class="text-center">写站内信</h3>

            </div>

        </div> <!--END PANEL HEADING-->
        
        <form class="form">
          
            <ul class="list-group list-bottom-no-margin">

                <li class="list-group-item">

                    <div class="input-group">

                        <span class="input-group-addon"><div class="label-user">收件人</div></span>

                        <input type="text" name="touser" id="mail-editor-touser" value="<{$mail_touser}>" class="form-control mail-user" placeholder="请输入收件人姓名" data-provide="typeahead" autocomplete="off"></input>

                    </div>
                </li>

                <li class="list-group-item">

                    <div class="input-group">

                        <span class="input-group-addon"><div class="label-title"><strong>标题</strong></div></span>

                        <input type="text" name="title" id="mail-editor-title" value="<{$mail_title}>"  class="form-control mail-title" placeholder="请输入信息标题" autocomplete="off"></input>

                    </div>
                </li>
                
                <li class="list-group-item">

                    <textarea name="content" class="form-control textarea-custom" id="mail-editor-content" rows=10 ><{$mail_content}></textarea>

                </li>

                <li class="list-group-item text-right">
              
                    <button class="btn btn-warning" id="btn-save-draft">保存草稿</button>

                    <button class="btn btn-success" type="submit" id="btn-send-mail">发送信息</button>

                </li>

            </ul> <!--END PANEL BODY-->

        </form>

    </div><!--END MAIL EDITOR-->

    <!-- 模态框（Modal） -->
    <div class="modal fade" id="tips-modal" tabindex="-1" role="dialog" aria-labelledby="tips-modal-title" aria-hidden="true">

        <div class="modal-dialog">

            <div class="modal-content">

                <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                    <h4 class="modal-title text-center" id="tips-modal-title"></h4>

                </div>

                <div class="modal-body text-center"></div>

                    <div class="modal-footer">
                        
                        <button type="button" class="btn btn-success" data-dismiss="modal" id="btn-modal-close">关闭</button>
                    </div>

                </div><!-- /.modal-body -->

            </div><!-- /.modal-content -->

        </div><!-- /.modal-dialog -->

    </div><!-- /.modal -->

<{/block}>

<{block name="scripts" append}>

    <script type="text/javascript" src="<{#SiteDomain#}>/plugins/typeahead/js/bootstrap-typeahead.js"></script>

    <script type="text/javascript" src="<{#SiteDomain#}>/plugins/wysihtml5/js/wysihtml5-0.3.0.js"></script>

    <script type="text/javascript" src="<{#SiteDomain#}>/plugins/wysihtml5/js/bootstrap-wysihtml5-0.0.2.js"></script>

    <script type="text/javascript">

        $(document).ready(function () {

            //初始化按钮单击事件
            $('#btn-save-draft').click(function() {
                var param = {
                    action: 'save_draft',
                    title: $('#mail-editor-title').val(),
                    touser: $('#mail-editor-touser').val(),
                    content: $('#mail-editor-content').val()
                };
                $.post('<{#SiteDomain#}>/server/mail.server.php', param, function (data, status) {
                    var obj = eval('(' + data + ')');
                    if (obj.result == 'true') {
                        $('.modal-body').html('保存成功');
                    } else if (obj.result == 'false') {
                        $('.modal-body').html('保存失败');
                    }
                    $('.modal-title').html('保存状态');
                    $('#tips-modal').modal({keyboard: true});
                });

                return false;
            });
            $('#btn-send-mail').click(function() {
                var param = {
                    action: 'send_mail',
                    title: $('#mail-editor-title').val(),
                    touser: $('#mail-editor-touser').val(),
                    content: $('#mail-editor-content').val()
                };
                $.post('<{#SiteDomain#}>/server/mail.server.php', param, function (data, status) {
                    var obj = eval('(' + data + ')');
                    if (obj.result == 'true') {
                        $('.modal-body').html('发送成功');
                    } else if (obj.result == 'false') {
                        $('.modal-body').html('发送失败');                
                    } else {
                        $('.modal-body').html('失败列表：' + obj.result);
                    }
                    
                    $('#btn-modal-close').click(function() {
                        set_mail_num();
                    });

                    $('.modal-title').html('发送状态');
                    $('#tips-modal').modal({keyboard: true});
                });

                return false;          
            });

            //收件人输入框自动完成功能
            $('#mail-editor-touser').typeahead({
                source: function(query, process) {//匹配最后一个逗号之后的内容
                    var pname = query.split(',');
                    var pname = pname[pname.length - 1];

                    var param = {action: 'auto_complete', username: pname};
                    $.post('<{#SiteDomain#}>/server/mail.server.php', param, function (data) {
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



    </script>

<{/block}>