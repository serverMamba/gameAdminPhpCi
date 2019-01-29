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
												<form class="form-horizontal" action="#">
													<div class="form-group">
														<label class="col-xs-10 col-sm-2"
															style="height: 26px; width: 80px; margin-left: 10px; margin-top: 5px;">账户ID</label>
														<input type="text" id="id" placeholder="" readonly="readonly"
															class="col-xs-10 col-sm-2" value="<?php echo $notice['id'];?>"
															style="margin-left: 0px; height: 30px; width: 120px;" />
														<label class="col-xs-10 col-sm-2"
															style="height: 26px; width: 80px; margin-left: 10px; margin-top: 5px;">是否启用</label>
														<input type="text" id="status" placeholder="" readonly="readonly"
															class="col-xs-10 col-sm-2" value="<?php echo $notice['status'];?>"
															style="margin-left: 0px; height: 30px; width: 120px;" />
													</div>
													<div class="form-group">
														<label class="col-xs-10 col-sm-2"
															style="height: 26px; width: 80px; margin-left: 10px; margin-top: 5px;">创建时间</label>
														<input type="text" id="addtime" placeholder="" readonly="readonly"
															class="col-xs-10 col-sm-2" value="<?php echo $notice['addtime'];?>"
															style="margin-left: 0px; height: 30px; width: 120px;" />
													
														<label class="col-xs-10 col-sm-2"
															style="height: 26px; width: 80px; margin-left: 10px; margin-top: 5px;">创建人</label>
														<input type="text" id="adduser" placeholder="" readonly="readonly"
															class="col-xs-10 col-sm-2" value="<?php echo $notice['adduser'];?>"
															style="margin-left: 0px; height: 30px; width: 120px;" />
													</div>
													<div class="form-group">
														<label class="col-xs-10 col-sm-2"
															style="height: 26px; width: 80px; margin-left: 10px; margin-top: 5px;">收款账号</label>
														<input type="text" id="bankcard_no" placeholder="" readonly="readonly"
															class="col-xs-10 col-sm-2" value="<?php echo $notice['bankcard_no'];?>"
															style="margin-left: 0px; height: 30px; width: 120px;" />
													
														<label class="col-xs-10 col-sm-2"
															style="height: 26px; width: 80px; margin-left: 10px; margin-top: 5px;">支行名称</label>
														<input type="text" id="bank_branch" placeholder="" readonly="readonly"
															class="col-xs-10 col-sm-2" value="<?php echo $notice['bank_branch'];?>"
															style="margin-left: 0px; height: 30px; width: 120px;" />
													</div>
													<div class="form-group">
														<label class="col-xs-10 col-sm-2"
															style="height: 26px; width: 80px; margin-left: 10px; margin-top: 5px;">收款人姓名</label>
														<input type="text" id="cardholder_name" placeholder="" readonly="readonly"
															class="col-xs-10 col-sm-2" value="<?php echo $notice['cardholder_name'];?>"
															style="margin-left: 0px; height: 30px; width: 120px;" />
													
														<label class="col-xs-10 col-sm-2"
															style="height: 26px; width: 80px; margin-left: 10px; margin-top: 5px;">收款人手机</label>
														<input type="text" id="cardholder_mobile" placeholder="" readonly="readonly"
															class="col-xs-10 col-sm-2" value="<?php echo $notice['cardholder_mobile'];?>"
															style="margin-left: 0px; height: 30px; width: 120px;" />
													</div>
													<div class="form-group">
														<label class="col-xs-10 col-sm-2"
															style="height: 26px; width: 80px; margin-left: 10px; margin-top: 5px;">客户类型</label>
														<input type="text" id="customer_type" placeholder="" readonly="readonly"
															class="col-xs-10 col-sm-2" value="<?php if('01'==$notice['customer_type']){echo '个人';}else if('02'==$notice['customer_type']){echo '企业';}else{echo $notice['customer_type'];}?>"
															style="margin-left: 0px; height: 30px; width: 120px;" />
													
														<label class="col-xs-10 col-sm-2"
															style="height: 26px; width: 80px; margin-left: 10px; margin-top: 5px;">资产类型</label>
														<input type="text" id="account_type" placeholder="" readonly="readonly"
															class="col-xs-10 col-sm-2" value="<?php if('01'==$notice['account_type']){echo '个人';}else if('04'==$notice['account_type']){echo '企业对公账户';}else{echo $notice['account_type'];}?>"
															style="margin-left: 0px; height: 30px; width: 120px;" />
														<!-- 	
														<label class="col-xs-10 col-sm-2"
															style="height: 26px; width: 80px; margin-left: 10px; margin-top: 5px;">支付密码</label>
														<input type="text" id="pay_password" placeholder="" readonly="readonly"
															class="col-xs-10 col-sm-2" value="<?php echo $notice['pay_password'];?>"
															style="margin-left: 0px; height: 30px; width: 120px;" />
														 -->
													</div>
													<div class="form-group">
														<label class="col-xs-10 col-sm-2"
															style="height: 26px; width: 80px; margin-left: 10px; margin-top: 5px;">收款银行卡总行联行号</label>
														<input type="text" id="headquarters_bank_id" placeholder="" readonly="readonly"
															class="col-xs-10 col-sm-2" value="<?php echo $notice['headquarters_bank_id'];?>"
															style="margin-left: 0px; height: 30px; width: 120px;" />
													
														<label class="col-xs-10 col-sm-2"
															style="height: 26px; width: 80px; margin-left: 10px; margin-top: 5px;">发卡行联行号</label>
														<input type="text" id="issue_bank_id" placeholder="" readonly="readonly"
															class="col-xs-10 col-sm-2" value="<?php echo $notice['issue_bank_id'];?>"
															style="margin-left: 0px; height: 30px; width: 120px;" />
													</div>
													<div class="form-group">
														<label class="col-xs-10 col-sm-2"
															style="height: 26px; width: 80px; margin-left: 10px; margin-top: 5px;">备注</label>
														<textarea class="form-control"  style="width:80%; margin-right: 10px;" readonly="readonly"
															id="describe" name="describe" rows="3" ><?php echo $notice['describe'];?></textarea>
													</div>
												</form>
											</div>
											<hr/>
												<div class="modal-body no-padding">
													<div id="solveremark"></div>
													<div id="btn_ns_span" class="form-group">
														<label class="col-xs-10 col-sm-2"
															style="height: 26px; width: 80px; margin-left: 10px; margin-top: 5px;">打款金额</label>
														<input type="text" name="amount" id="amount" placeholder=""
															class="col-xs-10 col-sm-2" value="0"
															style="margin-left: 0px; height: 30px; width: 120px;" />  
														<label class="col-xs-10 col-sm-2"
															style="height: 26px; width: 80px; margin-left: 10px; margin-top: 5px;">短信通知</label>
														<select name="notify_cardholder" id="notify_cardholder" style="margin-left: 0px; width: 120px;">
															<option value="y">是</option>
															<option value="n">否</option>
														</select>
													</div>
													<div id="btn_ns_span_weipai" class="form-group">
														<button onclick="javascript:ajaxAddTaskForm(1)"
															class="btn btn-xs btn-success "
															style="margin-top: 1px; margin-left: 20px;">
															<i class="icon-star-half icon-on-left"></i> <span
																class="bigger-110">微派-创建1个新任务</span>
														</button>
														<button onclick="javascript:ajaxAddTaskForm(5)"
															class="btn btn-xs btn-success "
															style="margin-top: 1px; margin-left: 20px;">
															<i class="icon-star-half icon-on-left"></i> <span
																class="bigger-110">微派-创建5个新任务</span>
														</button>
														<button onclick="javascript:ajaxAddTaskForm(10)"
															class="btn btn-xs btn-success "
															style="margin-top: 1px; margin-left: 20px;">
															<i class="icon-star-half icon-on-left"></i> <span
																class="bigger-110">微派-创建10个新任务</span>
														</button>
														<button onclick="javascript:ajaxAddTaskForm(20)"
															class="btn btn-xs btn-success "
															style="margin-top: 1px; margin-left: 20px;">
															<i class="icon-star-half icon-on-left"></i> <span
																class="bigger-110">微派-创建20个新任务</span>
														</button>
													</div>
													<div id="btn_ns_span_huiyi" class="form-group">
														<button onclick="javascript:ajaxAddHuiyiForm(1)"
															class="btn btn-xs btn-success "
															style="margin-top: 1px; margin-left: 20px;">
															<i class="icon-star-half icon-on-left"></i> <span
																class="bigger-110">汇亿-创建1个新任务</span>
														</button>
														<button onclick="javascript:ajaxAddHuiyiForm(5)"
															class="btn btn-xs btn-success "
															style="margin-top: 1px; margin-left: 20px;">
															<i class="icon-star-half icon-on-left"></i> <span
																class="bigger-110">汇亿-创建5个新任务</span>
														</button>
														<button onclick="javascript:ajaxAddHuiyiForm(10)"
															class="btn btn-xs btn-success "
															style="margin-top: 1px; margin-left: 20px;">
															<i class="icon-star-half icon-on-left"></i> <span
																class="bigger-110">汇亿-创建10个新任务</span>
														</button>
														<button onclick="javascript:ajaxAddHuiyiForm(20)"
															class="btn btn-xs btn-success "
															style="margin-top: 1px; margin-left: 20px;">
															<i class="icon-star-half icon-on-left"></i> <span
																class="bigger-110">汇亿-创建20个新任务</span>
														</button>
													</div>
													<div id="btn_ns_span_rongyin" class="form-group">
														<button onclick="javascript:ajaxAddRongyinForm(1)"
															class="btn btn-xs btn-success "
															style="margin-top: 1px; margin-left: 20px;">
															<i class="icon-star-half icon-on-left"></i> <span
																class="bigger-110">蓉银-创建1个新任务</span>
														</button>
														<button onclick="javascript:ajaxAddRongyinForm(5)"
															class="btn btn-xs btn-success "
															style="margin-top: 1px; margin-left: 20px;">
															<i class="icon-star-half icon-on-left"></i> <span
																class="bigger-110">蓉银-创建5个新任务</span>
														</button>
														<button onclick="javascript:ajaxAddRongyinForm(10)"
															class="btn btn-xs btn-success "
															style="margin-top: 1px; margin-left: 20px;">
															<i class="icon-star-half icon-on-left"></i> <span
																class="bigger-110">蓉银-创建10个新任务</span>
														</button>
														<button onclick="javascript:ajaxAddRongyinForm(20)"
															class="btn btn-xs btn-success "
															style="margin-top: 1px; margin-left: 20px;">
															<i class="icon-star-half icon-on-left"></i> <span
																class="bigger-110">蓉银-创建20个新任务</span>
														</button>
													</div>
													<hr/>
													<div>
														<lable style="margin-left: 10px;"><b>派提款扩展信息：</b></lable>
													</div>
													<div class="widget-main" style="padding: 0;">
														<div class="modal-body no-padding">
															<label class="col-xs-10 col-sm-2"
																style="height: 26px; width: 80px; margin-left: 10px; margin-top: 5px;">银行代码</label>
															<input type="text" id=bank_code placeholder="" readonly="readonly"
																class="col-xs-10 col-sm-2" value="<?php echo $infoExpPai['bank_code'];?>"
																style="margin-left: 0px; height: 30px; width: 120px;" />
															<label class="col-xs-10 col-sm-2"
																style="height: 26px; width: 80px; margin-left: 10px; margin-top: 5px;">省份代码</label>
															<input type="text" id="province_code" placeholder="" readonly="readonly"
																class="col-xs-10 col-sm-2" value="<?php echo $infoExpPai['province_code'];?>"
																style="margin-left: 0px; height: 30px; width: 120px;" />
															<label class="col-xs-10 col-sm-2"
																style="height: 26px; width: 80px; margin-left: 10px; margin-top: 5px;">城市代码</label>
															<input type="text" id="city_code" placeholder="" readonly="readonly"
																class="col-xs-10 col-sm-2" value="<?php echo $infoExpPai['city_code'];?>"
																style="margin-left: 0px; height: 30px; width: 120px;" />
														</div>
													</div>
													<br/>
													<br/>
													<div id="btn_ns_span_pai" class="form-group">
														<button onclick="javascript:ajaxAddPaiForm(1)"
															class="btn btn-xs btn-success "
															style="margin-top: 1px; margin-left: 20px;">
															<i class="icon-star-half icon-on-left"></i> <span
																class="bigger-110">派提款-创建1个新任务</span>
														</button>
														<button onclick="javascript:ajaxAddPaiForm(5)"
															class="btn btn-xs btn-success "
															style="margin-top: 1px; margin-left: 20px;">
															<i class="icon-star-half icon-on-left"></i> <span
																class="bigger-110">派提款-创建5个新任务</span>
														</button>
														<button onclick="javascript:ajaxAddPaiForm(10)"
															class="btn btn-xs btn-success "
															style="margin-top: 1px; margin-left: 20px;">
															<i class="icon-star-half icon-on-left"></i> <span
																class="bigger-110">派提款-创建10个新任务</span>
														</button>
														<button onclick="javascript:ajaxAddPaiForm(20)"
															class="btn btn-xs btn-success "
															style="margin-top: 1px; margin-left: 20px;">
															<i class="icon-star-half icon-on-left"></i> <span
																class="bigger-110">派提款-创建20个新任务</span>
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
	<script src="<?php echo base_url().'res/js/ace-elements.min.js'; ?>"></script>
	<script src="<?php echo base_url().'res/js/ace.min.js'; ?>"></script>
</body>
<script>
	function ajaxAddRongyinForm(patchNum){
		if(patchNum<=0){return;}
		var _amount = $("#amount").val();
		if(""==_amount)
		{
			$("#solveremark").html("<font color=\"red\">打款金额不可空！</font>");//alert("打款金额不可空！");
			return false;
		}
		if(isNaN(_amount) || !isInteger(_amount))
		{
			$("#solveremark").html("<font color=\"red\">打款金额必须为正整数！</font>");//alert("打款金额必须为数字！");
			return false;
		}
		if(parseInt(_amount)<=0)
		{
			$("#solveremark").html("<font color=\"red\">打款金额不能小于0！</font>");//alert("打款金额不可空！");
			return false;
		}
		var _url = "<?php echo site_url('task/taskmgr/ajaxAddRongyinForm'); ?>";
		var _card_id = "<?php echo $notice['id'];?>";
		if(_card_id == '' || _url == '' || _card_id.trim() == '' || isNaN(_card_id)  || _url.trim() == ''){
			$("#solveremark").html("<font color=\"red\">参数错误!</font>");
			return;
		}
		$.ajax({
	        type:"POST",
	        url:_url,
	        data:{
	            card_id:_card_id,
	            amount:_amount,
	            },
	        dataType: "json",
	        beforeSend:function(){
			}, 
	        success:function(data){
	       		if(data.status == 0){
	       			$("#solveremark").html("<font color=\"red\">"+data.msg+"</font>");
					return false;
	           	}else{
	           		$("#solveremark").html("<font color=\"red\">提交成功</font>");
	           		location.href = "<?php echo site_url('task/taskmgr/index'); ?>";
	           		patchNum--;
	           		ajaxAddRongyinForm(patchNum);
	               	return true;           		
	           	}         
	        }          
	     });
	}

    function ajaxAddHuiyiForm(patchNum){
    	if(patchNum<=0){return;}
		var _amount = $("#amount").val();
		if(""==_amount)
		{
			$("#solveremark").html("<font color=\"red\">打款金额不可空！</font>");//alert("打款金额不可空！");
			return false;
		}
		if(isNaN(_amount) || !isInteger(_amount))
		{
			$("#solveremark").html("<font color=\"red\">打款金额必须为正整数！</font>");//alert("打款金额必须为数字！");
			return false;
		}
		if(parseInt(_amount)<=0)
		{
			$("#solveremark").html("<font color=\"red\">打款金额不能小于0！</font>");//alert("打款金额不可空！");
			return false;
		}
		var _url = "<?php echo site_url('task/taskmgr/ajaxAddHuiyiForm'); ?>";
		var _card_id = "<?php echo $notice['id'];?>";
		if(_card_id == '' || _url == '' || _card_id.trim() == '' || isNaN(_card_id)  || _url.trim() == ''){
			$("#solveremark").html("<font color=\"red\">参数错误!</font>");
			return;
		}
		$.ajax({
            type:"POST",
            url:_url,
            data:{
                card_id:_card_id,
                amount:_amount,
                },
            dataType: "json",
            beforeSend:function(){
			}, 
            success:function(data){
           		if(data.status == 0){
           			$("#solveremark").html("<font color=\"red\">"+data.msg+"</font>");
					return false;
               	}else{
               		$("#solveremark").html("<font color=\"red\">提交成功</font>");
               		location.href = "<?php echo site_url('task/taskmgr/index'); ?>";
               		patchNum--;
               		ajaxAddHuiyiForm(patchNum);
                   	return true;           		
               	}         
            }          
         });
	}
    
	function ajaxAddTaskForm(patchNum){
		if(patchNum<=0){return;}
		var _amount = $("#amount").val();
		var _notify_cardholder = $("#notify_cardholder").val();
		if(""==_amount)
		{
			$("#solveremark").html("<font color=\"red\">打款金额不可空！</font>");//alert("打款金额不可空！");
			return false;
		}
		if(isNaN(_amount) || !isInteger(_amount))
		{
			$("#solveremark").html("<font color=\"red\">打款金额必须为正整数！</font>");//alert("打款金额必须为数字！");
			return false;
		}
		if(parseInt(_amount)<=0)
		{
			$("#solveremark").html("<font color=\"red\">打款金额不能小于0！</font>");//alert("打款金额不可空！");
			return false;
		}
		if("n"!=_notify_cardholder)
		{
			_notify_cardholder = "y";
		}
		var _url = "<?php echo site_url('task/taskmgr/ajaxAddTaskForm'); ?>";
		var _card_id = "<?php echo $notice['id'];?>";
		if(_card_id == '' || _url == '' || _card_id.trim() == '' || isNaN(_card_id)  || _url.trim() == ''){
			$("#solveremark").html("<font color=\"red\">参数错误!</font>");
			return;
		}
		
		$.ajax({
            type:"POST",
            url:_url,
            data:{
                card_id:_card_id,
                amount:_amount,
                notify_cardholder:_notify_cardholder,
                },
            dataType: "json",
            beforeSend:function(){
			}, 
            success:function(data){
           		if(data.status == 0){
           			$("#solveremark").html("<font color=\"red\">"+data.msg+"</font>");
					return false;
               	}else{
               		$("#solveremark").html("<font color=\"red\">提交成功</font>");
               		location.href = "<?php echo site_url('task/taskmgr/index'); ?>";
               		patchNum--;
               		ajaxAddTaskForm(patchNum);
                   	return true;           		
               	}         
            }          
         });
    }


	function ajaxAddPaiForm(patchNum){
		if(patchNum<=0){return;}
		var _amount = $("#amount").val();
		var _notify_cardholder = $("#notify_cardholder").val();
		if(""==_amount)
		{
			$("#solveremark").html("<font color=\"red\">打款金额不可空！</font>");//alert("打款金额不可空！");
			return false;
		}
		if(isNaN(_amount) || !isInteger(_amount))
		{
			$("#solveremark").html("<font color=\"red\">打款金额必须为正整数！</font>");//alert("打款金额必须为数字！");
			return false;
		}
		if(parseInt(_amount)<=0)
		{
			$("#solveremark").html("<font color=\"red\">打款金额不能小于0！</font>");//alert("打款金额不可空！");
			return false;
		}
		if("n"!=_notify_cardholder)
		{
			_notify_cardholder = "y";
		}
		var _url = "<?php echo site_url('task/taskmgr/ajaxAddPaiForm'); ?>";
		var _card_id = "<?php echo $notice['id'];?>";
		if(_card_id == '' || _url == '' || _card_id.trim() == '' || isNaN(_card_id)  || _url.trim() == ''){
			$("#solveremark").html("<font color=\"red\">参数错误!</font>");
			return;
		}

		var _bank_code = $("#bank_code").val().trim();
		var _province_code = $("#province_code").val().trim();
		var _city_code = $("#city_code").val().trim();
		if(_bank_code == '' || _province_code == '' || _city_code == '' ){
			$("#solveremark").html("<font color=\"red\">请首先完善派提款扩展信息!</font>");
			return;
		}
		
		$.ajax({
            type:"POST",
            url:_url,
            data:{
                card_id:_card_id,
                amount:_amount,
                notify_cardholder:_notify_cardholder,
                bank_code:_bank_code,
				province_code:_province_code,
				city_code:_city_code
                },
            dataType: "json",
            beforeSend:function(){
			}, 
            success:function(data){
           		if(data.status == 0){
           			$("#solveremark").html("<font color=\"red\">"+data.msg+"</font>");
					return false;
               	}else{
               		$("#solveremark").html("<font color=\"red\">提交成功</font>");
               		patchNum--;
               		ajaxAddPaiForm(patchNum);
                   	return true;           		
               	}         
            }          
         });
    }
    
	function post(URL, PARAMS) {
	    var temp = document.createElement("form");        
	    temp.action = URL;        
	    temp.method = "post";        
	    temp.style.display = "none";        
	    for (var x in PARAMS) {        
	        var opt = document.createElement("textarea");        
	        opt.name = x;        
	        opt.value = PARAMS[x];        
	        temp.appendChild(opt);        
	    }        
	    document.body.appendChild(temp);        
	    temp.submit();        
	    return temp;        
	}

	function isInteger(obj) {
		 return obj%1 === 0;
	}
	
	String.prototype.trim= function(){  
	    // 用正则表达式将前后空格  
	    // 用空字符串替代。  
	    return this.replace(/(^\s*)|(\s*$)/g, "");  
	}


</script>
</html>