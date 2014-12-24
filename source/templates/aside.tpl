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

    <li class="hidden-nav-xs padder m-t m-b-sm text-xs text-muted">

        应用

    </li>

    <li>

        <a href="index.php">

            <i class="icon-home"></i>

 <!--           <b class="badge bg-info pull-right">10</b>-->

            <span class="font-bold">主页</span>

        </a>

    </li>
<{section name=n loop=$aside_app_list}>
    <li>

        <a href="http://cs.xiyoulinux.org/plugins/<{$aside_app_list[n].app_home}>">

            <i class="<{$aside_app_list[n].app_icon}> icon text-success"></i>

            <{if $aside_app_list[n].update_status == 'true'}>
            <b class="badge bg-info pull-right"><{$aside_app_list[n].update_number}></b>
            <{/if}>
            <span class="font-bold"><{$aside_app_list[n].app_name}></span>

        </a>

    </li>
<{/section}>
    <li class="m-b hidden-nav-xs"></li>

</ul>





<ul class="nav" data-ride="collapse">

    <li class="hidden-nav-xs padder m-t m-b-sm text-xs text-muted">

        管理

    </li>



    <li>

        <a href="profile.php">

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
            <{if $aside_unread_count > 0}>
            <b class="badge bg-info" style="margin-left:1em;"><{$aside_unread_count}></b>
            <{/if}>
        </a>

        <ul class="nav dk text-sm">

            <li >

                <a href="mail_edit.php" class="auto">

                    <i class="fa fa-angle-right text-xs"></i>



                    <span>写信</span>

                </a>

            </li>

            <li >

                <a href="mail_all.php" class="auto">

                    <i class="fa fa-angle-right text-xs"></i>

                    <span>全部</span>

                </a>

            </li>
            <li >

                <a href="mail_send.php" class="auto">

                    <i class="fa fa-angle-right text-xs"></i>

                    <span>已发</span>

                </a>

            </li>
            <li >

                <a href="mail_read.php" class="auto">

                    <i class="fa fa-angle-right text-xs"></i>

                    <span>已读</span>

                </a>

            </li>

            <li >

                <a href="mail_unread.php" class="auto">

                    <i class="fa fa-angle-right text-xs"></i>

                    <span>未读</span>

                    <{if $aside_unread_count > 0}>
                    <b class="badge bg-info" style="margin-left:2em;"><{$aside_unread_count}></b>
                    <{/if}>

                </a>

            </li>

            <li >

                <a href="mail_draft.php" class="auto">

                    <i class="fa fa-angle-right text-xs"></i>



                    <span>草稿</span>

                </a>

            </li>

        </ul>

    </li>


<!--  小组负责人管理权限  -->
    <{if $aside_privilege == '1'}>
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
                <a href="load_adduser.php"> <i class="icon-plus icon text-success"></i>
                    <span class="font-bold">添加用户</span>
                </a>
            </li>
            <li>
                <a href="load_deluser.php"> <i class="fa fa-trash-o icon text-danger"></i>
                    <span class="font-bold">删除用户</span>
                </a>
            </li>
            <li>
                <a href="load_reflash.php">
                    <i class="icon-refresh icon text-info"></i>
                    <span class="font-bold">权限移交</span>
                </a>
            </li>
            <li>
                <a href="load_appmanager.php">
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
