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
												<table class="common_table_div">
													<tr>
														<td>
															<label style="height: 26px; width: 100px; margin-left: 10px; margin-top: 5px;">玩家账号<font color="red">*</font></label>
														</td>
														<td>
															<input type="text" id="limit_target" placeholder=""
																class="col-xs-10 col-sm-2" value=""
																style="margin-left: 0px; height: 30px; width: 120px;" />
														</td>
														<td>
															<label style="height: 26px; width: 100px; margin-left: 10px; margin-top: 5px;">记录人</label>
														</td>
														<td>
															<label style="height: 26px; width: 100px; margin-left: 10px; margin-top: 5px;"><?php echo $this->session->userdata('admin_name');?></label>
														</td>
													</tr>
													<tr>
														<td>
															<label style="height: 26px; width: 100px; margin-left: 10px; margin-top: 5px;">原因<font color="red">*</font></label>
														</td>
														<td colspan="3">
															<textarea class="form-control"  style="width:100%; margin-right: 10px;"
																id="discribe" name="discribe" rows="3" ></textarea>
														</td>
													</tr>
												</table>
											</div>
											<div class="modal-body no-padding">
												<div id="solveremark"></div>
												<div id="btn_ns_span" class="form-group">
													<button onclick="javascript:reset()"
														class="btn btn-xs btn-success "
														style="margin-top: 1px; margin-left: 10px;">
														<i class="icon-star-half icon-on-left"></i> <span
															class="bigger-110">重置</span>
													</button>
													<button onclick="javascript:ajaxAddPayLimitNew()"
														class="btn btn-xs btn-success " style="margin-top: 1px; margin-left: 10px;">
														<span class="bigger-110">提交</span> <i
															class="icon-search icon-on-right"></i>
													</button>
												</div>
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
	<!-- /.main-container -->
	<script src="<?php echo base_url().'res/js/jquery-2.0.3.min.js'; ?>"></script>
	<script src="<?php echo base_url().'res/js/jquery-ui-1.10.3.custom.min.js'; ?>"></script>
	<script src="<?php echo base_url().'res/js/bootstrap.min.js'; ?>"></script>
	<script src="<?php echo base_url().'res/js/date-time/bootstrap-datepicker.min.js'; ?>"></script>
    <script src="<?php echo base_url().'res/js/date-time/bootstrap-timepicker.min.js'; ?>"></script>
	<script src="<?php echo base_url().'res/js/ace-elements.min.js'; ?>"></script>
	<script src="<?php echo base_url().'res/js/ace.min.js'; ?>"></script>
	
	<script src="../res/js/date-time/bootstrap-datepicker.min.js"></script>
    <script src="../res/js/date-time/bootstrap-timepicker.min.js"></script>
    <script src="../res/js/date-time/moment.min.js"></script>
    <script src="../res/js/date-time/daterangepicker.min.js"></script>
    <script src="../res/js/date-time/daterangepicker.min.js"></script>
</body>
<script type="text/javascript">
	function reset() 
	{
		$("#solveremark").html("");
		$("#limit_target").val("");
		$("#discribe").val("");
	}

	function ajaxAddPayLimitNew()
	{
		var _url = "<?php echo site_url('no3/paylimit/ajaxAddPayLimit'); ?>";
		var _limit_target = $('#limit_target').val().trim();
		var _discribe = $('#discribe').val().trim();
		if(_limit_target == ''){
			$("#solveremark").html("<font color=\"red\">玩家帐号不可空!</font>");
			return;
		}
		if(_discribe == ''){
			$("#solveremark").html("<font color=\"red\">原因不可空!</font>");
			return;
		}
		if(_discribe.length>1500){
			$("#solveremark").html("<font color=\"red\">原因不能超过1500个字符!</font>");
			return;
		}
		
		_limit_target = encodeURIComponent(_limit_target);
		_discribe = encodeURIComponent(_discribe);
		var _data_obj = {limit_target:_limit_target,discribe:_discribe};
		$("#solveremark").html("<font color=\"red\">提交中，请稍等。。。</font>");
		$.ajax({
			type:"POST",
            url:_url,
            data:_data_obj,
            dataType: "json",
            beforeSend:function(){
			}, 
            success:function(data){
           		if(data.status == 0){
           			$("#solveremark").html("<font color=\"red\">"+data.msg+"</font>");
					return false;
               	}else{
               		$("#solveremark").html("<font color=\"red\">保存成功</font>");
               		var url_bug = "<?php echo site_url('no3/paylimit/index'); ?>";
               		location.href = url_bug;
                   	return true;           		
               	}         
            }          
         });
	}
	
	
	String.prototype.trim= function(){  
	    // 用正则表达式将前后空格  
	    // 用空字符串替代。  
	    return this.replace(/(^\s*)|(\s*$)/g, "");  
	}

</script>
</html>