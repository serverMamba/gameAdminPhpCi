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
<script src="<?php echo $base_url.'js/Chart.bundle.js'; ?>"></script>	
<title>报表</title>
</head>
<body style="background:url('<?php echo $base_url; ?>images/ppp.jpg') no-repeat;background-attachment:fixed;background-position: center;background-size:100% 100%;">
	<button onclick="javascript:history.go(-1);" type="button" class="btn btn-primary">返回</button>
	<canvas id="myChart" width="100%"></canvas>
	<script>
		$(function(){
			Chart.defaults.global.defaultFontColor = '#fff';
			var ctx = document.getElementById("myChart").getContext("2d");	
			var bar_data = <?php echo json_encode($report_data['pay_total_num']); ?>;			
			window.myBar = new Chart(ctx,{
				type: 'line',
	            data: bar_data,
	            options: {
	                tooltips: {
	                    mode: 'index',
	                    intersect: false,
	                },
	                hover: {
	                    mode: 'nearest',
	                    intersect: true
	                },
	                scales: {
	                	yAxes: [{
	                        gridLines: {
	                            color: '#fff',
	                            drawTicks:false
	                        }
	                    }],
	                    xAxes: [{
	                        gridLines: {
	                            color: '#fff',
	                            drawTicks:false
	                        }
	                    }]
	                }
	            }
			});
		});	
	</script>
</body>
</html> 