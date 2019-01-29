<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php SITE_NAME?></title>
<link rel="stylesheet" href="<?php echo base_url() . 'css/common.css?v=' . CSS_VERSION?>" type="text/css" media="screen" />
<script type="text/javascript" src="<?php echo base_url() . 'js/jquery.js?v=' . JS_VERSION?>"></script>
<style type="text/css">
    .info{display: none;}
</style>
</head>
<body>
<div class="common_table_div" style="width:600px;">
    <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#E8E8E8" id="j_info_table">
        <tr>
            <th colspan="2">用户信息</th>       
        </tr>
        <tr>
            <th align="left" width="30%">用户帐号:</th>
            <td>
                <input type="text" placeholder="输入6位id或邮箱" id="j_account"/> 
                <input type="button" value="查询" id="j_search" />
            </td>  
        </tr>
        <tr id="j_update_wrap" style="display:none;">
            <th align="left" width="30%">
                <input type="text" placeholder="修改字段名或[pass]" id="j_update_key" /> 
            </th>
            <td>
                <input type="text" placeholder="修改字段值" id="j_update_value"/> 
                <input type="text" placeholder="备注" id="j_comment_value"/> 
                <input type="button" id="j_update" value="更新" />
            </td>  
        </tr>
    </table>
</div>
<script type="text/javascript">
$(function(){

    var user_exist = false;

    //查询
    $('#j_search').click(function(){
        selectUserInfo();
    })


    $('#j_update').click(function(){
        updateUserInfo();
    })

    function updateUserInfo() {
        var account = $('#j_account').attr('value');
        var key = $('#j_update_key').attr('value');
        var val = $('#j_update_value').attr('value');
        var comment = $('#j_comment_value').attr('value');

        if ($.trim(key) !== '') {
            $.ajax({
                type: 'get',
                url: 'user_new/update_user_info',
                data: {account:account, key:key, val:val, comment:comment},
                dataType: 'json',
                success: function(ret) {
                    if (ret.result == 1) {
                        alert(ret.msg);
                    } else {
                        alert(ret.msg);
                    }
                }
            });
        }
    }


    function selectUserInfo() {
        var account = $('#j_account').attr('value');
        var table = $('#j_info_table');

        $.ajax({
            type: 'get',
            url: 'user_new/get_user_info',
            data: 'account=' + account,
            dataType: 'json',
            success: function(ret) {
                table.find('.add').empty();
                if (ret.result == 1) {
                    var data = ret.data[0];
                    var html = []; 
                    for (var each in data) {
                        html.push('<tr class="add"><th align="left" width="30%">' + each + '</th><td>' + data[each] + '</td></tr>');
                    }
                    table.append(html.join(''));
                    $('#j_update_wrap').show();
               } else {
                    alert(ret.msg);
                    $('#j_update_wrap').hide();
               }
            }, 
            error: function() {

            }
        });
    }

});


function supports_input_placeholder(){
    var i = document.createElement("input");
    return "placeholder" in i;
}

// 让不支持placeholder的浏览器实现此属性
$(function(){
        var input_placeholder = $("input[placeholder],textarea[placeholder]");

        if (input_placeholder.length !== 0 && !supports_input_placeholder()) {

        var color_place = "#A9A9A9";    

        $.each(input_placeholder, function(i){
            var isUserEnter = 0; // 是否为用户输入内容,placeholder允许用户的输入和默认内容一样
            var ph = $(this).attr("placeholder");
            var curColor = $(this).css("color");

            $(this).val(ph).css("color", color_place);

            $(this).focus(function(){
                if ($(this).val() == ph && !isUserEnter) $(this).val("").css("color", curColor);
                })
            .blur(function(){
                if ($(this).val() == "") {
                $(this).val(ph).css("color", color_place);
                isUserEnter = 0;
                }
                })
            .keyup(function(){
                if ($(this).val() !== ph) isUserEnter = 1;
                });

            });
        }
})

</script>
</body>
</html>
