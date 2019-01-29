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
															<input type="text" id="user_id" placeholder=""
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
															<label style="height: 26px; width: 100px; margin-left: 10px; margin-top: 5px;">手机系统<font color="red">*</font></label>
														</td>
														<td>
															<input type="text" id="phonesystem" placeholder=""
																class="col-xs-10 col-sm-2" value=""
																style="margin-left: 0px; height: 30px; width: 120px;" />
														</td>
														<td>
															<label style="height: 26px; width: 100px; margin-left: 10px; margin-top: 5px;">手机型号</label>
														</td>
														<td>
															<input type="text" id="phonemodel" placeholder=""
																class="col-xs-10 col-sm-2" value=""
																style="margin-left: 0px; height: 30px; width: 120px;" />
														</td>
													</tr>
													<tr>
														<td>
															<label style="height: 26px; width: 100px; margin-left: 10px; margin-top: 5px;">网络类型<font color="red">*</font></label>
														</td>
														<td>
															<input type="text" id="networktype" placeholder=""
																class="col-xs-10 col-sm-2" value=""
																style="margin-left: 0px; height: 30px; width: 120px;" />
														</td>
														<td>
															<label style="height: 26px; width: 100px; margin-left: 10px; margin-top: 5px;">所在城市</label>
														</td>
														<td>
															<input type="text" id="address" placeholder=""
																class="col-xs-10 col-sm-2" value=""
																style="margin-left: 0px; height: 30px; width: 360px;" />
														</td>
													</tr>
													<tr>
														<td>
															<label style="height: 26px; width: 100px; margin-left: 10px; margin-top: 5px;">包体大小</label>
														</td>
														<td>
															<input type="text" id="appsize" placeholder=""
																class="col-xs-10 col-sm-2" value=""
																style="margin-left: 0px; height: 30px; width: 120px;" />
														</td>
														<td>
															<label style="height: 26px; width: 100px; margin-left: 10px; margin-top: 5px;">包体来源</label>
														</td>
														<td>
															<input type="text" id="appsource" placeholder=""
																class="col-xs-10 col-sm-6" value=""
																style="margin-left: 0px; height: 30px; width: 360px;" />
														</td>
													</tr>
													<tr>
														<td>
															<label style="height: 26px; width: 100px;  margin-left: 10px; margin-top: 0px;">问题类型</label>
														</td>
														<td>
															<select name="bugtype" id="bugtype" style="margin-left: 0px; width: 120px;" >
																<option value="bug">游戏Bug</option>
																<option value="install">无法安装</option>
																<option value="conn">无法连接</option>
																<option value="slow">游戏卡顿</option>
																<option value="flash">游戏闪退</option>
																<option value="other">其他问题</option>
															</select>
														</td>
													</tr>
													<tr>
														<td>
															<label style="height: 26px; width: 100px; margin-left: 10px; margin-top: 5px;">问题描述<font color="red">*</font></label>
														</td>
														<td colspan="3">
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
													<button onclick="javascript:ajaxSaveBugNew()"
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
		$("#user_id").val("");
		$("#phonesystem").val("");
		$("#phonemodel").val("");
		$("#networktype").val("");
		$("#address").val("");
		$("#appsize").val("");
		$("#appsource").val("");
		$("#bugtype").val("bug");
		$("#describe").val("");
	}

	function ajaxSaveBugNew()
	{
		var _url = "<?php echo site_url('no3/clientbuginfo/ajaxSaveBugNew'); ?>";
		var _user_id = $('#user_id').val().trim();
		var _phonesystem = $('#phonesystem').val().trim();
		var _phonemodel = $('#phonemodel').val().trim();
		var _networktype = $('#networktype').val().trim();
		var _address = $('#address').val().trim();
		var _appsize = $('#appsize').val().trim();
		var _appsource = $('#appsource').val().trim();
		var _bugtype = $("#bugtype").val();
		var _describe = $('#describe').val().trim();
		if(_user_id == ''){
			$("#solveremark").html("<font color=\"red\">玩家帐号不可空!</font>");
			return;
		}
		if(_phonesystem == ''){
			$("#solveremark").html("<font color=\"red\">手机系统不可空!</font>");
			return;
		}
		if(_networktype == ''){
			$("#solveremark").html("<font color=\"red\">网络类型不可空!</font>");
			return;
		}
		if(_describe == ''){
			$("#solveremark").html("<font color=\"red\">问题描述不可空!</font>");
			return;
		}
		if(_describe.length>1500){
			$("#solveremark").html("<font color=\"red\">问题描述不能超过1500个字符!</font>");
			return;
		}
		
		_user_id = encodeURIComponent(_user_id);
		_describe = encodeURIComponent(_describe);
		_phonemodel = encodeURIComponent(_phonemodel);
		_address = encodeURIComponent(_address);
		_appsource = encodeURIComponent(_appsource);
		var _data_obj = {user_id:_user_id,phonesystem:_phonesystem,phonemodel:_phonemodel,networktype:_networktype,address:_address,appsize:_appsize,appsource:_appsource,bugtype:_bugtype,describe:_describe};
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
               		var url_bug = "<?php echo site_url('no3/clientbuginfo/toEdit'); ?>";
               		url_bug += "?id="+data.bug_id;
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
