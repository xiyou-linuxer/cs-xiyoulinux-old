<{extends file="frame.tpl"}>

<{block name="stylesheet" append}>

    <link rel="stylesheet" href="<{$site_domain}>/js/chosen/chosen.css" type="text/css" />

<{/block}>

<{block name="content"}>

    <!-- 管理员删除用户界面 -->
    <div class="row">
    	<section class="panel panel-default">
    		<div class="panel-body">
    			<form class="form-horizontal" method="post" action="server/admin_deluser.php">
    				<h4 class="m-t-none">删除用户</h4>
    				<div class="line line-dashed b-b line-lg pull-in"></div>
    				<div class="panel-body">
    					<form class="form-inline" role="form">
    						<div class="form-group">
    							<label class="col-sm-2 control-label">选择级别</label>
    							<div class="col-sm-4">
                                    <select style="width:260px" class="chosen-select" id="grade-select">
                                        <!--<optgroup label="2004 - 2020" id="grade-list">
                                            <option value="2004">2004级</option>
                                            <option value="2005">2005级</option>
                                            <option value="2006">2006级</option>
                                            <option value="2007">2007级</option>
                                            <option value="2008">2008级</option>
                                            <option value="2009">2009级</option>
                                            <option value="2010">2010级</option>
                                            <option value="2011">2011级</option>
                                            <option value="2012">2012级</option>
                                            <option value="2013">2013级</option>
                                            <option value="2014">2014级</option>
                                            <option value="2015">2015级</option>
                                        </optgroup>-->
                                    </select>
    							</div>
    							<label class="col-sm-2 control-label">选择成员</label>
    							<div class="col-sm-4">
                                    <select style="width:260px" class="chosen-select" id="member-select">
                                        <!--<optgroup label="04级成员" id="member-list">
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
                                    <button type="button" class="btn btn-danger" id="submit">确认删除</button>
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
            $.post('<{$site_domain}>/server/admin.server.php',
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

                    $.post('<{$site_domain}>/server/admin.server.php',
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
                    )

                    $("#grade-select").change(function() {
                            $.post('<{$site_domain}>/server/admin.server.php',
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
                        }
                    );

                    $("#submit").click(function(){
                        $.post('<{$site_domain}>/server/admin.server.php',
                            {
                                action:'deleteUser',
                                uid:$('#member-select').val()
                            },
                            function(info){
                                //console.log($('#member-select').val());
                                if (info == 1){
                                    alert('删除成功');
                                }else{
                                    alert('删除失败');
                                }
                                location.reload();
                            }
                        );
                    });
                }
            )

        });

    </script>

<{/block}>