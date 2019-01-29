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
											<form action="<?php echo site_url('no3/tgAccount/income/'.$tg_account_id);?>">
	                                           	<input value="<?php echo $start_date; ?>" name="start_date" class="date-picker col-xs-10 col-sm-2" id="id_date_picker_1"  placeholder="开始时间" type="text" data-date-format="yyyy-mm-dd" style = "margin-left:5px;height:30px;width:100px;"  />
	                                            <input value="<?php echo $end_date; ?>" name="end_date" class=" date-picker col-xs-10 col-sm-2" id="id_date_picker_2"  placeholder="终止时间" type="text" data-date-format="yyyy-mm-dd" style = "margin-left:5px;height:30px;width:100px;"  />
												
	                                            <button class="btn btn-xs btn-success " style="margin-top:3px;">
	                                                <span class="bigger-110">查询</span>
	                                                <i class="icon-search icon-on-right"></i>
	                                            </button>
                                            </form>
                                        </div>
										<div class="widget-body">
											<div class="widget-main" style="padding: 0;">
												<div>充值总计：<?php echo $total_pay / 100; ?>元</div>
												<div>抽水总计：<?php echo $total_mission / 100; ?>元</div>
												<div>收入总计：<?php echo $total_income / 100; ?>元</div>
												<table class="table table-border table-bordered table-hover table-bg table-sort">
													<thead>
														<tr class="text-c">
															<th width="30">时间</th>
															<th width="50">推广名称</th>
															<th width="50">游戏总抽水金额</th>
															<th width="50">您的提成比例</th>
															<th width="50">下级提成比例</th>
															<th width="50">收入</th>
														</tr>
													</thead>
													<tbody>
														<?php if(!empty($promotion_data)){ foreach ($promotion_data as $k=>$v){ ?>
														<tr class="text-c">
															<td rowspan="<?php echo count($v);?>"><?php echo $k; ?></td>
															<?php $i=0;foreach ($v as $k1=>$v1){ ?>
																<?php if($i>0){ ?>
																<tr class="text-c">
																<?php } ?>
																<td><?php echo $v1['name']; ?>
																	<?php if(isset($v1['account_id']) && $v1['account_id'] == $account_id){ ?>
																		（直推）
																	<?php }else if(isset($v1['agent_name'])){ ?>
																		（下级代理 : <?php echo $v1['agent_name']; ?>）
																	<?php } ?>
																</td>
																<td><?php echo $v1['commission_amount']/100; ?>元</td>	
																<td><?php echo $member['commission'] * 100; ?>%</td>
																<td><?php if(isset($v1['commission'])){echo ($v1['commission']*100).'%';}else{echo '-';} ?></td>
																<td><?php echo $v1['income_amount']/100; ?>元</td>
																<?php if($i>0){ ?>
																</tr>
																<?php } ?>
															<?php $i++;} ?>
														</tr>
														<?php }} ?>
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
	<script src="<?php echo base_url().'res/js/jquery-ui-1.10.3.custom.min.js'; ?>"></script>
	<script src="<?php echo base_url().'res/js/bootstrap.min.js'; ?>"></script>
	<script src="<?php echo base_url().'res/js/date-time/bootstrap-datepicker.min.js'; ?>"></script>
    <script src="<?php echo base_url().'res/js/date-time/bootstrap-timepicker.min.js'; ?>"></script>
	<script src="<?php echo base_url().'res/js/ace-elements.min.js'; ?>"></script>
	<script src="<?php echo base_url().'res/js/ace.min.js'; ?>"></script>	
	
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