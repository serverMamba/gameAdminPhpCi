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
    <form action="" method="get">
        <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#E8E8E8" >
            <tr>
                <th colspan="2">插入一条购买记录</th>
            </tr>
            <tr>
                <th align="left" width="30%">account:</th>
                <td>
                    <input type="text" name="account" value="<?php echo $account;?>"/> 
                </td>  
            </tr>
            <tr>
                <th align="left" width="30%">type:</th>
                <td>
                    <select name="type">
                    <?php foreach($statistics as $k=>$v) {?> 
                        <option value="<?php echo $k;?>" <?php if($k == $type){ echo 'selected';}?>><?php echo $v;?></option>
                    <?php }?> 
                    </select>
                </td>  
            </tr>
            <tr>
                <th align="left" width="30%">chip:</th>
                <td>
                    <input type="text" name="chip" value="<?php echo $chip;?>"/> 
                </td>  
            </tr>
            <tr>
                <th align="left" width="30%">source:</th>
                <td>
                    <input type="text" name="source" value="<?php echo $source;?>"/> 
                </td>  
            </tr>
            <tr>
                <th></th>
                <td><input type="submit" value="插入" /></td>
            </tr>
            <?php if ($result) {?>
            <tr>
                <th colspan="2">成功</th>
            </tr>
            <?php }?>
        </table>
    </form>
</div>
<script>

</script>
</body>
</html>
