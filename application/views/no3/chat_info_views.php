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
									<div class="widget-box" style="border: none;">
										<div class="widget-body" style="border: none;">
											<div class="widget-main" style="padding: 0;">
												<div style="overflow: hidden;width: 700px;">
													<div style="float: left;"><a href="<?php echo site_url('no3/chat'); ?>" class="btn btn-success">返回列表</a></div>
													<div style="float: right;"><a href="javascript:;" onclick="close1();" class="btn btn-danger">服务结束，关闭该用户客服会话</a></div>
												</div>
												<div id="chat_content" class="form-group" style="height: 600px;overflow-y: scroll;width: 700px;overflow-x:hidden;background-color: #F0F0F0">												
												<?php if(!empty($chat_list)){ ?>
												<ul style="margin: 0;padding: 10px;list-style: none;" id="chat_content_ul">
													<?php foreach ($chat_list as $c){ ?>
													<li style="width:100%;overflow: hidden;margin-top: 40px;">
														<div style="<?php if(!$c['admin_id']){ ?> float: right; <?php } ?>">
															<?php if($c['admin_id']){ ?>
															<div>
																<div style="float: left;font-weight: bold;padding: 5px;"><?php echo $c['admin_name']; ?></div>
																<div style="float: left;max-width: 65%;margin-left: 10px;">
																	<div style="padding: 5px;"><?php echo $c['add_time_show']; ?></div>
																	<div style="background-color:#62b900; border-radius: 6px;padding: 5px;float: left;"><?php echo $c['content']; ?></div>
																</div>
															</div>																																									
															<?php }else{ ?>
															<div>
																<div style="float: right;font-weight: bold;padding: 5px;">UserID:<?php echo $c['user_id']; ?></div>														
																<div style="float: right;max-width: 65%;margin-right: 10px;">
																	<div style="text-align: right;padding: 5px;"><?php echo $c['add_time_show']; ?></div>
																	<div style="background-color:white; border-radius: 6px;padding: 5px;float: left;"><?php echo $c['content']; ?></div>
																</div>
															</div>
															<?php } ?>	
														</div>											
													</li>							
													<?php } ?>
												</ul>
												<?php } ?>												
												</div>
												<div style="margin-top: 10px;width: 700px;">
													<textarea class="form-control" style="width: 100%;" id="content" name="content" rows="3"></textarea>						
													<button style="margin-top: 5px;float: right;" onclick="reply();" id="reply_btn" class="btn btn-success">回复</button>
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
	<script src="<?php echo base_url().'res/js/jquery-2.0.3.min.js'; ?>"></script>
	<script
		src="<?php echo base_url().'res/js/jquery-ui-1.10.3.custom.min.js'; ?>"></script>
		<script src="<?php echo base_url().'res/js/bootstrap.min.js'; ?>"></script>
	<script src="<?php echo base_url().'res/js/ace-elements.min.js'; ?>"></script>
	<script src="<?php echo base_url().'res/js/ace.min.js'; ?>"></script>
	<script type="text/javascript">
	var stop_get_flag = false;
	var _tmp_time = '<?php echo $tmp_time; ?>';
	$(function(){
		$('#chat_content').scrollTop( $('#chat_content_ul').height() );
		setInterval("getContent(0)",5000);//1000为1秒钟 
		
	});

	$(document).keyup(function(event){
		if(event.keyCode ==13){
			reply();
		}
	});

	function getContent(refer){
		if(stop_get_flag && refer == 0){
			return false;
		}
		$.ajax({
            type:"POST",
            url:"<?php echo site_url('no3/chat/ajaxGetContent'); ?>",
            data:{user_id:"<?php echo $user_id; ?>",tmp_time:_tmp_time},
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
            data:{user_id:"<?php echo $user_id; ?>",content:encodeURIComponent(send_content)},
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

  	function quick_reply(content){
  		$('#content').val($('#content').val() + content);
  	}

	function close1(){
	 	if(confirm("服务未完成请不要关闭会话，关闭会话该会员将会重新分配客服，是否确定？")){
	 		location.href = "<?php echo site_url('no3/chat/closeChatSession/'.$user_id); ?>";
	 		return true;
	 	}else{
		 	return false;
	 	}
	}
	</script>
</body>
</html>