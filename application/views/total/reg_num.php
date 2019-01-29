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
            <th colspan="9">注册用户</th>       
        </tr>
        <tr>
            <th colspan="3" align="left" width="30%">日期:</th>
            <td colspan="6">
                <input type="text" name="d1" id="d1" value="<?php echo $d1;?>" style="width:80px;"/> 
                -
                <input type="text" name="d2" id="d2" value="<?php echo $d2;?>" style="width:80px;"/> 
                
                <!--
                <input type="text" name="year" id="j_year" value="<?php echo $d[0];?>"/> 
                <input type="text" name="month" id="j_month" value="<?php echo $d[1];?>"/>
                <input type="text" name="day" id="j_day" value="<?php echo $d[2];?>"/>
                -->
                <input type="submit" id="j_search" value="查询"/>

            </td>  
        </tr>
         <tr>
            <th align="left" width="30%">profit_day</th>
            <td>day_reg_num</td>
            <td>total_reg_num</td>
            <td>total_login_num</td>
            <td>1_day_login</td>
            <td>3_day_login</td>
            <td>7_day_login</td>
            <td>15_day_login</td>
            <td>30_day_login</td>
        </tr>
        <?php foreach ($result as $v) {
            $dp1 = $day_reg[date('Y-m-d', strtotime($v['profit_day']) - 24 * 60 * 60 * 1)]; 
            $dp3 = $day_reg[date('Y-m-d', strtotime($v['profit_day']) - 24 * 60 * 60 * 3)]; 
            $dp7 = $day_reg[date('Y-m-d', strtotime($v['profit_day']) - 24 * 60 * 60 * 7)]; 
            $dp15 = $day_reg[date('Y-m-d', strtotime($v['profit_day']) - 24 * 60 * 60 * 15)]; 
            $dp30 = $day_reg[date('Y-m-d', strtotime($v['profit_day']) - 24 * 60 * 60 * 30)]; 
            //echo $dp1;
        ?> 
        <tr>
            <th align="left" width="30%"><?php echo $v['profit_day'];?></th>
            <th><?php echo number_format($v['day_reg_num']);?></th>
            <th><?php echo number_format($v['total_reg_num']);?></th>
            <th><?php echo number_format($v['total_login_num']);?></th>
            <th><?php echo number_format($v['1_day_login']) .' (' . round(intval($v['1_day_login']) / intval($dp1) * 100, 2) . '%)';?></th>
            <th><?php echo number_format($v['3_day_login']) .' (' . round(intval($v['3_day_login']) / intval($dp3) * 100, 2) . '%)';?></th>
            <th><?php echo number_format($v['7_day_login']) .' (' . round(intval($v['7_day_login']) / intval($dp7) * 100, 2) . '%)';?></th>
            <th><?php echo number_format($v['15_day_login']) .' (' . round(intval($v['15_day_login']) / intval($dp15) * 100, 2) . '%)';?></th>
            <th><?php echo number_format($v['30_day_login']) .' (' . round(intval($v['30_day_login']) / intval($dp30) * 100, 2) . '%)';?></th>
        </tr>
        <?php }?> 
        <?php if (count($result) <= 0) {
            echo '<tr><td colspan="9">没有数据</td></tr>';    
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
