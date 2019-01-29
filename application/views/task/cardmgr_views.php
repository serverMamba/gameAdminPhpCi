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
											<form action="<?php echo site_url('task/cardmgr/index');?>" style="float:left;">
	                                            <input value="<?php if($query['bankcard_no']){echo $query['bankcard_no']; }?>"  type="text" placeholder="收款账号" name="bankcard_no" class="col-xs-10 col-sm-2" style="margin-left:5px;height:34px;width:80px;"/>
	                                            <input value="<?php if($query['bank_branch']){echo $query['bank_branch']; }?>"  type="text" placeholder="支行名称" name="bank_branch" class="col-xs-10 col-sm-2" style="margin-left:5px;height:34px;width:80px;"/>
	                                            <input value="<?php if($query['cardholder_name']){echo $query['cardholder_name']; }?>" type="text" placeholder="收款人姓名" name="cardholder_name"  class="col-xs-10 col-sm-2" style = "margin-left:5px;height:34px;width:80px;"/> 
												<input value="<?php if($query['cardholder_mobile']){echo $query['cardholder_mobile']; }?>" type="text" placeholder="收款人手机" name="cardholder_mobile"  class="col-xs-10 col-sm-2" style = "margin-left:5px;height:34px;width:80px;"/> 
												<input value="<?php if($query['start_time']){echo $query['start_time']; }?>" name="start_time" class="date-picker col-xs-10 col-sm-2" id="id_date_picker_1"  placeholder="开始时间（任务开启）" type="text" data-date-format="yyyy-mm-dd" style = "margin-left:5px;height:30px;width:100px;"  />
	                                            <input value="<?php if($query['end_time']){echo $query['end_time']; }?>" name="end_time" class=" date-picker col-xs-10 col-sm-2" id="id_date_picker_2"  placeholder="终止时间（任务开启）" type="text" data-date-format="yyyy-mm-dd" style = "margin-left:5px;height:30px;width:100px;"  />
	                                            <input value="<?php if($query['describe']){echo $query['describe']; }?>" type="text" placeholder="备注关键字" name="describe"  class="col-xs-10 col-sm-2" style = "margin-left:5px;height:34px;width:80px;"/> 
	                                            <button class="btn btn-xs btn-success " style="margin-top:3px;">
	                                                <span class="bigger-110">查询</span>
	                                                <i class="icon-search icon-on-right"></i>
	                                            </button>
	                                         </form>
                                        </div>
                                        <div class="widget-body">
											<div class="widget-main" style="padding: 0;">
												<button onclick="createNewCard();" class="btn btn-danger" style="border: none;margin-bottom: 10px;">创建新账户</button>												
												<form action="" method="post" name="of" id="of">
													<table id="sample-table-2"
														class="table table-striped table-bordered table-hover" style="margin-bottom: 10px;">
														<thead id="targethead">
															<tr>
																<th><input type="checkbox" id="header_checkbox" onclick="checkAll(this)" /></th>
																<th>编号</th>
																<th>提现</th>
																<th>收款账号</th>														
																<th>支行名称</th>
																<th>收款人姓名</th>
																<th>收款人手机</th>
																<th>客户类型</th>														
																<th>资产类型</th>
																<th>收款银行卡总行联行号</th>
																<th>发卡行联行号</th>
																<th>创建时间</th>
																<th>创建人</th>
																<th>状态</th>	
																<th>操作</th>
																<th>扩展</th>
															</tr>
														</thead>
														<tbody id="tbody">
														<?php if(!empty($cash_order_list)){ foreach ($cash_order_list as $v){ ?>
															<tr>
																<td><input type="checkbox" class="line_check_box" name="select_cash_ids[]" value="<?php echo $v['id']; ?>" /></td>
																<td class="td_user_id" _data="<?php echo $v['out_trade_no']; ?>"><a href="<?php echo site_url('task/cardmgr/cardInfo').'?id='.$v['id']; ?>"><?php echo $v['id']; ?></a></td>
																<td style="width:30px;">
																	<a href="<?php echo site_url('task/cardmgr/cardInfo').'?id='.$v['id']; ?>"><font color="blue">提现</font></a><br/>
																</td>
																<td><?php echo $v['bankcard_no']; ?></td>
																<td><?php echo $v['bank_branch']; ?></td>
																<td><?php echo $v['cardholder_name']; ?></td>
																<td><?php echo $v['cardholder_mobile']; ?></td>
																<td><?php if($v['customer_type'] === '02'){echo '企业';}else{echo '个人';} ?></td>
																<td><?php if($v['account_type'] === '04'){echo '企业对公账户';}else{echo '借记卡';} ?></td>
																<td><?php echo $v['headquarters_bank_id']; ?></td>
																<td><?php echo $v['issue_bank_id']; ?></td>
																<td><?php echo $v['addtime']; ?></td>
																<td><?php echo $v['adduser']; ?></td>
																<td><?php if($v['status'] === 'y'){echo '<font color="green">启用</font>';}else{echo '<font color="red">禁用</font>';} ?></td>
																<td style="width:60px;">
																	<a href="<?php echo site_url('task/cardmgr/modify').'?id='.$v['id']; ?>">修改</a><br/>
																	|
																	<a onclick="deleteOne('<?php echo $v['id']; ?>');" href="javascript:;">删除</a>
																</td>
																<td style="width:50px;">
																	<a href="<?php echo site_url('task/cardmgr/modifyExpandedMsg').'?id='.$v['id']; ?>">编辑扩展</a><br/>
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
	
	function createNewCard()
	{
		location.href = '<?php echo site_url('task/cardmgr/createNewCard'); ?>';
		return true;
	}

	function deleteOne(id)
	{
		if (!confirm('确定删除吗？'))
		{
			return;
		}

		location.href = '<?php echo site_url('task/cardmgr/delete') . "?id="; ?>' + id;
		return;
	}


	function checkAll(obj){
		$("#tbody input[type='checkbox']").prop('checked', $(obj).prop('checked'));
	}
	
	</script>
</body>
</html>