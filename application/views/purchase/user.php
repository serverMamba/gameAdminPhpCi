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
<?php $d = split('-', $strDate);?>
<div class="common_table_div" style="width:600px;">
        <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#E8E8E8" id="j_info_table">
            <tr>
                <th colspan="5">查询用户购买记录</th>       
            </tr>
            <tr>
                <th colspan="1" align="left">查询条件:</th>
                <td colspan="4">
                    <form action="" method="get">
                        <input type="text" name="account" value="<?php echo $account;?>" placeholder="userId" style="width:60px;"/> 
                        <input type="text" name="year" id="j_year" value="<?php echo $d[0];?>"/> 
                        <input type="text" name="month" id="j_month" value="<?php echo $d[1];?>"/>
                        <input type="text" name="day" id="j_day" value="<?php echo $d[2];?>" /> 
                        <input type="submit" id="j_search" value="查询"/>
                        <input type="hidden" name="offset" value="0"/>
                        <select name="type">
                        <?php foreach($statistics as $k=>$v) {?>
                            <option value="<?php echo $k;?>" <?php if($k == $type){ echo 'selected';}?>><?php echo $v;?></option>
                        <?php }?>
                        </select>
                        <?php 
                        if(!empty($result)) {
                            echo '第' . ($offset + 1) . '页';    
                        }?>
                    </form>

                    <?php if ($haveNextPage) {?>
                        <form action="" method="get" >
                            <input type="hidden" name="year" value="<?php echo $d[0];?>"/> 
                            <input type="hidden" name="month" value="<?php echo $d[1];?>"/> 
                            <input type="hidden" name="day" value="<?php echo $d[2];?>"/> 
                            <input type="hidden" name="type" value="<?php echo $type?>"/>
                            <input type="hidden" name="account" value="<?php echo $account?>"/>
                            <input type="hidden" name="offset" value="<?php echo $offset + 1?>"/>
                            <input type="submit" value="下一页"/>
                        </form>
                    <?php }?>
                    <?php if ($offset > 0) {?>
                    <form action="" method="get" >
                        <input type="hidden" name="year" value="<?php echo $d[0];?>"/> 
                        <input type="hidden" name="month" value="<?php echo $d[1];?>"/> 
                        <input type="hidden" name="day" value="<?php echo $d[2];?>"/> 
                        <input type="hidden" name="type" value="<?php echo $type?>"/>
                        <input type="hidden" name="account" value="<?php echo $account?>"/>
                        <input type="hidden" name="offset" value="<?php echo $offset - 1;?>"/>
                        <input type="submit" value="上一页"/>
                    </form>
                    <?php }?>
                </td>  
            </tr>
            <tr>
                <th>用户id</th>
                <th>类型</th>
                <th>筹码数</th>
                <th>来源</th>
                <th>时间</th>
            </tr>
            <?php foreach ($result as $v) {?> 
            <tr>
                <th><?php echo $v['0'];?></th>
                <td><?php echo $statistics[$v['1']];?></td>
                <td><?php echo number_format($v['2']);?></td>
                <td><?php echo $v['3'];?></td>
                <td><?php echo $v['4'];?></td>
            </tr>
            <?php }?> 
            <?php if (count($result) <= 0) {
                echo '<tr><td colspan="5">没有数据</td></tr>';        
            }?>
        </table>
</div>
<script type="text/javascript">
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
