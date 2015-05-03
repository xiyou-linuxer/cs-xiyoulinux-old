<{extends file="frame.tpl"}>

<{block name="stylesheet" append}>

    <link rel="stylesheet" href="<{$site_domain}>/js/chosen/chosen.css" type="text/css" />

<{/block}>

<{block name="content"}>

    <!-- 管理员权限移交页面 -->
    <div class="row">
        <section class="panel panel-default">
            <div class="panel-body">
                <form class="form-horizontal" method="post">
                    <h4 class="m-t-none">权限移交</h4>
                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="panel-body">
                        <form class="form-inline" role="form" action="server/admin_reflash.php">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">选择级别</label>
                                <div class="col-sm-4">
                                    <select style="width:260px" class="chosen-select" id="grade-select">
                                        <!--<optgroup label="2004 - 2020">
                                            <option value="CT">2004级</option>
                                            <option value="CT">2005级</option>
                                            <option value="CT">2006级</option>
                                            <option value="CT">2007级</option>
                                            <option value="CT">2008级</option>
                                            <option value="CT">2009级</option>
                                            <option value="CT">2010级</option>
                                            <option value="CT">2011级</option>
                                            <option value="CT">2012级</option>
                                            <option value="CT">2013级</option>
                                            <option value="CT">2014级</option>
                                            <option value="CT">2015级</option>
                                            <option value="CT">2016级</option>
                                            <option value="CT">2017级</option>
                                            <option value="CT">2018级</option>
                                            <option value="CT">2019级</option>
                                            <option value="CT">2020级</option>
                                        </optgroup>-->
                                    </select>
                                </div>
                                <label class="col-sm-2 control-label">选择成员</label>
                                <div class="col-sm-4">
                                    <select style="width:260px" class="chosen-select" id="member-select">
                                        <!--<optgroup label="04级成员">
                                            <option value="CT">王聪</option>
                                            <option value="CT">孔建军</option>
                                            <option value="CT">辛龙</option>
                                        </optgroup>-->
                                    </select>
                                </div>
                            </div>
                            <div class="line line-dashed b-b line-lg pull-in"></div>

                            <div class="form-group">
                                <div class="col-sm-6"></div>
                                <div class="col-sm-4 col-sm-offset-2">
                                    <button type="button" id="submit" class="btn btn-success">确认移交</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </form>
            </div>
        </section>
    </div>

<{/block}>

<{block name="scripts" append}>
    
    <script type="text/javascript" src="<{$site_domain}>/js/chosen/chosen.jquery.min.js"></script>
    
    <script type="text/javascript">

        /**
         * Created by andrew on 14-12-27.
         */
        $(document).ready(function() {
            $.post(
                '<{$site_domain}>/server/admin.server.php',
                {
                    action:'getAllGrade'
                },
                function(info){
                    $('grade-select').html('');
                    //console.log(info);
                    var data = $.parseJSON(info);
                    $(data).each(function (i, item) {
                        if (i == 0){
                            $('<optgroup label="入学年份"><option value="' + item.grade + '">' + item.grade + '级</option>').appendTo('#grade-select');
                        }else {
                            $('<option value="' + item.grade + '">&nbsp&nbsp&nbsp' + item.grade + '级</option>').appendTo('#grade-select');
                        }
                    });
                    $('</optgroup>').appendTo('#grade-select');
                    $('#grade-select').trigger('chosen:updated');

                    $.post(
                        '<{$site_domain}>/server/admin.server.php',
                        {
                            action:'getMemberByGrade',
                            grade:$('#grade-select').val()
                        },
                        function (info) {
                            //console.log(info);
                            var data = $.parseJSON(info);
                            $('#member-select').html('');
                            $(data).each(function (i, item) {
                                if (i == 0){
                                    $('<optgroup label="成员姓名"><option value="' + item.uid + '">' + item.name + '</option>').appendTo('#member-select');
                                }else {
                                    $('<option value="' + item.uid + '">&nbsp&nbsp&nbsp' + item.name + '</option>').appendTo('#member-select');
                                }
                            });
                            $('</optgroup>').appendTo('#member-select');
                            $('#member-select').trigger('chosen:updated');

                        }
                    );

                    $("#grade-select").change(function() {
                        $.post(
                            '<{$site_domain}>/server/admin.server.php',
                            {
                                action:'getMemberByGrade',
                                grade:$('#grade-select').val()
                            },
                            function (info) {
                                //console.log($('#member-select').val());
                                var data = $.parseJSON(info);
                                $('#member-select').html('');
                                $(data).each(function (i, item) {
                                    if (i == 0){
                                        $('<optgroup label="成员姓名"><option value="' + item.uid + '">' + item.name + '</option>').appendTo('#member-select');
                                    }else {
                                        $('<option value="' + item.uid + '">&nbsp&nbsp&nbsp' + item.name + '</option>').appendTo('#member-select');
                                    }
                                });
                                $('</optgroup>').appendTo('#member-select');
                                $('#member-select').trigger('chosen:updated');

                            }
                        );
                    });

                    $("#submit").click(function(){
                        $.post(
                            '<{$site_domain}>/server/admin.server.php',
                            {
                                action:'deliver_privilege',
                                next_uid: $('#member-select').val(),
                                now_uid: get_cookie("uid")
                            },
                            function(info){
                                console.log(info);
                                if (info == 1){
                                    alert('移交成功');
                                }else{
                                    alert('移交失败');
                                }
                            }
                        );
                    });
                }
            );

        });

    </script>

<{/block}>
