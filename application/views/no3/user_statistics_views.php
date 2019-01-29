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
									<select id="channel_id" onchange="changeChannel('<?php echo site_url('no3/userStatistics'); ?>')">
										<option value="0">全部</option>
										<?php foreach ($channel_list as $k=>$v){ ?>
										<option value="<?php echo $k; ?>" <?php if($channel_id == $k){ ?> selected="selected" <?php } ?>><?php echo $v;?></option>
										<?php } ?>
									</select>
									<div class="widget-box">																	
										<canvas id="myChart" style="width: 300px;height: 100px;"></canvas>
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
		var ctx = document.getElementById("myChart").getContext("2d");	
		var bar_data = <?php echo json_encode($chart_data['user_chart']); ?>;			
		window.myBar = new Chart(ctx,{
			type: 'bar',
            data: bar_data,
            options: {
                title: {
                    display: true,
                    text: '用户统计报表'
                }
            }
		});
	});
	function changeChannel(url){
		var channel_id = $('#channel_id').val();
		location.href = url + '?channel_id=' + channel_id;
	}
	</script>
</body>
</html>