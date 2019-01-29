<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php SITE_NAME?></title>
<link rel="stylesheet" href="<?php echo base_url() . 'css/common.css?v=' . CSS_VERSION?>" type="text/css" media="screen" />
<script type="text/javascript" src="<?php echo base_url() . 'js/jquery.js?v=' . JS_VERSION?>"></script>
<style type="text/css">
    .info{display: none;}
    .common_table_div input{width:40px;}
</style>
</head>
<body>
<div class="common_table_div" style="width:600px;">
    <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#E8E8E8" id="j_info_table">
        <tr>
            <th colspan="2">日志信息</th>       
        </tr>
        <tr>
            <th align="left" width="30%">日期:</th>
            <td>
                <input type="text" id="j_year" value="<?php echo date('Y');?>"/> 
                <input type="text" id="j_month" value="<?php echo date('m');?>"/>
                <input type="text" id="j_day" value="<?php echo date('d');?>"/>
                <input type="button" id="j_search" value="查询"/>
            </td>  
        </tr>
    </table>

    <div id="j_log_ret"></div>
</div>
<script type="text/javascript">
$(function(){

    //查询
    $('#j_search').click(function(){
        view();
    })

    function view() {
        var year = $('#j_year').attr('value');
        var month = $('#j_month').attr('value');
        var day = $('#j_day').attr('value');
        
        if ($.trim(year) !== '' && $.trim(month) !== '' && $.trim(day) !== '') {
            $.ajax({
                type: 'get',
                url: 'viewlog/view',
                data: {year:year, month:month, day:day},
                dataType: 'text',
                success: function(ret) {
                    $('.log').empty();
                    if (ret.length > 0) {
                        var arr = ret.split('ERROR');
                        var l = arr.length;
                        var html = [];
                        
                        for ( var i=0; i<l; i++ ) {
                           html.push('<tr class="log"><td colspan="2">' + arr[i] + '</td></tr>'); 
                        }

                        $('#j_info_table').append(html.join(''));
                    } else {
                        $('#j_info_table').append('<tr class="log"><td colspan="2">没有记录</td></tr>');
                    }
                }
            });
        }
    }


});
</script>
</body>
</html>
