    <!--[if lt IE 9]>
    <script src="js/ie/html5shiv.js"></script>
    <script src="js/ie/respond.min.js"></script>
    <script src="js/ie/excanvas.js"></script>
    <![endif]-->

</head>

<body class="">

<section class="vbox">

<header class="bg-white-only header header-md navbar navbar-fixed-top-xs">

<div class="navbar-header aside bg-info">

    <a class="btn btn-link visible-xs" data-toggle="class:nav-off-screen,open" data-target="#nav,html">

        <i class="icon-list"></i>

    </a>

    <a href="index.php" class="navbar-brand text-lt">

        <i class="icon-screen-desktop"></i>

        <span class="hidden-nav-xs m-l-sm">西邮Linux CS</span>

    </a>

    <a class="btn btn-link visible-xs" data-toggle="dropdown" data-target=".user">

        <i class="icon-settings"></i>

    </a>

</div>      <ul class="nav navbar-nav hidden-xs">

    <li>

        <a href="#nav,.navbar-header" data-toggle="class:nav-xs,nav-xs" class="text-muted">

            <i class="fa fa-indent text"></i>

            <i class="fa fa-dedent text-active"></i>

        </a>

    </li>

</ul>

<form class="navbar-form navbar-left input-s-box m-t m-l-n-xs hidden-xs" role="search" action="search.php" method="get">

    <div class="form-group">

        <div class="input-group">

            <span class="input-group-btn">

              <button type="submit" id="bt_search" class="btn btn-sm bg-white btn-icon rounded"><i class="fa fa-search"></i></button>

            </span>

            <input name="wd" type="text" id="search_inf" class="form-control input-sm no-border rounded" placeholder="搜索项目、问答、招聘、活动等应用内容...">

        </div>

    </div>

</form>

<form class="navbar-form navbar-left input-s-box m-t m-l-n-xs hidden-xs" role="search" action="new_updata.php" method="post">

    <div class="form-group">

        <div class="input-group">

            <span class="input-group-btn">

              <button type="submit" id="bt_updata" class="btn btn-sm bg-white btn-icon rounded"><i class="fa fa-edit"></i></button>

            </span>

            <input name="updata" type="text" id="updata_text" class="form-control input-sm no-border rounded" placeholder="发表一条新动态...">

        </div>

    </div>

</form>

<div class="navbar-right ">



    <ul class="nav navbar-nav m-n hidden-xs nav-user user">

        <li class="hidden-xs">

            <a href="#" class="dropdown-toggle lt" data-toggle="dropdown">

                <i class="icon-bell"></i>
		<{if $header_mail_count > 0}>
                <span class="badge badge-sm up bg-danger count"><{$header_mail_count}></span>
		<{/if}>
            </a>

            <section class="dropdown-menu aside-xl animated fadeInUp">

                <section class="panel bg-white">

                    <div class="panel-heading b-light bg-light">

                        <strong>你有 <span class="count"><{$header_mail_count}></span> 条站内信</strong>

                    </div>

                    <div class="list-group list-group-alt">

                    <{section name=n loop=$header_mail_list}>
                        <a href="mail_view.php?mid=<{$header_mail_list[n].mid}>" class="media list-group-item">

                            <span class="pull-left thumb-sm">

                                <img src="<{$header_mail_list[n].fromuser_avatar}>" alt="头像" class="img-circle">

                            </span>

                            <span class="media-body block m-b-none">

                                <{$header_mail_list[n].title}><br>

                                <small class="text-muted"><{$header_mail_list[n].date}></small>

                            </span>

                        </a>
                    <{sectionelse}>
                        <a href="mail_unread.php" class="media list-group-item">
                            <span class="media-body block m-b-none">

                                暂时没有任何未读站内信

                            </span>

                        </a>
                    <{/section}>
                    </div>

                    <div class="panel-footer text-sm">

                        <a href="mail_unread.php" class="pull-right"><i class="fa fa-cog"></i></a>

                        <a href="mail_unread.php" data-toggle="class:show animated fadeInRight">查看所有站内信</a>

                    </div>

                </section>

            </section>

        </li>

        <li class="dropdown">

            <a href="#" class="dropdown-toggle bg clear" data-toggle="dropdown">

              <span class="thumb-sm avatar pull-right m-t-n-sm m-b-n-sm m-l-sm">

                  <img src="<{$header_user_avatar}>" alt="加载中">

              </span>

              <{$header_username}><b class="caret"></b>

            </a>

            <ul class="dropdown-menu animated fadeInRight">
                <li>

                    <a href="profile.php?id=<{$header_user_id}>">个人中心</a>

                </li>

                <li>

                    <a href="mail_all.php">

		<{if $header_mail_count > 0}>
                        <span class="badge bg-danger pull-right"><{$header_mail_count}></span>
		<{/if}>
                        站内信

                    </a>

                </li>



                <li class="divider"></li>

                <li>

                    <a id="btn-logout" data-toggle="ajaxModal">退出</a>

                </li>

            </ul>

        </li>

        <ul class="nav navbar-nav hidden-xs">

            <li>

                <a href="#sidebar" data-toggle="class:nav-xs,nav-xs" class="text-muted active">

                    <i class="fa fa-indent text"></i>

                    <i class="fa fa-dedent text-active"></i>

                </a>

            </li>

        </ul>

    </ul>

</div>

</header>
