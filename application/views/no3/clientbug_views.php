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
											<form action="<?php echo site_url('no3/clientbug/index');?>" style="float:left;">
	                                            <input value="<?php if($query['id']){echo $query['id']; }?>"  type="text" placeholder="工单号" name="id" class="col-xs-10 col-sm-2" style="margin-left:5px;height:34px;width:80px;"/>
	                                            <input value="<?php if($query['user_id']){echo $query['user_id']; }?>"  type="text" placeholder="玩家帐号" name="user_id" class="col-xs-10 col-sm-2" style="margin-left:5px;height:34px;width:80px;"/>
	                                            <input value="<?php if($query['operuser']){echo $query['operuser']; }?>" type="text" placeholder="记录人" name="operuser"  class="col-xs-10 col-sm-2" style = "margin-left:5px;height:34px;width:80px;"/> 
												<input value="<?php if($query['start_time']){echo $query['start_time']; }?>" name="start_time" class="date-picker col-xs-10 col-sm-2" id="id_date_picker_1"  placeholder="开始时间" type="text" data-date-format="yyyy-mm-dd" style = "margin-left:5px;height:30px;width:100px;"  />
	                                            <input value="<?php if($query['end_time']){echo $query['end_time']; }?>" name="end_time" class=" date-picker col-xs-10 col-sm-2" id="id_date_picker_2"  placeholder="终止时间" type="text" data-date-format="yyyy-mm-dd" style = "margin-left:5px;height:30px;width:100px;"  />
												<select name="status">
													<option value="">解决状态</option>
													<option value="0">开启</option>
													<option value="1">关闭</option>
												</select>
												<select name="bugtype">
													<option value="">问题类型</option>
													<option value="bug">游戏Bug</option>
													<option value="install">无法安装</option>
													<option value="conn">无法连接</option>
													<option value="slow">游戏卡顿</option>
													<option value="flash">游戏闪退</option>
													<option value="other">其他问题</option>
												</select>
	                                            <input type="text" placeholder="问题描述关键字" name="describe" class="col-xs-10 col-sm-2" style="margin-left:5px;height:34px;width:160px;"/>
	                                            <button class="btn btn-xs btn-success " style="margin-top:3px;">
	                                                <span class="bigger-110">查询</span>
	                                                <i class="icon-search icon-on-right"></i>
	                                            </button>
	                                         </form>
                                        </div>
                                        <div class="widget-body">
											<div class="widget-main" style="padding: 0;">
												<button onclick="batchFinish('<?php echo site_url('no3/clientbug/batchFinish'); ?>');" class="btn btn-danger" style="border: none;margin-bottom: 10px;">批量处理关闭</button>												
												<button onclick="addBugForm();" class="btn btn-danger" style="border: none;margin-bottom: 10px;">创建缺陷工单</button>												
												<form action="" method="post" name="of" id="of">
													<table id="sample-table-2"
														class="table table-striped table-bordered table-hover" style="margin-bottom: 10px;">
														<thead id="targethead">
															<tr>
																<th><input type="checkbox" id="header_checkbox" onclick="checkAll(this)" /></th>
																<!-- 
																<th>总充值</th>
																<th>总提现</th>
																<th>实际提现金额</th>
																<th>扣除手续费后金额</th>
																<th>提现后金币</th>
																<th>提现时间</th>
																<th>支付宝账号</th>
																<th>支付宝实名</th>
																<th>处理完成/退款时间</th>
																<th>描述</th>
																<th>渠道</th>
																
																<th>手机型号</th>
																<th>城市/地址</th>
																<th>包体大小</th>
																<th>包体来源</th>
																<th>网络状况</th>
																-->
																<th>单号</th>
																<th>状态</th>															
																<th>记录人</th>
																<th>记录时间</th>
																<th>玩家帐号</th>
																<th>手机系统</th>																
																<th>问题描述</th>
																<th>问题类型</th>																															
																<th>操作</th>
															</tr>
														</thead>
														<tbody id="tbody">
														<?php if(!empty($cash_order_list)){ foreach ($cash_order_list as $v){ ?>
															<tr>
																<td><input type="checkbox" class="line_check_box" name="select_cash_ids[]" value="<?php echo $v['id']; ?>" /></td>
																<td class="td_user_id" _data="<?php echo $v['id']; ?>"><a href="<?php echo site_url('no3/clientbuginfo/toEdit').'?id='.$v['id']; ?>"><?php echo $v['id']; ?></a></td>
																<!--
																<td><?php echo $v['totalBuy']; ?>元</td>
																<td><?php echo $v['cash_total_money']; ?>元</td>
																<td><?php echo $v['cash_money']; ?>元</td>
																<td><?php echo $v['cut_money']; ?>元</td>
																<td><?php echo $v['balance']; ?>金币</td>
																<td><?php echo date('Y-m-d H:i:s',$v['add_time']); ?></td>
																<td><?php echo $v['alipay_account']; ?></td>
																<td><?php echo $v['alipay_real_name']; ?></td>
																<td><?php if($v['update_time']){ echo date('Y-m-d H:i:s',$v['update_time']);}else{echo '-';}?></td>																
																<td><?php echo $v['discribe']; ?></td>
																<td><?php echo $v['channel']; ?></td>
																
																<td><?php echo $v['phonemodel']; ?></td>
																<td><?php echo $v['address']; ?></td>
																<td><?php echo $v['appsize']; ?></td>
																<td><?php echo $v['appsource']; ?></td>
																<td><?php echo $v['networktype']; ?></td>
																 -->	
																<td style="width:30px;"><?php if($v['status'] == 1){echo '<font color="green">关闭</font>';}else{echo '<font color="red">开启</font>';} ?></td>
																<td><?php echo $v['operuser']; ?></td>
																<td style="width:100px;"><?php if($v['opertime']){ echo $v['opertime'];}else{echo '-';}?></td>																
																<td><?php echo $v['user_id']; ?></td>
																<td><?php echo $v['phonesystem']; ?></td>																
																<td><?php echo $v['describe']; ?></td>
																<td style="width:50px;"><?php echo $bugtypeArr[$v['bugtype']]; ?></td>
																<td style="width:30px;">
																	<a href="<?php echo site_url('no3/clientbuginfo/toEdit').'?id='.$v['id']; ?>"><?php if($v['status'] != 1){echo '<font color="blue">处理</font>';}else{echo '<font color="green">查看</font>';} ?></a>
																	<?php } ?>
																</td>
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
	
	function batchFinish(url){
		$("#of").attr("action", url);
		$("#of").submit();
	}

	function createBugForm()
	{
		var _url = "<?php echo site_url('no3/clientbuginfo/toAdd'); ?>";
		location.href = _url;
		return true;
	}

	function addBugForm()
	{
		location.href = '<?php echo site_url('no3/clientbuginfo/toAdd'); ?>';
		return true;
	}

	function checkAll(obj){
		$("#tbody input[type='checkbox']").prop('checked', $(obj).prop('checked'));
	}
	
	</script>
</body>
</html>