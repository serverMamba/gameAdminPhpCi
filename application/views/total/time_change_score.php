<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php SITE_NAME?></title>
<link rel="stylesheet" href="<?php echo base_url() . 'css/common.css?v=' . CSS_VERSION?>" type="text/css" media="screen" />
<script type="text/javascript" src="<?php echo base_url() . 'js/jquery.js?v=' . JS_VERSION?>"></script>
<style type="text/css">
    .info{display: none;}
    .common_table_div input.w40{width:40px;}
</style>
</head>
<body>
<?php
$s = split(' ', $strDate);
$s0 = split('-', $s[0]);
$s1 = split(':', $s[1]);
?>
<div class="common_table_div" style="width:600px;">
    <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#E8E8E8" id="j_info_table">
        <tr>
            <th colspan="6">查时间点加减分</th>       
        </tr>
        <tr>
            <th colspan="1" align="left" width="30%">时间点</th>
            <td colspan="5">
                <form action="" method="get" >
                    <input class="w40" type="text" name="year" value="<?php echo $s0[0];?>"/>－ 
                    <input class="w40" type="text" name="month" value="<?php echo $s0[1];?>"/>－ 
                    <input class="w40" type="text" name="day" value="<?php echo $s0[2];?>"/>&nbsp; 
                    <input class="w40" type="text" name="hour" value="<?php echo $s1[0];?>"/> ：
                    <input class="w40" type="text" name="minute" value="<?php echo $s1[1];?>"/> ： 
                    <input class="w40" type="text" name="second" value="<?php echo $s1[2];?>"/> 
                    <input class="w40" type="submit" id="j_search" value="查询"/>
                    <input class="w40" type="hidden" name="offset" value="0"/>
                    <?php 
                        echo '第' . ($offset + 1) . '页';    
                    ?>
                </form>
                <?php if ($haveNextPage) {?>
                <form action="" method="get" >
                    <input type="hidden" name="year" value="<?php echo $s0[0];?>"/> 
                    <input type="hidden" name="month" value="<?php echo $s0[1];?>"/> 
                    <input type="hidden" name="day" value="<?php echo $s0[2];?>"/> 
                    <input type="hidden" name="hour" value="<?php echo $s1[0];?>"/>
                    <input type="hidden" name="minute" value="<?php echo $s1[1];?>"/> 
                    <input type="hidden" name="second" value="<?php echo $s1[2];?>"/> 
                    <input type="hidden" name="offset" value="<?php echo $offset + 1?>"/>
                    <input type="submit" value="下一页"/>
                </form>
                <?php }?>
                <?php if ($offset > 0) {?>
                <form action="" method="get" >
                    <input type="hidden" name="year" value="<?php echo $s0[0];?>"/> 
                    <input type="hidden" name="month" value="<?php echo $s0[1];?>"/> 
                    <input type="hidden" name="day" value="<?php echo $s0[2];?>"/> 
                    <input type="hidden" name="hour" value="<?php echo $s1[0];?>"/>
                    <input type="hidden" name="minute" value="<?php echo $s1[1];?>"/> 
                    <input type="hidden" name="second" value="<?php echo $s1[2];?>"/> 
                    <input type="hidden" name="offset" value="<?php echo $offset - 1;?>"/>
                    <input type="submit" value="上一页"/>
                </form>
                <?php }?>
            </td>  
        </tr>
        <tr>
            <th>用户名</th>
            <th>增加筹码数</th>
            <th>减少筹码数</th>
            <th>总筹码数</th>
            <th>类型</th>
            <th>时间</th>
        </tr>
        <?php foreach ($result as $v) {?> 
        <tr>
            <td><?php echo $v[0];?></td>
            <td><?php echo number_format($v[1]);?></td>
            <td><?php echo number_format($v[2]);?></td>
            <td><?php echo number_format($v[3]);?></td>
            <td><?php echo array_key_exists($v[4], $statistics) ? $statistics[$v[4]] : $v[4];?></td>
            <td><?php echo $v[5];?></td>
        </tr>
        <?php }?> 
        <?php if (count($result) <= 0) {
            echo '<tr><td colspan="6">没有数据</td></tr>';    
        }?> 
        </tr>
    </table>

    <div id="j_log_ret"></div>
</div>
<script type="text/javascript">
</script>
</body>
</html>
