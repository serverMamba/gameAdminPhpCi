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
												<div><h3>基本信息：</h3></div>
												<table class="common_table_div">
													<tr>
														<td>
															<label style="height: 26px; width: 100px; margin-left: 10px; margin-top: 5px;">收款账号</label>
														</td>
														<td>
															<input type="text" id="bankcard_no" name="bankcard_no" placeholder="" disabled="disabled" 
																class="col-xs-10 col-sm-2" value="<?php echo $infoBase['bankcard_no'];?>"
																style="margin-left: 0px; height: 30px; width: 120px;" />
														</td>
														<td>
															<label style="height: 26px; width: 100px; margin-left: 10px; margin-top: 5px;">银行名称</label>
														</td>
														<td>
															<input type="text" id="bank_branch" name="bank_branch" placeholder="" disabled="disabled" 
																class="col-xs-10 col-sm-2" value="<?php echo $infoBase['bank_branch'];?>"
																style="margin-left: 0px; height: 30px; width: 120px;" />
														</td>
													</tr>
												</table>
											</div>
											<hr />
											<div class="widget-main" style="padding: 0;">
												<div><h3>派支付扩展信息：</h3></div>
												<table class="common_table_div">
													<tr>
														<td>
															<label style="height: 26px; width: 100px; margin-left: 10px; margin-top: 5px;">银行代码<font color="red">*</font></label>
														</td>
														<td>
															<select id="bank_code" name="bank_code" class="form-control">
																<option value="">请选择银行代码</option>
																<?php foreach ($bankCodes as $k=>$v){  ?>
																<option <?php if( $infoExpPai['bank_code'] == $k){ ?> selected="selected" <?php } ?> value="<?php echo $k; ?>"><?php echo $v; ?></option>
																<?php } ?>
															</select>
														</td>
														<td>
															<label style="height: 26px; width: 100px; margin-left: 10px; margin-top: 5px;">省份代码<font color="red">*</font></label>
														</td>
														<td>
															<select id="province_code" name="province_code" class="form-control">
																<option value="">请选择省份代码</option>
																<?php foreach ($provinceCodes as $k=>$v){  ?>
																<option <?php if( $infoExpPai['province_code'] == $k){ ?> selected="selected" <?php } ?> value="<?php echo $k; ?>"><?php echo $v; ?></option>
																<?php } ?>
															</select>
														</td>
														<td>
															<label style="height: 26px; width: 100px; margin-left: 10px; margin-top: 5px;">城市代码<font color="red">*</font></label>
														</td>
														<td>
															<select id="city_code" name="city_code" class="form-control">
																<option value="">请选择省份代码</option>
																<?php foreach ($cityCodes as $k=>$v){  ?>
																<option <?php if( $infoExpPai['city_code'] == $k){ ?> selected="selected" <?php } ?> value="<?php echo $k; ?>"><?php echo $v; ?></option>
																<?php } ?>
															</select>
														</td>
													</tr>
												</table>
											</div>
											<div class="modal-body no-padding">
												<div id="solveremark"></div>
												<div id="btn_ns_span" class="form-group">
													<button onclick="javascript:ajaxModifyCardExp()"
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
	function checkParams(_bankcard_no,_bank_code,_province_code,_city_code){
		if(null==_bankcard_no || !_bankcard_no || typeof(_bankcard_no) == "undefined" || ""==_bankcard_no)
		{
			$("#solveremark").html("<font color=\"red\">收款账号不可空！</font>");
			return false;
		}
		if(null==_bank_code || !_bank_code || typeof(_bank_code) == "undefined" || ""==_bank_code)
		{
			$("#solveremark").html("<font color=\"red\">请选择银行代码！</font>");
			return false;
		}
		if(null==_province_code || !_province_code || typeof(_province_code) == "undefined" || ""==_province_code)
		{
			$("#solveremark").html("<font color=\"red\">请选择省份代码！</font>");
			return false;
		}
		if(null==_city_code || !_city_code || typeof(_city_code) == "undefined" || ""==_city_code)
		{
			$("#solveremark").html("<font color=\"red\">请选择城市代码！</font>");
			return false;
		}
		return true;
	}
	
	function ajaxModifyCardExp()
	{
		var _url = "<?php echo site_url('task/cardmgr/ajaxModifyCardExp'); ?>";
		var _bankcard_no = $("#bankcard_no").val().trim();
		var _bank_code = $("#bank_code").val().trim();
		var _province_code = $("#province_code").val().trim();
		var _city_code = $("#city_code").val().trim();
		
		var paramFlag = checkParams(_bankcard_no,_bank_code,_province_code,_city_code);
		if(!paramFlag){return;}
		
		var _data_obj = {
				bankcard_no:_bankcard_no,
				bank_code:_bank_code,
				province_code:_province_code,
				city_code:_city_code
				};
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
           			//alert(data.msg);
					return false;
               	}else{
               		$("#solveremark").html("<font color=\"red\">保存成功</font>");
               		var url_task = "<?php echo site_url('task/cardmgr/index'); ?>";
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
