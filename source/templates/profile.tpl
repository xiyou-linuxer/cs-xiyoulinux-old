<{include file="header.tpl"}>
<link rel="stylesheet" href="js/chosen/chosen.css" type="text/css" />
<{include file="header_nav.tpl"}>
<{include file="aside.tpl"}>
<section id="content">
<section class="vbox">
<section class="scrollable">
<section class="hbox stretch">

<aside class="aside-lg bg-light lter b-r">
    <section class="vbox">
        <section class="scrollable">
            <div class="wrapper">
                <div class="text-center m-b m-t">
                    <a href="#" class="thumb-lg">
                        <img src="<{$avatar}>" class="img-circle">
                    </a>
                    <div>
                        <div class="h3 m-t-xs m-b-xs"><small class="text-muted"><{if $info.sex == 1}><i class="fa fa-male"><{else}><i class="fa fa-female"><{/if}></i></small><{$info.name}></div>
                        <small class="text-muted"><i class="fa fa-map-marker"></i><{if $info.native != null}><i id="city"><{$info.native}></i>,<{/if}>中国</small>
                    </div>
                </div>

                <{if $info.issame == true}>
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
                    <a class="btn btn-success btn-rounded" id="info-btn" href="mail_edit.php?touid=<{$info.infouid}>">
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
                                    <input id="phone" type="text" class="form-control" value="<{$info.phone}>" <{if $info.issame != true}>disabled<{/if}> btvd-el="/^[\d-]+$/" btvd-class="btvdclass" btvd-err="您的输入格式错误</br>类似:12345678901">
                                </div>
                                <div class="form-group" style="padding-top: 1px;padding-left: 15px;padding-right: 15px; position:relative; min-height: 1px">
                                    <label>邮箱</label>
                                    <input id="mail" class="form-control" value="<{$info.mail}>" <{if $info.issame != true}>disabled<{/if}> btvd-el="/^[\w!#$%&'*+/=?^_`{|}~-]+(?:\.[\w!#$%&'*+/=?^_`{|}~-]+)*@(?:[\w](?:[\w-]*[\w])?\.)+[\w](?:[\w-]*[\w])?$/" btvd-class="btvdclass" btvd-err="输入格式:/^[\w!#$%&'*+/=?^_`{|}~-]+(?:\.[\w!#$%&'*+/=?^_`{|}~-]+)*@(?:[\w](?:[\w-]*[\w])?\.)+[\w](?:[\w-]*[\w])?$/">
                                </div>
                                <div class="form-group" style="padding-left: 15px;padding-right: 15px; position:relative; min-height: 1px">
                                    <label>工作地点及职位</label>
                                    <div class="row">
                                        <div class="col-md-5" style="padding-right:0px">
                                            <input type="text" class="form-control" id="workplace" placeholder="工作地点" value="<{$info.workplace}>" <{if $info.issame != true}>disabled<{/if}> btvd-el="/^[\x{4e00}-\x{9fa5}]+$/u" btvd-class="btvdclass" btvd-err="输入格式:/^[\x{4e00}-\x{9fa5}]+$/u">
                                        </div>
                                        <div class="col-md-7" style="padding-left:0px">
                                            <input type="text" class="form-control" id="job" placeholder="职位" value="<{$info.job}>"<{if $info.issame != true}>disabled<{/if}> btvd-el="/^[\x{4e00}-\x{9fa5}]+$/u" btvd-class="btvdclass" btvd-err="输入格式:/^[\x{4e00}-\x{9fa5}]+$/u">
                                        </div>
                                    </div>
                                </div>
                                <!--    <div class="input-group ">
                                        <div class="input-group-btn">
                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" id="workplace-btn">
                                                <{if $info.workplace == null}>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<{else}><{$info.workplace}><{/if}>
                                                <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu" id="workplace-ul">
                                            </ul>
                                        </div>
                                        <input id="job" class="form-control" value="<{$info.job}>" <{if $info.issame != true}>disabled<{/if}>>
                                    </div>
                                </div>-->
                                <div class="form-group" style="padding-left: 15px;padding-right: 15px; position:relative; min-height: 1px">
                                    <label>届别及专业</label>
                                    <div class="input-group ">
                                        <div class="input-group-btn">
                                            <button type="button" class="btn btn-default" id="grade-btn">
                                                <{$info.grade}>
                                                <!--  <span class="caret"></span>-->
                                            </button>
                                        </div>
                                        <input id="major" class="form-control" value="<{$info.major}>" <{if $info.issame != true}>disabled<{/if}> btvd-el="/^[\x{4e00}-\x{9fa5}]+$/u" btvd-class="btvdclass" btvd-err="输入格式:/^[\x{4e00}-\x{9fa5}]+$/u">
                                    </div>
                                </div>
                                <div class="form-group pull-in clearfix">
                                    <div class="col-sm-6">
                                        <label>QQ号</label>
                                        <input id="qq" type="text" class="form-control" placeholder="" value="<{$info.qq}>" <{if $info.issame != true}>disabled<{/if}> btvd-el="/^\w+$/" btvd-class="btvdclass" btvd-err="输入格式:/^\w+$/">
                                    </div>
                                    <div class="col-sm-6">
                                        <label>微信</label>
                                        <input id="wechat" type="text" class="form-control" placeholder="" value="<{$info.wechat}>" <{if $info.issame != true}>disabled<{/if}> btvd-el="/^\w+$/" btvd-class="btvdclass" btvd-err="输入格式:/^\w+$/">
                                    </div>
                                </div>
                                <div class="form-group" style="padding-left: 15px;padding-right: 15px; position:relative; min-height: 1px">
                                    <label>博客</label>
                                    <input id="blog" type="text" class="form-control" value="<{$info.blog}>" <{if $info.issame != true}>disabled<{/if}> btvd-el="/^[a-zA-z]+:\/\/[^\s]*$/" btvd-class="btvdclass" btvd-err="输入格式:/^[a-zA-z]+:\/\/[^\s]*$/">
                                </div>
                                <div class="form-group" style="padding-left: 15px;padding-right: 15px; position:relative; min-height: 1px">
                                    <label>github</label>
                                    <input id="github" type="text" class="form-control" value="<{$info.github}>" <{if $info.issame != true}>disabled<{/if}> btvd-el="/^[a-zA-z]+:\/\/[^\s]*$/" btvd-class="btvdclass" btvd-err="输入格式:/^[a-zA-z]+:\/\/[^\s]*$/">
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
                <{section name=times loop=$Dynamics_array}>
                <article class="comment-item" mid="<{$Dynamics_array[times].mid}>">
                    <a class="pull-left thumb-sm avatar">
                        <img src="<{$Dynamics_array[times].avatar}>" alt="..."></a>
                    <span class="arrow left"></span>
                    <section class="comment-body panel panel-default">
                        <header class="panel-heading">
                            <a href="#">
                                <{$Dynamics_array[times].name}></a>
                            <label class="label <{$Dynamics_array[times].actioncolor}> m-l-xs">
                                <{$Dynamics_array[times].actiontext}></label>
										<span class="text-muted m-l-sm pull-right"> <i class="fa fa-clock-o"></i>
											<{$Dynamics_array[times].time}></span>
                        </header>
                        <div class="panel-body">
                            <h4>
                                <{$Dynamics_array[times].mdescribe}></h4>
                            <div class="panel-body">
                                <blockpanel-bodyquote>
                                    <p><{$Dynamics_array[times].message}></p>
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
                        <li class="list-group-item" mid="<{$Dynamics_array[times].mid}>">
                            <a class="pull-left thumb-sm avatar">
                                <img src="<{$Dynamics_array[times].avatar}>" alt="..."></a>
                            <span class="arrow left"></span>
                            <section class="comment-body panel panel-default">
                                <header class="panel-heading">
                                    <a href="#">
                                        <{$Dynamics_array[times].name}></a>
                                    <label class="label <{$Dynamics_array[times].actioncolor}> m-l-xs">
                                        <{$Dynamics_array[times].actiontext}></label>
										<span class="text-muted m-l-sm pull-right"> <i class="fa fa-clock-o"></i>
											<{$Dynamics_array[times].time}></span>
                                </header>
                                <div class="panel-body">
                                    <h4>
                                        <{$Dynamics_array[times].mdescribe}></h4>
                                    <div class="panel-body">
                                        <blocpanel-bodykquote>
                                            <p><{$Dynamics_array[times].message}></p>
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

<script>var modifyPasswdUrl = '<{$modifyPasswdUrl}>';</script>

<!-- section id="bjax-target" --> </section>
<!-- section class="vbox" --> </section>
</section>
</section>
<{include file="chat.tpl"}>
<{include file="script.tpl"}>
<script type="text/javascript" src="js/profile.js"></script>
<{include file="footer.tpl"}>
