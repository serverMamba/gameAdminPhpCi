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
										<div class="widget-body">
											<div class="widget-main" style="padding: 0;">
												<form class="form-horizontal" action="<?php if(isset($role)){ echo site_url('no3/role/edit/'.$role['id']);  }else{ echo site_url('no3/role/addRole'); } ?>" method="post">
													<div class="form-group">
														<label for="inputEmail3" class="col-sm-2 control-label">角色名称</label>
														<div class="col-sm-4">
															<input type="text" class="form-control" id="role_name" name="role_name"
																placeholder="请输入角色名称" value="<?php if(isset($role)){echo $role['role_name']; }?>">
														</div>
													</div>
													<div class="form-group">
														<label for="inputPassword3" class="col-sm-2 control-label">权限</label>
														<div class="col-sm-4">
															<?php if(isset($role)){$priv_ary = json_decode($role['priv'],true); }?>
															<select name="priv[]" multiple="multiple" size="30" style="width: 300px;">
															<?php foreach ($total_menu as $k=>$v){ ?>
																<option disabled="disabled"><?php echo $k; ?></option>
																<?php foreach ($v['child'] as $kc=>$kv){ ?>
																<option <?php if(isset($role) && in_array($kv['ns'], $priv_ary)){ ?> selected="selected" <?php } ?> value="<?php echo $kv['ns']; ?>"><?php echo '|----'.$kv['name']; ?></option>
																<?php } ?>
															<?php } ?>
															</select>															
														</div>
														<div class="col-sm-2">
															按 "ctrl" 或  "shift" 可进行多选
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
	<script
		src="<?php echo base_url().'res/js/jquery-ui-1.10.3.custom.min.js'; ?>"></script>
		<script src="<?php echo base_url().'res/js/bootstrap.min.js'; ?>"></script>
	<script src="<?php echo base_url().'res/js/ace-elements.min.js'; ?>"></script>
	<script src="<?php echo base_url().'res/js/ace.min.js'; ?>"></script>
</body>
</html>