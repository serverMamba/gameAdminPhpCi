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
									<div><b><font color="red"><?php if($web_check){echo $web_check;}?></font></b></div>
									<div class="widget-box">
										<div class="widget-toolbox padding-8 clearfix">
											<a style="float: left" href="javascript:;" onclick="refresh();" class="btn btn-success">刷新</a>
											<div style="float: left;font-size: 18px; margin-left: 20px;margin-top: 10px;"><span id="refresh_sec">10</span> 秒后自动刷新...</div>
                                            <a style="float: left" href="<?php echo site_url('no3/chat/quickReplyList'); ?>" class="btn btn-success">添加快捷回复</a>
                                            <a style="float: right" href="<?php echo site_url('no3/chat/rgkf'); ?>" class="btn btn-success"><?php if($brecharge == '1'){ ?>关闭人工充值 <?php }else{ ?>开启人工充值<?php } ?></a>
                                            <?php if($is_emergency){ ?>
                                            <a style="float: right;margin-right:10px;" href="<?php echo site_url('no3/chat/closeEmergency'); ?>" class="btn btn-danger">关闭紧急回复</a>                                 
                                            <?php }else{ ?>
                                            <a style="float: right;margin-right:10px;" href="<?php echo site_url('no3/chat/emergencyReply'); ?>" class="btn btn-success">开启紧急回复</a>
                                            <?php } ?>
                                            <a style="float: right;margin-right:10px;" href="<?php echo site_url('no3/chat/batchToOtherAdmin'); ?>" class="btn btn-success">批量转客服</a>
                                            <a style="float: right;margin-right:10px;" onclick="openDirectChatChannel();" class="btn btn-danger">直接打开聊天通道</a>
                                            <input id="directChatUserId" style="float: right;margin:4px;height:100%;padding:6px 12px" placeholder="输入UserId" ></input>
                                       </div>
										<div class="widget-toolbox padding-8 clearfix">
											<?php if(!in_array($this->session->userdata('id'),$super_admin_list)){ ?>
											<?php if($is_chat){ ?>
											<p><b>当前状态：当前<font color="red">在线</font>，接受客服消息中</b></p>
                                            <a href="<?php echo site_url('no3/chat/setAdminIsChat'); ?>" class="btn btn-danger" style="border: none;">设置离线</a>
                                            <?php }else{ ?>
                                            <p><b>当前状态：当前<font color="red">离线</font>，不接受客服消息</b></p>
                                            <a href="<?php echo site_url('no3/chat/setAdminIsChat'); ?>" class="btn btn-success" style="border: none;">设置在线</a>
                                            <?php } ?>
                                            <?php } ?>
                                        </div>
										<div class="widget-body">
											<div class="widget-main" style="padding: 0;">
												<table id="sample-table-2"
													class="table table-striped table-bordered table-hover">
													<thead id="targethead">
														<tr>
															<th class="center">用户ID</th>
															<th>渠道</th>
															<th>内容</th>
															<th>最后回复人</th>
															<th>最后回复时间</th>
															<th>操作</th>
														</tr>
													</thead>
													<tbody>
													<?php foreach ($chat_list as $v){ ?>
														<tr>
															<td width="5%"><?php echo $v['user_id']; ?></td>
															<td width="10%"><?php echo $v['channel']; ?></td>
															<td width="40%" class="td_content" _data="<?php echo $v['user_id']; ?>" _data1="<?php echo $v['add_time']; ?>" _data2="<?php echo $v['channel']; ?>"><?php echo $v['content']; ?></td>
															<td class="td_content" _data="<?php echo $v['user_id']; ?>"><?php if($v['admin_id']){echo $v['admin_name'];}else{echo 'UserID: '.$v['user_id']; } ?> <?php if(!$v['admin_id'] && $v['is_user_reply']){echo '（<font color="red">未受理</font>）'; }?></td>
															<td><?php echo date('Y-m-d H:i:s',$v['add_time']); ?></td>
															<td>
																<a href="javascript:;" onclick="toReply('<?php echo $v['user_id']; ?>');">回复</a>
																|
																<a href="<?php echo site_url('no3/chat/toOtherAdmin/'.$v['user_id']); ?>">转给其他客服</a>
																|
																<a href="<?php echo site_url('no3/chat/setReply').'?user_id='.$v['user_id']; ?>">关闭并受理</a>
																<?php if(!in_array($this->session->userdata('id'),$super_admin_list)){ ?>
																|
																<a href="javascript:;" onclick="close1('<?php echo site_url('no3/chat/closeChatSession/'.$v['user_id']); ?>');">客服结束</a>
																<?php } ?>
																|
																<?php if($v['is_gag']){ ?>
																<a href="<?php echo site_url('no3/chat/cancelGag/'.$v['user_id']); ?>">取消禁言</a>
																<?php }else{ ?>
																<a href="javascript:;" onclick="gag('<?php echo $v['user_id']; ?>');">禁言</a>
																<?php } ?>
															</td>
														</tr>
													<?php } ?>
													</tbody>
												</table>
												<div class="modal-footer no-margin-top">
													<?php echo $this->pagination->create_links();?>	
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
	</div>
	<!-- /.main-container -->
	
	<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="chat_modal">
  		<div class="modal-dialog modal-lg">
    		<div class="modal-content">
    			<div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			        <h4 class="modal-title" id="chatModalTitle">Modal title</h4>
			    </div>
			    <div class="modal-body">
	      			<div id="chat_content" class="form-group" style="height: 400px;overflow-y: scroll;width: 100%;overflow-x:hidden;background-color: #F0F0F0">												
						<ul style="margin: 0;padding: 10px;list-style: none;" id="chat_content_ul">
						</ul>
					</div>
					<div style="margin-top: 10px;width: 100%;">
						<textarea class="form-control" style="width: 100%;" id="content" name="content" rows="3"></textarea>	
						<button style="margin-top: 5px;float: right;" onclick="reply();" id="reply_btn" class="btn btn-success">回复并看下一条</button>
						<button style="margin-top: 5px;float: right;margin-right: 10px;" onclick="reply1();" id="reply_btn" class="btn btn-success">回复</button>
						<button style="margin-top: 5px;float: right;margin-right: 10px;" onclick="reply2();" id="cr_btn" class="btn btn-success">关闭并受理</button>	
						<button style="margin-top: 5px;float: right;margin-right: 10px;" onclick="qgag();" id="cr_btn" class="btn btn-success">禁言</button>																											
						<div class="btn-group dropup" style="margin-top: 5px;float: right;margin-right: 10px;">
							<button style="border-width:5px;" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
								快捷回复
							</button>
							<ul style="z-index: 100" class="dropdown-menu" role="menu">
								<?php if(!empty($reply_list)){ foreach ($reply_list as $r){ ?>
								<li><a href="javascript:;" onclick="quick_reply('<?php echo $r['content']; ?>');"><?php echo $r['content']; ?></a></li>
							 	<?php }} ?>
							</ul>
						</div>
					</div>
				</div>
    		</div>
  		</div>
	</div>
	
	<div class="modal fad bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="gag_modal">
  		<div class="modal-dialog modal-sm">
    		<div class="modal-content">
    			<div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			        <h4 class="modal-title" id="gagModalTitle"></h4>
			    </div>
			    <div class="modal-body">
			   	 	<div>
			   	 		<select id="gag_time" name="gag_time">
			   	 			<option value="3600">1小时</option>
			   	 			<option value="7200">2小时</option>
			   	 			<option value="43200">12小时</option>
			   	 			<option value="86400">24小时</option>
			   	 			<option value="172800">2天</option>
			   	 			<option value="-1">永久</option>
			   	 		</select>
			   	 	</div>
			   	 	<button style="margin-top: 5px;" onclick="gagUser('<?php echo site_url('no3/chat/ajaxGag'); ?>')" id="gag_btn" class="btn btn-danger">禁言</button>
				</div>
    		</div>
  		</div>
	</div>
	
	<script src="<?php echo base_url().'res/js/jquery-2.0.3.min.js'; ?>"></script>
	<script src="<?php echo base_url().'res/js/jquery-ui-1.10.3.custom.min.js'; ?>"></script>
	<script src="<?php echo base_url().'res/js/bootstrap.min.js'; ?>"></script>
	<script src="<?php echo base_url().'res/js/ace-elements.min.js'; ?>"></script>
	<script src="<?php echo base_url().'res/js/ace.min.js'; ?>"></script>	
	<script type="text/javascript">
	var stop_get_flag = false;
	var _tmp_time = '';
	var _user_id = '';
	var _gag_user_id = 0;
	var timer;
	var timer1;
	$(function(){
		$('.td_content').click(function () {
			clearInterval(timer1);
			_user_id = $(this).attr('_data');	
			_channel_id = $(this).attr('_data2');
			$('#chatModalTitle').html('会员 UserID: <a target="_blank" href="<?php echo site_url('no3/infodetail'); ?>?user_id='+_user_id+'">'+_user_id+'</a> 渠道:'+ _channel_id);		    
			$('#chat_modal').modal('show');
		});
		timer1 = setInterval("refresh1()",1000);//1000为1秒钟 

		$('#chat_modal').on('shown.bs.modal', function (e) {
			getContent(0);
			timer = setInterval("getContent(0)",5000);//1000为1秒钟 

			$(this).draggable({
		        handle: ".modal-header"   // 只能点击头部拖动
		    });
		    $(this).css("overflow", "hidden"); 
		});

		$('#chat_modal').on('hide.bs.modal', function (e) {
			_tmp_time = '';
			_user_id = '';
			$('#chat_content_ul li').remove();
			clearInterval(timer);
			timer1 = setInterval("refresh1()",1000);
		});

		$('#gag_modal').on('shown.bs.modal', function (e) {
			clearInterval(timer1);
			$(this).draggable({
		        handle: ".modal-header"   // 只能点击头部拖动
		    });
		    $(this).css("overflow", "hidden"); 
		});

		$('#gag_modal').on('hide.bs.modal', function (e) {
			timer1 = setInterval("refresh1()",1000);
		});
	});

	$(document).keyup(function(event){
		if(event.keyCode ==13){
			reply();
		}
	});

	function toReply(user_id){
		clearInterval(timer1);
		_user_id = user_id;	
		$('#chatModalTitle').html('会员 UserID: '+_user_id);		    
		$('#chat_modal').modal('show');
	}

	function refresh(){
		window.location.reload();
	}

	function refresh1(){
		var refresh_sec = parseInt($('#refresh_sec').html());
		if(refresh_sec > 0){
			refresh_sec --;
			$('#refresh_sec').html(refresh_sec);
		}else{
			refresh();
		}
	}

	function getContent(refer){
		if(stop_get_flag && refer == 0){
			return false;
		}
		$.ajax({
            type:"POST",
            url:"<?php echo site_url('no3/chat/ajaxGetContent'); ?>",
            data:{user_id:_user_id,tmp_time:_tmp_time},
            dataType: "json",
            beforeSend:function(){
			},         
            success:function(data){
           		if(data.status == 0){
					alert(data.msg);
					return false;
               	}else{
                   	if(data.content_list.length == 0){
						return false;
                    }
                   	var content = '';
               		$.each(data.content_list, function(k, v) {
                   		content += '<li style="width:100%;overflow: hidden;margin-top: 40px;"><div><div>';
                   		if(v['admin_id'] == 0){
                   			content += '<div style="float: right;font-weight: bold;padding: 5px;">UserID:'+v['user_id']+'</div>';
                       		content += '<div style="float: right;max-width: 60%;margin-right: 10px;">';
                       		content += '<div style="padding: 5px;">'+v['add_time_show']+'</div>';
                       		content += '<div style="background-color:white; border-radius: 6px;padding: 5px;float: left;">'+v['content']+'</div>';
                   		}else{
                   			content += '<div style="float: left;font-weight: bold;padding: 5px;">'+v['admin_name']+'</div>';
                       		content += '<div style="float: left;max-width: 60%;margin-left: 10px;">';
                       		content += '<div style="padding: 5px;">'+v['add_time_show']+'</div>';
                       		content += '<div style="background-color:#62b900; border-radius: 6px;padding: 5px;float: left;">'+v['content']+'</div>';
                   		}
                   		content += '</div></div></div></li>';
                   		_tmp_time = v['add_time'];
               		});  
               		$('#chat_content_ul').append(content);
					$('#chat_content').scrollTop( $('#chat_content_ul').height() ); 
					stop_get_flag = false;       		
               	}           
            }          
         });
    }

	function reply(){
		stop_get_flag = true;
		$('#reply_btn').attr('disabled',"true");
		
		var send_content = $('#content').val();
		if($.trim(send_content) == ''){
			alert('请输入回复内容');
			$('#content').val('');
			return false;
		}
		var content = '';
		$.ajax({
            type:"POST",
            url:"<?php echo site_url('no3/chat/ajaxPostContent'); ?>",
            data:{user_id:_user_id,content:encodeURIComponent(send_content)},
            dataType: "json",
            beforeSend:function(){
			},         
            success:function(data){
            	$('#reply_btn').removeAttr('disabled');
           		if(data.status == 0){
					alert(data.msg);
					return false;
               	}else{
               		$('#content').val('');
                   	if(data.next_admin_id == 0){                   		
                   		$('#chat_content_ul li').remove();              		
            			_user_id = data.next_user_id;	
            			_tmp_time = '';
            			$('#chatModalTitle').html('会员 UserID: '+_user_id);		    
                   		getContent(1);
                    }else{
                    	$('#chat_modal').modal('hide');                   	
                    }              		
               	}           
            }          
         });
  	}

  	function reply1(){
  		stop_get_flag = true;
		$('#reply_btn').attr('disabled',"true");
		
		var send_content = $('#content').val();
		if($.trim(send_content) == ''){
			alert('请输入回复内容');
			$('#content').val('');
			return false;
		}
		var content = '';
		$.ajax({
            type:"POST",
            url:"<?php echo site_url('no3/chat/ajaxPostContent'); ?>",
            data:{user_id:_user_id,content:encodeURIComponent(send_content)},
            dataType: "json",
            beforeSend:function(){
			},         
            success:function(data){
            	$('#reply_btn').removeAttr('disabled');
           		if(data.status == 0){
					alert(data.msg);
					return false;
               	}else{
               		$('#content').val('');
               		getContent(1);              		
               	}           
            }          
         });
  	}

  	function reply2(){
  		stop_get_flag = true;
		$('#cr_btn').attr('disabled',"true");
		var content = '';
		$.ajax({
            type:"POST",
            url:"<?php echo site_url('no3/chat/ajaxSetReply'); ?>?user_id="+_user_id,
            dataType: "json",
            beforeSend:function(){
			},         
            success:function(data){
            	$('#cr_btn').removeAttr('disabled');
           		if(data.status == 0){
					alert(data.msg);
					return false;
               	}else{
                    $('#chat_modal').modal('hide');                   	
                    refresh();  
               	}           
            }          
         });
  	}

	function quick_reply(content){
  		$('#content').val($('#content').val() + content);
  	}

	function close1(url){
	 	if(confirm("服务未完成请不要关闭会话，关闭会话该会员将会重新分配客服，是否确定？")){
	 		location.href = url;
	 		return true;
	 	}else{
		 	return false;
	 	}
	}

	function qgag(){
		_gag_user_id = _user_id;
		$('#chat_modal').modal('hide');
		$('#gagModalTitle').html('禁言用户ID:'+_gag_user_id);
		$('#gag_modal').modal('show');
	}

	function gag(user_id){
		_gag_user_id = user_id;
		$('#gagModalTitle').html('禁言用户ID:'+_gag_user_id);
		$('#gag_modal').modal('show');
	}

	function gagUser(url){
		$.ajax({
            url:"<?php echo site_url('no3/chat/ajaxGag'); ?>?user_id="+_gag_user_id+'&gag_time='+$('#gag_time').val(),
            dataType: "json",
            beforeSend:function(){
			},         
            success:function(data){
           		if(data.status == 0){
					alert(data.msg);
					return false;
               	}else{
                    $('#gag_modal').modal('hide');                   	
                    refresh();  
               	}           
            }          
         });
	}

	// 直接和某个聊天
	function openDirectChatChannel()
	{
		var chatUserId = $('#directChatUserId').val().trim();
		if (chatUserId.length == 0)
		{
			alert("请输入用户Id");
			return;
		}

		toReply(chatUserId);
	}
	</script>
</body>
</html>