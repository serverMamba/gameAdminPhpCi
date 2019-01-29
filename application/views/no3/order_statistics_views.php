<!DOCTYPE html>
<html lang="en">
    <?php $this->load->view('no3/common/header'); ?>

    <body>
    <?php $this->load->view('no3/common/message'); ?>

    <div class="main-container" id="main-container">
		<script type="text/javascript">
            try {
                ace.settings.check('main-container', 'fixed')
            } catch (e) {
            }
        </script>

		<div class="main-container-inner">
			<a class="menu-toggler" id="menu-toggler" href="#"> <span
				class="menu-text"></span>
			</a>

			<div class="sidebar" id="sidebar">
				<script type="text/javascript">
                    try {
                        ace.settings.check('sidebar', 'fixed')
                    } catch (e) {
                    }
                </script>

                <?php $this->load->view('no3/common/nav_shortcut'); ?>

                <?php $this->load->view('no3/common/nav_left1'); ?>

                <div class="sidebar-collapse" id="sidebar-collapse">
					<i class="icon-double-angle-left"
						data-icon1="icon-double-angle-left"
						data-icon2="icon-double-angle-right"></i>
				</div>

				<script type="text/javascript">
                    try {
                        ace.settings.check('sidebar', 'collapsed')
                    } catch (e) {
                    }
                </script>
			</div>

			<div class="main-content">
                <?php $this->load->view('no3/common/nav_top'); ?>

                <div class="page-content">
					<div class="row">
						<div class="col-xs-12">
							<div class="row">
								<div class="col-xs-12 col-sm-12 widget-container-span">
									<select id="show_type" onchange="changeShowType('<?php echo site_url('no3/orderStatistics'); ?>')">
										<option value="1" <?php if($show_type == 1){ ?> selected="selected" <?php } ?>>小时</option>
										<option value="2" <?php if($show_type == 2){ ?> selected="selected" <?php } ?>>天</option>
									</select>
									
									<select id="channel_id" onchange="changeChannel('<?php echo site_url('no3/orderStatistics'); ?>')">
										<option value="0">全部</option>
										<?php foreach ($channel_list as $k=>$v){ ?>
										<option value="<?php echo $k; ?>" <?php if($channel_id == $k){ ?> selected="selected" <?php } ?>><?php echo $v;?></option>
										<?php } ?>
									</select>
									
									<select id="show_v" onchange="changeShowV('<?php echo site_url('no3/orderStatistics'); ?>')">
										<option value="1" <?php if($show_v == 1){ ?> selected="selected" <?php } ?>>表格</option>
										<option value="2" <?php if($show_v == 2){ ?> selected="selected" <?php } ?>>图表</option>
									</select>
									<div class="widget-box">	
										<?php if($show_v == 1){ ?>	
										<div class="widget-body">
											<div class="widget-main" style="padding: 0;">
												<table id="sample-table-2"
													class="table table-striped table-bordered table-hover">
													<thead id="targethead">
														<tr>
															<th class="center">时间</th>
															<th>成功订单总数量</th>
															<th>下单用户总数量</th>
															<th>支付总金额</th>
															<th>实际提现金额</th>
															<th>抽水金额</th>
															<th>用户总提现金额</th>
														</tr>
													</thead>
													<tbody>
													<?php foreach ($chart_data as $v){ ?>
														<tr>
															<td><?php echo $v['date']; ?></td>
															<td><?php echo $v['order_total_num']; ?></td>
															<td><?php echo $v['user_total_num']; ?></td>
															<td><?php echo $v['pay_total_num']; ?></td>
															<td><?php echo $v['cash_money']; ?></td>
															<td><?php echo $v['choushui_money']; ?></td>	
															<td><?php echo $v['cash_total_money']; ?></td>							
														</tr>
													<?php } ?>
													</tbody>
												</table>
											</div>
										</div>
										<?php }else{ ?>															
										<canvas id="myChart" style="width: 300px;height: 100px;"></canvas>
										<canvas id="myChart1" style="width: 300px;height: 100px;"></canvas>
										<canvas id="myChart2" style="width: 300px;height: 100px;"></canvas>
										<?php } ?>
									</div>
								</div>
							</div>
						</div>
						<!-- /.col -->
					</div>
					<!-- /.row -->
				</div>
				<!-- /.page-content -->
			</div>
			<!-- /.main-content -->
			<!-- /#ace-settings-container -->
		</div>
		<!-- /.main-container-inner -->
	</div>
	<!-- /.main-container -->
	<script src="<?php echo base_url().'res/js/jquery-2.0.3.min.js'; ?>"></script>
	<script src="<?php echo base_url().'res/js/jquery-ui-1.10.3.custom.min.js'; ?>"></script>
	<script src="<?php echo base_url().'res/js/bootstrap.min.js'; ?>"></script>
	<script src="<?php echo base_url().'res/js/ace-elements.min.js'; ?>"></script>
	<script src="<?php echo base_url().'res/js/ace.min.js'; ?>"></script>
	<script src="<?php echo base_url().'js/chart.js'; ?>"></script>		
	<script type="text/javascript">
	$(function(){
		<?php if($show_v == 2){ ?>
		var ctx = document.getElementById("myChart").getContext("2d");	
		var bar_data = <?php echo json_encode($chart_data['order_total_num']); ?>;			
		window.myBar = new Chart(ctx,{
			type: 'bar',
            data: bar_data,
            options: {
                title: {
                    display: true,
                    text: '订单统计报表'
                }
            }
		});

		var ctx = document.getElementById("myChart1").getContext("2d");	
		var bar_data = <?php echo json_encode($chart_data['pay_total_num']); ?>;			
		window.myBar = new Chart(ctx,{
			type: 'bar',
            data: bar_data,
            options: {
                title: {
                    display: true,
                    text: '支付金额报表'
                }
            }
		});

		var ctx = document.getElementById("myChart2").getContext("2d");	
		var bar_data = <?php echo json_encode($chart_data['cash_money']); ?>;			
		window.myBar = new Chart(ctx,{
			type: 'bar',
            data: bar_data,
            options: {
                title: {
                    display: true,
                    text: '提现金额报表'
                }
            }
		});
		<?php } ?>
	});

	function changeChannel(url){
		var channel_id = $('#channel_id').val();
		var show_type_id = $('#show_type').val();
		var show_v = $('#show_v').val();
		location.href = url + '?channel_id=' + channel_id+'&show_type='+show_type_id+'&v='+show_v;
	}

	function changeShowType(url){
		var channel_id = $('#channel_id').val();
		var show_type_id = $('#show_type').val();
		var show_v = $('#show_v').val();
		location.href = url + '?channel_id=' + channel_id+'&show_type='+show_type_id+'&v='+show_v;
	}
	function changeShowV(url){
		var channel_id = $('#channel_id').val();
		var show_type_id = $('#show_type').val();
		var show_v = $('#show_v').val();
		location.href = url + '?channel_id=' + channel_id+'&show_type='+show_type_id+'&v='+show_v;
	}
	</script>
</body>
</html>