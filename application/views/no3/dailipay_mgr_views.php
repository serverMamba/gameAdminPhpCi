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
											<form action="<?php echo site_url('no3/dailipaymgr/index');?>" style="float:left;">
												<input value="<?php if($query['daili_no']){echo $query['daili_no']; }?>" type="text" placeholder="代理账号" name="daili_no"  class="col-xs-10 col-sm-2" style = "margin-left:5px;height:34px;width:200px;"/> 
												<input value="<?php if($query['start_time']){echo $query['start_time']; }?>" name="start_time" class="date-picker col-xs-10 col-sm-2" id="id_date_picker_1"  placeholder="开始时间" type="text" data-date-format="yyyy-mm-dd" style = "margin-left:5px;height:30px;width:100px;"  />
	                                            <input value="<?php if($query['end_time']){echo $query['end_time']; }?>" name="end_time" class=" date-picker col-xs-10 col-sm-2" id="id_date_picker_2"  placeholder="终止时间" type="text" data-date-format="yyyy-mm-dd" style = "margin-left:5px;height:30px;width:100px;"  />
	                                            <input value="<?php if($query['describe']){echo $query['describe']; }?>" type="text" placeholder="备注关键字" name="describe"  class="col-xs-10 col-sm-2" style = "margin-left:5px;height:34px;width:80px;"/> 
	                                            <button class="btn btn-xs btn-success " style="margin-top:3px;">
	                                                <span class="bigger-110">查询</span>
	                                                <i class="icon-search icon-on-right"></i>
	                                            </button>
	                                         </form>
                                        </div>
                                        <div class="widget-body">
											<div class="widget-main" style="padding: 0;">
												<button onclick="createNewDailiPay();" class="btn btn-danger" style="border: none;margin-bottom: 10px;">创建新账户</button>												
												<form action="" method="post" name="of" id="of">
													<table id="sample-table-2"
														class="table table-striped table-bordered table-hover" style="margin-bottom: 10px;">
														<thead id="targethead">
															<tr>
																<th><input type="checkbox" id="header_checkbox" onclick="checkAll(this)" /></th>
																<th>代理账号</th>
																<th>创建人</th>														
																<th>创建时间</th>
																<th>备注</th>
																<th>操作</th>
															</tr>
														</thead>
														<tbody id="tbody">
														<?php if(!empty($daili_no_list)){ foreach ($daili_no_list as $v){ ?>
															<tr>
																<td><input type="checkbox" class="line_check_box" name="select_cash_ids[]" value="<?php echo $v['id']; ?>" /></td>
																<td><?php echo $v['daili_no']; ?></td>
																<td><?php echo $v['adduser']; ?></td>
																<td><?php echo $v['addtime']; ?></td>
																<td><?php echo $v['describe']; ?></td>
																<td style="width:60px;">
																	<a onclick="deleteOne('<?php echo $v['id']; ?>');" href="javascript:;">删除</a>
																</td>
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
	<script src="<?php echo base_url().'js/context.js'; ?>"></script>
	
	<script src="<?php echo base_url().'res/js/date-time/bootstrap-datepicker.min.js'; ?>"></script>
	<script src="<?php echo base_url().'res/js/date-time/bootstrap-timepicker.min.js'; ?>"></script>
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
	
	function createNewDailiPay()
	{
		location.href = '<?php echo site_url('no3/dailipaymgr/createNewDailiPay'); ?>';
		return true;
	}

	function deleteOne(id)
	{
		if (!confirm('确定删除吗？'))
		{
			return;
		}

		location.href = '<?php echo site_url('no3/dailipaymgr/delete') . "?id="; ?>' + id;
		return;
	}


	function checkAll(obj){
		$("#tbody input[type='checkbox']").prop('checked', $(obj).prop('checked'));
	}
	
	</script>
</body>
</html>