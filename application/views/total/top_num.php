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
    <form action="" method="get" >
    <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#E8E8E8" id="j_info_table">
        <tr>
            <th colspan="3">num数目</th>       
        </tr>
        <tr>
            <th align="left" width="30%">profit_day</th>
            <th>type</th>
            <th>total_num</th>
        </tr>

        <?php foreach ($result as $v) {?> 
        <tr>
            <th align="left" width="30%"><?php echo $v['profit_day'];?></th>
            <td><?php echo $v['type'];?></td>
            <td><?php echo number_format($v['total_num']);?></td>
        </tr>
        <?php }?> 
        <?php if (count($result) <= 0) {
            echo '<tr><td colspan="3">没有数据</td></tr>';    
        }?> 
        </tr>
    </table>
    </form>

    <div id="j_log_ret"></div>
</div>
<script type="text/javascript">
</script>
</body>
</html>
