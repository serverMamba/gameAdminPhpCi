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
					
					<a class="" style="font-weight:bold;float:right" href="<?php echo site_url('no3/alipayformal/config')?>">配置支付渠道参数</a>
					<div class="row">
						<!-- 开关支付 -->
						<div>
							<label class="control-label" style="font-weight:bold">支付总开关</label>
						</div>
						<div class="col-xs-12">
							<div class="widget-box">
								<div class="widget-main" style="padding: 0;">
									<form class="form-horizontal" action="<?php echo site_url('no3/alipayformal/closePay'); ?>" method="post">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-1 control-label">支付开关</label>
											<div class="col-sm-4">
												<input type="checkbox" name="closePay" value="1" <?php if ($closePay == 1) { echo "checked"; } else { echo ""; }?>>关闭
											</div>
										</div>
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-1 control-label">人工充值</label>
											<div class="col-sm-4">
												<input type="radio" name="brecharge" value="1" <?php if($brecharge == 1){ ?> checked="checked"  <?php } ?>/> 开启
												<input type="radio" name="brecharge" value="2" <?php if($brecharge != 1){ ?> checked="checked"  <?php } ?> /> 关闭
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
						<!-- /.col -->

						<!-- 支付宝支付 -->
						<div>
							<label class="control-label" style="font-weight:bold">支付宝第三方</label>
						</div>
						<div class="col-xs-12">
							<div class="widget-box">
								<div class="widget-main" style="padding: 0;">
									<form class="form-horizontal" action="<?php echo site_url('no3/alipayformal/alipayPay'); ?>" method="post">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-1 control-label">支付宝支付渠道</label>
											<div class="col-sm-4">
												<?php foreach ($aliPays as $k => $v){?>
												<div>
													<input type="checkbox" name="alipayPayPlatforms[]" value="<?php echo $k;?>" <?php if (key_exists($k, $alipayRange) && $alipayRange[$k]['open'] == 1) { echo "checked"; } else { echo ""; }?>><?php echo $v;?>
													<input type="text" style="width:100px" name="<?php echo 'min' . $k;?>" value="<?php if (key_exists($k, $alipayRange)) { echo $alipayRange[$k]['min']; } else { echo ""; } ?>" > - 
													<input type="text" style="width:100px" name="<?php echo 'max' . $k;?>" value="<?php if (key_exists($k, $alipayRange)) { echo $alipayRange[$k]['max']; } else { echo ""; } ?>" >
													关闭时间：<input type="number" placeholder="0~23" style="width:60px" name="<?php echo 'closeStart' . $k;?>" value="<?php if (key_exists($k, $alipayRange)) { echo $alipayRange[$k]['closeStart']; } else { echo ""; } ?>" > - 
													<input type="number" placeholder="0~23" style="width:60px" name="<?php echo 'closeEnd' . $k;?>" value="<?php if (key_exists($k, $alipayRange)) { echo $alipayRange[$k]['closeEnd']; } else { echo ""; } ?>" >
												</div>
												<?php }?>
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
						<!-- /.col -->

						<div>
							<label class="control-label" style="font-weight:bold">支付宝官方</label>
						</div>
						<div class="col-xs-12">
							<div class="widget-box">
								<div class="widget-main" style="padding: 0;">
									<form class="form-horizontal" action="<?php echo site_url('no3/alipayformal/modify'); ?>" method="post">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-1 control-label">金额(小于等于)</label>
											<div class="col-sm-4">
												<input type="text" class="form-control" id="alipayAmount" name="alipayAmount"
													placeholder="请输入金额" value="<?php if(isset($alipayAmount)){echo $alipayAmount; }?>">
											</div>
										</div>
									
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-1 control-label">开关时间</label>
											<div class="col-sm-8">
												<div>
													开启时间：<input type="number" class="" id="" name="openTime"
														placeholder="输入0~23小时数" value="<?php if(isset($openTime)){echo $openTime; }?>">
													结束时间：<input type="number" class="" id="" name="closeTime"
														placeholder="输入0~23小时数" value="<?php if(isset($closeTime)){echo $closeTime; }?>">
												</div>
												<div>
													(设置为相等则不会关闭)
												</div>
											</div>
										</div>
									
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-1 control-label">支付控制</label>
											<div class="col-sm-8">
												几秒内：<input type="number" class="" id="" name="controlDuration"
													placeholder="单位秒" value="<?php if(isset($controlDuration)){echo $controlDuration; }?>">
												支付几单：<input type="number" class="" id="" name="controlOrderNum"
													placeholder="订单数" value="<?php if(isset($controlOrderNum)){echo $controlOrderNum; }?>">
											</div>
										</div>
									
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-1 control-label">官方支付宝</label>
											<div class="col-sm-4">
												<div>
													<input type="radio" name="formalAlipayPlatformType" value="0" <?php if ($selectedPlatformType == 0) { echo "checked"; } else { echo ""; }?>>[不使用]
												</div>
												<?php foreach ($formalAlipays as $k => $v){?>
												<div>
													<input type="radio" name="formalAlipayPlatformType" value="<?php echo $k;?>" <?php if ($selectedPlatformType == $k) { echo "checked"; } else { echo ""; }?>><?php echo $v;?>
												</div>
												<?php }?>
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
						<!-- /.col -->

						<!-- 微信支付 -->
						<div>
							<label class="control-label" style="font-weight:bold">微信第三方</label>
						</div>
						<div class="col-xs-12">
							<div class="widget-box">
								<div class="widget-main" style="padding: 0;">
									<form class="form-horizontal" action="<?php echo site_url('no3/alipayformal/wxPay'); ?>" method="post">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-1 control-label">微信支付渠道</label>
											<div class="col-sm-4">
												<?php foreach ($wxPays as $k => $v){?>
												<div>
													<input type="checkbox" name="wxPayPlatforms[]" value="<?php echo $k;?>" <?php if (key_exists($k, $wxpayRange) && $wxpayRange[$k]['open'] == 1) { echo "checked"; } else { echo ""; }?>><?php echo $v;?>
													<input type="text" style="width:100px" name="<?php echo 'min' . $k;?>" value="<?php if (key_exists($k, $wxpayRange)) { echo $wxpayRange[$k]['min']; } else { echo ""; } ?>" > - 
													<input type="text" style="width:100px" name="<?php echo 'max' . $k;?>" value="<?php if (key_exists($k, $wxpayRange)) { echo $wxpayRange[$k]['max']; } else { echo ""; } ?>" >
												</div>
												<?php }?>
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
						<!-- /.col -->
						
						<!-- QQ支付 -->
						<div>
							<label class="control-label" style="font-weight:bold">QQ第三方</label>
						</div>
						<div class="col-xs-12">
							<div class="widget-box">
								<div class="widget-main" style="padding: 0;">
									<form class="form-horizontal" action="<?php echo site_url('no3/alipayformal/qqPay'); ?>" method="post">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-1 control-label">QQ支付渠道</label>
											<div class="col-sm-4">
												<?php foreach ($qqPays as $k => $v){?>
												<div>
													<input type="checkbox" name="qqPayPlatforms[]" value="<?php echo $k;?>" <?php if (key_exists($k, $qqpayRange) && $qqpayRange[$k]['open'] == 1) { echo "checked"; } else { echo ""; }?>><?php echo $v;?>
													<input type="text" style="width:100px" name="<?php echo 'min' . $k;?>" value="<?php if (key_exists($k, $qqpayRange)) { echo $qqpayRange[$k]['min']; } else { echo ""; } ?>" > - 
													<input type="text" style="width:100px" name="<?php echo 'max' . $k;?>" value="<?php if (key_exists($k, $qqpayRange)) { echo $qqpayRange[$k]['max']; } else { echo ""; } ?>" >
												</div>
												<?php }?>
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
						<!-- /.col -->
						
						<!-- JD支付 -->
						<div>
							<label class="control-label" style="font-weight:bold">京东钱包第三方</label>
						</div>
						<div class="col-xs-12">
							<div class="widget-box">
								<div class="widget-main" style="padding: 0;">
									<form class="form-horizontal" action="<?php echo site_url('no3/alipayformal/jdPay'); ?>" method="post">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-1 control-label">京东支付渠道</label>
											<div class="col-sm-4">
												<?php foreach ($jdPays as $k => $v){?>
												<div>
													<input type="checkbox" name="jdPayPlatforms[]" value="<?php echo $k;?>" <?php if (key_exists($k, $jdpayRange) && $jdpayRange[$k]['open'] == 1) { echo "checked"; } else { echo ""; }?>><?php echo $v;?>
													<input type="text" style="width:100px" name="<?php echo 'min' . $k;?>" value="<?php if (key_exists($k, $jdpayRange)) { echo $jdpayRange[$k]['min']; } else { echo ""; } ?>" > - 
													<input type="text" style="width:100px" name="<?php echo 'max' . $k;?>" value="<?php if (key_exists($k, $jdpayRange)) { echo $jdpayRange[$k]['max']; } else { echo ""; } ?>" >
												</div>
												<?php }?>
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
						<!-- /.col -->
						
						<!-- 银联快捷支付 -->
						<div>
							<label class="control-label" style="font-weight:bold">银联快捷支付</label>
						</div>
						<div class="col-xs-12">
							<div class="widget-box">
								<div class="widget-main" style="padding: 0;">
									<form class="form-horizontal" action="<?php echo site_url('no3/alipayformal/ylPay'); ?>" method="post">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-1 control-label">银联快捷支付渠道</label>
											<div class="col-sm-4">
												<?php foreach ($ylPays as $k => $v){?>
												<div>
													<input type="checkbox" name="ylPayPlatforms[]" value="<?php echo $k;?>" <?php if (key_exists($k, $ylpayRange) && $ylpayRange[$k]['open'] == 1) { echo "checked"; } else { echo ""; }?>><?php echo $v;?>
													<input type="text" style="width:100px" name="<?php echo 'min' . $k;?>" value="<?php if (key_exists($k, $ylpayRange)) { echo $ylpayRange[$k]['min']; } else { echo ""; } ?>" > - 
													<input type="text" style="width:100px" name="<?php echo 'max' . $k;?>" value="<?php if (key_exists($k, $ylpayRange)) { echo $ylpayRange[$k]['max']; } else { echo ""; } ?>" >
												</div>
												<?php }?>
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
