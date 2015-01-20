<!DOCTYPE html>
<html lang="en" class="app">
<head>  
  <meta charset="utf-8" />
  <title>找回密码 - CS</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  <link rel="stylesheet" href="<{$SITE_DOMAIN}>/js/jPlayer/jplayer.flat.css" type="text/css" />
  <link rel="stylesheet" href="<{$SITE_DOMAIN}>/css/bootstrap.css" type="text/css" />
  <link rel="stylesheet" href="<{$SITE_DOMAIN}>/css/animate.css" type="text/css" />
  <link rel="stylesheet" href="<{$SITE_DOMAIN}>/css/font-awesome.min.css" type="text/css" />
  <link rel="stylesheet" href="<{$SITE_DOMAIN}>/css/simple-line-icons.css" type="text/css" />
  <link rel="stylesheet" href="<{$SITE_DOMAIN}>/css/font.css" type="text/css" />
  <link rel="stylesheet" href="<{$SITE_DOMAIN}>/css/app.css" type="text/css" />  
    <!--[if lt IE 9]>
    <script src="js/ie/html5shiv.js"></script>
    <script src="js/ie/respond.min.js"></script>
    <script src="js/ie/excanvas.js"></script>
  <![endif]-->
</head>
<body class="bg-info dker">
  <section id="content" class="m-t-lg wrapper-md animated fadeInDown">
    <div class="container aside-xl">
      <a class="navbar-brand block" href="<{$SITE_DOMAIN}>/index.php"><span class="h1 font-bold">Xiyou Linux Group</span></a>
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
      <p>
        <small>Copyright &copy; 2014 Xiyou Linux Group</small>
      </p>
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
  <!-- / footer -->
  <script src="<{$SITE_DOMAIN}>/js/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="<{$SITE_DOMAIN}>/js/bootstrap.js"></script>
  <!-- App -->
  <script src="<{$SITE_DOMAIN}>/js/app.js"></script>  
  <script src="<{$SITE_DOMAIN}>/js/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="<{$SITE_DOMAIN}>/js/app.plugin.js"></script>
  <script type="text/javascript" src="<{$SITE_DOMAIN}>/js/jPlayer/jquery.jplayer.min.js"></script>
  <script type="text/javascript" src="<{$SITE_DOMAIN}>/js/jPlayer/add-on/jplayer.playlist.min.js"></script>
  <script type="text/javascript" src="<{$SITE_DOMAIN}>/js/jPlayer/demo.js"></script>
  <script>
  </script>
  <script>
        $(document).ready(function() {
      		$('#btn-submit').click(function () { 
			if($('#username').val() == "" || $('#email').val() == "")
			{	
				$('#tips_message').html("姓名或邮箱不能为空～");
                                $('#example').modal({keyboard:true});
				return false;	

			}
			else{
				var param = {
                        		name: $('#username').val(),
                        		email: $('#email').val()
				};
				$.post('<{$SITE_DOMAIN}>/server/forgetpd.server.php', param, function(data) {
                        		$('#tips_message').html(data);
					$('#example').modal({keyboard:true});
                		});

                		return false; 
			    }
       		});

                $('#signingo').click(function() {
                       
                        window.location = '<{$SITE_DOMAIN}>/index.php';
                        return false;
                });

        });
</script>
</body>
</html>
