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
															style="height: 26px; width: 80px; margin-left: 10px; margin-top: 5px;">单号</label>
														<input type="text" id="formid" placeholder="" readonly="readonly"
															class="col-xs-10 col-sm-2" value="<?php echo $notice['id'];?>"
															style="margin-left: 0px; height: 30px; width: 120px;" />
															
														<label class="col-xs-10 col-sm-2"
															style="height: 26px; width: 80px; margin-left: 10px; margin-top: 5px;">记录日期</label>
														<input class=" date-picker col-xs-10 col-sm-2" readonly="readonly"
															id="id_date_picker_1" placeholder="" type="text"
															data-date-format="yyyy-mm-dd" value="<?php echo $notice['opertime'];?>"
															style="margin-left: 0px; height: 30px; width: 120px;" />
														
														<label class="col-xs-10 col-sm-2"
															style="height: 26px; width: 80px; margin-left: 10px; margin-top: 5px;">记录人</label>
														<input class=" date-picker col-xs-10 col-sm-2" readonly="readonly"
															id="id_date_picker_1" placeholder="" type="text"
															data-date-format="yyyy-mm-dd" value="<?php echo $notice['operuser'];?>"
															style="margin-left: 0px; height: 30px; width: 120px;" />
													</div>
													<div class="form-group">
														<label class="col-xs-10 col-sm-2"
															style="height: 26px; width: 80px; margin-left: 10px; margin-top: 5px;">玩家账号</label>
														<input type="text" id="userid1" placeholder="" readonly="readonly"
															class="col-xs-10 col-sm-2" value="<?php echo $notice['user_id'];?>"
															style="margin-left: 0px; height: 30px; width: 120px;" />
													
														<label class="col-xs-10 col-sm-2"
															style="height: 26px; width: 80px; margin-left: 10px; margin-top: 5px;">手机系统</label>
														<input type="text" id="phonesystem" placeholder="" readonly="readonly"
															class="col-xs-10 col-sm-2" value="<?php echo $notice['phonesystem'];?>"
															style="margin-left: 0px; height: 30px; width: 120px;" />
															
														<label class="col-xs-10 col-sm-2"
															style="height: 26px; width: 80px; margin-left: 10px; margin-top: 5px;">手机型号</label>
														<input type="text" id="phonemodel" placeholder="" readonly="readonly"
															class="col-xs-10 col-sm-2" value="<?php echo $notice['phonemodel'];?>"
															style="margin-left: 0px; height: 30px; width: 120px;" />
													</div>
													<div class="form-group">
														<label class="col-xs-10 col-sm-2"
															style="height: 26px; width: 80px; margin-left: 10px; margin-top: 5px;">网络情况</label>
														<input type="text" id="networktype" placeholder="" readonly="readonly"
															class="col-xs-10 col-sm-2" value="<?php echo $notice['networktype'];?>"
															style="margin-left: 0px; height: 30px; width: 120px;" />
													
														<label class="col-xs-10 col-sm-6"
															style="height: 26px; width: 80px; margin-left: 10px; margin-top: 5px;">所在城市</label>
														<input type="text" id="address" placeholder="" readonly="readonly"
															class="col-xs-10 col-sm-2" value="<?php echo $notice['address'];?>"
															style="margin-left: 0px; height: 30px; width: 360px;" />
													</div>
													<div class="form-group">										
														<label class="col-xs-10 col-sm-2"
															style="height: 26px; width: 80px; margin-left: 10px; margin-top: 5px;">包体大小</label>
														<input type="text" id="appsize" placeholder="" readonly="readonly"
															class="col-xs-10 col-sm-2" value="<?php echo $notice['appsize'];?>"
															style="margin-left: 0px; height: 30px; width: 120px;" />
															
														<label class="col-xs-10 col-sm-2"
															style="height: 26px; width: 80px; margin-left: 10px; margin-top: 5px;">包体来源</label>
														<input type="text" id="appurl" placeholder="" readonly="readonly"
															class="col-xs-10 col-sm-6" value="<?php echo $notice['appsource'];?>"
															style="margin-left: 0px; height: 30px; width: 360px;" />
													</div>
													<div class="form-group">
														<label class="col-xs-10 col-sm-2"
															style="height: 26px; width: 80px; margin-left: 10px; margin-top: 5px;">描述</label>
														<textarea class="form-control"  style="width:80%; margin-right: 10px;" readonly="readonly"
															id="content" name="content" rows="3" ><?php echo $notice['describe'];?></textarea>
													</div>
													<div class="form-group">
														<div class="form-group" style="margin-left: 0px;">
															<label class="col-xs-10 col-sm-2"
																style="height: 26px; width: 80px;  margin-left: 10px; margin-top: 0px;">类型</label>
																<select name="notice_tag" id="notice_tag" disabled="true">
																	<!-- 
																	<option value="0">请选择...</option>
																	<option value="all">所有</option>
																	-->
																	<?php 
																	$bugtypeArr = array (
																			"bug" => "游戏Bug",
																			"install" => "无法安装",
																			"conn" => "无法连接",
																			"slow" => "游戏卡顿",
																			"flash" => "游戏闪退",
																			"other" => "其他问题"
																	);
																	foreach ($bugtypeArr as $k=>$v){ ?>
																	<option <?php if(isset($notice) && $k == $notice['bugtype']){ ?> selected="selected" <?php } ?> value="<?php echo $k; ?>"><?php echo $v; ?></option>
																	<?php } ?>
																</select>
																<!-- 
																<label class="radio-inline"> <input type="radio"
																	name="status" value="0">游戏Bug
																</label> 
																<label class="radio-inline"> <input type="radio"
																	name="status" value="1">无法安装
																</label>
																<label class="radio-inline"> <input type="radio"
																	name="status" value="2">无法连接
																</label> 
																<label class="radio-inline"> <input type="radio"
																	name="status" value="3">游戏卡顿
																</label>
																<label class="radio-inline"> <input type="radio"
																	name="status" value="4">游戏闪退
																</label> 
																<label class="radio-inline"> <input type="radio"
																	name="status" value="5">其他问题
																</label>
																 -->
														</div>
													</div>
												</div>
												<hr style="height:1px;border:none;border-top:1px solid #555555;" />
												<form class="form-horizontal" action="#">
												</form>
												<div class="modal-body no-padding">
													<div id="solvehistory"></div>
													<div id="solvenext"></div>
													<div id="solveremark"></div>
													<div id="btn_ns_span" class="form-group">
														<button onclick="javascript:addBugForm()"
															class="btn btn-xs btn-success "
															style="margin-top: 1px; margin-left: 20px;">
															<i class="icon-star-half icon-on-left"></i> <span
																class="bigger-110">创建新工单</span>
														</button>
														<button onclick="javascript:closebug()"
															class="btn btn-xs btn-success "
															style="margin-top: 1px; margin-left: 20px;">
															<i class="icon-star-half icon-on-left"></i> <span
																class="bigger-110">关闭本工单</span>
														</button>
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
		var _url = "<?php echo site_url('no3/clientbuginfo/ajaxSaveSolution'); ?>";
		var _bug_id = "<?php echo $notice['id'];?>";
		if(_bug_id == '' || _url == '' || _bug_id.trim() == '' || _url.trim() == ''){
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
            data:{bug_id:_bug_id,solution:_solution},
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
               		var userMsg = "【"+data.operuser+" "+data.time+"】";
               		var datastr = "<div class=\"widget-toolbox padding-8 clearfix\"><label class=\"col-xs-10 col-sm-2\" style=\"height: 26px; width: 500px; margin-top: 5px;\">过往处理"+userMsg+"</label> <textarea class=\"form-control\" style=\"width: 100%;overflow:auto;\" name=\"solvehistorytmp\" rows=\"3\" readonly=\"readonly\">"+solvehistoryItemContent+"</textarea></div>";
        	    	$("#solvehistory").append(datastr);
                   	return true;           		
               	}         
            }          
         });
    }
	function addBugForm()
	{
		var _url = '<?php echo site_url('no3/clientbuginfo/toAdd'); ?>';
		location.href = _url;
	}
	function closebug()
	{
		var flag = confirm("确认关闭工单？");
		if(!flag)
		{
			return;
		}
		var _bug_id = "<?php echo $notice['id'];?>";
		var _url = "<?php echo site_url('no3/clientbuginfo/ajaxClosebug'); ?>";
		if(_bug_id == '' || _bug_id.trim() == ''){
			$("#solveremark").html("<font color=\"red\">参数错误!</font>");
			return;
		}
		$.ajax({
            type:"POST",
            url:_url,
            data:{bug_id:_bug_id},
            dataType: "json",
            beforeSend:function(){
			}, 
            success:function(data){
           		if(data.status == 0){
           			$("#solveremark").html("关闭失败，请稍后重试！");
					return false;
               	}else{
               		location.href = window.location.protocol + "//" + window.location.host + "/no3/clientbug";
                   	return true;
               	}         
            }          
         });
	}
	function initAppentBtn()
	{
		var _status = "<?php echo $notice['status'];?>";
		if("1"==_status)
		{
			var btnHtml = "<button onclick=\"javascript:ajaxDelBug()\" class=\"btn btn-xs btn-success \" style=\"margin-top: 1px; margin-left: 20px;\"> <i class=\"icon-star-half icon-on-left\"></i> <span class=\"bigger-110\">删除本工单</span></button>";
			btnHtml += "<span style=\"width:20px;\"/><button onclick=\"javascript:addBugForm();\" class=\"btn btn-xs btn-success \" style=\"margin-top: 1px; margin-left: 20px;\"> <i class=\"icon-star-half icon-on-left\"></i> <span class=\"bigger-110\">创建新工单</span></button>";
			$("#btn_ns_span").html(btnHtml);
		}
	}
	function ajaxDelBug()
	{
		var flag = confirm("确认删除工单？");
		if(!flag)
		{
			return;
		}
		var _bug_id = "<?php echo $notice['id'];?>";
		var _url = "<?php echo site_url('no3/clientbuginfo/ajaxDelBug'); ?>";
		if(_bug_id == '' || _bug_id.trim() == ''){
			$("#solveremark").html("<font color=\"red\">参数错误!</font>");
			return;
		}
		$("#solveremark").html("<font color=\"red\">工单"+_bug_id+"删除中，请稍候。。。</font>");
		$.ajax({
            type:"POST",
            url:_url,
            data:{bug_id:_bug_id},
            dataType: "json",
            beforeSend:function(){
			}, 
            success:function(data){
           		if(data.status == 0){
           			$("#solveremark").html("<font color=\"red\">"+data.msg+"</font>");
					return false;
               	}else{
               		$("#solveremark").html("<font color=\"red\">工单"+_bug_id+"删除成功！</font>");
               		location.href = window.location.protocol + "//" + window.location.host + "/no3/clientbug";
                   	return true;
               	}         
            }          
         });
	}
	function getChildSolution(){
		var _url = "<?php echo site_url('no3/clientbuginfo/ajaxGetChildSolution'); ?>";
		var _bug_id = "<?php echo $notice['id'];?>";
		if(_bug_id == '' || _url == '' || _bug_id.trim() == '' || _url.trim() == ''){
			$("#solveremark").html("<font color=\"red\">参数错误!</font>");
			return;
		}
		
		$.ajax({
            type:"POST",
            url:_url,
            data:{bug_id:_bug_id},
            dataType: "json",
            beforeSend:function(){
			}, 
            success:function(data){
           		if(data.status == 0){
           			$("#solveremark").html("<font color=\"red\">"+data.msg+"</font>");
					return false;
               	}else{
               		if(null==data.solutions || data.solutions.length == 0){
               			$("#solveremark").html("<font color=\"red\">无过往处理记录！</font>");
						return true;
                    }
                   	var content = '';
               		$.each(data.solutions, function(k, solutionObj) {
               			var userMsg = "【处理人："+solutionObj.operuser+" 处理时间："+solutionObj.opertime+"】";
           				var solutionContent = solutionObj.solution;
                   		var datastr = "<div class=\"widget-toolbox padding-8 clearfix\"><label class=\"col-xs-10 col-sm-2\" style=\"height: 26px; width: 500px; margin-top: 5px;\">过往处理"+userMsg+"</label> <textarea class=\"form-control\" style=\"width: 100%;\" name=\"solvehistorytmp\" rows=\"3\" readonly=\"readonly\">"+solutionContent+"</textarea></div>";
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
		initAppentBtn();
		getChildSolution();
	});
	
</script>
</html>