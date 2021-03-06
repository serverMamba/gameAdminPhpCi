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
	<select onchange="change_channel('<?php echo $base_url.'report/tongji'; ?>');" id="channel_id">
		<option value="10000" <?php if($channel_id == 10000){ ?>selected="selected"<?php } ?> >全部</option>
		<?php foreach ($channel_list as $k=>$v){ ?>
		<option <?php if($channel_id == $k){ ?>selected="selected"<?php } ?> value="<?php echo $k;?>" ><?php echo $v;?></option>
		<?php } ?>
	</select>
	<?php if($username == 'coffee'){ ?>
	<select id="report" onchange="select_report();">
		<option value="0">统计功能</option>
		<option value="1">渠道统计</option>
		<option value="2">充值曲线图</option>
		<option value="3">充值平台统计</option>
		<option value="4">在线人数</option>
		<option value="5">小西的渠道</option>
		<option value="6">小西的渠道</option>
	</select>
	<?php } ?>
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
	$(function() {
		$('#report').val('0');
	});
		function channelTonji(url){
			$('#wait').html('加载中，请稍后...');
			location.href = url+'?username=<?php echo $username; ?>&password=<?php echo $password; ?>';
		}
		function change_channel(url){
			$('#wait').html('加载中，请稍后...');
			var channel_id = $('#channel_id').val();
			location.href = url+'?channel_id='+channel_id+'&username=<?php echo $username; ?>&password=<?php echo $password; ?>';
		}
		function select_report(){
			var c_id = $('#report').val();
			if(c_id == 1){
				channelTonji('<?php echo $base_url.'report/channelReport'; ?>');
			}else if(c_id == 2){
				channelTonji('<?php echo $base_url.'report/rechargeReport'; ?>');
			}else if(c_id == 3){
				channelTonji('<?php echo $base_url.'report/rechargePlatform'; ?>');
			}else if(c_id == 4){
				channelTonji('<?php echo $base_url.'report/onlineReport'; ?>');
			}else if(c_id == 5){
				channelTonji('<?php echo $base_url.'report/xiaoxiTongjiList'; ?>');
			}else if(c_id == 6){
				channelTonji('<?php echo $base_url.'report/myTongjiList'; ?>');
			}
		}
		function myChannel(url){
			channelTonji(url);
		}
	</script>
</body>
</html>