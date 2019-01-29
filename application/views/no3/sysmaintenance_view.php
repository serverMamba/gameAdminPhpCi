<?php
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
						<!-- 开关支付 -->
						<div>
							<label class="control-label" style="font-weight:bold">运维开关</label>
						</div>
						<div class="col-xs-12">
							<div class="widget-box">
								<div class="widget-body">
									<div class="widget-main" style="padding: 0;">
										<form class="form-horizontal" action="<?php echo site_url('no3/sysmaintenance/modify'); ?>" method="post">
											<div class="form-group">
												<label for="" class="col-sm-1 control-label">游戏开关</label>
												<div class="col-sm-4">
													<input type="checkbox" name="open" value="1" <?php if ($gameSwitch['open'] == 1) { echo "checked"; } else { echo ""; }?>>打开
												</div>
											</div>
											<div class="form-group">
												<label for="" class="col-sm-1 control-label">关闭提示</label>
												<div class="col-sm-5">
													<input type="text" class="form-control" name="notice" value="<?php echo $gameSwitch['notice'];?>">
												</div>
											</div>
											<div class="form-group">
												<div class="col-sm-offset-2 col-sm-10">
													<button type="submit" class="btn btn-default">提交</button>
												</div>
											</div>
										</form>
										<div class="modal-body no-padding"></div>
									</div>
								</div>
							</div>
						</div>
						<!-- /.col -->
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
	<script src="<?php echo base_url().'res/js/date-time/bootstrap-datepicker.min.js'; ?>"></script>
    <script src="<?php echo base_url().'res/js/date-time/bootstrap-timepicker.min.js'; ?>"></script>
	<script src="<?php echo base_url().'res/js/ace-elements.min.js'; ?>"></script>
	<script src="<?php echo base_url().'res/js/ace.min.js'; ?>"></script>

	<script type="text/javascript">
	/**
	* 关闭支付宝账号
	*/
	function onclickCloseAccount(account)
	{
		if (confirm("确认关闭此账号吗？"))
		{
			location.href = "<?php echo site_url('no3/alipaytransferswitch/addInvalid').'?alipayAccount=';?>" + account;
		}
	}
		
	/**
	* 开启支付宝账号
	*/
	function onclickOpenAccount(account)
	{
		if (confirm("确认开启此账号吗？"))
		{
			location.href = "<?php echo site_url('no3/alipaytransferswitch/removeInvalid').'?alipayAccount=';?>" + account;
		}
	}

	</script>
</body>
</html>
