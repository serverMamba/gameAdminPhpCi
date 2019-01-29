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
<?php echo $query_time;?>
<div class="common_table_div" style="width:600px;">
    <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#E8E8E8" id="j_info_table">
        <tr>
            <th colspan="6">查用户加减分</th>       
        </tr>
        <tr>
            <th colspan="2" align="left" width="30%">User ID</th>
            <td colspan="4">
                <form action="" method="get" >
                    uid: <input type="text" name="account" value="<?php echo $account;?>"/><br /> 
                    from time:
                    <select name="query_time">
                        <?php
                        for ($i=0; $i<10; $i++) {
                            if ($i == 0) {
                                $cur_time = date('Y-m-d'); 
                            } else {
                                $cur_time = date('Y-m-d', strtotime("-$i day"));
                            }
                        ?>
                        <option value="<?php echo -$i;?>" <?php if($query_time == -$i){echo 'selected';}?>><?php echo $cur_time;?></option>
                        <?php }?>
                    </select>
                    <br /><input type="submit" id="j_search" value="查询"/>
                    <input type="hidden" name="offset" value="0"/>
                    <?php 
                    if(!empty($account)) {
                        echo '第' . ($offset + 1) . '页';    
                    } else {
                    ?>
                    <?php
                    }?>
                </form>
                <?php if ($haveNextPage) {?>
                <form action="" method="get" >
                    <input type="hidden" name="account" value="<?php echo $account;?>"/> 
                    <input type="hidden" name="offset" value="<?php echo $offset + 1?>"/>
                    <input type="hidden" name="query_time" value="<?php echo $query_time;?>"/>
                    <input type="submit" value="下一页"/>
                </form>
                <?php }?>
                <?php if ($offset > 0) {?>
                <form action="" method="get" >
                    <input type="hidden" name="account" value="<?php echo $account;?>"/> 
                    <input type="hidden" name="offset" value="<?php echo $offset - 1;?>"/>
                    <input type="hidden" name="query_time" value="<?php echo $query_time;?>"/>
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
