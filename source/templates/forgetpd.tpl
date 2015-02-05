<{extends file="base.tpl"}>

<{block name="page_title"}>找回密码 - CS<{/block}>

<{block name="body_style"}>bg-info dker<{/block}>

<{block name="frame"}>

    <section id="content" class="m-t-lg wrapper-md animated fadeInDown">
      
        <div class="container aside-xl">
            
            <a class="navbar-brand block" href="/index.php"><span class="h1 font-bold">Xiyou Linux Group</span></a>
          
                <section class="m-b-lg">

                    <header class="wrapper text-center">

                        <strong>填写以下信息找回密码</strong>

                    </header>
          
                    <form action="" method="post">
          
                        <div class="form-group">
            
                            <input id="username" placeholder="姓名" class="form-control rounded input-lg text-center no-border" >
          
                        </div>
          
                        <div class="form-group">
              
                            <input id="email" placeholder="您绑定的邮箱" class="form-control rounded input-lg text-center no-border" >
          
                        </div>
          
                        <button type="submit" id="btn-submit" class="btn btn-lg btn-warning lt b-white b-2x btn-block btn-rounded"><i class="icon-arrow-right pull-right"></i><span class="m-r-n-lg">找回密码</span></button>
          
                        <div class="line line-dashed"></div>
        
                    </form>
      
                </section>
            
            </div>
  
        </section>
  
    <!-- footer -->
    <footer id="footer">

        <div class="text-center padder clearfix">
      
            <p><small>Copyright &copy; 2014 Xiyou Linux Group</small></p>
        
        </div>

    </footer>
  
    <div class="modal fade" id="example">
  
        <div class="modal-dialog">
    
            <div class="modal-content">
            
                <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>

                    <strong style="color:#222222">提示</strong>

                </div>

                <div class="modal-body">

                    <p style="color:#222222" id="tips_message">邮件已发送到您绑定的邮箱。</p>

                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>

                    <button type="button" id="signingo" class="btn btn-primary">去登入页</button>

                </div>

            </div><!-- /.modal-content -->

        </div><!-- /.modal-dialog -->

    </div><!-- /.modal -->

<{/block}>

<{block name="scripts" append}>
    <script>
        $(document).ready(function() {
            $('#btn-submit').click(function () { 
                if($('#username').val() == "" || $('#email').val() == "") {    
                    $('#tips_message').html("姓名或邮箱不能为空～");
                    $('#example').modal({keyboard:true});
                    return false;    
                } else {
                    var param = {
                        name: $('#username').val(),
                        email: $('#email').val()
                    };
                            
                    $.post('<{#SiteDomain#}>/server/forgetpd.server.php', param, function(data) {
                        $('#tips_message').html(data);
                        $('#example').modal({keyboard:true});
                    });

                    return false; 
                }
            });

            $('#signingo').click(function() {
                window.location = '<{#SiteDomain#}>/signin.php';
                return false;
            });
        });
    </script>
<{/block}>
