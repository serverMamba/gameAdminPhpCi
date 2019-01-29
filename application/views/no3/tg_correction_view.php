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
						<div>
							<label class="control-label" style="font-weight:bold">修正推广链ID</label>
						</div>
						<div class="col-xs-12">
							<div class="widget-box">
								<div class="widget-body" style="padding: 10;">
									<div class="widget-main" style="padding: 5;">
										<div id="query_span" class="form-group">
											<div class="form-group">
												<div class="col-sm-4">
													<input type="text" id="userid" placeholder="用户ID" class="col-xs-20 col-sm-10" style="margin-left: 10px;width:230px;" />
													<button onclick="javascript:ajaxQueryPromotion()"
															class="btn btn-xs btn-success "
															style="margin-top: 1px; margin-left: 20px;">
															<i class="icon-star-half icon-on-left"></i> <span
																class="bigger-110">查询</span>
													</button>
												</div>
												<div id="solveremark"></div>
												<div class="col-sm-4">
													<span id="proid_1" style="width:150px"></span>&nbsp;
													<span id="proid_2" style="width:150px"></span>&nbsp;
													<span id="proid_3" style="width:150px"></span>
												</div>
												<div>
													<input id="old_proid_1" name="old_proid_1" type="hidden" value=""/>
													<input id="old_proid_2" name="old_proid_2" type="hidden" value=""/>
													<input id="old_proid_3" name="old_proid_3" type="hidden" value=""/>
												</div>
											</div>
										</div>
										<div class="modal-body no-padding"></div>
									</div>
									<br/>
									<div class="widget-main" style="padding: 5;">
										<div id="correction_span" class="form-group">
											<div class="col-sm-4">
												<input type="text" id="promotion_id" placeholder="请输入正确推广ID" class="col-xs-20 col-sm-10" style="margin-left: 10px;width:230px;" />
												<button onclick="javascript:ajaxCorrectionPromotion()"
														class="btn btn-xs btn-success "
														style="margin-top: 1px; margin-left: 20px;">
														<i class="icon-star-half icon-on-left"></i> <span
															class="bigger-110">提交</span>
												</button>
											</div>
										</div>
										<div class="modal-body no-padding"></div>
									</div>
									<br/>
								</div>
							</div>
						</div>
						<br/>
						<div class="col-xs-12">
							<iframe id="correction_log" scrolling="yes" frameborder="0" src="<?php echo site_url('no3/tgCorrection/tgCorrectionLog'); ?>"  style="width:100%;height:500px"></iframe>
						</div>
						<!-- /.col -->
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
	function ajaxQueryPromotion(){
		var _user_id = $('#userid').val().trim();
		if(""==_user_id||isNaN(_user_id)||parseInt(_user_id)<=0){
			$("#solveremark").html("<font color=\"red\">用户ID无效!</font>");
			return;
		}
		$('#userid').val(parseInt(_user_id));
		$("#solveremark").html("请稍候...");
		$("#proid_1").html("");
		$("#proid_2").html("");
		$("#proid_3").html("");
		$("#old_proid_1").val("");
		$("#old_proid_2").val("");
		$("#old_proid_3").val("");
		var _url = "<?php echo site_url('no3/tgCorrection/ajaxQueryPromotion'); ?>";
		$.ajax({
            type:"POST",
            url:_url,
            data:{user_id:_user_id},
            dataType: "json",
            beforeSend:function(){
			}, 
            success:function(data){
           		if(data.code == 1){
           			$("#solveremark").html(data.msg);
           			$("#proid_1").html(data.data_promotion.proid_1);
           			$("#proid_2").html(data.data_promotion.proid_2);
           			$("#proid_3").html(data.data_promotion.proid_3);
           			$("#old_proid_1").val(data.data_promotion.proid_1);
           			$("#old_proid_2").val(data.data_promotion.proid_2);
           			$("#old_proid_3").val(data.data_promotion.proid_3);
           			var _log_url = "<?php echo site_url('no3/tgCorrection/tgCorrectionLog'); ?>";
           			_log_url = _log_url.replace(".html","");
           			_log_url = _log_url+"?"+"user_id="+_user_id;
           			$("#correction_log").attr("src",_log_url);
					return true;
               	}else{
               		$("#solveremark").html("<font color=\"red\">"+data.msg+"</font>");
                   	return false;           		
               	}         
            }          
         });
	}

	function ajaxCorrectionPromotion(){
		var _user_id = $('#userid').val().trim();
		if(""==_user_id||isNaN(_user_id)){
			$("#solveremark").html("<font color=\"red\">用户ID无效!</font>");
			return;
		}
		_user_id = parseInt(_user_id);
		if(_user_id<=0){
			$("#solveremark").html("<font color=\"red\">用户ID无效!</font>");
			return;
		}
		var _promotion_id = $('#promotion_id').val().trim();
		if(""==_promotion_id||isNaN(_promotion_id)){
			$("#solveremark").html("<font color=\"red\">新的推广ID无效!</font>");
			return;
		}
		_promotion_id = parseInt(_promotion_id);
		/**
		if(_promotion_id<=0){
			$("#solveremark").html("<font color=\"red\">新的推广ID无效!</font>");
			return;
		}**/
		if(_promotion_id<0||_promotion_id==_user_id||_promotion_id>=1000000){
			$("#solveremark").html("<font color=\"red\">新的推广ID无效!</font>");
			return;
		}
		$('#userid').val(_user_id);
		$('#promotion_id').val(_promotion_id);
		var _proid_1 = $("#old_proid_1").val().trim();
		var _proid_2 = $("#old_proid_2").val().trim();
		var  _proid_3= $("#old_proid_3").val().trim();
		if(""==_proid_1||isNaN(_proid_1)||""==_proid_2||isNaN(_proid_2)||""==_proid_3||isNaN(_proid_3)){
			$("#solveremark").html("<font color=\"red\">请首先查询原推广ID!</font>");
			return;
		}
		_proid_1 = parseInt(_proid_1);
		_proid_2 = parseInt(_proid_2);
		_proid_3 = parseInt(_proid_3);
		/**
		if(_proid_1>0&&_proid_1==_proid_2&&_proid_1==_proid_3){
			$("#solveremark").html("<font color=\"red\">原推广ID合法，不可修改!</font>");
			return;
		}**/
		var fixStr = "";
		if(_promotion_id==0){
			fixStr = _user_id+"将无归属推广ID！！！";
		}
		if (!confirm('确定要将'+_user_id+'推广ID修正为'+_promotion_id+'吗？'+fixStr)) {
			$("#solveremark").html("");
			return;
		}
		if(_proid_1>0&&_proid_1==_proid_2&&_proid_1==_proid_3){
			if (!confirm('原推广ID合法，确定修改为'+_promotion_id+'吗?')) {
				$("#solveremark").html("");
				return;
			}
		}
		$("#solveremark").html("请稍候...");
		var _url = "<?php echo site_url('no3/tgCorrection/ajaxCorrectionPromotion'); ?>";
		$.ajax({
            type:"POST",
            url:_url,
            data:{user_id:_user_id,promotion_id:_promotion_id},
            dataType: "json",
            beforeSend:function(){
			}, 
            success:function(data){
           		if(data.code == 1){
           			$("#solveremark").html("修改成功！");
               	}else{
               		$("#solveremark").html("<font color=\"red\">"+data.msg+"</font>");
               	}
           		$("#proid_1").html(data.data_promotion.proid_1);
       			$("#proid_2").html(data.data_promotion.proid_2);
       			$("#proid_3").html(data.data_promotion.proid_3);
       			$("#old_proid_1").val(data.data_promotion.proid_1);
       			$("#old_proid_2").val(data.data_promotion.proid_2);
       			$("#old_proid_3").val(data.data_promotion.proid_3);
               	return true;         
            }          
         });
	}

	</script>
</body>
</html>
