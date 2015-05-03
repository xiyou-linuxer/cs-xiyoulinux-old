<{extends file="frame.tpl"}>

<{block name="stylesheet" append}>

    <link rel="stylesheet" href="<{$site_domain}>/css/mail.css" type="text/css" />

<{/block}>

<{block name="content"}>

    <{section name=mail_info_list loop=$mail_info_list}>
    <{if $smarty.section.mail_info_list.first}>

    <div class="panel panel-default">

        <table class="table table-striped m-b-none dataTable no-footer" data-ride="datatables" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info" style="width: 100%;">

            <thead>

                <tr role="row">

                    <th>标题</th>

                    <th style="width: 200px;text-align: center;">时间</th>

                    <th style="width: 15%;text-align: center;">发件人</th>

                    <th style="width: 150px;text-align: center;">状态</th>

                </tr>

            </thead>

            <tbody style="cursor:pointer;">

    <{/if}>

                <tr  onclick="location.href='mail_view.php?mid=<{$mail_info_list[mail_info_list].mid}>'">

                    <td><{$mail_info_list[mail_info_list].title}></td>

                    <td class="text-center"><{$mail_info_list[mail_info_list].date}></td>

                    <td class="text-center"><{$mail_info_list[mail_info_list].fromuser}></td>

                    <td class="text-center"><{$mail_info_list[mail_info_list].status}></td>

                </tr>

    <{if $smarty.section.mail_info_list.last}>

            </tbody>

        </table>

    </div><!--END MAIL LIST-->

    <{/if}>
    <{sectionelse}>

    <div>你还没有没有任何信息</div>

    <{/section}>

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
