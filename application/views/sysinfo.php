<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php SITE_NAME?></title>
<link rel="stylesheet" href="<?php echo base_url() . 'css/common.css?v=' . CSS_VERSION?>" type="text/css" media="screen" />
</head>
<body>
<div class="common_table_div" style="width:600px;">
	<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#E8E8E8">
		<tr>
			<th colspan="2">系统信息</th>		
		</tr>
		<tr>
			<th align="left" width="30%">CodeIgniter设置</th>
			<td><?php echo  strtoupper(ENVIRONMENT)?></td>	
		</tr>
		<tr>
			<th align="left">CodeIgniter版本</th>
			<td><?php echo 'CodeIgniter ' . CI_VERSION?></td>	
		</tr>
		<tr>
			<th align="left">服务器环境</th>
			<td><?php echo $server_env?></td>	
		</tr>
		<tr>
			<th align="left">PHP版本</th>
			<td><?php echo $php_version?></td>	
		</tr>
		<tr>
			<th align="left">数据库信息</th>
			<td><?php echo $database?></td>	
		</tr>
		<tr>
			<th align="left">最大内存使用</th>
			<td><?php echo $max_memory_limit?></td>	
		</tr>
		<tr>
			<th align="left">文件上传功能</th>
			<td><?php echo $file_uploads?></td>	
		</tr>
		<tr>
			<th align="left">最大文件上传字节数</th>
			<td><?php echo $upload_max_filesize?></td>	
		</tr>
		<tr>
			<th align="left">POST数据最大值</th>
			<td><?php echo $post_max_size?></td>	
		</tr>
		<tr>
			<th align="left">PHP错误显示</th>
			<td><?php echo $php_display_errors?></td>	
		</tr>
		<tr>
			<th align="left">PHP错误级别</th>
			<td><?php echo $php_error_reporting?></td>	
		</tr>
		<tr>
			<th align="left">PHP magic_quotes_gpc</th>
			<td><?php echo $magic_quotes_gpc?></td>	
		</tr>
	</table>
</div>
</body>
</html>
