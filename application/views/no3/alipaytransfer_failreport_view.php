<?php 
$statusText = array(
		0 => "新建",
		1 => "成功",
		2 => "已关闭",
		)
?>
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
					
					<div class="row">
						<div class="col-xs-12">
							<div class="row">
								<div class="col-xs-12 col-sm-12 widget-container-span">
									<div class="widget-box">
										<div class="widget-toolbox padding-8 clearfix">
											<form action="<?php echo site_url('no3/alipaytransfer_failreport/index');?>" id="form" style="display:inline-block">
	                                            <input value="<?php if($query['alipay_orderid']){echo $query['alipay_orderid']; }?>" type="text" placeholder="支付宝订单号" name="alipay_orderid"  class="col-xs-10 col-sm-2" style = "margin-left:5px;height:34px;width:160px;"/> 
	                                            <input value="<?php if($query['alipay_account']){echo $query['alipay_account']; }?>" type="text" placeholder="支付宝账号" name="alipay_account"  class="col-xs-10 col-sm-2" style = "margin-left:5px;height:34px;width:160px;"/> 
												<input value="<?php if($query['start_time']){echo $query['start_time']; }?>" name="start_time" class="date-picker col-xs-10 col-sm-2" id="id_date_picker_1"  placeholder="开始时间" type="text" data-date-format="yyyy-mm-dd" style = "margin-left:5px;height:30px;width:100px;"  />
												<div class="input-group bootstrap-timepicker" style="float:left;">
													<input value="<?php if($query['start_time_time']){echo $query['start_time_time'];}else{echo "00:00";}?>" name="start_time_time" id="id_time_picker_1" type="text" class="form-control col-xs-10 col-sm-2" style = "height:30px;width:100px;" />
												</div>
	                                            <input value="<?php if($query['end_time']){echo $query['end_time']; }?>" name="end_time" class=" date-picker col-xs-10 col-sm-2" id="id_date_picker_2"  placeholder="终止时间" type="text" data-date-format="yyyy-mm-dd" style = "margin-left:5px;height:30px;width:100px;"  />
												<div class="input-group bootstrap-timepicker" style="float:left;">
													<input value="<?php if($query['end_time_time']){echo $query['end_time_time'];}else{echo "00:00";}?>" name="end_time_time" id="id_time_picker_2" type="text" class="form-control col-xs-10 col-sm-2" style = "height:30px;width:100px;" />
												</div>
												<select name="status">
													<option <?php if($query['status'] == -1){ ?> selected="selected" <?php } ?> value="-1">全部</option>
													<option <?php if($query['status'] == 0){ ?> selected="selected" <?php } ?> value="0">新建</option>
													<option <?php if($query['status'] == 1){ ?> selected="selected" <?php } ?> value="1">成功</option>
													<option <?php if($query['status'] == 2){ ?> selected="selected" <?php } ?> value="2">支付失败</option>
												</select>
	                                            <button class="btn btn-xs btn-success " style="margin-top:3px;">
	                                                <span class="bigger-110">查询</span>
	                                                <i class="icon-search icon-on-right"></i>
	                                            </button>
                                            </form>
                                            
											<button onclick="closeAllSystemReport()" class="btn btn-xs btn-danger " style="margin-top:3px;">
												<span class="bigger-110">关闭所有系统报告</span>
											</button>
                                        </div>

										<div class="widget-body">
											<div class="widget-main" style="padding: 0;">
												<table id="sample-table-2"
													class="table table-striped table-bordered table-hover">
													<thead id="targethead">
														<tr>
															<th>ID</th>
															<th>支付宝订单号</th>
															<th>RMB</th>
															<th>转入支付宝</th>
															<th>备注</th>
															<th>出错原因</th>
															<th>提交时间</th>
															<th>处理时间</th>
															<th>状态</th>
															<th>操作</th>
														</tr>
													</thead>
													<tbody>
													<?php foreach ($reportList as $v){ ?>
														<tr>
															<td><?php echo $v['id']; ?></td>
															<td><?php echo $v['alipayOrderId']; ?></td>
															<td><?php echo $v['money']; ?></td>
															<td><?php echo $v['alipayAccount']; ?></td>
															<td><?php echo $v['memo']; ?></td>
															<td><?php echo $v['reason']; ?></td>
															<td><?php echo date("Y-m-d H:i:s", intval($v['time']));?></td>
															<td><?php if ($v['dealTime'] == 0) {echo "--"; } else { echo date("Y-m-d H:i:s", intval($v['dealTime']));}?></td>
															<td><?php echo $statusText[intval($v['status'])]; ?></td>
															<td>
																<?php if($v['status'] == 0){ ?>
																	<a onclick="onclickConfirmTransferSuccess('<?php echo $v['id']; ?>')">确认转账成功</a>
																	|<a onclick="onclickCloseReport('<?php echo $v['id']; ?>')">关闭报告</a>
																<?php }?>
															</td>
														</tr>
													<?php } ?>
													</tbody>
												</table>
												
												<div class="modal-footer no-margin-top">
													<?php echo $this->pagination->create_links();?>											
												</div>

												<div class="modal-body no-padding"></div>
											</div>
										</div>
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
	
	<script src="<?php echo base_url().'res/js/jquery-2.0.3.min.js'; ?>"></script>
	<script src="<?php echo base_url().'res/js/jquery-ui-1.10.3.custom.min.js'; ?>"></script>
	<script src="<?php echo base_url().'res/js/bootstrap.min.js'; ?>"></script>
	<script src="<?php echo base_url().'res/js/date-time/bootstrap-datepicker.min.js'; ?>"></script>
    <script src="<?php echo base_url().'res/js/date-time/bootstrap-timepicker.min.js'; ?>"></script>
	<script src="<?php echo base_url().'res/js/ace-elements.min.js'; ?>"></script>
	<script src="<?php echo base_url().'res/js/ace.min.js'; ?>"></script>
	<script src="<?php echo base_url().'res/js/date-time/moment.min.js'; ?>"></script>
	<script src="<?php echo base_url().'res/js/date-time/daterangepicker.min.js'; ?>"></script>

	<script type="text/javascript">
	$(function(){
		$('#id_date_picker_1').datepicker({autoclose:true}).on(ace.click_event, function(){
			$("#id_date_picker_1").focus();
		});
		$('#id_date_picker_2').datepicker({autoclose:true}).on(ace.click_event, function(){
			$("#id_date_picker_2").focus();
		});

		$('#id_time_picker_1').timepicker({
				minuteStep: 1,
				showSeconds: false,
				showMeridian: false
			}).on(ace.click_event, function(){
				$("#id_time_picker_1").focus();
			  });
							
		$('#id_time_picker_2').timepicker({
				minuteStep: 1,
				showSeconds: false,
				showMeridian: false
			}).on(ace.click_event, function(){
				$("#id_time_picker_2").focus();
			});  

		$('#order_modal').on('hide.bs.modal', function (e) {
			$('#modal_order_sn').html('');
			$('#modal_money').html('');
			$('#modal_result').html('');
			$('#modal_pay_type').html('');
		})
	});

	/**
	* 已经转账成功
	*/
	function onclickConfirmTransferSuccess(id)
	{
		var userId = prompt("输入用户ID:", "");

		if (userId == null || userId == "")
		{
			return;
		}

		if (confirm("确认此订单属于用户ID：" + userId + "吗？"))
		{
			location.href = "<?php echo site_url('no3/alipaytransfer_failreport/transferSuccess').'?id=';?>" + id + "&userId=" + userId;
		}
	}
		
	function onclickCloseReport(id)
	{
		if (confirm("确认关闭报告吗？"))
		{
			location.href = "<?php echo site_url('no3/alipaytransfer_failreport/close').'?id=';?>" + id;
		}
	}

	/**
		关闭所有系统报告
	*/
	function closeAllSystemReport()
	{
		if (confirm("确认关闭所有系统报告吗？"))
		{
			location.href = "<?php echo site_url('no3/alipaytransfer_failreport/closeAllSysReport');?>";
		}
	}
		
	</script>
</body>
</html>
