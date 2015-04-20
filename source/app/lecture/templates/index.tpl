<{extends file="../../../templates/frame.tpl"}>

<{block name="stylesheet" append}>
<link rel="stylesheet" href="<{#SiteDomain#}>/js/datatables/datatables.css" type="text/css" />
<link rel="stylesheet" href="<{#SiteDomain#}>/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css" type="text/css" />
<link rel="stylesheet" href="css/style.css" type="text/css" />
<{/block}>

<{block name="content"}> 
    <div class="row page-content">
        <div class="col-md-7">
            <h4 class="font-thin">近期讲座</h4>
            <ul class="lecture-toggle-list">
                <{section name=n loop=$recent_lecture}>
                <li>
                    <a href="#">
                        <div class="title"><i class="fa  fa-comments-o"></i><{$recent_lecture[n].title}></div>
                        <div class="time"><i class="fa fa-clock-o"></i><{$recent_lecture[n].time}></div>
                    </a>
                    <div class="row lecture-details">
                        <div class="col-md-3 author">
                            <div class="avatar">
                                <img src="<{$recent_lecture[n].lecture_author_avatar}>">
                            </div>
                            <p><{$recent_lecture[n].lecture_author}></p>
                            <{if $recent_lecture[n].slide != ""}>
                            <a href="<{$recent_lecture[n].slide}>" class="btn btn-block btn-default" target="_blank"><i class="fa fa-download"></i> 讲义下载</a>
                            <{/if}>
                        </div>
                        <div class="col-md-9">
                            <h3><{$recent_lecture[n].title}></h3>
                            <hr/>
                            <ul class="meta">
                                <li>
                                    <i class="fa fa-clock-o"></i>
                                    <p class="text"><{$recent_lecture[n].time}></p>
                                </li>
                                <li>
                                    <i class="fa fa-map-marker"></i>
                                    <p class="text"><{$recent_lecture[n].location}></p>
                                </li>
                                <li>
                                    <i class="fa fa-tags"></i>
                                    <p class="text" data-type="json_tag" data-json='<{$recent_lecture[n].tag}>'></p>
                                </li>
                                <li class="text-right">
                                    <a class="link-details" href="#modal-details" data-toggle="modal" data-lid="<{$recent_lecture[n].lid}>">查看详情>></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
                <{sectionelse}>
                        <div class="panel-body">没有查询到任何近期讲座！</div>
                <{/section}>
            </ul>
        </div>
        <div class="col-md-5">
            <div class="owned-lecture-header">
                <h4 class="font-thin">我的讲座</h4>
                <a href="#modal-edit" class="badge badge-info new-lecture" data-toggle="modal" data-action="add" >
                    <i class="fa fa-plus"></i> 新 建
                </a>
            </div>
            <ul class="owned-lecture-list">
                <{section name=n loop=$my_lecture}>
                <li>
                    <i class="fa fa-comments-o"></i>
                    <a href="#modal-details" data-toggle="modal" data-lid="<{$my_lecture[n].lid}>"><{$my_lecture[n].title}></a>
                    <div class="op-wrapper">
                        <a href="#modal-edit" data-toggle="modal" data-action="update" data-lid="<{$my_lecture[n].lid}>">
                            <i class="fa fa-edit"></i>
                        </a>
                        <a href="#" data-action="del" data-lid="<{$my_lecture[n].lid}>">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </li>
                <{sectionelse}>
                <li>您还没有发布过任何讲座！</li>
                <{/section}>
            </ul>
            
            <h4 class="font-thin">往期讲座</h4>
            <table class="table m-b-none past-lecture-table" data-ride="datatables">
                <thead>
                    <tr>
                        <th>
                            标题
                        </th>
                        <th>
                            时间
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <{section name=n loop=$pass_lecture}>
                    <tr>
                        <td class="text-bold">
                            <i class="fa fa-comments-o"></i>
                            <a href="#modal-details" data-toggle="modal"  data-lid="<{$pass_lecture[n].lid}>"><{$pass_lecture[n].title}></a>
                        </td>
                        <td class="text-right"><i class="fa fa-clock-o"></i><{$pass_lecture[n].time}></td>
                    </tr>
                    <{/section}>
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal fade" id="modal-details">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <button type="button" class="close" 
                    data-dismiss="modal" aria-hidden="true">
                          &times;
                    </button>
                    <h4 class="modal-title" id="lct_title"></h4>
                </div>
                <div class="modal-body lecture-details"> 
                    <ul class="meta">
                        <li>
                            <i class="fa fa-user"></i>
                            <p class="text" id="lct_author"></p>
                        </li>
                        <li>
                            <i class="fa fa-clock-o"></i>
                            <p class="text" id="lct_time"></p>
                        </li>
                        <li>
                            <i class="fa fa-map-marker"></i>
                            <p class="text" id="lct_location"></p>
                        </li>
                        <li>
                            <i class="fa fa-tags"></i>
                            <p class="text" id="lct_tag">
                            </p>
                        </li>
                        <li>
                            <i class="fa fa-list-ul"></i>
                            <p class="text" id="lct_description"></p>
                        </li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <{if $laside_user_privilege == '1'}>
                    <a href="#modal-edit" class="btn btn-success lct_lid" data-toggle="modal">编辑</button>
                    <a href="#" class="btn btn-danger lct_lid" data-action="del">删除</a>
                    <{/if}>
                    <a href="#" class="btn btn-info" id="lct_slide">讲义下载</a>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    <div class="modal fade" id="modal-edit">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <button type="button" class="close" 
                    data-dismiss="modal" aria-hidden="true">
                          &times;
                    </button>
                    <h4 class="modal-title" id="modal_title">编辑讲座</h4>
                </div>
                <div class="modal-body"> 
                    <form class=" form-horizontal">
                        <div class="form-group">
                            <label class="col-lg-2 control-label">* 标题</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" placeholder="讲座标题，必填" id="lct_title">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">* 时间</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" placeholder="讲座时间，必填" data-toggle="datepicker" id="lct_time">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">* 地点</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" placeholder="讲座地点，必填" id="lct_location">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">标签</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" placeholder="讲座标签，多标签用“,”隔开，可为空" id="lct_tag">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">讲义</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" placeholder="讲座讲义下载地址，可为空" id="lct_slide">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">描述</label>
                            <div class="col-lg-9">
                                <textarea class="form-control" placeholder="讲座描述，可为空" rows="5" id="lct_description"></textarea>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">发布</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">取消</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
<{/block}>

<{block name="scripts" append}>
<script type="text/javascript" src="<{#SiteDomain#}>/js/datatables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="http://cdn.bootcss.com/moment.js/2.10.2/moment.min.js"></script>
<script type="text/javascript" src="<{#SiteDomain#}>/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="<{#SiteDomain#}>/js/jquery.urlGET.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        // 手风琴列表
        $('.lecture-toggle-list>li a').click(function() {
            var checkElement = $(this).next();
            if((checkElement.is('.lecture-details')) && (checkElement.is(':visible'))) {
                return false;
            }
            
            if((checkElement.is('.lecture-details')) && (!checkElement.is(':visible'))) {
                $('.lecture-toggle-list>li .lecture-details:visible').slideUp('normal');
                checkElement.slideDown('normal');
                return false;
            }
        });

        // 标签解析
        $('[data-type="json_tag"]').each(function () {
            var tags = $(this).data("json");

            var inner_text = "";
            for(var i=0, len=tags.tag.length; i<len; i++) {
                inner_text += '<label class="label label-info">' + tags.tag[i] + '</label>';
            }
            $(this).html(inner_text);
        });

        $('[data-toggle="modal"]').click(function() {
            var href = $(this).attr("href");

            switch(href) {
                case '#modal-details':
                    var param = {
                        action : "get_info",
                        lid : $(this).data("lid")
                    }

                    $.post("./lecture.server.php", param, function(data) {
                        if (data == "0") {
                            alert("讲座不存在!");
                            location.href = "./index.php";
                        } 
                        if (data == "-1") {
                            alert("请求信息不全!");
                            location.href = "./index.php";
                        }

                        var lct_info = JSON.parse(data);
                        var modal = $("#modal-details");

                        modal.find("#lct_title").html(lct_info.title);
                        modal.find("#lct_author").html(lct_info.lecture_author);
                        modal.find("#lct_time").html(lct_info.time);
                        modal.find("#lct_location").html(lct_info.location);
                        modal.find("#lct_description").html(lct_info.description);
                        modal.find(".lct_lid").data("lid", lct_info.lid);
                        modal.find("#lct_slide").attr("href", lct_info.slide);

                        if (lct_info.tag) {
                            var lct_tag = JSON.parse(lct_info.tag);
                            var html_tag = "";
                            for (var i=0, len=lct_tag.tag.length; i<len; i++) {
                                html_tag += '<label class="label label-info">' + lct_tag.tag[i] + '</label>';
                            };
                            modal.find("#lct_tag").html(html_tag);
                        }

                        if (lct_info.slide) {
                            modal.find("#lct_slide").show().val(lct_info.description);
                        } else {
                            modal.find("#lct_slide").hide();
                        }
                    });

                    break;
                case '#modal-edit':
                    var lct_id = $(this).data("lid");
                    var modal = $("#modal-edit");

                    if (lct_id == undefined) {
                        modal.find("#modal_title").html("新建讲座");
                        modal.find("#lct_title").val("");
                        modal.find("#lct_time").val("");
                        modal.find("#lct_location").val("");
                        modal.find("#lct_tag").val("");
                        modal.find("#lct_slide").val("");
                        modal.find("#lct_description").val("");
                        modal.find('button[type="submit"]').html("发布").data("action", "add").data("lid", "");
                    } else {
                        var param = {
                            action : "get_info",
                            lid : lct_id
                        };
                        $.post("./lecture.server.php", param, function(data) {
                            if (data == "0") {
                                alert("讲座不存在!");
                                location.href = "./index.php";
                            } 
                            if (data == "-1") {
                                alert("请求信息不全!");
                                location.href = "./index.php";
                            }
                            var lct_info = JSON.parse(data);

                            modal.find("#modal_title").html("编辑讲座");
                            modal.find("#lct_title").val(lct_info.title);
                            modal.find("#lct_time").val(lct_info.time);
                            modal.find("#lct_location").val(lct_info.location);
                            modal.find('button[type="submit"]').html("编辑").data("action", "update").data("lid", lct_id);

                            var lct_tag = JSON.parse(lct_info.tag);
                            var inner_text = "";
                            for (var i=0, len=lct_tag.tag.length; i<len; i++) {
                                inner_text += lct_tag.tag[i] + ',';
                            };
                            modal.find("#lct_tag").val(inner_text.slice(0, -1));
                        });
                    }
            }
        });
        
        var GET = $.urlGet();
        if (GET["lid"]) {
            var param = {
                action : "get_info",
                lid : GET["lid"]
            }

            $.post("./lecture.server.php", param, function(data) {
                if (data == "0") {
                    alert("讲座不存在!");
                    return false;
                } 
                if (data == "-1") {
                    alert("请求信息不全!");
                    return false;
                }

                var lct_info = JSON.parse(data);
                var modal = $("#modal-details");

                modal.find("#lct_title").html(lct_info.title);
                modal.find("#lct_author").html(lct_info.lecture_author);
                modal.find("#lct_time").html(lct_info.time);
                modal.find("#lct_location").html(lct_info.location);
                modal.find("#lct_description").html(lct_info.description);
                modal.find(".lct_lid").data("lid", lct_info.lid);
                modal.find("#lct_slide").attr("href", lct_info.slide);

                if (lct_info.tag) {
                    var lct_tag = JSON.parse(lct_info.tag);
                    var html_tag = "";
                    for (var i=0, len=lct_tag.tag.length; i<len; i++) {
                        html_tag += '<label class="label label-info">' + lct_tag.tag[i] + '</label>';
                    };
                    modal.find("#lct_tag").html(html_tag);
                }

                if (lct_info.slide) {
                    modal.find("#lct_slide").show().val(lct_info.description);
                } else {
                    modal.find("#lct_slide").hide();
                }

                $("#modal-details").modal("show"); 
            });
        }
    
        $('#modal-edit button[type="submit"]').click(function() {
            var modal = $('#modal-edit');
            var tag_obj = {
                tag : modal.find("#lct_tag").val().split(",")
            };
            var param = {
                action : $(this).data("action"),
                lid : $(this).data("lid"),
                title : modal.find("#lct_title").val(),
                time : modal.find("#lct_time").val(),
                location : modal.find("#lct_location").val(),
                tag : JSON.stringify(tag_obj),
                slide : modal.find("#lct_slide").val(),
                description : modal.find("#lct_description").val()
            };
            console.log(param);
            if (!param.title) {
                alert("请填写讲座标题!");
                return false;
            }
            if (!param.time) {
                alert("请填写讲座时间!");
                return false;
            }
            if (!param.location) {
                alert("请填写讲座地点!");
                return false;
            }

            $.post("./lecture.server.php", param, function(data) {
                if (data == "1") {
                    if (!param.lid) {
                        alert("讲座信息发布成功！");
                    } else {
                        alert("讲座信息编辑成功！");
                    }
                    location.href = "./index.php";
                } else if (data == "-1") {
                    alert("讲座信息不全！");
                } else if (data == "-2") {
                    alert("该讲座不存在或已删除！");
                } else if (dat == "-3") {
                    alert("您不具有操作权限！");
                } else {
                    if (!param.lid) {
                        alert("讲座信息发布失败！");
                    } else {
                        alert("讲座信息编辑失败！");
                    }
                }
            });
        });

        $('[data-action="del"]').click(function() {
            var param = {
                action : "del",
                lid : $(this).data("lid")
            };

            if (!confirm("确定要删除该讲座吗？")) {
                return false;
            }

            $.post("./lecture.server.php", param, function (data) {
                if (data  == "1") {
                    alert("删除成功！");
                    location.href = "./index.php";
               } else if (data == "-1") {
                    alert("请求信息不全！");
                } else if (data == "-2") {
                    alert("该讲座不存在或已删除！");
                } else if (dat == "-3") {
                    alert("您不具有操作权限！");
                } else {
                    alert("删除失败！");
                }
            });
        });

        // 自动调整头像高度
        function resize_avatar() {
            var avatar = $('.lecture-details .avatar');
            avatar.height(avatar.width());
        }
        $(window).resize(resize_avatar);
        resize_avatar();

        // datatable
         $('[data-ride="datatables"]').each(function() {
            var oTable = $(this).dataTable({
                "order": [],
                "sDom": "t<'past-lecture-paginate-panel'p>",
                "sPaginationType": "full_numbers",
                "oLanguage": {
                    "sProcessing": "正在加载中......",
                    "sLengthMenu": "每页显示 _MENU_ 条记录",
                    "sZeroRecords": "对不起，查询不到相关数据！",
                    "sEmptyTable": "没有查询到任何记录！",
                    "sInfo": "当前显示 _START_ 到 _END_ 条，共 _TOTAL_ 条记录",
                    "sInfoFiltered": "数据表中共为 _MAX_ 条记录",
                    "sSearch": "搜索",
                    "oPaginate": {
                        "sFirst": "首页",
                        "sPrevious": "上一页",
                        "sNext": "下一页",
                        "sLast": "末页"
                    }
                }
            });
        });

         // 日期选择组件
        $('[data-toggle="datepicker"]').datetimepicker({format: "YYYY-MM-DD HH:mm:SS"});

    });
</script>
<{/block}>