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
											<form action="<?php echo site_url('no3/tgAgentBlanceLog/index');?>">
												<select name="data_type">
													<option value="">日志类型</option>
													<option <?php if($query['data_type'] && $query['data_type'] == 'houtai'){ ?> selected="selected" <?php } ?> value="houtai">后台增减信用金</option>
													<option <?php if($query['data_type'] && $query['data_type'] == 'agent_recharge'){ ?> selected="selected" <?php } ?> value="agent_recharge">推广代理充值</option>
												</select>
												<input
													value="<?php if($query['agent_account']){echo $query['agent_account']; }?>"
													type="text" placeholder="推广账号" name="agent_account"
													class="col-xs-10 col-sm-2"
													style="margin-left: 5px; height: 34px; width: 80px;" /> 
												<input
													value="<?php if($query['user_id']){echo $query['user_id']; }?>"
													type="text" placeholder="用户ID" name="user_id"
													class="col-xs-10 col-sm-2"
													style="margin-left: 5px; height: 34px; width: 80px;" /> 
	                                           	<input value="<?php if($query['start_time']){echo $query['start_time']; }?>" name="start_time" class="date-picker col-xs-10 col-sm-2" id="id_date_picker_1"  placeholder="开始时间" type="text" data-date-format="yyyy-mm-dd" style = "margin-left:5px;height:30px;width:100px;"  />
	                                            <input value="<?php if($query['end_time']){echo $query['end_time']; }?>" name="end_time" class=" date-picker col-xs-10 col-sm-2" id="id_date_picker_2"  placeholder="终止时间" type="text" data-date-format="yyyy-mm-dd" style = "margin-left:5px;height:30px;width:100px;"  />
												
	                                            <button class="btn btn-xs btn-success " style="margin-top:3px;">
	                                                <span class="bigger-110">查询</span>
	                                                <i class="icon-search icon-on-right"></i>
	                                            </button>
                                            </form>
                                        </div>
										<div class="widget-body">
											<div class="widget-main" style="padding: 0;">
												<table id="sample-table-2"
													class="table table-striped table-bordered table-hover">
													<thead id="targethead">
														<tr>
															<th>日期</th>
															<th>推广账号</th>
															<th>金额</th>
															<th>类型</th>
															<th>操作前信用金余额</th>
															<th>用户ID</th>
															<th>备注</th>
														</tr>
													</thead>
													<tbody>
													<?php foreach ($log_list as $v){ ?>
														<tr style="cursor:pointer;" onclick="toUserInfo('<?php echo site_url('no3/infodetail').'?user_id='.$v['userid'];?>')">
															<td><?php echo date ( 'Y-m-d H:i:s', $v['add_time'] ); ?></td>
															<td><?php echo $v['agent_account']; ?></td>
															<td><?php echo ($v['money']/100)."元"; ?></td>
															<td><?php if('agent_recharge'==$v['data_type']){echo '推广代理充值';}else if('houtai'==$v['data_type']){echo '后台增减信用金';}else{echo $v['data_type'];} ?></td>
															<td><?php echo ($v['agentbalanace_before']/100)."元"; ?></td>
															<td><?php echo $v['userid']; ?></td>
															<td><?php echo $v['content']; ?></td>
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
	
	<script src="../res/js/date-time/bootstrap-datepicker.min.js"></script>
    <script src="../res/js/date-time/bootstrap-timepicker.min.js"></script>
    <script src="../res/js/date-time/moment.min.js"></script>
    <script src="../res/js/date-time/daterangepicker.min.js"></script>
    <script src="../res/js/date-time/daterangepicker.min.js"></script>	
	<script type="text/javascript">
	$(function(){
		$('#id_date_picker_1').datepicker({autoclose:true}).on(ace.click_event, function(){
			$("#id_date_picker_1").focus();
		});
		$('#id_date_picker_2').datepicker({autoclose:true}).on(ace.click_event, function(){
				$("#id_date_picker_2").focus();
		});
	});

	function toUserInfo(url){
		//location.href = url;  
	}
	</script>
</body>
</html>