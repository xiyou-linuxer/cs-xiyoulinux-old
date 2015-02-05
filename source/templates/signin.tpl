<{extends file="base.tpl"}>

<{block name="body_style"}>bg-info dker<{/block}>

<{block name="frame"}>

    <section id="content" class="m-t-lg wrapper-md animated fadeInUp">    
      <div class="container aside-xl">
        <a class="navbar-brand block" href="index.php"><span class="h1 font-bold">Xiyou Linux Group</span></a>
        <section class="m-b-lg">
          <header class="wrapper text-center">
            <strong>请在下方登录本系统</strong>
          </header>
          <form>
            <div class="form-group">
              <input type="text" placeholder="姓名" name="username" class="form-control rounded input-lg text-center no-border">
            </div>
            <div class="form-group">
               <input type="password" placeholder="密码" name="password" class="form-control rounded input-lg text-center no-border">
            </div>
            <button type="submit" id="btn-login" class="btn btn-lg btn-warning lt b-white b-2x btn-block btn-rounded"><i class="icon-arrow-right pull-right"></i><span class="m-r-n-lg">登录</span></button>
            <div class="text-center m-t m-b"><a href="forgetpd.php"><small>忘记密码？</small></a></div>
          </form>
        </section>
      </div>
    </section>
    <!-- footer -->
    <footer id="footer">
      <div class="text-center padder">
        <p>
          <small>Copyright &copy; 2014 Xiyou Linux Group</small>
        </p>
      </div>
  </footer>
<{/block}>

<{block name="scripts" append}>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#btn-login').click(function(){
                var param = {
                    action: 'login',
                    name: $('[name=username]').val(),
                    password: $('[name=password]').val(),
                    checknum: $('[name=checknum]').val()
                };
                $.post('<{#SiteDomain#}>/server/login.server.php', param, function(data){
                    if(data.substring(0,4) == 'true' ){
                        $.get("<{#SiteDomain#}>/server/online.server.php?uid="+data.substring(5)+"&logout=false",function(){});
                        location.href = 'index.php';
                    }else{
                        if(data.substring(5,6) == '1'){
                            data = data.substring(6);
                        }
                        switch(data.substring(5,6)){
                        case '2':
                            alert('用户和密码都不可为空 !!');
                            break;
                        case '3':
                            alert('用户不存在 !!');
                            break;
                        case '4':
                            alert('验证码错误 !!');
                            //$('img').attr('src','checknum.php');
                            break;
                        case '5':
                            alert('密码错误 !!');
                            break;
                        default:
                            break;
                        }
                    }
                });

                return false;
            });
        });
    </script>

<{/block}>

