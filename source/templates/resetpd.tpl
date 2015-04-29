<{extends file="base.tpl"}>

<{block name="body_style"}>bg-info dker<{/block}>

<{block name="frame"}>

    <section id="content" class="m-t-lg wrapper-md animated fadeInDown">
  
        <div class="container aside-xl">

            <a class="navbar-brand block" href="index.php"><span class="h1 font-bold">Xiyou Linux Group</span></a>
    
            <section class="m-b-lg">
      
                <header class="wrapper text-center">
                    
                    <strong>请在下方重置密码</strong>
                
                </header>
        
                <form>
        
                    <div class="form-group">
          
                        <input placeholder="姓名" id="username" class="form-control rounded input-lg text-center no-border">
                    
                    </div>
        
                    <div class="form-group">
            
                        <input type="password" placeholder="输入新密码" id="passwd" class="form-control rounded input-lg text-center no-border">
                    </div>

                    <div class="form-group">

                        <input type="password" placeholder="确认新密码" id="repasswd" class="form-control rounded input-lg text-center no-border">
        
                    </div>

                    <!--<div class="checkbox i-checks m-b">
                    <label class="m-l">
                    <input type="checkbox" checked=""><i></i> Agree the <a href="#">terms and policy</a>
                    </label>
                    </div>-->

                    <button type="submit" id="btn-submit" class="btn btn-lg btn-warning lt b-white b-2x btn-block btn-rounded"><i class="icon-arrow-right pull-right"></i><span class="m-r-n-lg">确认</span></button>

                    <!--<div class="line line-dashed"></div>
                    <p class="text-muted text-center"><small>Already have an account?</small></p>
                    <a href="signin.html" class="btn btn-lg btn-info btn-block btn-rounded">Sign in</a>-->

                </form>

            </section>
        
        </div>

    </section>

    <!-- footer -->
    <footer id="footer">
  
        <div class="text-center padder clearfix">
            
            <p><small>Copyright © 2014 Xiyou Linux Group</small></p>
  
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
          
                    <p id="tips_message" style="color:#222222"></p>
        
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
    <script type="text/javascript">
        $(document).ready(function() {
            $('#btn-submit').click(function () { 
                    if($('#username').val()=="" || $('#passwd').val()=="" || $('#repasswd').val()=="") {
                        $('#tips_message').html("姓名或密码不能为空～");
                        $('#example').modal({keyboard:true});
                    return false;
                } else {
                    if($('#passwd').val() != $('#repasswd').val()) {
                        $('#tips_message').html("两次密码输入不一致。");
                        $('#example').modal({keyboard:true});
                        return false;
                    } else {
                        var param = {
                            name: $('#username').val(),
                            passwd: $('#passwd').val(),
                            verify:'<{$verify}>',
                            time:'<{$time}>'
                        };
                        $.post('<{#SiteDomain#}>/server/resetpd.server.php', param, function(data) {
                            $('#tips_message').html(data);
                            $('#example').modal({keyboard:true});
                        });

                        return false; 
                    }
                }
            });
            $('#signingo').click(function() {
                window.location = 'signin.php';
                return false;
            });
        });
    </script>
<{/block}>
