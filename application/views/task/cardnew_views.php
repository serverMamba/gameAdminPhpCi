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
												<div>银行名称示例： 农业银行</div>
												<table class="common_table_div">
													<tr>
														<td>
															<label style="height: 26px; width: 100px; margin-left: 10px; margin-top: 5px;">收款账号<font color="red">*</font></label>
														</td>
														<td>
															<input type="text" id="bankcard_no" name="bankcard_no" placeholder=""
																class="col-xs-10 col-sm-2" value=""
																style="margin-left: 0px; height: 30px; width: 120px;" />
														</td>
														<td>
															<label style="height: 26px; width: 100px; margin-left: 10px; margin-top: 5px;">银行名称<font color="red">*</font></label>
															
														</td>
														<td>
															<input type="text" id="bank_branch" name="bank_branch" placeholder=""
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
															<label style="height: 26px; width: 100px; margin-left: 10px; margin-top: 5px;">收款人姓名<font color="red">*</font></label>
														</td>
														<td>
															<input type="text" id="cardholder_name" name="cardholder_name" placeholder=""
																class="col-xs-10 col-sm-2" value=""
																style="margin-left: 0px; height: 30px; width: 120px;" />
														</td>
														<td>
															<label style="height: 26px; width: 100px; margin-left: 10px; margin-top: 5px;">收款人手机<font color="red">*</font></label>
														</td>
														<td>
															<input type="text" id="cardholder_mobile" name="cardholder_mobile" placeholder=""
																class="col-xs-10 col-sm-2" value=""
																style="margin-left: 0px; height: 30px; width: 120px;" />
														</td>
													</tr>
													<hr/>
													<tr>
														<td>
															<label style="height: 26px; width: 100px; margin-left: 10px; margin-top: 5px;">客户类型<font color="red">*</font></label>
														</td>
														<td>
															<select id="customer_type" name="customer_type" class="form-control">
																<option value="01">个人</option>
																<option value="02">企业</option>
															</select>
														</td>
														<td>
															<label style="height: 26px; width: 100px; margin-left: 10px; margin-top: 5px;">资产类型<font color="red">*</font></label>
														</td>
														<td>
															<select id="account_type" name="account_type" class="form-control">
																<option value="01">借记卡</option>
																<option value="04">企业对公账户</option>
															</select>
														</td>
														<td style="display:none">
															<label style="height: 26px; width: 100px; margin-left: 10px; margin-top: 5px;">支付密码</label>
														</td>
														<td style="display:none">
															<input type="text" id="pay_password" name="pay_password" placeholder=""
																class="col-xs-10 col-sm-2" value=""
																style="margin-left: 0px; height: 30px; width: 120px;" />
														</td>
													</tr>
													<tr>
														<td>
															<label style="height: 26px; width: 100px; margin-left: 10px; margin-top: 5px;">收款银行卡总行联行号</label>
														</td>
														<td>
															<input type="text" id="headquarters_bank_id" name="headquarters_bank_id" placeholder=""
																class="col-xs-10 col-sm-2" value=""
																style="margin-left: 0px; height: 30px; width: 120px;" />
														</td>
														<td>
															<label style="height: 26px; width: 100px; margin-left: 10px; margin-top: 5px;">发卡行联行号</label>
														</td>
														<td>
															<input type="text" id="issue_bank_id" name="issue_bank_id" placeholder=""
																class="col-xs-10 col-sm-2" value=""
																style="margin-left: 0px; height: 30px; width: 120px;" />
														</td>
													</tr>
													<tr>
														<td>
															<label style="height: 26px; width: 100px; margin-left: 10px; margin-top: 5px;">备注</label>
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
													<button onclick="javascript:ajaxAddCardNew()"
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
		$("#bankcard_no").val("");
		$("#bank_branch").val("");
		$("#cardholder_name").val("");
		$("#cardholder_mobile").val("");
		$("#describe").val("");
	}

	function checkParams(_bankcard_no,_bank_branch,_cardholder_name,_cardholder_mobile,_describe){
		if(null==_bankcard_no || !_bankcard_no || typeof(_bankcard_no) == "undefined" || ""==_bankcard_no)
		{
			$("#solveremark").html("<font color=\"red\">收款账号不可空！</font>");//alert("收款账号不可空！");
			return false;
		}
		if(null==_bank_branch || typeof(_bank_branch) == "undefined" || ""==_bank_branch)
		{
			$("#solveremark").html("<font color=\"red\">支行名称不可空！</font>");//alert("支行名称不可空！");
			return false;
		}
		if(null==_cardholder_name || typeof(_cardholder_name) == "undefined" || ""==_cardholder_name)
		{
			$("#solveremark").html("<font color=\"red\">收款人姓名不可空！</font>");//alert("收款人姓名不可空！");
			return false;
		}
		if(null==_cardholder_mobile || typeof(_cardholder_mobile) == "undefined" || ""==_cardholder_mobile)
		{
			$("#solveremark").html("<font color=\"red\">收款人手机不可空！</font>");//alert("收款人手机不可空！");
			return false;
		}
		if(_describe.length>500)
		{
			$("#solveremark").html("<font color=\"red\">描述太长！</font>");//alert("描述太长！");
			return false;
		}
		return true;
	}
	
	function ajaxAddCardNew()
	{
		var _url = "<?php echo site_url('task/cardmgr/ajaxAddCardNew'); ?>";
		var _bankcard_no = $("#bankcard_no").val().trim();
		var _bank_branch = $("#bank_branch").val().trim();
		var _cardholder_name = $("#cardholder_name").val().trim();
		var _cardholder_mobile = $("#cardholder_mobile").val().trim();
		var _describe = $('#describe').val().trim();

		var _customer_type = $("#customer_type").val().trim();
		var _account_type = $("#account_type").val().trim();
		var _pay_password = $("#pay_password").val().trim();
		var _headquarters_bank_id = $("#headquarters_bank_id").val().trim();
		var _issue_bank_id = $("#issue_bank_id").val().trim();

		var paramFlag = checkParams(_bankcard_no,_bank_branch,_cardholder_name,_cardholder_mobile,_describe);
		if(!paramFlag){return;}
		_bankcard_no = encodeURIComponent(_bankcard_no);
		_bank_branch = encodeURIComponent(_bank_branch);
		_cardholder_name = encodeURIComponent(_cardholder_name);
		_cardholder_mobile = encodeURIComponent(_cardholder_mobile);
		_describe = encodeURIComponent(_describe);

		_customer_type = encodeURIComponent(_customer_type);
		_account_type = encodeURIComponent(_account_type);
		_pay_password = encodeURIComponent(_pay_password);
		_headquarters_bank_id = encodeURIComponent(_headquarters_bank_id);
		_issue_bank_id = encodeURIComponent(_issue_bank_id);
		
		var _data_obj = {bankcard_no:_bankcard_no,bank_branch:_bank_branch,cardholder_name:_cardholder_name,
				cardholder_mobile:_cardholder_mobile,describe:_describe,
				customer_type:_customer_type,account_type:_account_type,
				pay_password:_pay_password,headquarters_bank_id:_headquarters_bank_id,issue_bank_id:_issue_bank_id};
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
