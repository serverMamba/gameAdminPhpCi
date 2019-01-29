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
										<p style="color:red;">当用户输入的内容包含关键词中 <b>所有词</b> 时会自动回复相应内容</p>
										<div class="widget-body">
											<div class="widget-main" style="padding: 0;">
												<table id="sample-table-2"
													class="table table-striped table-bordered table-hover">
													<thead id="targethead">
														<tr>
															<th>关键词</th>
															<th>回复</th>
															<th>操作</th>
														</tr>
													</thead>
													<tbody>
													<?php if(!empty($chat_auto_reply_list)){ foreach ($chat_auto_reply_list as $v){ ?>
														<tr>
															<td><?php echo $v['keywords']; ?></td>
															<td><?php echo $v['reply']; ?></td>
															<td>
															<a onclick="onclickModifyAutoReply(<?php echo $v['id']; ?>, '<?php echo $v['keywords']; ?>', '<?php echo $v['reply']; ?>')">修改</a>
															<a href="<?php echo site_url('no3/chatAutoReply/delReply').'?id='.$v['id'];?>">删除</a>
															</td>
														</tr>
													<?php }} ?>
													</tbody>
												</table>
												
												<div class="modal-body no-padding"></div>
											</div>
										</div>
										<div class="widget-toolbox padding-8 clearfix">
											<form action="<?php echo site_url('no3/chatAutoReply/addReply');?>" method="post" style="float:left;">
	                                           	<input type="text" placeholder="填写关键词(英文逗号隔开)" name="keywords"  class="col-xs-10 col-sm-2" style = "margin-left:5px;height:34px;width:300px;"/> 
												<input type="text" placeholder="填写回复内容" name="reply"  class="col-xs-10 col-sm-2" style = "margin-left:5px;height:34px;width:500px;"/> 
												
	                                            <button type="submit" class="btn btn-xs btn-success " style="margin-top:3px;">
	                                                <span class="bigger-110">添加</span>
	                                            </button>
                                            </form>
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
	
	<!-- 修改内容的模态框 -->
	<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modify_modal">
  		<div class="modal-dialog modal-lg">
    		<div class="modal-content">
    			<div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			        <h4 class="modal-title" id="chatModalTitle">修改自动回复内容</h4>
			    </div>
			    <div class="modal-body">
					<div style="margin-top: 10px;width: 100%; overflow:hidden">
						<div>关键词要用英文逗号隔开: ","</div>
						<input type="text" placeholder="填写关键词(英文逗号隔开)" id="modifyKeywords"  class="col-xs-10 col-sm-2" style = "margin:5px;height:34px;width:500px;"/> 
						<input type="text" placeholder="填写回复内容" id="modifyReply"  class="col-xs-10 col-sm-2" style = "margin:5px;height:34px;width:500px;"/> 
						<button style="margin-top: 5px;float: right;" onclick="confirmModifyAutoReply();" id="reply_btn" class="btn btn-success">确定修改</button>
					</div>
				</div>
    		</div>
  		</div>
	</div>
	<script src="<?php echo base_url().'res/js/jquery-2.0.3.min.js'; ?>"></script>
	<script src="<?php echo base_url().'res/js/jquery-ui-1.10.3.custom.min.js'; ?>"></script>
	<script src="<?php echo base_url().'res/js/bootstrap.min.js'; ?>"></script>
	<script src="<?php echo base_url().'res/js/date-time/bootstrap-datepicker.min.js'; ?>"></script>
    <script src="<?php echo base_url().'res/js/date-time/bootstrap-timepicker.min.js'; ?>"></script>
	<script src="<?php echo base_url().'res/js/ace-elements.min.js'; ?>"></script>
	<script src="<?php echo base_url().'res/js/ace.min.js'; ?>"></script>
	<script>

		var modifyId = 0;
		function onclickModifyAutoReply(id, keywords, reply)
		{
			modifyId = id;
			$('#modifyKeywords').val(keywords);
			$('#modifyReply').val(reply);
			// 弹出二级框
			$('#modify_modal').modal('show');
		}

		function confirmModifyAutoReply()
		{
			$.ajax({
	            type:"POST",
	            url:"<?php echo site_url('no3/chatAutoReply/ajaxUpdateReply'); ?>",
	            data:{id : modifyId, keywords : $('#modifyKeywords').val(), reply : $('#modifyReply').val()},
	            dataType: "json",
	            beforeSend:function(){
				},         
	            success:function(data){
	           		if(data.status == 0){
						alert(data.msg);
						return false;
	               	}else{
		               	// 重新刷新本页
						alert("修改成功");
		               	window.location.href = "<?php /*echo site_url('no3/chatAutoReply');*/ ?>";
	               	}           
	            }          
	         });
		}

	</script>
</body>
</html>
