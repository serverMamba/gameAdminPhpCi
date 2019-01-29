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
										<div class="widget-main" style="padding: 0;">
											<div class="form-group">
												<div class="col-sm-6">
													<label>支付宝提现状态：</label>
													<b><?php if("open"==$switch_status){?><font color="green">Open</font><?php }else{?><font color="red">Close</font><?php }?></b>
													&nbsp;&nbsp;
													<a onclick="openAlipayCash()" href="javascript:;">开启总闸</a>&nbsp;|&nbsp;
													<a onclick="closeAlipayCash()" href="javascript:;">关闭总闸</a>
												</div>
											</div>
										</div>	
										<div>
										<?php if("open"==$switch_status && !$alipaycashps_status){?><font color="red">检测到提现进程未正常运行，请1分钟后刷新页面复查或重启进程</font><?php }else if("open"==$switch_status && $alipaycashps_status){?>
										<font color="green">提现进程运行中...（刷新页面可复查提现进程状态）</font>
										<?php }else{echo "开启总闸后，刷新页面可复查提现进程状态";}?>
										</div>
										<div class="widget-toolbox padding-8 clearfix">
											<form action="<?php echo site_url('task/alipaycashswtichmgr/index');?>" style="float:left;">
												<select name="status">
													<option value="0">全部</option>
													<option value="1" <?php if($query['status']==1){?>selected="selected"<?php }?>>启用</option>
													<option value="2" <?php if($query['status']==2){?>selected="selected"<?php }?>>停用</option>
												</select>
												<select name="check_flag">
													<option value="0">全部</option>
													<option value="1" <?php if($query['status']==1){?>selected="selected"<?php }?>>测试通过</option>
													<option value="2" <?php if($query['status']==2){?>selected="selected"<?php }?>>测试失败</option>
													<option value="3" <?php if($query['status']==3){?>selected="selected"<?php }?>>未测试</option>
												</select>
	                                            <input value="<?php if($query['app_id']){echo $query['app_id']; }?>"  type="text" placeholder="app_id" name="app_id" class="col-xs-10 col-sm-2" style="margin-left:5px;height:34px;width:80px;"/>
	                                            <input value="<?php if($query['email']){echo $query['email']; }?>"  type="text" placeholder="注册邮箱" name="email" class="col-xs-10 col-sm-2" style="margin-left:5px;height:34px;width:80px;"/>
	                                            <input value="<?php if($query['update_admin']){echo $query['update_admin']; }?>" type="text" placeholder="操作人" name="update_admin"  class="col-xs-10 col-sm-2" style = "margin-left:5px;height:34px;width:80px;"/> 
												<input value="<?php if($query['pc_ip']){echo $query['pc_ip']; }?>" type="text" placeholder="注册IP" name="pc_ip"  class="col-xs-10 col-sm-2" style = "margin-left:5px;height:34px;width:80px;"/> 
												<input value="<?php if($query['start_time']){echo $query['start_time']; }?>" name="start_time" class="date-picker col-xs-10 col-sm-2" id="id_date_picker_1"  placeholder="开始时间（任务开启）" type="text" data-date-format="yyyy-mm-dd" style = "margin-left:5px;height:30px;width:100px;"  />
	                                            <input value="<?php if($query['end_time']){echo $query['end_time']; }?>" name="end_time" class=" date-picker col-xs-10 col-sm-2" id="id_date_picker_2"  placeholder="终止时间（任务开启）" type="text" data-date-format="yyyy-mm-dd" style = "margin-left:5px;height:30px;width:100px;"  />
	                                            <button class="btn btn-xs btn-success " style="margin-top:3px;">
	                                                <span class="bigger-110">查询</span>
	                                                <i class="icon-search icon-on-right"></i>
	                                            </button>
	                                         </form>
                                        </div>
                                        <div class="widget-body">
											<div class="widget-main" style="padding: 0;">
												<form action="" method="post" name="of" id="of">
													<table id="sample-table-2"
														class="table table-striped table-bordered table-hover" style="margin-bottom: 10px;">
														<thead id="targethead">
															<tr>
																<th><input type="checkbox" id="header_checkbox" onclick="checkAll(this)" /></th>
																<th>注册邮箱</th>
																<th>操作人</th>
																<th>操作时间</th>
																<th>备注说明</th>														
																<th>状态</th>
																<th>最近一次检测结果</th>
																<th>启用或测试</th>
																<th>操作</th>
															</tr>
														</thead>
														<tbody id="tbody">
														<?php if(!empty($config_list)){ foreach ($config_list as $v){ ?>
															<tr>
																<td><input type="checkbox" class="line_check_box" name="select_cash_ids[]" value="<?php echo $v['id']; ?>" /></td>
																<td><?php echo $v['email']; ?></td>
																<td><?php echo $v['update_admin']; ?></td>
																<td><?php echo $v['oper_time']; ?></td>
																<td><?php echo $v['describe']; ?></td>
																<td><?php if($v['status'] === '1'){echo '<font color="green">已启用</font>';}
																else if($v['status'] === '2'){echo '<font color="red">已禁用</font>';}
																else if($v['status'] === '3'){echo '<font color="blue">未启用</font>';}
																else{echo $v['status'];} ?></td>
																<td><?php if($v['check_flag'] === '1'){echo '<font color="green">通过</font>';}
																else if($v['check_flag'] === '2'){echo '<font color="red">未通过</font>';}
																else if($v['check_flag'] === '3'){echo '<font color="blue">未检测</font>';}
																else{echo $v['status'];} ?></td>
																<td style="width:60px;">
																	<a onclick="openOne('<?php echo $v['app_id']; ?>','<?php echo $v['check_flag']; ?>');" href="javascript:;">启用</a>|<br/>
																	<a href="<?php echo site_url('task/alipaycashswtichmgr/check').'?app_id='.$v['app_id']; ?>">检测</a>
																</td>
																<td style="width:60px;">
																	<a onclick="closeOne('<?php echo $v['app_id']; ?>');" href="javascript:;">禁用</a>
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
	
	function closeOne(app_id)
	{
		if (!confirm('确定禁用吗？'))
		{
			return;
		}

		location.href = '<?php echo site_url('task/alipaycashswtichmgr/close') . "?app_id="; ?>' + app_id;
		return;
	}
	function openOne(app_id,check_flag)
	{
		if(1!=check_flag){
			alert("未通过测试，不可开启！");
			return;
		}
		if (!confirm('确定开启吗？（必须确保该支付宝有钱才可开启）'))
		{
			return;
		}

		location.href = '<?php echo site_url('task/alipaycashswtichmgr/open') . "?app_id="; ?>' + app_id;
		return;
	}

	function openAlipayCash(){
		if (!confirm('确定开启吗？（请确保客服已经停止人工提现！！！）'))
		{
			return;
		}
		location.href = '<?php echo site_url('task/alipaycashswtichmgr/modifySwitch') . "?alipaycashswtich_status=open"; ?>';
		return;
	}
	function closeAlipayCash(){
		if (!confirm('确定关闭吗？（关闭后请通知客服开始人工提现）'))
		{
			return;
		}
		location.href = '<?php echo site_url('task/alipaycashswtichmgr/modifySwitch') . "?alipaycashswtich_status=close"; ?>';
		return;
	}

	function checkAll(obj){
		$("#tbody input[type='checkbox']").prop('checked', $(obj).prop('checked'));
	}
	
	</script>
</body>
</html>