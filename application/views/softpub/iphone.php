<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php SITE_NAME?></title>
<link rel="stylesheet" href="<?php echo base_url() . 'css/common.css?v=' . CSS_VERSION?>" type="text/css" media="screen" />
</head>
<body>
<div class="common_table_div">
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr>
			<th colspan="2">当前iPhone版本信息</th>		
		</tr>
		<tr>
			<th align="left">文件名：</th>
			<td><?php echo $name?></td>	
		</tr>
		<tr>
			<th align="left">文件大小:</th>
			<td><?php echo $size?> Byte</td>	
		</tr>
		<tr>
			<th align="left">最后发布时间:</th>
			<td><?php echo date('Y-m-d H:i:s', $date)?></td>	
		</tr>
	</table>
</div>
<div class="common_table_div">
	<form action="<?php echo site_url('softpub/iphone_upload')?>" method="post" enctype="multipart/form-data">
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr>
			<th colspan="2">发布新版本</th>		
		</tr>
		<tr>
			<th align="left">程序上传:</th>
			<td><input type="file" name="upload_file" id="upload_file" /></td>
		</tr>
		<tr>
			<th scope="row">&nbsp;</th>
			<td><input type="submit" name="submit" value="确认上传" /></td>
		</tr>
	</table>
	</form>
</div>
</body>
</html>