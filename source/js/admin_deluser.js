/**
 * Created by andrew on 14-12-27.
 */
$(document).ready(
    $.post(
        'server/admin_tool.server.php',
        {
            func:'getAllGrade'
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
                'server/admin_tool.server.php',
                {
                    func:'getMemberByGrade',
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
                    $.post(
                        'server/admin_tool.server.php',
                        {
                            func:'getMemberByGrade',
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
                $.post(
                    'server/admin_tool.server.php',
                    {
                        func:'deleteUser',
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

);