<{extends file="frame.tpl"}>

<{block name="stylesheet" append}>

    <link rel="stylesheet" href="<{$site_domain}>/js/chosen/chosen.css" type="text/css" />

<{/block}>

<{block name="content"}>

    <!-- 管理员应用管理页面 -->
    <div class="row">
        <section class="panel panel-default">
            <div class="panel-body">

                <h4 class="m-t-none">
                    应用管理
                    <button class="btn btn-info" id="flush-btn">
                            <a href="#">刷新列表</a>
                    </button>
                <h4>
                    
            </div>

            <div class="line line-dashed b-b line-lg pull-in col-sm-12"></div>

            <div class="panel-body">

                <form class="form-inline col-sm-6" role="form" >
                    <div class="form-group">
                        <label class="col-sm-2 control-label">下线</label>
                        <div class="col-sm-10">
                            <select name="onlineapp" style="width:260px" class="chosen-select" id="online-select">
                            <!--    <optgroup label="目前运行应用">
                                    <option value="CT"><{$onlineapp[times]}></option>
                                    <option value="CT">招聘</option>
                                    <option value="CT">活动</option>
                                </optgroup>-->
                            </select>
                        </div>
                    </div>
                    <div class="line line-dashed b-b line-lg pull-in col-sm-12"></div>

                    <div class="col-sm-offset-3">
                        <button type="button" id="offline-btn" class="btn btn-danger">确认下线</button>
                    </div>
                </form>

                <form class="form-inline col-sm-6" role="form" >
                    <div class="form-group">
                        <label class="col-sm-2 control-label">上线</label>
                        <div class="col-sm-10">
                            <select name="offlineapp" style="width:260px" class="chosen-select" id="offline-select">
                                <!--<optgroup label="目前下线应用">
                                    <option value="CT">项目</option>
                                    <option value="CT">基金</option>
                                </optgroup>-->
                            </select>
                        </div>
                    </div>
                    <div class="line line-dashed b-b line-lg pull-in col-sm-12"></div>

                    <div class="col-sm-3 col-sm-offset-3">
                        <button type="button" id="online-btn" class="btn btn-success">确认上线</button>
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
         * Created by andrew on 15-1-23.
         */

        $(document).ready(function() {
            init(),
            $('#flush-btn').click(function(){
                $.post(
                    '<{$site_domain}>/server/admin.server.php',
                    {
                        action:'flush'
                    },
                    function(data){
                        if (data == 1){
                            alert('应用刷新成功');
                        }else{
                            alert('应用刷新失败');
                        }
                    }
                );
            }),
            $('#offline-btn').click(function () {
                $.post(
                    '<{$site_domain}>/server/admin.server.php',
                    {
                        action:'changeAppStatus',
                        name:$('#online-select').val(),
                        status:0
                    },
                    function(data){
                   // console.log('return: ' + data);
                        if (data == 1){
                            alert($('#online-select').find("option:selected").text().trim() + ' 下线成功');
                        }else{
                            alert($('#online-select').find("option:selected").text().trim() + ' 下线失败');
                        }
                       location.reload();
                    }
                );
            }),
            $('#online-btn').click(function(){
                $.post(
                    '<{$site_domain}>/server/admin.server.php',
                    {
                        action:'changeAppStatus',
                        name:$('#offline-select').val(),
                        status:1
                    },
                    function (data) {
                        if (data == 1){
                            alert($('#offline-select').find("option:selected").text().trim() + ' 上线成功');
                        }else{
                            alert($('#offline-select').find("option:selected").text().trim() + '上线失败');
                        }
                        location.reload();
                    }
                );
            })
        });

        String.prototype.trim = function(){
            return this.replace(/(^\s*)|(\s*$)/g, '');
        }

        function init(){
            $.ajax({
                type:'POST',
                url:'<{$site_domain}>/server/admin.server.php',
                data:{
                    action:'getAppList'
                },
                success: function(data){
        //        console.log("data :" + data);
                    var info = $.parseJSON(data);
                    $(info).each(function (i, item) {

                        online = item.online;
                        offline = item.offline;
                        $(online).each(function(i, value){
                            if (i == 0){
                                $('<optgroup label="目前运行应用"><option value="' + value.name + '">' + value.dis_name + '</option>').appendTo('#online-select');
                            }else {
                                $('<option value="' + value.name + '">&nbsp&nbsp&nbsp' + value.dis_name + '</option>').appendTo('#online-select');
                            }
                        });
                        if (online!='' && typeof(online)!='undefined' && online!=null){
                                $('</optgroup>').appendTo('#online-select');
                                $('#online-select').trigger('chosen:updated');
                        }
                        $(offline).each(function(i, value){
                            if (i == 0){
                                $('<optgroup label="目前下线应用"><option value="' + value.name + '">' + value.dis_name + '</option>').appendTo('#offline-select');
                            }else {
                                $('<option value="' + value.name + '">&nbsp&nbsp&nbsp' + value.dis_name + '</option>').appendTo('#offline-select');
                            }
                            if (offline!='' && typeof(offline)!='undefined' && offline!=null){
                                $('</optgroup>').appendTo('#offline-select');
                                $('#offline-select').trigger('chosen:updated');
                            }
                        });

                    });
                }
            });
        }

    </script>

<{/block}>
