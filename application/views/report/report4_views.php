<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<!-- 新 Bootstrap 核心 CSS 文件 -->
<link rel="stylesheet" href="<?php echo $base_url; ?>report_static/bootstrap.min.css">

<!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
<script src="<?php echo $base_url; ?>report_static/jquery.min.js"></script>

<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
<script src="<?php echo $base_url; ?>report_static/bootstrap.min.js"></script>
<title>报表</title>
</head>
<body style="background:url('<?php echo $base_url; ?>images/ppp.jpg') no-repeat;">
	<select onchange="change_channel('<?php echo $base_url.'report/guangeTongjiList'; ?>');" id="channel_id">
		<option value="10000" <?php if($channel_id == 10000){ ?>selected="selected"<?php } ?> >全部</option>
		<?php foreach ($channel_list as $k=>$v){ ?>
		<option <?php if($channel_id == $k){ ?>selected="selected"<?php } ?> value="<?php echo $k;?>" ><?php echo $v;?></option>
		<?php } ?>
	</select>
	<button onclick="back('<?php echo $base_url.'report/tongji'; ?>');" type="button" class="btn btn-primary">返回</button>
	<span style="color:white;" id="wait"></span>
	<div class="table-responsive">
		<table class="table table-bordered table-condensed">
			<thead>
				<tr>
					<th></th>
					<?php foreach ($field_list as $v){ ?>
					<th style="color:#b4ff00;"><?php echo $v; ?></th>
					<?php } ?>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($time as $t){ ?>
				<tr>
					<td style="color:#b4ff00;"><?php echo $t;?></td>
					<?php foreach ($report_data[$t] as $k=>$v){ ?>
					<td align="center" style="color:#b4ff00;"><?php echo $v;?></td>
					<?php } ?>
				</tr>
				<?php } ?>
				
				<tr>
					<td style="color:#b4ff00;">上月总和</td>
					<?php foreach ($last_month_total_data as $k=>$v){ ?>
					<td align="center" style="color:#b4ff00;"><?php echo $v;?></td>
					<?php } ?>
				</tr>
				
				<tr>
					<td style="color:#b4ff00;">本月总和</td>
					<?php foreach ($cur_month_total_data as $k=>$v){ ?>
					<td align="center" style="color:#b4ff00;"><?php echo $v;?></td>
					<?php } ?>
				</tr>
			</tbody>
		</table>
	</div>
	<script>
		function back(url){
			$('#wait').html('加载中，请稍后...');
			location.href = url+'?username=<?php echo $username; ?>&password=<?php echo $password; ?>';
		}
		function change_channel(url){
			$('#wait').html('加载中，请稍后...');
			var channel_id = $('#channel_id').val();
			location.href = url+'?channel_id='+channel_id+'&username=<?php echo $username; ?>&password=<?php echo $password; ?>';
		}
	</script>
</body>
</html>