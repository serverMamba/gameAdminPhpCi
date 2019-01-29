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
						<div class="col-xs-12 col-sm-12 widget-container-span">
							<div class="widget-box">
								<div class="widget-body">
									<form class="form-horizontal" action="<?php echo site_url('no3/alipaytransferswitch/modify'); ?>" method="post">
										<div class="form-group">
											<label for="" class="col-sm-1 control-label" style="font-weight:bold">开关时间</label>
											<div class="col-sm-11">
												<div>
													开启时间：<input type="number" class="" id="" name="openTime"
														placeholder="输入0~23小时数" value="<?php if(isset($openTime)){echo $openTime; }?>">
													结束时间：<input type="number" class="" id="" name="closeTime"
														placeholder="输入0~23小时数" value="<?php if(isset($closeTime)){echo $closeTime; }?>">
														(设置为相等则不会关闭)
													<button type="submit" class="">修改</button>
												</div>
											</div>
										</div>
									</form>
										
									<div class="widget-main" style="padding: 0;">
										<table id="sample-table-2"
											class="table table-striped table-bordered table-hover">
											<thead id="targethead">
												<tr>
													<th>编号</th>
													<th>支付宝账号</th>
													<th>跳转链接</th>
													<th>状态</th>
													<th>操作</th>
												</tr>
											</thead>
											<tbody>
											<?php foreach ($alipayAccounts as $v){ ?>
												<tr>
													<td><?php echo $v['id'];?></td>
													<td><?php echo $v['account']; ?></td>
													<td><?php echo $v['url']; ?></td>
													<td><?php if ($v['invalid']) {echo '已关闭';} else {echo '开启';} ?></td>
													<td>
														<?php if($v['invalid']){ ?>
															<a onclick="onclickOpenAccount('<?php echo $v['account']; ?>')">重新打开</a>
														<?php } else { ?>
															<a onclick="onclickCloseAccount('<?php echo $v['account']; ?>')">关闭</a>
														<?php } ?>
													</td>
												</tr>
											<?php } ?>
											</tbody>
										</table>
										
										<div class="modal-body no-padding"></div>
									</div>

								</div>
							</div>
						</div>
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
