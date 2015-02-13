<{extends file="frame.tpl"}>

<{block name="content_wrapper_style"}><{/block}>

<{block name="stylesheet" append}>

    <link rel="stylesheet" href="<{#SiteDomain#}>/js/chosen/chosen.css" type="text/css" />

<{/block}>

<{block name="content"}>

    <section class="hbox stretch">

        <aside class="aside-lg bg-light lter b-r">

            <section class="vbox">

                <section class="scrollable">

                    <div class="wrapper">

                        <div class="text-center m-b m-t">

                            <a href="#" class="thumb-lg">

                                <img src="<{$user_info.avatar}>" class="img-circle">

                            </a>

                            <div>

                                <div class="h3 m-t-xs m-b-xs"><small class="text-muted"><{if $user_info.sex == 1}><i class="fa fa-male"><{else}><i class="fa fa-female"><{/if}></i></small><{$user_info.name}></div>

                                <small class="text-muted"><i class="fa fa-map-marker"></i><{if $user_info.native != null}><i id="city"><{$user_info.native}></i>,<{/if}>中国</small>

                            </div>

                        </div>

                        <{if $user_info.issame == true}>

                        <div class="btn-group btn-group-justified m-b">

                            <a class="btn btn-success btn-rounded" id="submit-info">

                                <i class="fa icon-user">保存资料</i>

                            </a>

                            <a class="btn btn-primary btn-rounded" id="change-password">

                                <i class="fa icon-lock">修改密码</i>

                            </a>

                        </div>

                        <{else}>

                        <div class="btn-group btn-group-justified m-b">

                            <a class="btn btn-success btn-rounded" id="info-btn" href="mail_edit.php?touid=<{$user_info.uid}>">

                                <i class="fa fa-comment-o" id="info">发站内信</i>

                            </a>

                        </div>

                        <{/if}>

                        <div>

                            <form class="form-horizontal" data-validate="parsley" id="person-info">

                                <section class="panel panel-default">

                                    <header class="panel-heading">

                                        <strong>个人信息</strong>

                                    </header>

                                    <div class="panel-body">

                                        <div class="form-group" style="padding-left: 15px;padding-right: 15px; position:relative; min-height: 1px">

                                            <label>手机号</label>

                                            <input id="phone" type="text" class="form-control" value="<{$user_info.phone}>" <{if $user_info.issame != true}>disabled<{/if}> btvd-el="/^[\d-]+$/" btvd-class="btvdclass" btvd-err="您的输入格式错误</br>类似:12345678901">

                                        </div>

                                        <div class="form-group" style="padding-top: 1px;padding-left: 15px;padding-right: 15px; position:relative; min-height: 1px">

                                            <label>邮箱</label>

                                            <input id="mail" class="form-control" value="<{$user_info.mail}>" <{if $user_info.issame != true}>disabled<{/if}> btvd-el="/^[\w!#$%&'*+/=?^_`{|}~-]+(?:\.[\w!#$%&'*+/=?^_`{|}~-]+)*@(?:[\w](?:[\w-]*[\w])?\.)+[\w](?:[\w-]*[\w])?$/" btvd-class="btvdclass" btvd-err="输入格式:/^[\w!#$%&'*+/=?^_`{|}~-]+(?:\.[\w!#$%&'*+/=?^_`{|}~-]+)*@(?:[\w](?:[\w-]*[\w])?\.)+[\w](?:[\w-]*[\w])?$/">

                                        </div>

                                        <div class="form-group" style="padding-left: 15px;padding-right: 15px; position:relative; min-height: 1px">

                                            <label>工作地点及职位</label>

                                            <div class="row">

                                                <div class="col-md-5" style="padding-right:0px">

                                                    <input type="text" class="form-control" id="workplace" placeholder="工作地点" value="<{$user_info.workplace}>" <{if $user_info.issame != true}>disabled<{/if}> btvd-el="/^[\x{4e00}-\x{9fa5}]+$/u" btvd-class="btvdclass" btvd-err="输入格式:/^[\x{4e00}-\x{9fa5}]+$/u">

                                                </div>

                                                <div class="col-md-7" style="padding-left:0px">

                                                    <input type="text" class="form-control" id="job" placeholder="职位" value="<{$user_info.job}>"<{if $user_info.issame != true}>disabled<{/if}> btvd-el="/^[\x{4e00}-\x{9fa5}]+$/u" btvd-class="btvdclass" btvd-err="输入格式:/^[\x{4e00}-\x{9fa5}]+$/u">

                                                </div>

                                            </div>

                                        </div>

                                        <!--    <div class="input-group ">

                                                <div class="input-group-btn">

                                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" id="workplace-btn">

                                                        <{if $user_info.workplace == null}>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<{else}><{$user_info.workplace}><{/if}>
                                                        <span class="caret"></span>

                                                    </button>

                                                    <ul class="dropdown-menu" id="workplace-ul">

                                                    </ul>

                                                </div>

                                                <input id="job" class="form-control" value="<{$user_info.job}>" <{if $user_info.issame != true}>disabled<{/if}>>

                                            </div>

                                        </div>-->

                                        <div class="form-group" style="padding-left: 15px;padding-right: 15px; position:relative; min-height: 1px">

                                            <label>届别及专业</label>

                                            <div class="input-group ">

                                                <div class="input-group-btn">

                                                    <button type="button" class="btn btn-default" id="grade-btn">

                                                        <{$user_info.grade}>

                                                        <!--  <span class="caret"></span>-->
                                                    </button>

                                                </div>

                                                <input id="major" class="form-control" value="<{$user_info.major}>" <{if $user_info.issame != true}>disabled<{/if}> btvd-el="/^[\x{4e00}-\x{9fa5}]+$/u" btvd-class="btvdclass" btvd-err="输入格式:/^[\x{4e00}-\x{9fa5}]+$/u">

                                            </div>

                                        </div>

                                        <div class="form-group pull-in clearfix">

                                            <div class="col-sm-6">

                                                <label>QQ号</label>

                                                <input id="qq" type="text" class="form-control" placeholder="" value="<{$user_info.qq}>" <{if $user_info.issame != true}>disabled<{/if}> btvd-el="/^\w+$/" btvd-class="btvdclass" btvd-err="输入格式:/^\w+$/">

                                            </div>

                                            <div class="col-sm-6">

                                                <label>微信</label>

                                                <input id="wechat" type="text" class="form-control" placeholder="" value="<{$user_info.wechat}>" <{if $user_info.issame != true}>disabled<{/if}> btvd-el="/^\w+$/" btvd-class="btvdclass" btvd-err="输入格式:/^\w+$/">

                                            </div>

                                        </div>

                                        <div class="form-group" style="padding-left: 15px;padding-right: 15px; position:relative; min-height: 1px">

                                            <label>博客</label>

                                            <input id="blog" type="text" class="form-control" value="<{$user_info.blog}>" <{if $user_info.issame != true}>disabled<{/if}> btvd-el="/^[a-zA-z]+:\/\/[^\s]*$/" btvd-class="btvdclass" btvd-err="输入格式:/^[a-zA-z]+:\/\/[^\s]*$/">

                                        </div>

                                        <div class="form-group" style="padding-left: 15px;padding-right: 15px; position:relative; min-height: 1px">

                                            <label>github</label>

                                            <input id="github" type="text" class="form-control" value="<{$user_info.github}>" <{if $user_info.issame != true}>disabled<{/if}> btvd-el="/^[a-zA-z]+:\/\/[^\s]*$/" btvd-class="btvdclass" btvd-err="输入格式:/^[a-zA-z]+:\/\/[^\s]*$/">

                                        </div>

                                    </div>

                                </section>

                            </form>

                        </div>

                        <div class="line"></div>

                        <small class="text-uc text-xs text-muted">connection</small>

                        <p class="m-t-sm">

                            <a href="#" class="btn btn-rounded btn-twitter btn-icon"><i class="fa fa-github"></i></a>

                            <a href="#" class="btn btn-rounded btn-facebook btn-icon"><i class="fa fa-renren"></i></a>

                            <a href="#" class="btn btn-rounded btn-gplus btn-icon"><i class="fa fa-weibo"></i></a>

                        </p>

                    </div>

                </section>

            </section>

        </aside>

        <aside class="bg-white">

            <section class="vbox">

                <header class="header bg-light lt">

                    <ul class="nav nav-tabs nav-white">

                        <li class="active"><a href="#activity" data-toggle="tab">相关动态</a></li>

                    </ul>

                </header>

                <section class="scrollable" id="activity-scroll">

                <div class="clo-sm-11">

                    <section class="comment-list block">

                        <!--  comment-item-id-1  -->
                        <{section name=activity_list loop=$activity_list}>

                        <article class="comment-item" mid="<{$activity_list[activity_list].mid}>">

                            <a class="pull-left thumb-sm avatar">

                                <img src="<{$activity_list[activity_list].avatar}>" alt="..."></a>

                            <span class="arrow left"></span>

                            <section class="comment-body panel panel-default">

                                <header class="panel-heading">

                                    <a href="#">

                                        <{$activity_list[activity_list].name}></a>

                                    <label class="label <{$activity_list[activity_list].actioncolor}> m-l-xs">

                                        <{$activity_list[activity_list].actiontext}>

                                    </label>

                                    <span class="text-muted m-l-sm pull-right"> <i class="fa fa-clock-o"></i>

                                        <{$activity_list[activity_list].time}>
                                    </span>

                                </header>

                                <div class="panel-body">

                                    <h4>

                                        <a href="<{$activity_list[activity_list].href}>"><{$activity_list[activity_list].mdescribe}></a></h4>

                                    <div class="panel-body">

                                        <blockpanel-bodyquote>

                                            <p><{$activity_list[activity_list].message}></p>

                                        </blockquote>

                                    </div>

                                </div>

                            </section>

                        </article>

                        <{/section}>

                    </section>

                </div>

                    <!--<div class="tab-content">

                        <div class="tab-pane active" id="activity">

                            <ul class="list-group no-radius m-b-none m-t-n-xxs list-group-lg no-border" id="activity-ul">

                                <{section name=times loop=$Dynamics_array}>

                                <li class="list-group-item" mid="<{$activity_list[activity_list].mid}>">

                                    <a class="pull-left thumb-sm avatar">

                                        <img src="<{$activity_list[activity_list].avatar}>" alt="..."></a>

                                    <span class="arrow left"></span>

                                    <section class="comment-body panel panel-default">

                                        <header class="panel-heading">

                                            <a href="#">

                                                <{$activity_list[activity_list].name}></a>

                                            <label class="label <{$activity_list[activity_list].actioncolor}> m-l-xs">

                                                <{$activity_list[activity_list].actiontext}></label>

                                                <span class="text-muted m-l-sm pull-right"> <i class="fa fa-clock-o"></i>

                                                    <{$activity_list[activity_list].time}></span>

                                        </header>

                                        <div class="panel-body">

                                            <h4>

                                                <{$activity_list[activity_list].mdescribe}></h4>

                                            <div class="panel-body">

                                                <blocpanel-bodykquote>

                                                    <p><{$activity_list[activity_list].message}></p>

                                                    </blockquote>

                                            </div>

                                        </div>

                                    </section>

                                </li>

                                <{/section}>

                            </ul>

                        </div>
                      
                    </div>-->

                </section>

            </section>

        </aside>

    </section>
<{/block}>

<{block name="scripts" append}>

    <script>
        var modifyPasswdUrl = '<{$reset_pass_url}>';

        $(document).ready(function(){
            getWorkplace();
            scrollLoad();
            $("#submit-info").click(function(){
                //alert('grade:' + $("#grade-btn").text() +'\nuid:'+ getCookie('uid') + "\nphone" + $("#phone").val() + "\nmail:" + $("#mail").val() + "\nworkplace" + $("#workplace-btn").text() + "\njob:" + $("#job").val() + "\nmajor:" + $("#major").val() + "\nqq:" + $("#qq").val() + "\nwechat" + $("#wechat").val() + "\nblog" + $("#blog").val() + "\ngithub" + $("#github").val());
                $.post(
                    '<{#SiteDomain#}>/server/profile.server.php',
                    {
                        action:'update_userinfo',
                        uid:getCookie('uid'),
                        phone:$("#phone").val(),
                        mail:$("#mail").val(),
                        workplace:$("#workplace").val(),
                        job:$("#job").val(),
                        major:$("#major").val(),
                        qq:$("#qq").val(),
                        wechat:$("#wechat").val(),
                        blog:$("#blog").val(),
                        github:$("#github").val(),
                        grade:$("#grade-btn").text()
                    },
                    function (data) {
                        if (data == 1)
                            alert("修改成功");
                        else
                            alert("修改失败");

                    }
                );
            });
        });

        var getWorkplace = function(){
            $("#workplace-ul li").click(function(){
                $('#workplace-btn').html($(this).text()+ '<span class="caret"></span>');
            });

        }

        $("#change-password").click(function(){
            window.location.href = modifyPasswdUrl; 
        });

        var times = 0;
        function scrollLoad(){
            $('#activity-scroll').scroll(function(){
                if($('#info-btn').length > 0)
                    uid = $('#info-btn').attr('href').substr(20);
                else 
                    uid = getCookie('uid');

                viewH = $(this).height();
                contentH = $(this).get(0).scrollHeight;
                scrollTop = $(this).scrollTop();
                if ((contentH - viewH - scrollTop <= 100) || (contentH - viewH < scrollTop)){
                    times++;
                    if(times == 1)
                    {
                    $.post('<{#SiteDomain#}>/server/profile.server.php',
                        {
                            action: 'refresh_activity',
                            uid: uid,
                            mid: $('.comment-item:last').attr('mid')
                        },
                        function(data){
                            if (data.substr(0,5) != 'false'){
                            $('.comment-item:last').after(data);
                            $('.comment-item:last').hide();
                            $('.comment-item:last').prev().hide();
                            $('.comment-item:last').prev().prev().hide();
                            $('.comment-item:last').slideDown();
                            $('.comment-item:last').prev().slideDown();
                            $('.comment-item:last').prev().prev().slideDown();
                        }
                        times = 0;
                    }
                    );
                    }
                }   
            });
        }

        function getCookie(str){
            var start = document.cookie.indexOf(str + "=");
            var len = start + str.length + 1;

            if( !start && str != document.cookie.substr(0,str.length) )
                return null;
            if(start == -1)
                return null;
            var end = document.cookie.indexOf(";",len);
            if(end == -1)
                end = document.cookie.length;
            return decodeURI( document.cookie.substring(len,end) );
        }

    </script>

<{/block}>
