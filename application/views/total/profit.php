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
    <form action="" method="get" >
    <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#E8E8E8" id="j_info_table">
        <tr>
            <th colspan="4">净分统计</th>       
        </tr>
        <tr>
            <th colspan="1" align="left" width="30%">日期:</th>
            <td colspan="3">
                <input type="text" name="year" id="j_year" value="<?php echo $d[0];?>"/> 
                <input type="text" name="month" id="j_month" value="<?php echo $d[1];?>"/>
                <input type="text" name="day" id="j_day" value="<?php echo $d[2];?>"/>
                <input type="submit" id="j_search" value="查询"/>
            </td>  
        </tr>
        <tr>
            <th align="left" width="30%">profit_day</th>
            <th>type</th>
            <th>item</th>
            <th>total_num</th>
        </tr>
        <?php foreach ($result as $v) {?> 
        <tr>
            <th align="left" width="30%"><?php echo $v['profit_day'];?></th>
            <td><?php echo $v['type'];?></td>
            <td><?php echo $v[item]?><?php echo array_key_exists($v[item], $statistics) ? $statistics[$v[item]] : $v[item];?></td>
            <td><?php echo number_format($v['total_num']);?></td>
        </tr>
        <?php }?> 
        <?php if (count($result) <= 0) {
            echo '<tr><td colspan="4">没有数据</td></tr>';    
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
