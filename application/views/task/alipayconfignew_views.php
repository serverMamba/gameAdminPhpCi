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
															<label style="height: 26px; width: 100px; margin-left: 10px; margin-top: 5px;">应用ID<font color="red">*</font></label>
														</td>
														<td>
															<input type="text" id="app_id" name="app_id" placeholder="app_id"
																class="col-xs-10 col-sm-2" value=""
																style="margin-left: 0px; height: 30px; width: 120px;" />
														</td>
														<td>
															<label style="height: 26px; width: 100px; margin-left: 10px; margin-top: 5px;">注册邮箱<font color="red">*</font></label>
														</td>
														<td>
															<input type="text" id="email" name="email" placeholder=""
																class="col-xs-10 col-sm-2" value=""
																style="margin-left: 0px; height: 30px; width: 120px;" />
														</td>
														<td>
															<label style="height: 26px; width: 100px; margin-left: 10px; margin-top: 5px;">注册IP<font color="red">*</font></label>
														</td>
														<td>
															<input type="text" id="pc_ip" name="pc_ip" placeholder=""
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
															<label style="height: 26px; width: 100px; margin-left: 10px; margin-top: 5px;">支付宝公钥<font color="red">*</font></label>
														</td>
														<td colspan="6">
															<textarea class="form-control"  style="width:100%; margin-right: 10px;"
																id="alipay_public_key" name="alipay_public_key" rows="3" ></textarea>
														</td>
													</tr>
													<tr>
														<td>
															<label style="height: 26px; width: 100px; margin-left: 10px; margin-top: 5px;">应用私钥<font color="red">*</font></label>
														</td>
														<td colspan="6">
															<textarea class="form-control"  style="width:100%; margin-right: 10px;"
																id="merchant_private_key" name="merchant_private_key" rows="10" ></textarea>
														</td>
													</tr>
													<tr>
														<td>
															<label style="height: 26px; width: 100px; margin-left: 10px; margin-top: 5px;">备注</label>
														</td>
														<td colspan="6">
															<textarea class="form-control"  style="width:100%; margin-right: 10px;"
																id="describe" name="describe" rows="3" ></textarea>
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
													<button onclick="javascript:ajaxAddAlipayConfigNew()"
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
		$("#app_id").val("");
		$("#email").val("");
		$("#pc_ip").val("");
		$("#alipay_public_key").val("");
		$("#merchant_private_key").val("");
		$("#describe").val("");
	}

	function checkParams(_appid,_alipay_public_key,_merchant_private_key,_email,_pc_ip){
		if(null==_appid || !_appid || typeof(_appid) == "undefined" || ""==_appid)
		{
			$("#solveremark").html("<font color=\"red\">应用ID不可空！</font>");//alert("收款账号不可空！");
			return false;
		}
		if(null==_alipay_public_key || typeof(_alipay_public_key) == "undefined" || ""==_alipay_public_key)
		{
			$("#solveremark").html("<font color=\"red\">支付宝公钥不可空！</font>");//alert("支行名称不可空！");
			return false;
		}
		if(null==_merchant_private_key || typeof(_merchant_private_key) == "undefined" || ""==_merchant_private_key)
		{
			$("#solveremark").html("<font color=\"red\">应用私钥不可空！</font>");//alert("收款人姓名不可空！");
			return false;
		}
		if(null==_email || !_email || typeof(_email) == "undefined" || ""==_email)
		{
			$("#solveremark").html("<font color=\"red\">请填写注册邮箱！</font>");//alert("收款账号不可空！");
			return false;
		}
		if(null==_pc_ip || !_pc_ip || typeof(_pc_ip) == "undefined" || ""==_pc_ip)
		{
			$("#solveremark").html("<font color=\"red\">请填写注册PC网址！</font>");//alert("收款账号不可空！");
			return false;
		}
		return true;
	}
	
	function ajaxAddAlipayConfigNew()
	{
		var _url = "<?php echo site_url('task/alipaycashswtichmgr/ajaxAddAlipayConfigNew'); ?>";
		var _appid = $("#app_id").val().trim();
		var _email = $("#email").val().trim();
		var _pc_ip = $("#pc_ip").val().trim();
		var _alipay_public_key = $("#alipay_public_key").val().trim();
		var _merchant_private_key = $("#merchant_private_key").val().trim();
		var _describe = $('#describe').val().trim();

		var paramFlag = checkParams(_appid,_alipay_public_key,_merchant_private_key,_email,_pc_ip);
		if(!paramFlag){return;}
		_describe = encodeURIComponent(_describe);
		
		var _data_obj = {app_id:_appid,email:_email,pc_ip:_pc_ip,
				alipay_public_key:_alipay_public_key,merchant_private_key:_merchant_private_key,describe:_describe};
		$("#solveremark").html("<font color=\"red\">提交中，请稍等。。。</font>");
		$.ajax({
			type:"POST",
            url:_url,
            data:_data_obj,
            dataType: "json",
            beforeSend:function(){
			}, 
            success:function(data){
           		if(data.code == 0){
           			$("#solveremark").html("<font color=\"red\">"+data.msg+"</font>");
           			//alert(data.msg);
					return false;
               	}else{
               		$("#solveremark").html("<font color=\"red\">保存成功</font>");
               		var url_task = "<?php echo site_url('task/alipaycashswtichmgr/index'); ?>";
               		location.href = url_task;
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
