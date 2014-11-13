<?php /* Smarty version Smarty-3.1.21-dev, created on 2014-11-13 18:46:48
         compiled from "./templates/signin.html" */ ?>
<?php /*%%SmartyHeaderCode:96059970454648b81a7ec50-14048063%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '09ef8a4dd13d8310064d9d352671ecc7c13addee' => 
    array (
      0 => './templates/signin.html',
      1 => 1415875586,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '96059970454648b81a7ec50-14048063',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_54648b81aa1fa0_55397316',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54648b81aa1fa0_55397316')) {function content_54648b81aa1fa0_55397316($_smarty_tpl) {?><!DOCTYPE html>
<html lang="en" class="app">
<head>  
  <meta charset="utf-8" />
  <title>西邮linux内部平台</title>
  <meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  <link rel="stylesheet" href="js/jPlayer/jplayer.flat.css" type="text/css" />
  <link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
  <link rel="stylesheet" href="css/animate.css" type="text/css" />
  <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css" />
  <link rel="stylesheet" href="css/simple-line-icons.css" type="text/css" />
  <link rel="stylesheet" href="css/font.css" type="text/css" />
  <link rel="stylesheet" href="css/app.css" type="text/css" />  
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
      <a class="navbar-brand block" href="index.html"><span class="h1 font-bold">西邮Linux</span></a>
      <section class="m-b-lg">
        <header class="wrapper text-center">
          <strong>Sign in to get in touch</strong>
        </header>
        <form action="index.html">
          <div class="form-group">
            <input type="email" placeholder="Email" class="form-control rounded input-lg text-center no-border">
          </div>
          <div class="form-group">
             <input type="password" placeholder="Password" class="form-control rounded input-lg text-center no-border">
          </div>
          <button type="submit" class="btn btn-lg btn-warning lt b-white b-2x btn-block btn-rounded"><i class="icon-arrow-right pull-right"></i><span class="m-r-n-lg">Sign in</span></button>
          <div class="text-center m-t m-b"><a href="#"><small>Forgot password?</small></a></div>
          <div class="line line-dashed"></div>
          <p class="text-muted text-center"><small>Do not have an account?</small></p>
          <a href="signup.html" class="btn btn-lg btn-info btn-block rounded">Create an account</a>
        </form>
      </section>
    </div>
  </section>
  <!-- footer -->
  <footer id="footer">
    <div class="text-center padder">
      <p>
        <small>Web app framework base on Bootstrap<br>&copy; 2014</small>
      </p>
    </div>
  </footer>
  <!-- / footer -->
  <?php echo '<script'; ?>
 src="js/jquery.min.js"><?php echo '</script'; ?>
>
  <!-- Bootstrap -->
  <?php echo '<script'; ?>
 src="js/bootstrap.js"><?php echo '</script'; ?>
>
  <!-- App -->
  <?php echo '<script'; ?>
 src="js/app.js"><?php echo '</script'; ?>
>  
  <?php echo '<script'; ?>
 src="js/slimscroll/jquery.slimscroll.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="js/app.plugin.js"><?php echo '</script'; ?>
>
  <?php echo '<script'; ?>
 type="text/javascript" src="js/jPlayer/jquery.jplayer.min.js"><?php echo '</script'; ?>
>
  <?php echo '<script'; ?>
 type="text/javascript" src="js/jPlayer/add-on/jplayer.playlist.min.js"><?php echo '</script'; ?>
>
  <?php echo '<script'; ?>
 type="text/javascript" src="js/jPlayer/demo.js"><?php echo '</script'; ?>
>
</body>
</html>
<?php }} ?>
