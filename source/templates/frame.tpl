<{extends file="base.tpl"}>

<{block name="frame"}>

    <section class="vbox">

        <header class="bg-white-only header header-md navbar navbar-fixed-top-xs">

            <div class="navbar-header aside bg-info">

                <a class="btn btn-link visible-xs" data-toggle="class:nav-off-screen,open" data-target="#nav,html">

                    <i class="icon-list"></i>

                </a>

                <a href="<{#SiteDomain#}>/index.php" class="navbar-brand text-lt">

                    <i class="icon-screen-desktop"></i>

                    <span class="hidden-nav-xs m-l-sm">西邮Linux CS</span>

                </a>

                <a class="btn btn-link visible-xs" data-toggle="dropdown" data-target=".user">

                    <i class="icon-settings"></i>

                </a>

            </div>

            <ul class="nav navbar-nav hidden-xs">

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

            <form class="navbar-form navbar-left input-s-box m-t m-l-n-xs hidden-xs" role="search" action="<{#SiteDomain#}>/server/activity.server.php" method="post">

                <div class="form-group">

                    <div class="input-group">

                        <span class="input-group-btn">

                          <button type="submit" id="btn_new_activity" class="btn btn-sm bg-white btn-icon rounded"><i class="fa fa-edit"></i></button>

                        </span>

                        <input name="activity_text" type="text" id="activity_text" class="form-control input-sm no-border rounded" placeholder="发表一条新动态...">

                    </div>

                </div>

            </form>

            <div class="navbar-right ">



                <ul class="nav navbar-nav m-n hidden-xs nav-user user">

                    <li class="hidden-xs">

                        <a href="#" class="dropdown-toggle lt" data-toggle="dropdown">

                            <i class="icon-bell"></i>
                            <{if $nav_unread_mail_count > 0}>
                            <span class="badge badge-sm up bg-danger count"><{$nav_unread_mail_count}></span>
                            <{/if}>
                        </a>

                        <section class="dropdown-menu aside-xl animated fadeInUp">

                            <section class="panel bg-white">

                                <div class="panel-heading b-light bg-light">

                                    <strong>你有 <span class="count"><{$nav_unread_mail_count}></span> 条站内信</strong>

                                </div>

                                <div class="list-group list-group-alt">

                                    <{section name=nav_unread_mail_list loop=$nav_unread_mail_list}>
                                    <a href="<{#SiteDomain#}>/mail_view.php?mid=<{$nav_unread_mail_list[nav_unread_mail_list].mid}>" class="media list-group-item">

                                        <span class="pull-left thumb-sm">

                                            <img src="<{$nav_unread_mail_list[nav_unread_mail_list].fromuser_avatar}>" alt="头像" class="img-circle">

                                        </span>

                                        <span class="media-body block m-b-none">

                                            <{$nav_unread_mail_list[nav_unread_mail_list].title}><br>

                                            <small class="text-muted"><{$nav_unread_mail_list[nav_unread_mail_list].date}></small>

                                        </span>

                                    </a>
                                    <{sectionelse}>
                                    <a href="<{#SiteDomain#}>/mail_unread.php" class="media list-group-item">
                                        <span class="media-body block m-b-none">

                                            暂时没有任何未读站内信

                                        </span>

                                    </a>
                                    <{/section}>
                                </div>

                                <div class="panel-footer text-sm">

                                    <a href="<{#SiteDomain#}>/mail_all.php" class="pull-right"><i class="fa fa-cog"></i></a>

                                    <a href="<{#SiteDomain#}>/mail_all.php">查看所有站内信</a>

                                </div>

                            </section>

                        </section>

                    </li>

                    <li class="dropdown">

                        <a href="#" class="dropdown-toggle bg clear" data-toggle="dropdown">

                          <span class="thumb-sm avatar pull-right m-t-n-sm m-b-n-sm m-l-sm">

                              <img src="<{$nav_profile_avatar}>" alt="加载中">

                          </span>

                          <{$nav_profile_username}><b class="caret"></b>

                        </a>

                        <ul class="dropdown-menu animated fadeInRight">
                            <li>

                                <a href="<{#SiteDomain#}>/profile.php?id=<{$nav_profile_uid}>">个人中心</a>

                            </li>

                            <li>

                                <a href="<{#SiteDomain#}>/mail_all.php">

                                    <{if $nav_unread_mail_count > 0}>
                                    <span class="badge bg-danger pull-right"><{$nav_unread_mail_count}></span>
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

        <section>

            <section class="hbox stretch">

                <!-- .aside -->

                <aside class="bg-black dk aside hidden-print" id="nav">

                    <section class="vbox">

                        <section class="scrollable">

                            <div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="10px" data-railOpacity="0.2">

                                <!-- nav -->

                                <nav class="nav-primary hidden-xs">

                                    <ul class="nav bg clearfix">

                                        <li class="hidden-nav-xs padder m-t m-b-sm text-xs text-muted">应用</li>

                                        <li>

                                            <a href="<{#SiteDomain#}>/index.php">

                                                <i class="icon-home"></i>

                                                     <!--<b class="badge bg-info pull-right">10</b>-->

                                                <span class="font-bold">主页</span>

                                            </a>

                                        </li>
                                        <{section name=laside_app_list loop=$laside_app_list}>
                                        <li>

                                            <a href="<{#SiteDomain#}>/app/<{$laside_app_list[laside_app_list].app_home}>">

                                                <i class="<{$laside_app_list[laside_app_list].app_icon}> icon text-success"></i>

                                                <{if $laside_app_list[laside_app_list].update_status == 'true'}>
                                                <b class="badge bg-info pull-right"><{$laside_app_list[laside_app_list].update_number}></b>
                                                <{/if}>
                                                <span class="font-bold"><{$laside_app_list[laside_app_list].app_name}></span>

                                            </a>

                                        </li>
                                        <{/section}>
                                        <li class="m-b hidden-nav-xs"></li>

                                    </ul>

                                    <ul class="nav" data-ride="collapse">

                                        <li class="hidden-nav-xs padder m-t m-b-sm text-xs text-muted">管理</li>

                                        <li>

                                            <a href="<{#SiteDomain#}>/profile.php">

                                                <i class="icon-user icon"></i>

                                                <span>个人中心</span>

                                            </a>

                                        </li>

                                        <li >

                                            <a href="#" class="auto">

                                                            <span class="pull-right text-muted">

                                                              <i class="fa fa-angle-left text"></i>

                                                              <i class="fa fa-angle-down text-active"></i>

                                                            </span>

                                                <i class="icon-notebook icon"></i>

                                                
                                                <span>站内信</span>
                                                <{if $laside_unread_mail_count > 0 }>
                                                <b class="badge bg-info" style="margin-left:1em;"><{$laside_unread_mail_count}></b>
                                                <{/if}>
                                            </a>

                                            <ul class="nav dk text-sm">

                                                <li >

                                                    <a href="<{#SiteDomain#}>/mail_edit.php" class="auto">

                                                        <i class="fa fa-angle-right text-xs"></i>

                                                        <span>写信</span>

                                                    </a>

                                                </li>

                                                <li >

                                                    <a href="<{#SiteDomain#}>/mail_all.php" class="auto">

                                                        <i class="fa fa-angle-right text-xs"></i>

                                                        <span>全部</span>

                                                    </a>

                                                </li>
                                                <li >

                                                    <a href="<{#SiteDomain#}>/mail_send.php" class="auto">

                                                        <i class="fa fa-angle-right text-xs"></i>

                                                        <span>已发</span>

                                                    </a>

                                                </li>
                                                <li >

                                                    <a href="<{#SiteDomain#}>/mail_read.php" class="auto">

                                                        <i class="fa fa-angle-right text-xs"></i>

                                                        <span>已读</span>

                                                    </a>

                                                </li>

                                                <li >

                                                    <a href="<{#SiteDomain#}>/mail_unread.php" class="auto">

                                                        <i class="fa fa-angle-right text-xs"></i>

                                                        <span>未读</span>

                                                        <{if $aside_unread_count > 0}>
                                                        <b class="badge bg-info" style="margin-left:2em;"><{$laside_unread_mail_count}></b>
                                                        <{/if}>

                                                    </a>

                                                </li>

                                                <li >

                                                    <a href="<{#SiteDomain#}>/mail_draft.php" class="auto">

                                                        <i class="fa fa-angle-right text-xs"></i>

                                                        <span>草稿</span>

                                                    </a>

                                                </li>

                                            </ul>

                                        </li>

                                        <!--  小组负责人管理权限  -->
                                        <{if $laside_user_privilege == '1'}>
                                        <li >

                                            <a href="#" class="auto">

                                                <span class="pull-right text-muted">

                                                    <i class="fa fa-angle-left text"></i>

                                                    <i class="fa fa-angle-down text-active"></i>

                                                </span>

                                                <i class="icon-settings icon">

                                                </i>

                                                <span>管理</span>

                                            </a>

                                            <ul class="nav dk text-sm">

                                                <li>
                                                    <a href="<{#SiteDomain#}>/admin_adduser.php"> <i class="icon-plus icon text-success"></i>
                                                        <span class="font-bold">添加用户</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="<{#SiteDomain#}>/admin_deluser.php"> <i class="fa fa-trash-o icon text-danger"></i>
                                                        <span class="font-bold">删除用户</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="<{#SiteDomain#}>/admin_deliver.php">
                                                        <i class="icon-refresh icon text-info"></i>
                                                        <span class="font-bold">权限移交</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="<{#SiteDomain#}>/admin_appmanager.php">
                                                        <i class="icon-grid icon text-primary-lter"></i>
                                                        <span class="font-bold">应用管理</span>
                                                    </a>
                                                </li>
                                            </ul>

                                        </li>
                                        <{/if}>

                                    </ul>

                                </nav>

                                <!-- / nav -->

                            </div>

                        </section>

                    </section>

                </aside>

                <!-- /.aside -->

                <section id="content">

                    <section class="hbox stretch">

                        <section class="vbox">

                            <section class="scrollable <{block name="content_wrapper_style"}>wrapper-lg<{/block}>" id="bjax-target">   

								<{block name="content"}><{/block}>

                            </section>

                        </section>


                        <aside class="aside-md bg-light dk" id="sidebar">

                            <section class="vbox animated fadeInRight">

                                <section class="scrollable hover">

                                    <nav class="nav-primary hidden-xs">

                                        <h4 class="font-thin m-l-md m-t hidden-nav-xs">用户列表</h4>

                                        <ul class="nav list-group no-bg no-borders auto m-t-n-xxs">

                                            <{section name=raside_user_list loop=$raside_user_list}>
                                            <li class="list-group-item">

                                                <span class="pull-left thumb-xs m-t-xs avatar m-l-xs m-r-sm" >

                                                    <img src="<{$raside_user_list[raside_user_list].avatar}>" alt="..." class="img-circle"> <i class="<{$raside_user_list[raside_user_list].status}>"></i>

                                                </span>

                                                <div class="clear">

                                                    <div class="hidden-nav-xs">
                                                        
                                                        <a href="<{#SiteDomain#}>/profile.php?uid=<{$raside_user_list[raside_user_list].uid}>"><{$raside_user_list[raside_user_list].name}></a>

                                                    </div>

                                                    <div class="visible-nav-xs">

                                                        <a href="#">占格</a>

                                                    </div>

                                                    <small class="text-muted hidden-nav-xs"><{$raside_user_list[raside_user_list].workplace}></small>
                                                      
                                                </div>

                                            </li>
                                            <{/section}>

                                        </ul>

                                    </nav>

                                </section>

                            </section>

                        </aside>

                    </section><!--hbox stretch-->

                    <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen,open" data-target="#nav,html"></a>
                
                </section><!--content-->

            </section><!--hbox stretch-->

        </section>

    </section>

<{/block}>

<{block name="scripts" append}>

    <script type="text/javascript">
        $(document).ready(function() {
            //online
            $.get("<{#SiteDomain#}>/server/online.server.php?uid="+get_cookie('uid')+"&logout=false",function(){});
            setInterval(function() {
                $.ajax({
                    url: "<{#SiteDomain#}>/server/online.server.php",
                    type: "GET",
                    dataType: "JSON",
                    data: {
                        "uid": get_cookie('uid'),
                    },
                    success: function(data){
                        console.log(data);
                    }
                });            
            }, 60000);

            $('.update-num').each(function() {
                var elem = $(this);
                var func_url = elem.data('funcurl') + '?func=cal_num';
                $.get(func_url, function(data) {
                    if (data == '0') {
                        elem.remove();
                    } else {
                        elem.html(data);
                    }
                });
            });

            //登出按钮事件
            $('#btn-logout').click(function(){
                var param = {
                    action: 'logout'
                };
                $.get("<{#SiteDomain#}>/server/online.server.php?uid="+get_cookie('uid')+"&logout=true",function(){});
                $.post('server/login.server.php', param, function() {
                    location.href = 'signin.php';
                });
            });
        });
    </script>

<{/block}>