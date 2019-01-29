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
	<div class="table-responsive">
		<table class="table table-bordered table-condensed">
			<thead>
				<tr>
					<th align="center" style="color:#b4ff00;text-align:center;">充值平台</th>
					<th align="center" style="color:#b4ff00;text-align:center;">充值总额</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($report_data as $k=>$v){ ?>
				<tr>
					<td align="center" style="color:#b4ff00;"><?php if(isset($pay_list[$v['pay_platform']])){echo $pay_list[$v['pay_platform']];}else{echo '--';}  ?></td>
					<td align="center" style="color:#b4ff00;"><?php echo number_format($v['total_money'],'2','.',',').'元'; ?></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
	<script>

			
	</script>
</body>
</html>