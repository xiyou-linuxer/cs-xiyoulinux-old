<{include file="header.tpl"}>
<link rel="stylesheet" href="css/mail.css" type="text/css" />
<link rel="stylesheet" href="plugin/wysihtml5/css/bootstrap-wysihtml5-0.0.2.css" type="text/css" />
<{include file="header_nav.tpl"}>
<{include file="aside.tpl"}>
<!-- /.aside -->
<section id="content">
    <section class="hbox stretch">
        <section class="vbox">
            <section class="scrollable wrapper-lg" id="bjax-target">   

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
                  </div><!-- /.modal-content -->
                </div><!-- /.modal -->
              </div>

            </section>
          </section>

<{include file="chat.tpl"}>
<{include file="script.tpl"}>
<script type="text/javascript" src="plugin/typeahead/js/bootstrap-typeahead.js"></script>
<script type="text/javascript" src="plugin/wysihtml5/js/wysihtml5-0.3.0.js"></script>
<script type="text/javascript" src="plugin/wysihtml5/js/bootstrap-wysihtml5-0.0.2.js"></script>
<script type="text/javascript" src="js/mail.js"></script>
<{include file="footer.tpl"}>