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
					
					<a class="" style="font-weight:bold;float:right" href="<?php echo site_url('no3/alipayformal')?>">返回</a>
					<div class="row">
						<!-- 开关支付 -->
						<div>
							<label class="control-label" style="font-weight:bold">设置支付渠道信息(留空则使用默认)</label>
						</div>
						<div class="col-xs-12">
							<div class="widget-main" style="padding: 0;">
								<form class="form-horizontal" action="<?php echo site_url('no3/alipayformal/modifyConfig'); ?>" method="post">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-1 control-label">聚宝云</label>
										<div class="col-sm-4">
											合作者ID
											<input type="text" class="form-control" name="jubaoPartnerId" 
												 value="<?php echo $jubaoConfig["partnerId"];?>">
										</div>
									</div>

									<div class="form-group">
										<label for="inputEmail3" class="col-sm-1 control-label">畅付</label>
										<div class="col-sm-4">
											AppID<input type="text" class="form-control" name="cfAppId" value="<?php echo $cfConfig["appId"];?>">
											SecretKey<input type="text" class="form-control" name="cfSecretKey" value="<?php echo $cfConfig["secretKey"];?>">
										</div>
									</div>

									<div class="form-group">
										<div class="col-sm-offset-1 col-sm-10">
											<button type="submit" class="btn btn-default">提交</button>
										</div>
									</div>
								</form>
								<div class="modal-body no-padding"></div>
							</div>
						</div>
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
