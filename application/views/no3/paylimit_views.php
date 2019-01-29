<!DOCTYPE html>
<html lang="en">
    <?php $this->load->view('no3/common/header'); ?>
    <script src="<?php echo base_url().'res/js/jquery-2.0.3.min.js'; ?>"></script>
	<script src="<?php echo base_url().'res/js/jquery-ui-1.10.3.custom.min.js'; ?>"></script>
	<script src="<?php echo base_url().'res/js/bootstrap.min.js'; ?>"></script>
	<script src="<?php echo base_url().'res/js/date-time/bootstrap-datepicker.min.js'; ?>"></script>
	<script src="<?php echo base_url().'res/js/date-time/bootstrap-timepicker.min.js'; ?>"></script>
	<script src="<?php echo base_url().'res/js/ace-elements.min.js'; ?>"></script>
	<script src="<?php echo base_url().'res/js/ace.min.js'; ?>"></script>
	<script src="<?php echo base_url().'js/context.js'; ?>"></script>
		
	<script src="../res/js/date-time/moment.min.js"></script>
	<script src="../res/js/date-time/daterangepicker.min.js"></script>
    
	<script type="text/javascript">
	$(function(){
		$('#id_date_picker_1').datepicker({autoclose:true}).on(ace.click_event, function(){
			$("#id_date_picker_1").focus();
		});
		$('#id_date_picker_2').datepicker({autoclose:true}).on(ace.click_event, function(){
				$("#id_date_picker_2").focus();
		});
	});

	function addPaylimit()
	{
		var to_url = "<?php echo site_url('no3/paylimit/toAddPaylimit'); ?>";
		location.href = to_url;
	}

	function ajaxSyncPaylimit()
	{
		var flag = confirm("确认同步？ \r(Redis清库或重启后，需要进行手工同步)");
		if(!flag)
		{
			return;
		}
		$("#solveremark").html("<font color=\"red\">同步中，请稍候。。。</font>");
		var _url = window.location.protocol + "//" + window.location.host + "/no3/paylimit/ajaxSyncPaylimit";
		$.ajax({
			type:"POST",
            url:_url,
            data:{},
            dataType: "json",
            beforeSend:function(){
			}, 
            success:function(data){
            	if(data.status == 0){
           			$("#solveremark").html("<font color=\"red\">同步失败！</font>");
					return false;
               	}else{
               		$("#solveremark").html("<font color=\"red\">同步成功！</font>");
                   	return true;
               	}
            }          
         });
	}

	function ajaxDelPaylimit(key)
	{
		var flag = confirm("确认删除？");
		if(!flag)
		{
			return;
		}
		if(key == null || key == undefined || key == '' || (key+"").trim() == ''){
			$("#solveremark").html("<font color=\"red\">参数错误!</font>");
			return;
		}
		key = key+"";
		$("#solveremark").html("<font color=\"red\">删除中，请稍候。。。</font>");
		var _url = window.location.protocol + "//" + window.location.host + "/no3/paylimit/ajaxDelPaylimit";
		$.ajax({
			type:"POST",
            url:_url,
            data:{limit_target:key},
            dataType: "json",
            beforeSend:function(){
			}, 
            success:function(data){
            	if(data.status == 0){
           			$("#solveremark").html("<font color=\"red\">删除失败！</font>");
					return false;
               	}else{
               		$("#solveremark").html("<font color=\"red\">删除成功！</font>");
               		location.href = window.location.protocol + "//" + window.location.host + "/no3/paylimit/index";
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
										<div class="widget-toolbox padding-8 clearfix">
											<form action="<?php echo site_url('no3/paylimit/index');?>" method="post" style="float:left;" class="form-horizontal">
	                                            <input value="<?php if($query['limit_target']){echo $query['limit_target']; }?>"  type="text" placeholder="玩家帐号" name="limit_target" class="col-xs-10 col-sm-2" style="margin-left:5px;height:34px;width:80px;"/>
												<select name="optuser">
	                                            	<option value="">操作人</option>
	                                            	<?php foreach ($optuser_list as $optuser){?>
	                                            	<option value="<?php echo $optuser;?>" <?php if($optuser===$query['optuser']){echo 'selected = \"selected\"';}?>><?php echo $optuser;?></option>
	                                            	<?php }?>
												</select>
												<input value="<?php if($query['start_time']){echo $query['start_time']; }?>" name="start_time" class="date-picker col-xs-10 col-sm-2" id="id_date_picker_1"  placeholder="开始时间" type="text" data-date-format="yyyy-mm-dd" style = "margin-left:5px;height:30px;width:100px;"  />
	                                            <input value="<?php if($query['end_time']){echo $query['end_time']; }?>" name="end_time" class=" date-picker col-xs-10 col-sm-2" id="id_date_picker_2"  placeholder="终止时间" type="text" data-date-format="yyyy-mm-dd" style = "margin-left:5px;height:30px;width:100px;"  />
												<input type="text" placeholder="原因关键字" name="discribe" class="col-xs-10 col-sm-2" style="margin-left:5px;height:34px;width:160px;"/>
	                                            <button class="btn btn-xs btn-success " style="margin-top:3px;">
	                                                <span class="bigger-110">查询</span>
	                                                <i class="icon-search icon-on-right"></i>
	                                            </button>
	                                         </form>
	                                         <button onclick="addPaylimit();" class="btn btn-danger" style="border: none;margin-bottom: 10px;">添加充值黑名单</button>
	                                         <button onclick="ajaxSyncPaylimit();" class="btn btn-danger" style="border: none;margin-bottom: 10px;">同步黑名单到Redis</button>
                                        </div>
                                        <div class="widget-body">
											<div class="widget-main" style="padding: 0;">
												<div id="solveremark"></div>											
												<form action="" method="post" name="of" id="of">
													<table id="sample-table-2"
														class="table table-striped table-bordered table-hover" style="margin-bottom: 10px;">
														<thead id="targethead">
															<tr>
																<th>玩家帐号(禁止充值)</th>															
																<th>操作人</th>
																<th>添加时间</th>
																<th>原因</th>																
																<th>操作</th>
															</tr>
														</thead>
														<tbody id="tbody">
														<?php if(!empty($data_list)){ foreach ($data_list as $v){ ?>
															<tr>
																<td><?php echo $v['limit_target']; ?></td>
																<td><?php echo $v['optuser']; ?></td>
																<td><?php if($v['add_time']){ echo $v['add_time'];}else{echo '-';}?></td>
																<td><?php echo $v['discribe']; ?></td>
																<td style="width:50px;">
																	<button class="btn btn-sm" onclick="ajaxDelPaylimit(<?php echo $v['limit_target']; ?>);"><font color="blue">删除</font></button>
																</td>
																<?php } ?>	
															</tr>
														<?php } ?>
														</tbody>
													</table>
												</form>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- /.col -->
					</div>
					<!-- /.row -->
					<div class="modal-footer no-margin-top">
						<?php echo $this->pagination->create_links();?>											
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
</body>
</html>
