<?php

$statusShowText = array(
		CASH_ORDER_STATUS_ALL => "全部",
		CASH_ORDER_STATUS_NOT_COMPLETE => "等待处理",
		CASH_ORDER_STATUS_NEW => "新建",
		CASH_ORDER_STATUS_SUCCESS => "成功",
		CASH_ORDER_STATUS_FAIL => "失败",
		CASH_ORDER_STATUS_WAIT_REVIEW => "被过滤",
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
								<div class="col-xs-12 col-sm-12 widget-container-span">
									<div class="widget-box">		
										<div class="widget-toolbox padding-8 clearfix">
											<form action="<?php echo site_url('no3/cashOrder/index');?>" style="float:left;">
	                                            <input value="<?php if($query['user_id']){echo $query['user_id']; }?>"  type="text" placeholder="用户ID" name="user_id" class="col-xs-10 col-sm-2" style="margin-left:5px;height:34px;width:160px;"/>
	                                            <input value="<?php if($query['alipay_account']){echo $query['alipay_account']; }?>" type="text" placeholder="支付宝账号" name="alipay_account"  class="col-xs-10 col-sm-2" style = "margin-left:5px;height:34px;width:160px;"/> 
	                                            <input value="<?php if($query['order_sn']){echo $query['order_sn']; }?>" type="text" placeholder="订单号" name="order_sn"  class="col-xs-10 col-sm-2" style = "margin-left:5px;height:34px;width:160px;"/> 
												<input value="<?php if($query['start_time']){echo $query['start_time']; }?>" name="start_time" class="date-picker col-xs-10 col-sm-2" id="id_date_picker_1"  placeholder="开始时间" type="text" data-date-format="yyyy-mm-dd" style = "margin-left:5px;height:30px;width:100px;"  />
	                                            <input value="<?php if($query['end_time']){echo $query['end_time']; }?>" name="end_time" class=" date-picker col-xs-10 col-sm-2" id="id_date_picker_2"  placeholder="终止时间" type="text" data-date-format="yyyy-mm-dd" style = "margin-left:5px;height:30px;width:100px;"  />
												<select name="order_status">
													<?php foreach($statusShowText as $k => $v){ ?>
													<option <?php if($query['order_status'] == $k){ ?> selected="selected" <?php } ?> value="<?php echo $k?>"><?php echo $v?></option>
													<?php }?>
												</select>
	                                            <button class="btn btn-xs btn-success " style="margin-top:3px;">
	                                                <span class="bigger-110">查询</span>
	                                                <i class="icon-search icon-on-right"></i>
	                                            </button>
	                                         </form>
	                                         <span>未处理订单数：<?php echo $no_process_num; ?></span>
	                                         <button onclick="deleteblack('<?php echo site_url('no3/cashOrder/clearBlackAlipayAccount'); ?>');" class="btn btn-danger" style="border: none;float:right;">清空支付宝黑名单</button>																									                                          
                                        </div>
																		
										<div class="widget-body">
											<div class="widget-main" style="padding: 0;">
												<form action="" method="post" name="of" id="of">
													<button onclick="batchFinish('<?php echo site_url('no3/cashOrder/batchFinish'); ?>');" class="btn btn-danger" style="border: none;margin-bottom: 10px;">批量处理完成</button>												
													<button onclick="batchProcessAgain('<?php echo site_url('no3/cashOrder/batchProcessAgain'); ?>');" class="btn btn-danger" style="border: none;margin-bottom: 10px;">批量重新处理</button>	
													<button onclick="batchFinish('<?php echo site_url('no3/cashOrder/batchSuccess'); ?>');" class="btn btn-danger" style="border: none;margin-bottom: 10px;">批量处理成功</button>												
													<?php if('10' == $tip_msg){?><b><font color="red">支付宝提现异常停止，请通知技术人员重启提现进程！！！</font></b><?php }else if('00' == $tip_msg){?><b><font color="blue">支付宝提现已经停止，请通知技术人员查看或开始人工审核</font></b><?php }else{?><b><font color="green">支付宝提现运行中...</font></b><?php }?>
													<table id="sample-table-2"
														class="table table-striped table-bordered table-hover" style="margin-bottom: 10px;">
														<thead id="targethead">
															<tr>
																<th><input type="checkbox" id="header_checkbox" onclick="checkAll(this)" /></th>
																<th>用户ID</th>
																<th>提现订单号</th>
																<th>总充值</th>
																<th>总提现</th>
																<th>实际提现金额</th>
																<th>扣除手续费后金额</th>
																<th>提现赠送金额</th>
																<th>提现后金币</th>
																<th>提现时间</th>
																<th>支付宝账号</th>
																<th>支付宝实名</th>
																<th>渠道</th>
																<th>状态</th>
																<th>处理完成/退款时间</th>
																<th>描述</th>
																<th>操作</th>
																<th>人工提现</th>
															</tr>
														</thead>
														<tbody id="tbody">
														<?php if(!empty($cash_order_list)){ foreach ($cash_order_list as $v){ ?>
															<tr>
																<td><input type="checkbox" class="line_check_box" name="select_cash_ids[]" value="<?php echo $v['order_sn']; ?>" /></td>
																<td class="td_user_id" _data="<?php echo $v['user_id']; ?>">
																	<a href="<?php echo site_url('no3/infodetail').'?user_id='.$v['user_id']; ?>"><?php echo $v['user_id']; ?></a><br/><br/>
																	<font size="1">今日金豆记录总数:</font><br/><font <?php if(intval($v['todayGoldRecNum'])<50){?> color="red"<?php }?>><b><?php echo $v['todayGoldRecNum']; ?></b></font><br/>
																	<font size="1">今日后台加分次数:</font><br/><font <?php if(intval($v['todayBuyRecNum'])<=0){?> color="red"<?php }?>><b><?php echo $v['todayBuyRecNum']; ?></b></font>
																</td>
																<td><?php echo $v['order_sn']; ?></td>
																<td>
																	<?php echo $v['totalBuy']; ?>元<br/><br/>
																	<b><font size="1">今日充值:</font></b><br/><font <?php if(intval($v['todayBuy'])<=0){?> color="red"<?php }?>><b><?php echo $v['todayBuy']; ?>元</b></font><br/>
																</td>
																<td>
																	<?php echo $v['cash_total_money']; ?>元<br/><br/>
																	<b><font size="1">今日提现:</font></b><br/><font <?php if(intval($v['todayCash'])>=10000){?> color="red"<?php }?>><b><?php echo $v['todayCash']; ?>元</b></font><br/>
																</td>
																<td><?php echo $v['cash_money']; ?>元</td>
																<td><?php echo $v['cut_money']; ?>元</td>
																<td><?php echo $v['cash_send_money']/100; ?>元</td>
																<td><?php echo $v['balance']; ?>金币</td>
																<td><?php 
																	echo date('Y-m-d H:i:s',$v['add_time']); 
																	// 如果是为完成状态，则显示据目前多久
																	if ($v['status'] != CASH_ORDER_STATUS_SUCCESS && $v['status'] != CASH_ORDER_STATUS_FAIL)
																	{
																		echo "<p style='color:red'>已创建：{$v['add_delay_time']}</p>"; 
																	}
																?></td>
																<td><?php echo $v['alipay_account']; ?></td>
																<td><?php echo $v['alipay_real_name']; ?></td>	
																<td><?php echo $v['channel']; ?></td>					
																<td>
																	<font color="<?php echo $statusTextColor[$v['status']];?>"><?php echo $statusShowText[$v['status']];
																	if ($v['status'] == CASH_ORDER_STATUS_NEW && $v['cut_money'] > CASH_ORDER_NEED_REVIEW_AMOUNT)
																	{
																		echo "【需要审核】";
																	}
																	?></font>
																	<p>提现总额<?php echo $v['cash_total_money'];?>元<br/>本次提现<?php echo $v['cut_money'];?>元</p>
																</td>
																<td><?php 
																	if($v['update_time'])
																	{ 
																		echo date('Y-m-d H:i:s',$v['update_time']);
																		// 如果是在处理中，则显示处于当前状态多久
																		if ($v['status'] == CASH_ORDER_STATUS_DEALING)
																		{
																			echo "<p style='color:red'>处于当前状态：{$v['update_delay_time']}</p>"; 
																		}
																	}else{echo '-';}
																	?></td>
																<td><?php if ($v['status'] == CASH_ORDER_STATUS_WAIT_REVIEW)
																		{ echo "<p style='color:red'>{$v['discribe']}</p>"; }
																		else{echo $v['discribe'];} ?></td>
																<td>
																	<?php if($v['status'] == CASH_ORDER_STATUS_NEW || $v['status'] == CASH_ORDER_STATUS_DEALING || $v['status'] == CASH_ORDER_STATUS_WAIT_REVIEW){ ?>
																		<a onclick="refund('<?php echo $v['order_sn']; ?>');" href="javascript:;">退款</a>
																	<?php } ?>
																	<?php if ($v['status'] == CASH_ORDER_STATUS_WAIT_REVIEW || $v['status'] == CASH_ORDER_STATUS_UNKNOWN){ ?>
																	|
																		<a onclick="processAgain('<?php echo site_url('no3/cashOrder/processAgain').'?id='.$v['order_sn']; ?>');" href="javascript:;">重新处理</a>
																	<?php } ?>
																	<?php if($v['status'] == CASH_ORDER_STATUS_NEW && $v['cut_money'] > CASH_ORDER_NEED_REVIEW_AMOUNT){ ?>
																	|
																	<a href="<?php echo site_url('no3/cashOrder/reviewOrder').'?id='.$v['order_sn']; ?>">审核通过</a>
																	<?php } ?>
																	<!-- 
																	<?php if($v['status'] == CASH_ORDER_STATUS_UNKNOWN){ ?>
																	<a onclick="onclickCheckAlipayLog('<?php echo site_url('no3/cashOrder/checkAlipayLogData').'?order_sn='.$v['order_sn']; ?>')">查看支付宝日志</a>
																	<?php } ?>
																	 -->
																	<?php if($v['status'] == CASH_ORDER_STATUS_DEALING || $v['status'] == CASH_ORDER_STATUS_UNKNOWN || $v['status'] == CASH_ORDER_STATUS_WAIT_REVIEW){ ?>
																	|
																		<a onclick="onclickConfirmTransferSuccess('<?php echo $v['order_sn']; ?>')">确认转账成功</a>
																	<?php } ?>
																</td>
																<td>
																	<?php if((isset($v['is_artificial']) && 1==intval($v['is_artificial']))){?>
																		<a onclick="onclickViewArtificial('<?php echo $v['order_sn']; ?>')">查看提现截图</a>
																	<?php }else if(isset($goto_artificial) && $goto_artificial && ($v['status']==CASH_ORDER_STATUS_NEW || $v['status']==CASH_ORDER_STATUS_REVIEW_PASS)){?>
																		<a onclick="onclickCashArtificial('<?php echo $v['order_sn']; ?>')">人工提现</a>
																	<?php }else{
																		echo "-----";
																	}?>
																</td>
															</tr>
														<?php }} ?>
														</tbody>
													</table>
													</form>
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
	
	function checkAll(obj){
		$("#tbody input[type='checkbox']").prop('checked', $(obj).prop('checked'));
	}

	function batchFinish(url){
		$("#of").attr("action", url);
		$("#of").submit();
	}
	function batchProcessAgain(url){
		$("#of").attr("action", url);
		$("#of").submit();
	}
	var refund_id = 0;
	var content = '';
	function refund(id){
		refund_id = id;
		$('#content').val('');		
		$('#chat_modal').modal('show');
	}
	function processAgain(url){
		location.href = url;
		return true;
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

	function deleteblack(url){
		location.href = url;
		return true;
	}

	/**
	* 查看支付宝日志
	*/
	function onclickCheckAlipayLog(url)
	{
		location.href = url;
		return;
	}

	/**
	* 已经转账成功
	*/
	function onclickConfirmTransferSuccess(id)
	{
		if (confirm("确认此订单已经转账成功吗？"))
		{
			location.href = "<?php echo site_url('no3/cashOrder/setCashOrderSuccess').'?id=';?>" + id;
		}
	}

	//查看截图
	function onclickViewArtificial(id){
		location.href = "http://i.yuming.com/cashorder/" + id + ".jpg";
		return true;
	}
	//人工提现
	function onclickCashArtificial(id){
		if (confirm("确认此订单人工提现吗？"))
		{
			//location.href = "http://webapi.yuming.com/al/bt?order_sn=" + id;
			location.href = "<?php echo site_url('no3/cashOrder/setCashArtificial').'?id=';?>" + id;
		}
		return true;
	}
		
	</script>
</body>
</html>