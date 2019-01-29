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
												<form class="form-horizontal" action="<?php if(isset($admin)){ echo site_url('no3/admin/edit/'.$admin['id']);  }else{ echo site_url('no3/admin/add'); } ?>" method="post">
													<div class="form-group">
														<label for="inputEmail3" class="col-sm-2 control-label">账号</label>
														<div class="col-sm-4">
															<input type="text" class="form-control" id="admin_name" name="admin_name"
																placeholder="请输入管理员账号名称" value="<?php if(isset($admin)){echo $admin['admin_name']; }?>">
														</div>
													</div>
													<div class="form-group">
														<label for="inputEmail3" class="col-sm-2 control-label">密码</label>
														<div class="col-sm-4">
															<input type="password" class="form-control" id="pass1" name="pass1"
																<?php if(isset($admin)){ ?> placeholder="不修改密码请留空" <?php }else{ ?> placeholder="请输入密码" <?php } ?> value="">
														</div>
													</div>
													<div class="form-group">
														<label for="inputEmail3" class="col-sm-2 control-label">再次确认</label>
														<div class="col-sm-4">
															<input type="password" class="form-control" id="pass2" name="pass2"
																placeholder="请再次输入密码" value="">
														</div>
													</div>
													<?php if((isset($admin) && $admin['role_id'] > 1) || !isset($admin)){ ?>
													<div class="form-group">
														<label for="inputEmail3" class="col-sm-2 control-label">角色</label>
														<div class="col-sm-4">
															<select name="role_id" class="form-control">
																<option value="0">请选择...</option>
																<?php foreach ($role_list as $v){ if($v['id'] == 1) continue; ?>
																<option <?php if(isset($admin) && $admin['role_id'] == $v['id']){ ?> selected="selected" <?php } ?> value="<?php echo $v['id']; ?>"><?php echo $v['role_name']; ?></option>
																<?php } ?>
															</select>
														</div>
													</div>
													
													<div class="form-group">
														<label for="inputEmail3" class="col-sm-2 control-label">状态</label>
														<div class="col-sm-4">
															<label class="radio-inline">
															  <input type="radio" name="status" value="1" <?php if(!isset($admin) || $admin['status'] == 1){ ?> checked="checked" <?php } ?>> 开启
															</label>
															<label class="radio-inline">
															  <input type="radio" name="status" value="0" <?php if(isset($admin) && $admin['status'] == 0){ ?> checked="checked" <?php } ?>> 关闭
															</label>
														</div>
													</div>
													<?php } ?>
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