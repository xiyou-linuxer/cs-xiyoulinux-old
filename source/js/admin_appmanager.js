/**
 * Created by andrew on 15-1-23.
 */

$(document).ready(
    init(),
    $('#flush-btn').click(function(){
            $.post(
                    'server/admin_tool.server.php',
                    {
                        func:'flush'
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
            'server/admin_tool.server.php',
            {
                func:'changeAppStatus',
                name:$('#online-select').val(),
                status:0
            },
            function(data){
           // console.log('return: ' + data);
                if (data == 1){
                    alert($('#online-select').text().trim() + ' 下线成功');
                }else{
                    alert($('#online-select').val().trim() + ' 下线失败');
                }
               location.reload();
            }
        );
    }),
    $('#online-btn').click(function(){
        $.post(
            'server/admin_tool.server.php',
            {
                func:'changeAppStatus',
                name:$('#offline-select').val(),
                status:1
            },
            function (data) {
                if (data == 1){
                    alert($('#offline-select').text().trim() + ' 上线成功');
                }else{
                    alert($('#offline-select').text().trim() + '上线失败');
                }
                location.reload();
            }
        );
    })
);

String.prototype.trim = function(){
        return this.replace(/(^\s*)|(\s*$)/g, '');
}

function init(){
    $.ajax({
        type:'POST',
        url:'server/admin_tool.server.php',
        data:{
            func:'getAppList'
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
