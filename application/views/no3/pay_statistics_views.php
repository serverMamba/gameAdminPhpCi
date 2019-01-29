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
                <?php if($this->session->flashdata('success')){ ?><div
						class="alert alert-success" role="alert"><?php echo $this->session->flashdata('success'); ?></div><?php } ?>
                	<?php if($this->session->flashdata('error')){ ?><div
						class="alert alert-danger" role="alert"><?php echo $this->session->flashdata('error'); ?></div><?php } ?>
					
					<div class="row">
						<div class="col-xs-12">
							<div class="row">
								<div class="col-xs-12 col-sm-12 widget-container-span">
									<div class="widget-box">
										<div class="widget-toolbox padding-8 clearfix">
											<form
												action="<?php echo site_url('no3/payStatistics/index');?>">
												<input
													value="<?php if($query['start_date']){echo $query['start_date']; }?>"
													name="start_date" class="date-picker col-xs-10 col-sm-2"
													id="id_date_picker_1" placeholder="开始时间" type="text"
													data-date-format="yyyy-mm-dd"
													style="margin-left: 5px; height: 30px; width: 100px;" /> <input
													value="<?php if($query['end_date']){echo $query['end_date']; }?>"
													name="end_date" class=" date-picker col-xs-10 col-sm-2"
													id="id_date_picker_2" placeholder="终止时间" type="text"
													data-date-format="yyyy-mm-dd"
													style="margin-left: 5px; height: 30px; width: 100px;" /> 
													
												<select
													id="channel" name="channel">
													<option value="">全部</option>
													<?php foreach ($channellist as $k=>$v){ ?>
													<option <?php if($select_channel == $k){ ?> selected="selected"
														<?php } ?> value="<?php echo $k; ?>"><?php echo $v;?></option>
													<?php } ?>
												</select>
												
												<select name="pay_type">
													<option value="">全部</option>
													<option <?php if($pay_type == 'alipay'){ ?> selected="selected"
														<?php } ?> value="alipay">支付宝</option>
													<option <?php if($pay_type == 'weixin'){ ?> selected="selected"
														<?php } ?> value="weixin">微信</option>
													<option <?php if($pay_type == 'card'){ ?> selected="selected"
														<?php } ?> value="card">卡支付</option>
		 <option <?php if($pay_type == 'qqpay'){ ?> selected="selected"
														<?php } ?> value="qqpay">QQ钱包</option>
													<option <?php if($pay_type == 'jdpay'){ ?> selected="selected"
														<?php } ?> value="jdpay">京东钱包</option>
												</select>
												<!-- 
												<select name="stat_time">
													<option value="">统计标准</option>
													<option <?php if($query['stat_time'] == 'pay_success_time'){ ?> selected="selected"
														<?php } ?> value="pay_success_time">到帐时间</option>
													<option <?php if($query['stat_time'] == 'add_time'){ ?> selected="selected"
														<?php } ?> value="add_time">创建时间</option>
												</select>
												 -->
												<button class="btn btn-xs btn-success "
													style="margin-top: 3px;">
													<span class="bigger-110">查询</span> <i
														class="icon-search icon-on-right"></i>
												</button>
											</form>
										</div>
										<div class="widget-body">
											<div class="widget-main" style="padding: 0;">
												<table id="sample-table-2"
													class="table table-striped table-bordered table-hover">
													<thead id="targethead">
														<tr>
															<th class="center">支付平台</th>
															<th>充值总额</th>
															<th>付费成功率</th>
															<th>统计依据</th>
														</tr>
													</thead>
													<tbody>
													<?php foreach ($statistics_list as $k=>$v){ ?>
														<tr>
															<td><?php if(isset($pay_list[$v['pay_platform']])){echo $pay_list[$v['pay_platform']];}else{echo $v['pay_platform'];}  ?></td>
															<td><?php echo number_format($v['total_money'],'2','.',',').'元'; ?></td>
															<td><?php echo $v['success_rate']; ?></td>
															<td><?php if("到帐时间"==$v['time_type']){?><b><?php }?><?php echo $v['time_type']; ?><?php if("到帐时间"==$v['time_type']){?></b><?php }?></td>
														</tr>
													<?php } ?>
													</tbody>
												</table>


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
	<!-- /.main-container -->
	<script src="<?php echo base_url().'res/js/jquery-2.0.3.min.js'; ?>"></script>
	<script
		src="<?php echo base_url().'res/js/jquery-ui-1.10.3.custom.min.js'; ?>"></script>
	<script src="<?php echo base_url().'res/js/bootstrap.min.js'; ?>"></script>
	<script src="<?php echo base_url().'res/js/ace-elements.min.js'; ?>"></script>
	<script src="<?php echo base_url().'res/js/ace.min.js'; ?>"></script>
	<script src="<?php echo base_url().'res/js/date-time/bootstrap-datepicker.min.js'; ?>"></script>
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

	});

	</script>
</body>
</html>
