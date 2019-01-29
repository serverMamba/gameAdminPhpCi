<!DOCTYPE html>
<html lang="en">
    <?php $this->load->view('no3/common/header'); ?>

    <body>

	<div class="main-container" id="main-container">
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
								<div>
									<label class="control-label" style="font-weight: bold">修正日志</label>
								</div>
								<div class="widget-toolbox padding-8 clearfix">
									<form
										action="<?php echo site_url('no3/tgCorrection/tgCorrectionLog');?>"
										style="float: left;">
										<input
											value="<?php if($query['user_id']){echo $query['user_id']; }?>"
											type="text" placeholder="用户ID" name="user_id"
											class="col-xs-10 col-sm-2"
											style="margin-left: 5px; height: 34px; width: 80px;" /> 
										<input
											value="<?php if($query['admin_name']){echo $query['admin_name']; }?>"
											type="text" placeholder="修正人" name="admin_name"
											class="col-xs-10 col-sm-2"
											style="margin-left: 5px; height: 34px; width: 80px;" /> 
										<input
											value="<?php if($query['promotion_old']){echo $query['promotion_old']; }?>"
											type="text" placeholder="修正前推广ID" name="promotion_old"
											class="col-xs-10 col-sm-2"
											style="margin-left: 5px; height: 34px; width: 80px;" /> 
										<input
											value="<?php if($query['promotion_new']){echo $query['promotion_new']; }?>"
											type="text" placeholder="修正后推广ID" name="promotion_new"
											class="col-xs-10 col-sm-2"
											style="margin-left: 5px; height: 34px; width: 80px;" /> 
										<input
											value="<?php if($query['start_time']){echo $query['start_time']; }?>"
											name="start_time" class="date-picker col-xs-10 col-sm-2"
											id="id_date_picker_1" placeholder="开始时间" type="text"
											data-date-format="yyyy-mm-dd"
											style="margin-left: 5px; height: 30px; width: 100px;" /> 
										<input
											value="<?php if($query['end_time']){echo $query['end_time']; }?>"
											name="end_time" class=" date-picker col-xs-10 col-sm-2"
											id="id_date_picker_2" placeholder="终止时间" type="text"
											data-date-format="yyyy-mm-dd"
											style="margin-left: 5px; height: 30px; width: 100px;" />
										<button class="btn btn-xs btn-success "
											style="margin-top: 3px;">
											<span class="bigger-110">查询</span> <i
												class="icon-search icon-on-right"></i>
										</button>
									</form>
								</div>
								<div class="widget-body">
									<div class="widget-main" style="padding: 0;">
										<form action="" method="post" name="of" id="of">
											<table id="sample-table-12"
												class="table table-striped table-bordered table-hover"
												style="margin-bottom: 10px;">
												<thead id="targethead">
													<tr>
														<th><input type="checkbox" id="header_checkbox"
															onclick="checkAll(this)" /></th>
														<th>用户ID</th>
														<th>目标推广ID</th>
														<th>修正时间</th>
														<th>修正者</th>
														<th>修正者IP</th>
														<th>原推广ID</th>
														<th>结果推广ID</th>
														<th>修正结果</th>
														<th>备注</th>
													</tr>
												</thead>
												<tbody id="tbody">
												<?php if(!empty($correction_log_list)){ foreach ($correction_log_list as $v){ ?>
													<tr>
														<td><input type="checkbox" class="line_check_box"
															name="select_cash_ids[]" value="<?php echo $v['id']; ?>" /></td>
														<td><?php echo $v['user_id']; ?></td>
														<td><?php echo $v['promotion_id']; ?></td>
														<td><?php echo $v['correction_time']; ?></td>
														<td><?php echo $v['admin_name']; ?></td>
														<td><?php echo $v['correction_ip']; ?></td>
														<td><?php echo $v['promotion_old']; ?></td>
														<td><?php echo $v['promotion_new']; ?></td>
														<td><?php if($v['flag']){echo '<font color="green">成功</font>';}else{echo '<font color="red">失败</font>';} ?></td>
														<td><?php echo $v['discribe']; ?></td>
														<?php } ?>
													</tr>
												<?php } ?>
												</tbody>
											</table>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- /.col -->
			</div>
			<!-- /.row -->
			<div class="modal-footer no-margin-top">
				<?php echo $this->pagination->create_links();?>											
			</div>
		</div>
	</div>
	<!-- /.main-container -->

	<script src="<?php echo base_url().'res/js/jquery-2.0.3.min.js'; ?>"></script>
	<script
		src="<?php echo base_url().'res/js/jquery-ui-1.10.3.custom.min.js'; ?>"></script>
	<script src="<?php echo base_url().'res/js/bootstrap.min.js'; ?>"></script>
	<script src="<?php echo base_url().'res/js/ace-elements.min.js'; ?>"></script>
	<script src="<?php echo base_url().'res/js/ace.min.js'; ?>"></script>
	<script src="<?php echo base_url().'js/context.js'; ?>"></script>

	<script
		src="<?php echo base_url().'res/js/date-time/bootstrap-datepicker.min.js'; ?>"></script>
	<script
		src="<?php echo base_url().'res/js/date-time/bootstrap-timepicker.min.js'; ?>"></script>
	<script
		src="<?php echo base_url().'res/js/date-time/moment.min.js'; ?>"></script>
	<script
		src="<?php echo base_url().'res/js/date-time/daterangepicker.min.js'; ?>"></script>
	<script type="text/javascript">
	$(function(){
		$('#id_date_picker_1').datepicker({autoclose:true}).on(ace.click_event, function(){
			$("#id_date_picker_1").focus();
		});
		$('#id_date_picker_2').datepicker({autoclose:true}).on(ace.click_event, function(){
			$("#id_date_picker_2").focus();
		});
	});
	

	function checkAll(obj){
		$("#tbody input[type='checkbox']").prop('checked', $(obj).prop('checked'));
	}
	
	</script>
</body>
</html>