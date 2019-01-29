<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php SITE_NAME?></title>
<link rel="stylesheet" href="<?php echo base_url() . 'css/common.css?v=' . CSS_VERSION?>" type="text/css" media="screen" />
<!--
<link rel="stylesheet" href="<?php echo base_url() . 'css/bootstrap.min.css?v=' . CSS_VERSION?>" type="text/css" />
-->
<script type="text/javascript" src="<?php echo base_url() . 'js/jquery.js?v=' . JS_VERSION?>"></script>
<script type="text/javascript" src="<?php echo base_url() . 'js/bootstrap.min.js?v=' . JS_VERSION?>"></script>
<style type="text/css">

</style>
</head>
<body>
<div class="common_table_div" style="width:600px;">
    <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#E8E8E8" >
        <tr>
            <th align="left" width="30%">添加ip:</th>
            <td>
                <input type="text" id="j_addip"/> 
                <input type="button" value="添加" id="j_addipbtn" />
            </td>  
        </tr>
    </table>
    
    <!--
    <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#E8E8E8" >
        <tr>
            <th align="left" width="30%">删除ip:</th>
            <td>
                <input type="text" id="j_delIP"/> 
                <input type="button" value="添加" id="j_delipbtn" />
            </td>  
        </tr>
    </table>
    -->

    <br />
    <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#E8E8E8" >
        <tr>
            <th colspan="2">iptables</th>       
        </tr>
        <?php foreach ($list as $l) {?>
        <tr>
            <th align="left" width="30%"><?php echo $l[0]?></th>
            <td>
                <input type="button" value="删除" class="delIPBtn" rel="<?php echo $l[0];?>"/>
            </td>
        </tr>
        <?php }?>
    </table>
</div>
<script>
$(function(){

    $('#j_addipbtn').click(function(){
        var ip = $('#j_addip').val();
        addIP(ip);
    })
    

    $('#j_delipbtn').click(function(){
        var ip = $('#j_delIP').val();
        delIP(ip);
    })

    $('.delIPBtn').click(function(){
        var ip =$(this).attr('rel');
        delIP(ip);
    })

    function addIP(ip) {
        $.ajax({
            url: 'iptables/add',
            type: 'get',
            data: {'ip': ip},
            dataType: 'json',
            success: function(ret) {
                if (ret.result == 1) {
                    alert(ret.msg);
                    window.location.reload();
                } else {
                    alert(ret.msg);
                }
            }
        })
    }

    function delIP(ip) {
        $.ajax({
            url: 'iptables/del',
            type: 'get',
            data: {'ip': ip},
            dataType: 'json',
            success: function(ret) {
                if (ret.result == 1) {
                    alert(ret.msg);
                    window.location.reload();
                } else {
                    alert(ret.msg);
                }
            }
        })
    }



})
</script>
</body>
</html>
