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
															<label style="height: 26px; width: 100px; margin-left: 10px; margin-top: 5px;">目标IP|域名<font color="red">*</font></label>
														</td>
														<td>
															<input type="text" id="target_ip" name="target_ip" placeholder=""
																class="col-xs-10 col-sm-2" value=""
																style="margin-left: 0px; height: 30px; width: 120px;" />
														</td>
														<td>
															<label style="height: 26px; width: 100px; margin-left: 10px; margin-top: 5px;">目标端口<font color="red">*</font></label>
														</td>
														<td>
															<input type="text" id="target_port" name="target_port" placeholder=""
																class="col-xs-10 col-sm-2" value="0"
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
															<label style="height: 26px; width: 100px; margin-left: 10px; margin-top: 5px;">任务类型<font color="red">*</font></label>
														</td>
														<td>
															<select name="tasktype" id="tasktype" style="margin-left: 0px; width: 120px;" onchange="typeChange()">
																<option value="1">循环任务</option>
																<option value="2">一次性任务</option>
															</select>
														</td>
														<td>
															<div id="div_type1_time_title">
																<label style="height: 26px; width: 100px; margin-left: 10px; margin-top: 5px;">开启时间<font color="red">*</font></label>
															</div>
															<div id="div_type2_time_title" style="display: none">
																<label style="height: 26px; width: 100px; margin-left: 10px; margin-top: 5px;">执行时间<font color="red">*</font></label>
															</div>
														</td>
														<td>
															<input value="<?php if($query['exec_time']){echo $query['exec_time']; }?>" name="exec_time" class=" date-picker col-xs-10 col-sm-2" id="exec_time"  placeholder="执行时间" type="text" data-date-format="yyyy-mm-dd" style = "margin-left:5px;height:30px;width:100px;"  />
															<div class="input-group bootstrap-timepicker" style="float:left;">
																<input value="<?php if($query['exec_time_time']){echo $query['exec_time_time'];}else{echo "00:00";}?>" name="exec_time_time" id="exec_time_time" type="text" class="form-control col-xs-10 col-sm-2" style = "height:30px;width:100px;" />
															</div>
														</td>
													</tr>
													<tr id="div_type1_time_val">
														<td>
															<label style="height: 26px; width: 100px; margin-left: 10px; margin-top: 5px;">间隔时间<font color="red">*</font></label>
														</td>
														<td>
															<input type="text" id="inter_time" name="inter_time" placeholder=""
																class="col-xs-10 col-sm-2" value="10"
																style="margin-left: 0px; height: 30px; width: 120px;" />(分钟)
														</td>
														<td>
															<label style="height: 26px; width: 100px; margin-left: 10px; margin-top: 5px;">截止时间<font color="red">*</font></label>
														</td>
														<td>
															<input value="<?php if($query['end_time']){echo $query['end_time']; }?>" name="end_time" class=" date-picker col-xs-10 col-sm-2" id="end_time"  placeholder="截止时间" type="text" data-date-format="yyyy-mm-dd" style = "margin-left:5px;height:30px;width:100px;"  />
															<div class="input-group bootstrap-timepicker" style="float:left;">
																<input value="<?php if($query['end_time_time']){echo $query['end_time_time'];}else{echo "00:00";}?>" name="end_time_time" id="end_time_time" type="text" class="form-control col-xs-10 col-sm-2" style = "height:30px;width:100px;" />
															</div>
														</td>
													</tr>
													<tr>
														<td>
															<label style="height: 26px; width: 100px; margin-left: 10px; margin-top: 5px;">目标类型<font color="red">*</font></label>
														</td>
														<td>
															<select name="target_type" id="target_type" style="margin-left: 0px; width: 120px;" onchange="targetChange()">
																<option value="server_task">server_task</option>
																<option value="client_task">client_task</option>
															</select>
														</td>
														<td>
															<label style="height: 26px; width: 100px; margin-left: 10px; margin-top: 5px;">动作类型<font color="red">*</font></label>
														</td>
														<td>
															<select name="action_type" id="action_type" style="margin-left: 0px; width: 120px;">
																<option value="UDP">UDP</option>
																<option value="ACK">ACK</option>
																<option value="CC">CC</option>
																<option value="SYN">SYN</option>
																<option value="ICMP">ICMP</option>
															</select>
														</td>
													</tr>
													<tr>
														<td>
															<label style="height: 26px; width: 100px; margin-left: 10px; margin-top: 5px;">优先级别<font color="red">*</font></label>
														</td>
														<td>
															<select name="priority_lev" id="priority_lev" style="margin-left: 0px; width: 120px;">
																<option value="1">1</option>
																<option value="2">2</option>
																<option value="3">3</option>
																<option value="4">4</option>
																<option value="5">5</option>
																<option value="6">6</option>
																<option value="7">7</option>
																<option value="8">8</option>
																<option value="9">9</option>
																<option value="10">10</option>
															</select>
														</td>
													</tr>
													<tr id="div_hex_val" style="display:none;">
														<td>
															<label style="height: 26px; width: 100px; margin-left: 10px; margin-top: 5px;">CC数据</label>
														</td>
														<td colspan="3">
															<textarea class="form-control"  style="width:100%; margin-right: 10px;"
																id="hex" name="hex" rows="3" ></textarea>
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
													<button onclick="javascript:ajaxSavetaskNew()"
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
	$(function(){
		initDatetimeCon();
	});

	function initDatetimeCon(){
		$("#div_hex_val").hide();
		/**
		$('#id_date_picker_1').datepicker({autoclose:true}).on(ace.click_event, function(){
			$("#id_date_picker_1").focus();
		});**/
		$('#exec_time').datepicker({autoclose:true}).on(ace.click_event, function(){
			$("#exec_time").focus();
		});
		/**
		$('#id_time_picker_1').timepicker({
				minuteStep: 1,
				showSeconds: false,
				showMeridian: false
			}).on(ace.click_event, function(){
				$("#id_time_picker_1").focus();
			  });**/
							
		$('#exec_time_time').timepicker({
				minuteStep: 1,
				showSeconds: false,
				showMeridian: false
			}).on(ace.click_event, function(){
				$("#exec_time_time").focus();
			}); 

		if(""==$("#exec_time").val().trim()){
			var myDate=new Date();
			var myDateStr1 = "<?php echo date ( 'Y-m-d', strtotime ( '1 minute' ));?>";//dateFormat(myDate,"yyyy-MM-dd");
			var myDateStr2 = "<?php echo date ( 'H:i', strtotime ( '1 minute' ));?>";//dateFormat(myDate,"HH:mm");
			$("#exec_time").val(myDateStr1);
			$("#exec_time_time").val(myDateStr2);

			var myDateStr3 = "<?php echo date ( 'Y-m-d', strtotime ( '+1 day' ));?>";//dateFormat(myDate,"yyyy-MM-dd");
			var myDateStr4 = "<?php echo date ( 'H:i', strtotime ( '+1 day' ));?>";//dateFormat(myDate,"HH:mm");
			$("#end_time").val(myDateStr3);
			$("#end_time_time").val(myDateStr4);
		}
	}

	function typeChange(){
		//var objS = document.getElementById("tasktype");
        var value = $("#tasktype").val();//objS.options[objS.selectedIndex].value;
        if("2"==value)
        {
        	$("#div_type2_time_title").show();
        	$("#div_type1_time_title").hide();
        	$("#div_type2_time_val").show();
        	$("#div_type1_time_val").hide();
        }
        else
        {
        	$("#div_type1_time_title").show();
        	$("#div_type2_time_title").hide();
        	$("#div_type1_time_val").show();
        	$("#div_type2_time_val").hide();
        }
	}

	function targetChange(){
        var value = $("#target_type").val();
        if("client_task"==value)
        {
        	$("#div_hex_val").show();
        	$("#hex").val("");
        }
        else
        {
        	$("#div_hex_val").hide();
        	$("#hex").val("");
        }
	}
                
	function reset() 
	{
		$("#solveremark").html("");
		$("#describe").val("");
		$("#target_ip").val("");
		$("#target_port").val("");
		$("#inter_time").val("10");
		$("#div_hex_val").hide();
    	$("#hex").val("");

		var myDateStr1 = "<?php echo date ( 'Y-m-d', strtotime ( '3 minute' ));?>";//dateFormat(myDate,"yyyy-MM-dd");
		var myDateStr2 = "<?php echo date ( 'H:i', strtotime ( '3 minute' ));?>";//dateFormat(myDate,"HH:mm");
		$("#exec_time").val(myDateStr1);
		$("#exec_time_time").val(myDateStr2);

		var myDateStr3 = "<?php echo date ( 'Y-m-d', strtotime ( '+1 day' ));?>";//dateFormat(myDate,"yyyy-MM-dd");
		var myDateStr4 = "<?php echo date ( 'H:i', strtotime ( '+1 day' ));?>";//dateFormat(myDate,"HH:mm");
		$("#end_time").val(myDateStr3);
		$("#end_time_time").val(myDateStr4);
	}

	function checkParams(_target_ip,_target_port,_tasktype,_inter_time,_exec_time,_exec_time_time,_describe,_end_time,_end_time_time,_hex){
		if(null==_target_ip || !_target_ip || typeof(_target_ip) == "undefined" || ""==_target_ip)
		{
			$("#solveremark").html("<font color=\"red\">目标IP不可空！</font>");//alert("目标IP不可空！");
			return false;
		}
		/**
		if(!check_IP(_target_ip))
		{
			$("#solveremark").html("<font color=\"red\">目标IP格式不正确！</font>");//alert("目标IP不可空！");
			return false;
		}**/
		if(null==_target_port || typeof(_target_port) == "undefined" || ""==_target_port)
		{
			$("#solveremark").html("<font color=\"red\">目标端口不可空！</font>");//alert("目标端口不可空！");
			return false;
		}
		if(isNaN(_target_port))
		{
			$("#solveremark").html("<font color=\"red\">端口必须为数字！</font>");//alert("间隔时间必须为数字！");
			return false;
		}
		if(null==_tasktype || typeof(_tasktype) == "undefined" || ""==_tasktype)
		{
			$("#solveremark").html("<font color=\"red\">请选择任务类型！</font>");//alert("请选择任务类型！");
			return false;
		}
		if("1"!=_tasktype && "2"!=_tasktype)
		{
			$("#solveremark").html("<font color=\"red\">请选择合法的任务类型！</font>");//alert("请选择合法的任务类型！");
			return false;
		}
		//1 循环任务，2 散点任务
		if("1"==_tasktype)
		{
			if(""==_inter_time)
			{
				$("#solveremark").html("<font color=\"red\">间隔时间不可空！</font>");//alert("间隔时间不可空！");
				return false;
			}
			if(isNaN(_inter_time))
			{
				$("#solveremark").html("<font color=\"red\">间隔时间必须为数字！</font>");//alert("间隔时间必须为数字！");
				return false;
			}
			if(_inter_time<1)
			{
				$("#solveremark").html("<font color=\"red\">间隔时间不可小于1分钟！</font>");//alert("间隔时间不可小于1分钟！");
				return false;
			}
			if(_inter_time>(24*60))
			{
				$("#solveremark").html("<font color=\"red\">间隔时间不可大于24小时！</font>");//alert("间隔时间不可大于24小时！");
				return false;
			}
		}
		if("2"==_tasktype)
		{
			if(""==_exec_time)
			{
				$("#solveremark").html("<font color=\"red\">执行时间不可空！</font>");//alert("执行时间不可空！");
				return false;
			}
			if(""==_exec_time_time)
			{
				_exec_time_time = "00:00";
			}
			_exec_time_time = _exec_time_time+":00";
			var param_exec_time = _exec_time+" "+_exec_time_time;
			if(!check_time(param_exec_time))
			{
				$("#solveremark").html("<font color=\"red\">执行时间格式不正确！</font>");//alert("执行时间格式不正确！");
				return false;
			}
			if( new Date(Date.parse(param_exec_time)) <= new Date()){
				$("#solveremark").html("<font color=\"red\">已过的时间无效！</font>");//alert("已过的时间无效！");
				return false;
			}
		}
		if(""==_end_time_time)
		{
			_end_time_time = "00:00";
		}
		_end_time_time = _end_time_time+":00";
		var param_end_time = _end_time+" "+_end_time_time;
		if(!check_time(param_end_time))
		{
			$("#solveremark").html("<font color=\"red\">截止时间格式不正确！</font>");//alert("截止时间格式不正确！");
			return false;
		}
		if( new Date(Date.parse(param_end_time)) <= new Date()){
			$("#solveremark").html("<font color=\"red\">截止时间已过无效！</font>");//alert("截止时间已过无效！");
			return false;
		}
		if(_describe.length>500)
		{
			$("#solveremark").html("<font color=\"red\">备注太长！</font>");//alert("备注太长！");
			return false;
		}
		if(_hex.length>2000)
		{
			$("#solveremark").html("<font color=\"red\">HEX长度不能超过2000！</font>");//alert("HEX太长！");
			return false;
		}
		return true;
	}
	
	function ajaxSavetaskNew()
	{
		var _url = "<?php echo site_url('task/taskinfo/ajaxSavetaskNew'); ?>";
		var _target_ip = $("#target_ip").val().trim();
		var _target_port = $("#target_port").val().trim();
		var _tasktype = $("#tasktype").val().trim();
		var _inter_time = $("#inter_time").val().trim();
		var _exec_time = $("#exec_time").val().trim();
		var _exec_time_time = $("#exec_time_time").val().trim();
		var _describe = $('#describe').val().trim();
		var _hex = $('#hex').val().trim();

		var _action_type = $("#action_type").val().trim();
		var _target_type = $("#target_type").val().trim();
		var _priority_lev = $("#priority_lev").val().trim();
		var _end_time = $("#end_time").val().trim();
		var _end_time_time = $("#end_time_time").val().trim();

		if(_target_type!="client_task"){
			$('#hex').val("");
			_hex = "";
		}
		var paramFlag = checkParams(_target_ip,_target_port,_tasktype,_inter_time,_exec_time,_exec_time_time,_describe,_end_time,_end_time_time,_hex);
		if(!paramFlag){return;}
		if(""==_exec_time_time)
		{
			_exec_time_time = "00:00";
		}
		_exec_time = _exec_time+" "+_exec_time_time+":00";

		if(""==_end_time_time)
		{
			_end_time_time = "00:00";
		}
		_end_time = _end_time+" "+_end_time_time+":00";

		if(""==_action_type)
		{
			_action_type = "UDP";
		}
		if(""==_target_type)
		{
			_target_type = "server_task";
		}
		if(""==_priority_lev)
		{
			_priority_lev = "1";
		}
		_describe = encodeURIComponent(_describe);
		//_hex = encodeURIComponent(_hex);
		var _data_obj = {target_ip:_target_ip,target_port:_target_port,tasktype:_tasktype,inter_time:_inter_time,exec_time:_exec_time,describe:_describe,end_time:_end_time,action_type:_action_type,target_type:_target_type,priority_lev:_priority_lev,hex:_hex};
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
               		var url_task = "<?php echo site_url('task/taskinfo/toEdit'); ?>";
               		url_task += "?id="+data.task_id;
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

	function check_time(dateStr){
		var a = /^(\d{4})-(\d{2})-(\d{2}) (\d{2}):(\d{2}):(\d{2})$/;
		if (!a.test(dateStr)) { 
			return false;
		} 
		else 
			return true;
	}

	function check_IP(ip)      
	{  
		var re=/^(\d+)\.(\d+)\.(\d+)\.(\d+)$/;//正则表达式     
	   	if(re.test(ip))     
	   	{     
	       	if( RegExp.$1<256 && RegExp.$2<256 && RegExp.$3<256 && RegExp.$4<256)   
	       	return true;     
	   	}     
	   	return false;      
	}  

	function dateFormat(now,mask)
    {
        var d = now;
        var zeroize = function (value, length)
        {
            if (!length) length = 2;
            value = String(value);
            for (var i = 0, zeros = ''; i < (length - value.length); i++)
            {
                zeros += '0';
            }
            return zeros + value;
        };
     
        return mask.replace(/"[^"]*"|'[^']*'|\b(?:d{1,4}|m{1,4}|yy(?:yy)?|([hHMstT])\1?|[lLZ])\b/g, function ($0)
        {
            switch ($0)
            {
                case 'd': return d.getDate();
                case 'dd': return zeroize(d.getDate());
                case 'ddd': return ['Sun', 'Mon', 'Tue', 'Wed', 'Thr', 'Fri', 'Sat'][d.getDay()];
                case 'dddd': return ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'][d.getDay()];
                case 'M': return d.getMonth() + 1;
                case 'MM': return zeroize(d.getMonth() + 1);
                case 'MMM': return ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'][d.getMonth()];
                case 'MMMM': return ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'][d.getMonth()];
                case 'yy': return String(d.getFullYear()).substr(2);
                case 'yyyy': return d.getFullYear();
                case 'h': return d.getHours() % 12 || 12;
                case 'hh': return zeroize(d.getHours() % 12 || 12);
                case 'H': return d.getHours();
                case 'HH': return zeroize(d.getHours());
                case 'm': return d.getMinutes();
                case 'mm': return zeroize(d.getMinutes());
                case 's': return d.getSeconds();
                case 'ss': return zeroize(d.getSeconds());
                case 'l': return zeroize(d.getMilliseconds(), 3);
                case 'L': var m = d.getMilliseconds();
                    if (m > 99) m = Math.round(m / 10);
                    return zeroize(m);
                case 'tt': return d.getHours() < 12 ? 'am' : 'pm';
                case 'TT': return d.getHours() < 12 ? 'AM' : 'PM';
                case 'Z': return d.toUTCString().match(/[A-Z]+$/);
                // Return quoted strings with the surrounding quotes removed
                default: return $0.substr(1, $0.length - 2);
            }
        });
    }

</script>
</html>
