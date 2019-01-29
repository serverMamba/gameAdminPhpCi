<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php SITE_NAME?></title>
<link rel="stylesheet" href="<?php echo base_url() . 'css/common.css?v=' . CSS_VERSION?>" type="text/css" media="screen" />
</head>
<body>
<div class="common_table_div" style="width:900px;">
	<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#E8E8E8">
		<tr>
			<th colspan="8">软件下载及安装问题反馈</th>		
		</tr>
		<tr>
			<th width="40">序号</th>
			<th>问题</th>	
			<th width="150">IP</th>
			<th width="150">时间</th>
		</tr>
		<?php if(empty($question)):?>
			<tr>
				<td colspan="8" align="center">无任何反馈</td>		
			</tr>
		<?php else:?>
			<?php foreach($question as $var):?>
			<tr>
				<td align="right"><?php echo $var['id']?></td>
				<td align="left"><?php echo nl2br(htmlspecialchars($var['question']))?></td>
				<td align="right"><?php echo $var['ip']?></td>
				<td align="center"><?php echo $var['timeline']?></td>
			</tr>
			<?php endforeach;?>
		<?php endif;?>
			<tr>
				<td colspan="8" align="center"><?php echo $pageinfo?>&nbsp;</td>		
			</tr>
	</table>
</div>
</body>
</html>