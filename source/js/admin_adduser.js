/**
 * Created by andrew on 14-12-27.
 */

$(document).ready(function(){

    /**
     * 检测手机号是否输入正确
     */
    $("input[name='telphone']").focusout(function(){
//                console.log("val: " + $("input[name='telphone']").val());
  //              console.log("boolean: " + checkMailCanUse($("input[name='telphone']").val()));

        if (checkPhoneCanUse($("input[name='telphone']").val()) != 1){
            if ($("input[name='telphone']").nextAll().html() == undefined){
                $("input[name='telphone']").after('<label class=" control-label" name="warn"><p class="text-danger">该手机号不可使用，请重新输入。</p></label>');
            }
        }else{
            $("input[name='telphone']").nextAll().remove();
        }
    });

    /**
     * 检测邮箱是否输入正确
     */
    $("input[name='email']").focusout(function(){
//        console.log("val: " + $("input[name='email']").val());
  //      console.log("boolean: " + checkMailCanUse($("input[name='email']").val()));
        if (checkMailCanUse($("input[name='email']").val()) != 1){
            if ($("input[name='email']").nextAll().html() == undefined){
                $("input[name='email']").after('<label class=" control-label" name="warn"><p class="text-danger">该邮箱不可使用，请重新输入。</p></label>');
            }
        }else{
            $("input[name='email']").nextAll().remove();
        }
    });

    $("#adduser").click(function(){
        $.post("server/admin_tool.server.php",
            {
                func:'addUser',
                name:$('[name=name]').val(),
                native:$('[name=native] option:selected').text(),
                major:$('[name=major] option:selected').text(),
                sex:$('[name=sex]').parent('.active').children('input').val(),
                grade:$('[name=grade] option:selected').text(),
                qq:$('[name=QQnum]').val(),
                mail:$('[name=email]').val(),
                tel:$('[name=telphone]').val()
            },
            function(data){
                if (data == 1) {
                    alert("" + $('[name=name]').val() + '信息添加成功');
                }else{
                    alert("" + $('[name=name]').val() + '信息添加失败')
                }
            }
        );
    });
});

/**
 * 检测邮箱是否可用
 * @param mail
 * @returns {number} 1 可用; 其余不可用
 */
function checkMailCanUse(mail){
    var isok = 0;
    $.ajax({
        type:'POST',
        url:"server/admin_tool.server.php",
        async:false,
        data: {
            func:'checkMailCanUse',
            mail: mail
        }
        ,success: function (data) {
    //        console.log("data: " + data)
            isok = data;
        }
    });
    return isok;
}

/**
 * 检测邮箱是
 * @param phone 手机号
 * @returns {number} 1可用 其余不可用
 */
function checkPhoneCanUse(phone){
    var isok = 0;
    $.ajax({
        type:'POST',
        url:"server/admin_tool.server.php",
        async:false,
        data: {
            func:'checkPhoneCanUse',
            phone:phone
        }
        ,success: function (data) {
            console.log("data: " + data)
            isok =  data;
        }
    });
    return isok;
}
