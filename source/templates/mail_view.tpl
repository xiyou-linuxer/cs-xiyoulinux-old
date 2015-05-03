<{extends file="frame.tpl"}>

<{block name="content"}>

    <div class="panel panel-default" id="mail_reader-view">

        <div class="panel-heading">

            <div class="panel-title">

                <h3 class="text-center"><{$mail_info.title}></h3>

            </div>

        </div> <!--END PANEL HEADING-->

        <ul class="list-group">

            <li class="list-group-item">

                <{if $mail_info.isdraft == 'true'}>

                <span>收件人：</h4><span><{$mail_info.touser}></span>

                <{else if $mail_info.fromuid == $login_uid}>

                <span>收件人：</h4><span><{$mail_info.touser}></span>

                <{else}>

                <span>信息来自：</h4><span><{$mail_info.fromuser}></span>

                <span style="margin-left: 30px">发送时间：</h4><span><{$mail_info.date}></span>

                <{/if}>

            </li>

            <li class="list-group-item">

                <h4><{$mail_info.content}></h4>

            </li>

        </ul> <!--END PANEL BODY-->

        <div class="panel-footer text-right">

            <a class="btn btn-danger" id="btn-delete-mail"><{$btn_del_caption}></a>

            <a class="btn btn-success" href="mail_edit.php<{if $mail_info.isdraft == 'true'}>?mid=<{$mail_info.mid}><{else}>?touid=<{$mail_info.fromuid}><{/if}>"><{$btn_edit_caption}></a>

        </div>

    </div><!--END MAIL CONTENT-->

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

            </div><!-- /.modal-content -->

        </div><!-- /.modal -->

    </div>

<{/block}>

<{block name="scripts" append}>

    <script type="text/javascript">

        $(document).ready(function() {

            $('#btn-modal-close').click(function() {
                var last_page = get_cookie('last_page');
                if (last_page) {
                    location.href = last_page;
                }
            });

            $('#btn-delete-mail').click(function() {
                var param = {action: 'del_mail', mid: '<{$mail_info.mid}>'};
                $.post('<{$site_domain}>/server/mail.server.php', param, function (data, status) {
                    var obj = eval('(' + data + ')');
                    if (obj.result == 'true') {
                        $('.modal-body').html('删除成功');
                    } else if (obj.result == 'false') {
                        $('.modal-body').html('删除失败');
                    }
                    $('.modal-title').html('删除状态');
                    $('#tips-modal').modal({keyboard: true});
                });

                return false;
            });
        });

    </script>

<{/block}>