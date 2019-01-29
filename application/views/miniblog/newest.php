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
			<th colspan="8">最新微博管理</th>		
		</tr>
		<tr>
			<th width="50" align="right">微博ID</th>
			<th width="100" align="right">微博作者</th>	
			<th width="300">微博内容</th>
			<th width="50" align="right">转发</th>
			<th width="50" align="right">评论</th>
			<th width="60">微博类型</th>
			<th width="70">发表时间</th>
			<th width="140">&nbsp;</th>
		</tr>
		<?php if(empty($newest)):?>
			<tr>
				<td colspan="8" align="center">无任何微博</td>		
			</tr>
		<?php else:?>
			<?php foreach($newest as $var):?>
			<tr>
				<td align="right"><?php echo $var['blogid']?></td>
				<td align="right"><a href="<?php echo $var['hurl']?>" target="_blank"><?php echo $var['account']?></a></td>
				<td><div style="overflow:hidden;width:300px;"><?php echo $var['content']?><?php if(!empty($var['pic_url'])):?><br /><img src="<?php echo $var['pic_url']?>" /><?php endif?></div></td>
				<td align="right"><?php echo $var['forward']?></td>
				<td align="right"><?php echo $var['comment']?></td>
				<td align="center"><?php echo empty($var['source_url']) ?  $var['type'] : '<a href="'. $var['source_url'] .'" target="_blank" title="查看源微博">' . $var['type'] . '</a>'?></td>
				<td align="center"><?php echo $var['time']?></td>
				<td><a href="<?php echo $var['url']?>" target="_blank">查看</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo $var['prime_url']?>">设为精华</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo $var['delete_url']?>" onclick="return confirm('删除微博后将无法恢复，确认要删除吗？');">删除</a></td>
			</tr>
			<?php endforeach;?>
		<?php endif;?>
			<tr>
				<td colspan="8" align="center"><?php echo $pageinfo?></td>		
			</tr>
	</table>
</div>
</body>
</html>