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
<body style="background:url('<?php echo $base_url; ?>images/ppp.jpg') no-repeat;background-attachment:fixed;background-position: center;background-size:100% 100%;">
	<button onclick="javascript:history.go(-1);" type="button" class="btn btn-primary">返回</button>
	<button onclick="refresh();" id="r_btn" type="button" class="btn btn-primary">刷新</button>
	<span style="color:white;" id="wait"></span>
	<div class="table-responsive">
		<table class="table table-bordered table-condensed">
			<thead>
				<tr>
					<th align="center" style="color:#b4ff00;text-align:center;">游戏</th>
					<th align="center" style="color:#b4ff00;text-align:center;">人数</th>
				</tr>
			</thead>
			<tbody>
				<tr>
						<td align="center" style="color:#b4ff00;">总在线</td>
						<td align="center" style="color:#b4ff00;"><?php echo $total_all; ?></td>
					</tr>
				<?php foreach ($online_report as $k=>$v){ if($total[$k] == 0)continue;?>
					
					<tr>
						<td align="center" style="color:#b4ff00;"><?php echo $k; ?></td>
						<td align="center" style="color:#b4ff00;"><?php echo $total[$k]; ?></td>
					</tr>
					<?php foreach ($v as $kk=>$vv){ if($vv == 0)continue;?>
					<tr>
						<td align="center" style="color:#b4ff00;font-size:10px;"><?php echo '|----'.$kk; ?></td>
						<td align="center" style="color:#b4ff00;font-size:10px;"><?php echo $vv; ?></td>
					</tr>
					<?php } ?>					
				<?php } ?>
				
			</tbody>
		</table>
	</div>
	<script>
	function refresh(){
		$('#wait').html('刷新中，请稍后...');
		javascript:history.go(0);
	}
			
	</script>
</body>
</html>