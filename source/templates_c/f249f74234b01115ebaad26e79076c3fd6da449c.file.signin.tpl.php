<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-02-05 02:42:57
         compiled from "/usr/local/lnmp/nginx/html/cs/templates/signin.tpl" */ ?>
<?php /*%%SmartyHeaderCode:105740108254d2d8b16d8d35-52891133%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f249f74234b01115ebaad26e79076c3fd6da449c' => 
    array (
      0 => '/usr/local/lnmp/nginx/html/cs/templates/signin.tpl',
      1 => 1423091892,
      2 => 'file',
    ),
    '83252c767b89fb45cda5781f3c9e564ac80e1f64' => 
    array (
      0 => '/usr/local/lnmp/nginx/html/cs/templates/base.tpl',
      1 => 1423091892,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '105740108254d2d8b16d8d35-52891133',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_54d2d8b1824a22_33049987',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54d2d8b1824a22_33049987')) {function content_54d2d8b1824a22_33049987($_smarty_tpl) {?><?php  $_config = new Smarty_Internal_Config("base.conf", $_smarty_tpl->smarty, $_smarty_tpl);$_config->loadConfigVars(null, 'local'); ?>
<!DOCTYPE html>

<html lang="en" class="app">

<head>

    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>

    <title>Linux兴趣小组 | CS平台</title>

    <meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />



    <link rel="stylesheet" href="<?php echo $_smarty_tpl->getConfigVariable('SiteDomain');?>
/css/bootstrap.css" type="text/css" />

    <link rel="stylesheet" href="<?php echo $_smarty_tpl->getConfigVariable('SiteDomain');?>
/css/animate.css" type="text/css" />

    <link rel="stylesheet" href="<?php echo $_smarty_tpl->getConfigVariable('SiteDomain');?>
/css/font-awesome.min.css" type="text/css" />

    <link rel="stylesheet" href="<?php echo $_smarty_tpl->getConfigVariable('SiteDomain');?>
/css/simple-line-icons.css" type="text/css" />

    <link rel="stylesheet" href="<?php echo $_smarty_tpl->getConfigVariable('SiteDomain');?>
/css/font.css" type="text/css" />

    <link rel="stylesheet" href="<?php echo $_smarty_tpl->getConfigVariable('SiteDomain');?>
/css/app.css" type="text/css" />
	
    <!--[if lt IE 9]>
    <?php echo '<script'; ?>
 src="js/ie/html5shiv.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="js/ie/respond.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="js/ie/excanvas.js"><?php echo '</script'; ?>
>
    <![endif]-->



</head>

<body class="bg-info dker">



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




    <?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->getConfigVariable('SiteDomain');?>
/js/jquery.min.js"><?php echo '</script'; ?>
>

    <!-- Bootstrap -->
    <?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->getConfigVariable('SiteDomain');?>
/js/bootstrap.js"><?php echo '</script'; ?>
>

    <!-- App -->
    <?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->getConfigVariable('SiteDomain');?>
/js/app.js"><?php echo '</script'; ?>
>

    <?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->getConfigVariable('SiteDomain');?>
/js/slimscroll/jquery.slimscroll.min.js"><?php echo '</script'; ?>
>

    <?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->getConfigVariable('SiteDomain');?>
/js/app.plugin.js"><?php echo '</script'; ?>
>

    <?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->getConfigVariable('SiteDomain');?>
/js/cookie.js"><?php echo '</script'; ?>
>


    <?php echo '<script'; ?>
 type="text/javascript">
        $(document).ready(function(){
            $('#btn-login').click(function(){
                var param = {
                    action: 'login',
                    name: $('[name=username]').val(),
                    password: $('[name=password]').val(),
                    checknum: $('[name=checknum]').val()
                };
                $.post('<?php echo $_smarty_tpl->getConfigVariable('SiteDomain');?>
/server/login.server.php', param, function(data){
                    if(data.substring(0,4) == 'true' ){
                        $.get("<?php echo $_smarty_tpl->getConfigVariable('SiteDomain');?>
/server/online.server.php?uid="+data.substring(5)+"&logout=false",function(){});
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
    <?php echo '</script'; ?>
>



</body>

</html>
<?php }} ?>
