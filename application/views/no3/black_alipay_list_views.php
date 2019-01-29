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
											<button onclick="deleteblack('<?php echo site_url('no3/alipayBlackList/toAddBlack'); ?>');" class="btn btn-success" style="border: none;float:left;">添加支付宝黑名单</button>
											<form action="<?php echo site_url('no3/alipayBlackList/index');?>" style="float:left;">
	                                           	<input value="<?php if($query['alipay_account']){echo $query['alipay_account']; }?>" type="text" placeholder="支付宝账号" name="alipay_account"  class="col-xs-10 col-sm-2" style = "margin-left:5px;height:34px;width:160px;"/> 
												<input value="<?php if($query['alipay_real_name']){echo $query['alipay_real_name']; }?>" type="text" placeholder="支付宝实名" name="alipay_real_name"  class="col-xs-10 col-sm-2" style = "margin-left:5px;height:34px;width:160px;"/> 
												
	                                            <button class="btn btn-xs btn-success " style="margin-top:3px;">
	                                                <span class="bigger-110">查询</span>
	                                                <i class="icon-search icon-on-right"></i>
	                                            </button>
                                            </form>
                                            <button onclick="deleteblack('<?php echo site_url('no3/cashOrder/clearBlackAlipayAccount'); ?>');" class="btn btn-danger" style="border: none;float:right;">清空支付宝黑名单</button>		
                                        </div>
										<div class="widget-body">
											<div class="widget-main" style="padding: 0;">
												<table id="sample-table-2"
													class="table table-striped table-bordered table-hover">
													<thead id="targethead">
														<tr>
															<th>支付宝帐号</th>
															<th>支付宝实名</th>
															<th>黑名单原因</th>
															<th>黑名单时间</th>
															<th>操作</th>
														</tr>
													</thead>
													<tbody>
													<?php if(!empty($alipay_list)){ foreach ($alipay_list as $v){ ?>
														<tr>
															<td><?php echo $v['alipay_account']; ?></td>
															<td><?php echo $v['alipay_real_name']; ?></td>
															<td><?php echo $v['discribe']; ?></td>
															<td><?php echo date('Y-m-d H:i:s',$v['add_time']); ?></td>
															<td><a href="<?php echo site_url('no3/alipayBlackList/delBlack').'?id='.$v['id'];?>">删除</a></td>
														</tr>
													<?php }} ?>
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
	<script>
		function deleteblack(url){
			location.href = url;
			return true;
		}
	</script>
</body>
</html>