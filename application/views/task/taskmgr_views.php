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
											<form action="<?php echo site_url('task/taskmgr/index');?>" style="float:left;">
	                                            <input value="<?php if($query['card_id']){echo $query['card_id']; }?>"  type="text" placeholder="账户ID" name="card_id" class="col-xs-10 col-sm-2" style="margin-left:5px;height:34px;width:80px;"/>
	                                            <input value="<?php if($query['amount']){echo $query['amount']; }?>"  type="text" placeholder="收款金额" name="amount" class="col-xs-10 col-sm-2" style="margin-left:5px;height:34px;width:80px;"/>
												<input value="<?php if($query['out_trade_no']){echo $query['out_trade_no']; }?>" type="text" placeholder="订单号" name="out_trade_no"  class="col-xs-10 col-sm-2" style = "margin-left:5px;height:34px;width:80px;"/> 
												<input value="<?php if($query['start_time']){echo $query['start_time']; }?>" name="start_time" class="date-picker col-xs-10 col-sm-2" id="id_date_picker_1"  placeholder="开始时间" type="text" data-date-format="yyyy-mm-dd" style = "margin-left:5px;height:30px;width:100px;"  />
	                                            <input value="<?php if($query['end_time']){echo $query['end_time']; }?>" name="end_time" class=" date-picker col-xs-10 col-sm-2" id="id_date_picker_2"  placeholder="终止时间" type="text" data-date-format="yyyy-mm-dd" style = "margin-left:5px;height:30px;width:100px;"  />
												<select name="notify_cardholder">
													<option value="">是否短信通知</option>
													<option value="y">是</option>
													<option value="n">否</option>
												</select>
												<select name="res_code">
													<option value="">订单状态</option>
													<option value="0">待处理</option>
													<option value="10000">打款成功</option>
													<option value="10101">单笔金额超出支付上限</option>
													<option value="10102">总金额超出支付上限</option>
													<option value="10103">余额不足</option>
													<option value="10201">请求参数不正确</option>
													<option value="10301">sign 签名不正确</option>
													<option value="10302">key 值不存在或未开通</option>
													<option value="10303">appid 错误</option>
													<option value="10304">打款记录已经存在</option>
													<option value="10401">请求异常</option>
												</select>
												<select name="pay_platform">
													<option value="">提现平台</option>
													<option value="31" <?php if('31'==$query['pay_platform']){ ?>selected="selected"<?php } ?>>微派</option>
													<option value="48" <?php if('48'==$query['pay_platform']){ ?>selected="selected"<?php } ?>>汇亿</option>
													<option value="87" <?php if('87'==$query['pay_platform']){ ?>selected="selected"<?php } ?>>派支付</option>
												</select>
	                                            <button class="btn btn-xs btn-success " style="margin-top:3px;">
	                                                <span class="bigger-110">查询</span>
	                                                <i class="icon-search icon-on-right"></i>
	                                            </button>
	                                         </form>
                                        </div>
                                        <div>
                                         	<button onclick="updatePaiOrdersStatus();" class="btn btn-danger" style="border: none;margin-bottom: 10px;">更新派支付提款单状态</button>
                                        </div>
                                        <div class="widget-body">
											<div class="widget-main" style="padding: 0;">
												<!-- 
												<button onclick="createNewTask();" class="btn btn-danger" style="border: none;margin-bottom: 10px;">创建新订单</button>	
												 -->											
												<form action="" method="post" name="of" id="of">
													<table id="sample-table-2"
														class="table table-striped table-bordered table-hover" style="margin-bottom: 10px;">
														<thead id="targethead">
															<tr>
																<th><input type="checkbox" id="header_checkbox" onclick="checkAll(this)" /></th>
																<th>状态</th>	
																<th>金额</th>
																<th>收款账号</th>														
																<th>支行名称</th>
																<th>收款人姓名</th>
																<th>收款人手机</th>
																<th>短信通知</th>
																<th>客户类型</th>														
																<th>资产类型</th>
																<th>收款银行卡总行联行号</th>
																<th>发卡行联行号</th>	
																<th>平台</th>													
																<th>创建时间</th>
																<th>订单号</th>
																<th>平台订单号</th>
																<th>处理时间</th>
																<th>結果描述</th>
															</tr>
														</thead>
														<tbody id="tbody">
														<?php if(!empty($cash_order_list)){ foreach ($cash_order_list as $v){ ?>
															<tr>
																<td><input type="checkbox" class="line_check_box" name="select_cash_ids[]" value="<?php echo $v['id']; ?>" /></td>
																<td><?php echo $states[$v['res_code']]; ?></td>
																<td><?php echo $v['amount']; ?></td>
																<td><?php echo $v['bankcard_no']; ?></td>
																<td><?php echo $v['bank_branch']; ?></td>
																<td><?php echo $v['cardholder_name']; ?></td>
																<td><?php echo $v['cardholder_mobile']; ?></td>
																<td><?php if($v['notify_cardholder'] === 'y'){echo '<font color="green">是</font>';}else{echo '<font color="red">否</font>';} ?></td>
																<td><?php if($v['customer_type'] === '02'){echo '企业';}else{echo '个人';} ?></td>
																<td><?php if($v['account_type'] === '04'){echo '企业对公账户';}else{echo '借记卡';} ?></td>
																<td><?php echo $v['headquarters_bank_id']; ?></td>
																<td><?php echo $v['issue_bank_id']; ?></td>
																<td><?php echo $pay_platform_list[$v['pay_platform']]; ?></td>
																<td><?php echo $v['addtime']; ?></td>
																<td><?php echo $v['out_trade_no']; ?></td>
																<td><?php echo $v['platform_orderid']; ?></td>
																<td><?php echo $v['opertime']; ?></td>
																<td><?php echo $v['res_msg']; ?></td>
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
	
	function createNewTask()
	{
		location.href = '<?php echo site_url('task/cardmgr/index'); ?>';
		return true;
	}

	function updatePaiOrdersStatus()
	{
		location.href = '<?php echo site_url('task/taskmgr/updatePaiOrdersStatus'); ?>';
		return true;
	}

	function checkAll(obj){
		$("#tbody input[type='checkbox']").prop('checked', $(obj).prop('checked'));
	}
	
	</script>
</body>
</html>