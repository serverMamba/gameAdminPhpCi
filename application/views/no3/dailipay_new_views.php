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
												<div>代理账号示例： wx18609090009</div>
												<table class="common_table_div">
													<tr>
														<td>
															<label style="height: 26px; width: 100px; margin-left: 10px; margin-top: 5px;">代理账号<font color="red">*</font></label>
														</td>
														<td>
															<input type="text" id="daili_no" name="daili_no" placeholder=""
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
													<button onclick="javascript:ajaxAddDailiPayNew()"
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
		$("#daili_no").val("");
		$("#describe").val("");
	}

	function checkParams(_daili_no,_describe){
		if(null==_daili_no || !_daili_no || typeof(_daili_no) == "undefined" || ""==_daili_no)
		{
			$("#solveremark").html("<font color=\"red\"代理账号不可空！</font>");
			return false;
		}
		if(_describe.length>500)
		{
			$("#solveremark").html("<font color=\"red\">描述太长！</font>");//alert("描述太长！");
			return false;
		}
		return true;
	}
	
	function ajaxAddDailiPayNew()
	{
		var _url = "<?php echo site_url('no3/dailipaymgr/ajaxAddDailiPayNew'); ?>";
		var _daili_no = $("#daili_no").val().trim();
		var _describe = $('#describe').val().trim();

		var paramFlag = checkParams(_daili_no,_describe);
		if(!paramFlag){return;}
		_daili_no = encodeURIComponent(_daili_no);
		_describe = encodeURIComponent(_describe);

		var _data_obj = {daili_no:_daili_no,describe:_describe};
		$("#solveremark").html("<font color=\"red\">提交中，请稍等。。。</font>");
		$.ajax({
			type:"POST",
            url:_url,
            data:_data_obj,
            dataType: "json",
            beforeSend:function(){
			}, 
            success:function(data){
           		if(data.status == 1){
               		$("#solveremark").html("<font color=\"red\">保存成功</font>");
               		var url_task = "<?php echo site_url('no3/dailipaymgr/index'); ?>";
               		location.href = url_task;
                   	return true;           		
               	}else{
               		$("#solveremark").html("<font color=\"red\">"+data.msg+"</font>");
					return false;
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
