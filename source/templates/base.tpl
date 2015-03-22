<{config_load file="base.conf"}>
<!DOCTYPE html>

<html lang="en" class="app">

<head>

    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>

    <title><{block name="page_title"}>Linux兴趣小组 | CS平台<{/block}></title>

    <meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

<{block name="stylesheet"}>

    <link rel="stylesheet" href="<{#SiteDomain#}>/css/bootstrap.css" type="text/css" />

    <link rel="stylesheet" href="<{#SiteDomain#}>/css/animate.css" type="text/css" />

    <link rel="stylesheet" href="<{#SiteDomain#}>/css/font-awesome.min.css" type="text/css" />

    <link rel="stylesheet" href="<{#SiteDomain#}>/css/simple-line-icons.css" type="text/css" />

    <link rel="stylesheet" href="<{#SiteDomain#}>/css/font.css" type="text/css" />

    <link rel="stylesheet" href="<{#SiteDomain#}>/css/app.css" type="text/css" />

    <link rel="stylesheet" href="<{#SiteDomain#}>/plugins/cs-coms/jquery.coms.css" type="text/css" />
	
    <!--[if lt IE 9]>
    <script src="js/ie/html5shiv.js"></script>
    <script src="js/ie/respond.min.js"></script>
    <script src="js/ie/excanvas.js"></script>
    <![endif]-->

<{/block}>

</head>

<body class="<{block name="body_style"}><{/block}>">

<{block name="frame"}><{/block}>

<{block name="scripts"}>

    <script type="text/javascript" src="<{#SiteDomain#}>/js/jquery.min.js"></script>

<!--    <script type="text/javascript" src="<{#SiteDomain#}>/plugins/cs-coms/jquery.coms.js"></script>-->

    <!-- Bootstrap -->
    <script type="text/javascript" src="<{#SiteDomain#}>/js/bootstrap.js"></script>

    <!-- App -->
    <script type="text/javascript" src="<{#SiteDomain#}>/js/app.js"></script>

    <script type="text/javascript" src="<{#SiteDomain#}>/js/slimscroll/jquery.slimscroll.min.js"></script>

    <script type="text/javascript" src="<{#SiteDomain#}>/js/app.plugin.js"></script>

    <script type="text/javascript" src="<{#SiteDomain#}>/js/cookie.js"></script>

<{/block}>

</body>

</html>
