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
															style="height: 26px; width: 80px; margin-left: 10px; margin-top: 5px;">任务编号</label>
														<input type="text" id="formid" placeholder="" readonly="readonly"
															class="col-xs-10 col-sm-2" value="<?php echo $notice['id'];?>"
															style="margin-left: 0px; height: 30px; width: 120px;" />
															
														<label class="col-xs-10 col-sm-2"
															style="height: 26px; width: 80px; margin-left: 10px; margin-top: 5px;">创建时间</label>
														<input class=" date-picker col-xs-10 col-sm-2" readonly="readonly"
															id="id_date_picker_1" placeholder="" type="text"
															data-date-format="yyyy-mm-dd" value="<?php echo $notice['addtime'];?>"
															style="margin-left: 0px; height: 30px; width: 120px;" />
														
														<label class="col-xs-10 col-sm-2"
															style="height: 26px; width: 80px; margin-left: 10px; margin-top: 5px;">创建人</label>
														<input class=" date-picker col-xs-10 col-sm-2" readonly="readonly"
															id="id_date_picker_1" placeholder="" type="text"
															data-date-format="yyyy-mm-dd" value="<?php echo $notice['adduser'];?>"
															style="margin-left: 0px; height: 30px; width: 120px;" />
													</div>
													<div class="form-group">
														<label class="col-xs-10 col-sm-2"
															style="height: 26px; width: 80px; margin-left: 10px; margin-top: 5px;">目标IP</label>
														<input type="text" id="target_ip" placeholder="" readonly="readonly"
															class="col-xs-10 col-sm-2" value="<?php echo $notice['target_ip'];?>"
															style="margin-left: 0px; height: 30px; width: 120px;" />
													
														<label class="col-xs-10 col-sm-2"
															style="height: 26px; width: 80px; margin-left: 10px; margin-top: 5px;">目标端口</label>
														<input type="text" id="target_port" placeholder="" readonly="readonly"
															class="col-xs-10 col-sm-2" value="<?php echo $notice['target_port'];?>"
															style="margin-left: 0px; height: 30px; width: 120px;" />
															
														<label class="col-xs-10 col-sm-2"
															style="height: 26px; width: 80px; margin-left: 10px; margin-top: 5px;">任务类型</label>
														<input type="text" id="tasktype" placeholder="" readonly="readonly"
															class="col-xs-10 col-sm-2" value="<?php if($notice['tasktype'] == 2){echo '一次性任务';}else{echo '循环任务';}?>"
															style="margin-left: 0px; height: 30px; width: 120px;" />
													</div>
													<div class="form-group">
														<label class="col-xs-10 col-sm-2"
															style="height: 26px; width: 80px; margin-left: 10px; margin-top: 5px;">任务状态</label>
														<input type="text" id="status" placeholder="" readonly="readonly"
															class="col-xs-10 col-sm-2" value="<?php if($notice['status'] == 2){echo '关闭';}else{echo '开启';}?>"
															style="margin-left: 0px; height: 30px; width: 120px;" />
													
														<label class="col-xs-10 col-sm-6"
															style="height: 26px; width: 80px; margin-left: 10px; margin-top: 5px;">开启时间</label>
														<input type="text" id="exec_time" placeholder="" readonly="readonly"
															class="col-xs-10 col-sm-2" value="<?php echo $notice['exec_time'];?>"
															style="margin-left: 0px; height: 30px; width: 360px;" />
													</div>
													<div class="form-group">
														<label class="col-xs-10 col-sm-2"
															style="height: 26px; width: 80px; margin-left: 10px; margin-top: 5px;">目标类型</label>
														<input type="text" id="target_type" placeholder="" readonly="readonly"
															class="col-xs-10 col-sm-2" value="<?php echo $notice['target_type'];?>"
															style="margin-left: 0px; height: 30px; width: 120px;" />
													
														<label class="col-xs-10 col-sm-2"
															style="height: 26px; width: 80px; margin-left: 10px; margin-top: 5px;">动作类型</label>
														<input type="text" id="target_port" placeholder="" readonly="readonly"
															class="col-xs-10 col-sm-2" value="<?php echo $notice['action_type'];?>"
															style="margin-left: 0px; height: 30px; width: 120px;" />
															
														<label class="col-xs-10 col-sm-2"
															style="height: 26px; width: 80px; margin-left: 10px; margin-top: 5px;">间隔时间</label>
														<input type="text" id="target_port" placeholder="" readonly="readonly"
															class="col-xs-10 col-sm-2" value="<?php echo $notice['inter_time'];?>"
															style="margin-left: 0px; height: 30px; width: 120px;" />
													</div>
													<div class="form-group">
														<label class="col-xs-10 col-sm-2"
															style="height: 26px; width: 80px; margin-left: 10px; margin-top: 5px;">优先级别</label>
														<input type="text" id="priority_lev" placeholder="" readonly="readonly"
															class="col-xs-10 col-sm-2" value="<?php echo $notice['priority_lev'];?>"
															style="margin-left: 0px; height: 30px; width: 120px;" />
													
														<label class="col-xs-10 col-sm-6"
															style="height: 26px; width: 80px; margin-left: 10px; margin-top: 5px;">截止时间</label>
														<input type="text" id="end_time" placeholder="" readonly="readonly"
															class="col-xs-10 col-sm-2" value="<?php echo $notice['end_time'];?>"
															style="margin-left: 0px; height: 30px; width: 360px;" />
													</div>
													<div id="div_ccdata" class="form-group">
														<label class="col-xs-10 col-sm-2"
															style="height: 26px; width: 80px; margin-left: 10px; margin-top: 5px;">CC数据</label>
														<textarea class="form-control"  style="width:80%; margin-right: 10px;" readonly="readonly"
															id="hex" name="hex" rows="3" ><?php echo $notice['hex'];?></textarea>
													</div>
													<div class="form-group">
														<label class="col-xs-10 col-sm-2"
															style="height: 26px; width: 80px; margin-left: 10px; margin-top: 5px;">备注</label>
														<textarea class="form-control"  style="width:80%; margin-right: 10px;" readonly="readonly"
															id="describe" name="describe" rows="3" ><?php echo $notice['describe'];?></textarea>
													</div>
												</form>
											</div>
												<div class="modal-body no-padding">
													<div id="solvehistory"></div>
													<div id="solvenext"></div>
													<div id="solveremark"></div>
													<div id="btn_ns_span" class="form-group">
														<button onclick="javascript:addtaskForm()"
															class="btn btn-xs btn-success "
															style="margin-top: 1px; margin-left: 20px;">
															<i class="icon-star-half icon-on-left"></i> <span
																class="bigger-110">创建新任务</span>
														</button>
														<button onclick="javascript:ajaxClosetask()"
															class="btn btn-xs btn-success "
															style="margin-top: 1px; margin-left: 20px;">
															<i class="icon-star-half icon-on-left"></i> <span
																class="bigger-110">关闭本任务</span>
														</button>
														<button onclick="javascript:delTask()"
															class="btn btn-xs btn-success "
															style="margin-top: 1px; margin-left: 20px;">
															<i class="icon-star-half icon-on-left"></i> <span
																class="bigger-110">删除本任务</span>
														</button>
														<!-- 
														<button id="btn_ns" onclick="javascript:nextsolve()"
															class="btn btn-xs btn-success "
															style="margin-top: 1px; margin-left: 20px;">
															<i class="icon-star-half icon-on-left"></i> <span
																class="bigger-110">追加处理</span>
														</button>
														<button onclick="javascript:reset()"
															class="btn btn-xs btn-success "
															style="margin-top: 1px; margin-left: 10px;">
															<i class="icon-star-half icon-on-left"></i> <span
																class="bigger-110">重置</span>
														</button>
														<button onclick="javascript:savesolution()"
															class="btn btn-xs btn-success " style="margin-top: 1px; margin-left: 10px;">
															<span class="bigger-110">提交</span> <i
																class="icon-search icon-on-right"></i>
														</button>
														 -->
													</div>
												</div>
												<hr style="height:1px;border:none;border-top:1px solid #555555;" />
												<h><b><font color="green"> > 关联工单列表（最近10条）：</font></b></h>
												<form action="" method="post" name="of" id="of">
													<table id="sample-table-2"
														class="table table-striped table-bordered table-hover" style="margin-bottom: 10px;">
														<thead id="targethead">
															<tr>
																<th>任务号</th>
																<th>工单号</th>
																<th>工单状态</th>
																<th>执行时间</th>
																<th>优先级</th>
																<th>目标IP</th>
																<th>目标端口</th>																
																<th>动作类型</th>
																<th>目标类型</th>
																<th>解析前IP或域名</th>
															</tr>
														</thead>
														<tbody id="tbody">
														<?php if(!empty($form_list)){ foreach ($form_list as $v){ ?>
															<tr>
																<td><?php echo $v['task_id']; ?></td>
																<td><?php echo $v['id']; ?></td>
																<td><?php if($v['flag'] == 2){echo '<font color="green">已完成</font>';}else{echo '<font color="red">未完成</font>';} ?></td>
																<td><?php echo $v['exec_time']; ?></td>
																<td><?php echo $v['priority_lev']; ?></td>
																<td><?php echo $v['target_ip']; ?></td>
																<td><?php echo $v['target_port']; ?></td>
																<td><?php echo $v['action_type']; ?></td>
																<td><?php echo $v['target_type']; ?></td>
																<td><?php echo $v['solution']; ?></td>
															</tr>
														<?php }} ?>
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
	$(function(){
		var target_type = "<?php echo $notice['target_type'];?>";
		if("client_task"!=target_type){
			$("#div_ccdata").hide();
		}
	});
	function nextsolve()
    {
	    if($("#content_append").length <=0)
		{
	    	$("#solveremark").html("");
	    	var datastr = "<div class=\"widget-toolbox padding-8 clearfix\"> <label class=\"col-xs-10 col-sm-2\" style=\"height: 26px; width: 100px; margin-top: 5px;\">处理意见</label> <textarea class=\"form-control\" style=\"width: 100%;\" id=\"content_append\" name=\"content_append\" rows=\"3\"></textarea></div>";
	    	$("#solvenext").append(datastr);
	    	//$("#btn_ns").attr("readonly","readonly");
		}
	    else
		{
	    	$("#solveremark").html("<font color=\"red\">请首先提交当前处理!</font>");
		}
    }
	function reset() 
	{
		$("#solveremark").html("");
		$("#content_append").val("");
	}

	function savesolution(){
		if($("#content_append").length <=0)
		{
			$("#solveremark").html("<font color=\"red\">请首先追加处理意见!</font>");
		}
		var _url = "<?php echo site_url('task/taskinfo/ajaxSaveSolution'); ?>";
		var _task_id = "<?php echo $notice['id'];?>";
		if(_task_id == '' || _url == '' || _task_id.trim() == '' || _url.trim() == ''){
			$("#solveremark").html("<font color=\"red\">参数错误!</font>");
			return;
		}
		var _solution = $('#content_append').val().trim();
		if(_solution == ''){
			$("#solveremark").html("<font color=\"red\">处理意见不可空!</font>");
			return;
		}
		if(_solution.length>1500){
			$("#solveremark").html("<font color=\"red\">处理意见不能超过1500个字符!</font>");
			return;
		}
		_solution = encodeURIComponent(_solution);
		$.ajax({
            type:"POST",
            url:_url,
            data:{task_id:_task_id,solution:_solution},
            dataType: "json",
            beforeSend:function(){
			}, 
            success:function(data){
           		if(data.status == 0){
           			$("#solveremark").html("提交失败！");
					return false;
               	}else{
               		var solvehistoryItemContent = $('#content_append').val();
               		$("#solvenext").html("");
               		$("#solveremark").html("<font color=\"red\">保存成功</font>");
               		var userMsg = "";//"【"+data.adduser+" "+data.time+"】";
               		var datastr = "<div class=\"widget-toolbox padding-8 clearfix\"><label class=\"col-xs-10 col-sm-2\" style=\"height: 26px; width: 500px; margin-top: 5px;\">工单"+userMsg+"</label> <textarea class=\"form-control\" style=\"width: 100%;overflow:auto;\" name=\"solvehistorytmp\" rows=\"3\" readonly=\"readonly\">"+solvehistoryItemContent+"</textarea></div>";
        	    	$("#solvehistory").append(datastr);
                   	return true;           		
               	}         
            }          
         });
    }
	function delTask()
	{
		var flag = confirm("确认删除本任务？一旦删除将无法找回");
		if(!flag)
		{
			return;
		}
		var _task_id = "<?php echo $notice['id'];?>";
		var _url = "<?php echo site_url('task/taskinfo/ajaxDelTask'); ?>";
		if(_task_id == '' || _task_id.trim() == ''){
			$("#solveremark").html("<font color=\"red\">任务ID为空!</font>");
			return;
		}
		$("#solveremark").html("<font color=\"red\">任务"+_task_id+"删除中，请稍候。。。</font>");
		$.ajax({
            type:"POST",
            url:_url,
            data:{task_id:_task_id},
            dataType: "json",
            beforeSend:function(){
			}, 
            success:function(data){
           		if(data.status == 0){
           			$("#solveremark").html("<font color=\"red\">"+data.msg+"</font>");
					return false;
               	}else{
               		$("#solveremark").html("<font color=\"red\">"+data.msg+"</font>");
               		location.href = window.location.protocol + "//" + window.location.host + "/task/taskmgr";
                   	return true;
               	}         
            }          
         });
	}
	function addtaskForm()
	{
		location.href = '<?php echo site_url('task/taskinfo/toAdd'); ?>';
		return true;
	}
	function closetask()
	{
		var _status = "<?php echo $notice['status'];?>";
		if(2==_status)
		{
			alert("任务已经关闭！");
			return;
		}
		var flag = confirm("确认关闭本任务？");
		if(!flag)
		{
			return;
		}
		var _task_id = "<?php echo $notice['id'];?>";
		$("#solveremark").html("<font color=\"red\">任务"+_task_id+"关闭中，请稍候。。。</font>");
		var _url = "<?php echo site_url('task/taskinfo/ajaxClosetask'); ?>";
		if(_task_id == '' || _task_id.trim() == ''){
			$("#solveremark").html("<font color=\"red\">参数错误!</font>");
			return;
		}
		$.ajax({
            type:"POST",
            url:_url,
            data:{task_id:_task_id},
            dataType: "json",
            beforeSend:function(){
			}, 
            success:function(data){
           		if(data.status == 0){
           			$("#solveremark").html("关闭失败，请稍后重试！");
					return false;
               	}else{
               		location.href = window.location.protocol + "//" + window.location.host + "/task/taskmgr";
                   	return true;
               	}         
            }          
         });
	}
	function initAppentBtn()
	{
		var _status = "<?php echo $notice['status'];?>";
		if(1==_status)
		{
			var btnHtml = "<button onclick=\"javascript:ajaxClosetask()\" class=\"btn btn-xs btn-success \" style=\"margin-top: 1px; margin-left: 20px;\"> <i class=\"icon-star-half icon-on-left\"></i> <span class=\"bigger-110\">关闭本任务</span></button>";
			btnHtml += "<span style=\"width:20px;\"/><button onclick=\"javascript:addtaskForm();\" class=\"btn btn-xs btn-success \" style=\"margin-top: 1px; margin-left: 20px;\"> <i class=\"icon-star-half icon-on-left\"></i> <span class=\"bigger-110\">创建新任务</span></button>";
			$("#btn_ns_span").html(btnHtml);
		}
	}
	function ajaxClosetask()
	{
		var _status = "<?php echo $notice['status'];?>";
		if(2==_status)
		{
			alert("任务已经关闭！");
			return;
		}
		var flag = confirm("确认关闭本任务？");
		if(!flag)
		{
			return;
		}
		var _task_id = "<?php echo $notice['id'];?>";
		var _url = "<?php echo site_url('task/taskinfo/ajaxClosetask'); ?>";
		if(_task_id == '' || _task_id.trim() == ''){
			$("#solveremark").html("<font color=\"red\">参数错误!</font>");
			return;
		}
		$("#solveremark").html("<font color=\"red\">任务"+_task_id+"关闭中，请稍候。。。</font>");
		$.ajax({
            type:"POST",
            url:_url,
            data:{task_id:_task_id},
            dataType: "json",
            beforeSend:function(){
			}, 
            success:function(data){
           		if(data.status == 0){
           			$("#solveremark").html("<font color=\"red\">"+data.msg+"</font>");
					return false;
               	}else{
               		$("#solveremark").html("<font color=\"red\">任务"+_task_id+"关闭成功！</font>");
               		location.href = window.location.protocol + "//" + window.location.host + "/task/taskmgr";
                   	return true;
               	}         
            }          
         });
	}
	function getChildSolution(){
		return;
		var _url = "<?php echo site_url('task/taskinfo/ajaxGetChildSolution'); ?>";
		var _task_id = "<?php echo $notice['id'];?>";
		if(_task_id == '' || _url == '' || _task_id.trim() == '' || _url.trim() == ''){
			$("#solveremark").html("<font color=\"red\">参数错误!</font>");
			return;
		}
		
		$.ajax({
            type:"POST",
            url:_url,
            data:{task_id:_task_id},
            dataType: "json",
            beforeSend:function(){
			}, 
            success:function(data){
           		if(data.status == 0){
           			$("#solveremark").html("<font color=\"red\">"+data.msg+"</font>");
					return false;
               	}else{
               		if(null==data.solutions || data.solutions.length == 0){
               			$("#solveremark").html("<font color=\"red\">无工单记录！</font>");
						return true;
                    }
                   	var content = '';
               		$.each(data.solutions, function(k, solutionObj) {
               			var userMsg = "";//"【处理人："+solutionObj.adduser+" 处理时间："+solutionObj.addtime+"】";
           				var solutionContent = solutionObj.solution;
                   		var datastr = "<div class=\"widget-toolbox padding-8 clearfix\"><label class=\"col-xs-10 col-sm-2\" style=\"height: 26px; width: 500px; margin-top: 5px;\">工单"+userMsg+"</label> <textarea class=\"form-control\" style=\"width: 100%;\" name=\"solvehistorytmp\" rows=\"3\" readonly=\"readonly\">"+solutionContent+"</textarea></div>";
            	    	$("#solvehistory").append(datastr);
               		});  
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
	
	String.prototype.trim= function(){  
	    // 用正则表达式将前后空格  
	    // 用空字符串替代。  
	    return this.replace(/(^\s*)|(\s*$)/g, "");  
	}


	$(document).ready(function(){
		//initAppentBtn();
		getChildSolution();
	});
	
</script>
</html>