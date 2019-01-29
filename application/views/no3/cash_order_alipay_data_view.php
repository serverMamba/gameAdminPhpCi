<?php
$statusShowText = array(
		CASH_ORDER_STATUS_NEW => "新建",
		CASH_ORDER_STATUS_SUCCESS => "成功",
		CASH_ORDER_STATUS_FAIL => "失败",
		CASH_ORDER_STATUS_WAIT_REVIEW => "等待处理",
		CASH_ORDER_STATUS_REVIEW_PASS => "审核通过",
		CASH_ORDER_STATUS_UNKNOWN => "未知状态",
		CASH_ORDER_STATUS_DEALING => "处理中",
		) ;


$statusTextColor = array(
		CASH_ORDER_STATUS_NEW => "LightSlateBlue",
		CASH_ORDER_STATUS_SUCCESS => "DarkGreen",
		CASH_ORDER_STATUS_FAIL => "DarkRed",
		CASH_ORDER_STATUS_WAIT_REVIEW => "DarkGold",
		CASH_ORDER_STATUS_REVIEW_PASS => "green",
		CASH_ORDER_STATUS_UNKNOWN => "DimGray",
		CASH_ORDER_STATUS_DEALING => "GoldenRod",
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
								<div class="col-xs-12 col-sm-12">
									<a href="<?php echo site_url('no3/cashOrder'); ?>')">返回提现订单列表</a>												
								</div>
								<div class="col-xs-12 col-sm-12 widget-container-span">
									<div class="widget-box">		
										<!-- 提现订单数据 -->
										<div class="widget-body">
											<div class="widget-main" style="padding: 0;">
												<div class="col-xs-12 col-sm-12" style="margin-top: 12px">
													<table id="sample-table-2"
														class="table table-striped table-bordered table-hover" style="margin-bottom: 10px;">
														<thead id="targethead">
															<tr>
																<th>用户ID</th>
																<th>实际提现金额</th>
																<th>扣除手续费后金额</th>
																<th>提现后金币</th>
																<th>提现时间</th>
																<th>支付宝账号</th>
																<th>支付宝实名</th>
																<th>渠道</th>
																<th>状态</th>
																<th>处理完成/退款时间</th>
																<th>描述</th>
																<th>操作</th>
															</tr>
														</thead>
														<tbody id="tbody">
															<tr>
																<td class="td_user_id"><a href="<?php echo site_url('no3/infodetail').'?user_id='.$data['orderData']['user_id']; ?>"><?php echo $data['orderData']['user_id']; ?></a></td>
																<td><?php echo $data['orderData']['cash_money']; ?>元</td>
																<td><?php echo $data['orderData']['cut_money']; ?>元</td>
																<td><?php echo $data['orderData']['balance']; ?>金币</td>
																<td><?php echo date('Y-m-d H:i:s',$data['orderData']['add_time']); ?></td>
																<td><?php echo $data['orderData']['alipay_account']; ?></td>
																<td><?php echo $data['orderData']['alipay_real_name']; ?></td>	
																<td><?php echo $data['orderData']['channel']; ?></td>					
																<td>
																	<font color="<?php echo $statusTextColor[$data['orderData']['status']];?>"><?php echo $statusShowText[$data['orderData']['status']];?></font>
																</td>
																<td><?php if($data['orderData']['update_time']){ echo date('Y-m-d H:i:s',$data['orderData']['update_time']);}else{echo '-';}?></td>
																<td><?php echo $data['orderData']['discribe']; ?></td>
																<td>
																	<a onclick="onclickSetOrderSuccess('<?php echo site_url('no3/cashOrder/setCashOrderSuccess').'?id='.$data['orderData']['order_sn']; ?>')">成功</a>|
																	<a onclick="onclickSetOrderFail('<?php echo site_url('no3/cashOrder/refund').'?id='.$data['orderData']['order_sn']; ?>')">失败</a>|
																	<a onclick="onclickResetOrder('<?php echo site_url('no3/cashOrder/processAgain').'?id='.$data['orderData']['order_sn']; ?>')">重新处理</a>
																</td>
															</tr>
														</tbody>
													</table>
												</div>

												<!-- 支付宝日志 -->
												<div class="col-xs-12 col-sm-12" style="margin-top: 12px">
												相关支付宝日志：
												</div>
												<div class="col-xs-12 col-sm-12" style="margin-top: 12px">
													<table id="sample-table-2"
														class="table table-striped table-bordered table-hover" style="margin-bottom: 10px;">
														<thead id="targethead">
															<tr>
																<th>支付宝订单号</th>
																<th>订单时间</th>
																<th>金额</th>
																<th>状态</th>
																<th>状态描述</th>
																<th>收款方id</th>
																<th>收款方名字</th>
																<th>付款方id</th>
																<th>付款方名字</th>
																<th>操作者</th>
																<th>手续费</th>
																<th>备注</th>
															</tr>
														</thead>
														<tbody id="tbody">
														<?php if(!empty($data['alipayLogData'])){ foreach ($data['alipayLogData'] as $v){ ?>
															<tr>
																<td><?php echo $v['bizNo']; ?></td>
																<td><?php echo date('Y-m-d H:i:s', $v['bizDate']);?></td>
																<td><?php echo $v['payAmount']; ?>元</td>
																<td><?php echo $v['status']; ?></td>
																<td><?php echo $v['statusDesc']; ?></td>
																<td><?php echo $v['payeeLoginId']; ?></td>
																<td><?php echo $v['payeeAccountName']; ?></td>	
																<td><?php echo $v['payerLoginId']; ?></td>
																<td><?php echo $v['payerAccountName']; ?></td>	
																<td><?php echo $v['operatorName']; ?></td>	
																<td><?php echo $v['chargeFee']; ?></td>					
																<td><?php echo $v['memo']; ?></td>					
																<td>
																	<font color="<?php echo $statusTextColor[$data['orderData']['status']];?>"><?php echo $statusShowText[$data['orderData']['status']];?></font>
																</td>
																<td><?php if($data['orderData']['update_time']){ echo date('Y-m-d H:i:s',$data['orderData']['update_time']);}else{echo '-';}?></td>
																<td><?php echo $data['orderData']['discribe']; ?></td>
																<td>
																	<a onclick="onclickSetOrderSuccess('<?php echo site_url('no3/cashOrder/checkAlipayLogData').'?id='.$data['orderData']['order_sn']; ?>')">成功</a>|
																	<a onclick="refund('<?php echo $data['orderData']['order_sn']; ?>')">退款</a>|
																	<a onclick="onclickResetOrder('<?php echo site_url('no3/cashOrder/checkAlipayLogData').'?id='.$data['orderData']['order_sn']; ?>')">重新处理</a>
																</td>
															</tr>
														<?php }} ?>
														</tbody>
													</table>
												</div>
												<div class="modal-footer no-margin-top">
													<?php //echo $this->pagination->create_links();?>	
												</div>
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

	<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="chat_modal">
  		<div class="modal-dialog modal-lg">
    		<div class="modal-content">
    			<div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			        <h4 class="modal-title" id="chatModalTitle">退款理由</h4>
			    </div>
			    <div class="modal-body">
					<div style="margin-top: 10px;width: 100%;">
						<textarea class="form-control" style="width: 100%;" id="content" name="content" rows="3"></textarea>	
						<button style="margin-top: 5px;float: right;" onclick="ref('<?php echo site_url('no3/cashOrder/refund'); ?>');" id="reply_btn" class="btn btn-success">退款</button>
					</div>
				</div>
    		</div>
  		</div>
	</div>

	
	<script src="<?php echo base_url().'res/js/jquery-2.0.3.min.js'; ?>"></script>
	<script src="<?php echo base_url().'res/js/jquery-ui-1.10.3.custom.min.js'; ?>"></script>
	<script src="<?php echo base_url().'res/js/bootstrap.min.js'; ?>"></script>
	<script src="<?php echo base_url().'res/js/ace-elements.min.js'; ?>"></script>
	<script src="<?php echo base_url().'res/js/ace.min.js'; ?>"></script>
	<script src="<?php echo base_url().'js/context.js'; ?>"></script>
	<script type="text/javascript">
		// 如下方法用于退款 
		var refund_id = 0;
		var content = '';
		function refund(id){
			refund_id = id;
			$('#content').val('');		
			$('#chat_modal').modal('show');
		}

		function ref(url){
			content = encodeURIComponent($('#content').val());
			if(refund_id == 0 || content == ''){
				alert('信息错误');
				return false;
			}
			location.href = url + '?id='+refund_id+'&discribe='+content;
			return true;
		}
	</script>
</body>
</html>