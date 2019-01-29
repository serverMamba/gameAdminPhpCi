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
                	<?php if($this->session->flashdata('success')){ ?><div class="alert alert-success" role="alert"><?php echo $this->session->flashdata('success'); ?></div><?php } ?>
                	<?php if($this->session->flashdata('error')){ ?><div class="alert alert-danger" role="alert"><?php echo $this->session->flashdata('error'); ?></div><?php } ?>
					
					<!-- 查看提现和充值曲线的模态框 -->
					<div class="page-header">
						<label class="blue bigger"
							style="font-size: 18px;">充值提现记录 </label>
					</div>

					<div class="page-body">
						<div>
							<label class="blue bigger"
								style="font-size: 16px;float:left">userId: </label>
							<input value="" 
								class="col-xs-10 col-sm-2" id="userId" type="text"
								style="margin-left: 5px; height: 30px; width: 100px; z-index:1100"> 

							<input value="" name="date-range-picker"
								class="date-picker col-xs-10 col-sm-2" id="startTime"
								placeholder="开始时间" type="text" data-date-format="yyyy-mm-dd"
								style="margin-left: 5px; height: 30px; width: 100px; z-index:1100"> 
							<input
								value="" name="date-range-picker" class="date-picker col-xs-10 col-sm-2"
								id="endTime" placeholder="结束时间" type="text"
								data-date-format="yyyy-mm-dd"
								style="margin-left: 5px; height: 30px; width: 100px;">
							<button class="btn btn-xs btn-success" style="margin-left:10px"
								onclick="confirmQueryChargeWithdrawal();">
								查询<i class="icon-search icon-on-right"></i>
							</button>

							<label id="chargeWithdrawalLoading" class="blue bigger"
								style="font-size: 16px;"><img src="../res/css/select2-spinner.gif">加载中...</label>
						</div>
						<div style="margin:20px 10px">
							<label class="blue bigger"
								style="font-size: 16px;">总充值：</label>
							<label id="totalCharge" class="blue bigger"
								style="font-size: 16px; margin-right:20px"></label>

							<label class="red bigger"
								style="font-size: 16px;">总提现：</label>
							<label id="totalWithdrawal" class="red bigger"
								style="font-size: 16px;"></label>
						</div>
						<div style="width:600px;height:300px">
							<canvas id="chargeWithdrawalCanvas" style="width: 400px;height: 200px;"></canvas>
						</div>
					</div>
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
	<script
		src="<?php echo base_url().'res/js/jquery-ui-1.10.3.custom.min.js'; ?>"></script>
		<script src="<?php echo base_url().'res/js/bootstrap.min.js'; ?>"></script>
	<script src="<?php echo base_url().'res/js/ace-elements.min.js'; ?>"></script>
	<script src="<?php echo base_url().'res/js/ace.min.js'; ?>"></script>
	<script src="<?php echo base_url().'js/Chart.bundle.js'; ?>"></script>	
	<script src="<?php echo base_url().'res/js/jspacket.js'; ?>"></script>

	<script src="../res/js/date-time/bootstrap-datepicker.min.js"></script>
	<script src="../res/js/date-time/bootstrap-timepicker.min.js"></script>
	<script src="../res/js/date-time/moment.min.js"></script>
	<script src="../res/js/date-time/daterangepicker.min.js"></script>
	<script>

			jQuery(function($) {
				var startTime = getFormatedDate(new Date() - 7 * 24 * 3600 * 1000);
				$('#startTime').val(startTime);
				var endTime = getFormatedDate(new Date());
				$('#endTime').val(endTime);
                $('#chargeWithdrawalLoading').hide();

                $('#startTime').datepicker({autoclose: true}).on(ace.click_event, function() {
                    $("#startTime").focus();
                });
                $('#endTime').datepicker({autoclose: true}).on(ace.click_event, function() {
                    $("#endTime").focus();
                });
			});

			/**
			*	确认获取数据
			*/
			function confirmQueryChargeWithdrawal()
			{
                function onsuccess(data) {
                    var datax = eval("(" + data + ")");
                    if (datax['status'] == 1)
                    {
                        alert(datax['msg']);
                		$('#chargeWithdrawalLoading').hide();
                        return;
                    }

                    // 设置总充值与总提现
					$('#totalCharge').html("" + datax.totalCharge + "元");
					$('#totalWithdrawal').html("" + datax.totalWithdrawal + "元");

                    var labels = datax.date;
                    var chargeArray = [];
                    var withDrawalArray = [];
                    for (var i in labels)
                    {
                        var chargeAmount = datax.chargeData[labels[i]];
                        if (chargeAmount == undefined)
                        {
                            chargeArray.push(0);
                        }
                        else
                        {
                            chargeArray.push(chargeAmount);
                        }

                        var withdrawalAmount = datax.withdrawalData[labels[i]];
                        if (withdrawalAmount == undefined)
                        {
                        	withDrawalArray.push(0);
                        }
                        else
                        {
                        	withDrawalArray.push(withdrawalAmount);
                        }
                    }

                    // 绘制canvas
					var ctx = document.getElementById("chargeWithdrawalCanvas").getContext("2d");	
					var chartData = {
							labels : labels,
							datasets : [
							            {
								            label:'充值',
								            data : chargeArray,
											pointStrokeColor : '#fff',
											fill : false,
											borderColor : 'green',
											spanGaps : true,
											lineTension : 0.1 
							            },
							            {
								            label:'提现',
								            data : withDrawalArray,
											pointStrokeColor : '#fff',
											fill : false,
											borderColor : 'red',
											spanGaps : true,
											lineTension : 0.1 
							            },
										],
					};

					if (window.myChart)
					{
						window.myChart.destroy();
					}

					window.myChart = new Chart(ctx,{
						type: 'line',
						data : chartData,
						options: {
							responsive: true,
							tooltips: {
								mode: 'index',
								intersect: false,
							},
							hover: {
								mode: 'nearest',
								intersect: true
							},
							scales: {
								
							}
						}
					});
                	$('#chargeWithdrawalLoading').hide();
                 }
                function onerrors(data) {
                	$('#chargeWithdrawalLoading').hide();
                }

                var packet = {
                		userId : $('#userId').val(),
                		startTime : $('#startTime').val(),
                		endTime : $('#endTime').val(),
                };
                jQuery.comm.sendmessage("<?php echo base_url()?>no3/userchargewithdrawal/getUserChargeWithdrawalDailyData", packet, onsuccess, onerrors);

                $('#chargeWithdrawalLoading').show();
			}

	</script>
</body>
</html>
