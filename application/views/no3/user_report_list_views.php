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
							<form action="<?php echo site_url('no3/userReport/index');?>">
	                                            <input value="<?php if($query['user_id']){echo $query['user_id']; }?>"  type="text" placeholder="用户ID" name="user_id" class="col-xs-10 col-sm-2" style="margin-left:5px;height:34px;width:160px;"/>
	                                           <select name="game">
													<option value="0">游戏</option>
													<option <?php if($query['game'] && $query['game'] == 1){ ?> selected="selected" <?php } ?> value="1">经典斗地主</option>
													<option <?php if($query['game'] && $query['game'] == 2){ ?> selected="selected" <?php } ?> value="2">欢乐斗地主</option>
													<option <?php if($query['game'] && $query['game'] == 3){ ?> selected="selected" <?php } ?> value="3">癞子斗地主</option>
												</select>
	                                           <select name="order_status">
													<option value="0">状态</option>
													<option <?php if($query['order_status'] && $query['order_status'] == 2){ ?> selected="selected" <?php } ?> value="2">未处理</option>
													<option <?php if($query['order_status'] && $query['order_status'] == 1){ ?> selected="selected" <?php } ?> value="1">已处理</option>
												</select>
	                                            <button class="btn btn-xs btn-success " style="margin-top:3px;">
	                                                <span class="bigger-110">查询</span>
	                                                <i class="icon-search icon-on-right"></i>
	                                            </button>
                                            </form>
								<div class="col-xs-12 col-sm-12 widget-container-span">
								
									<div class="widget-box">
										<div class="widget-body">
											<div class="widget-main" style="padding: 0;">
												<table id="sample-table-2"
													class="table table-striped table-bordered table-hover">
													<thead id="targethead">
														<tr>
															<th width="5%">举报用户</th>
															<th width="5%">金币变化</th>
															<th width="5%">同桌用户</th>
															<th width="10%">举报时间</th>
															<th width="50%">原因</th>
															<th width="6%">游戏</th>
															<th width="5%">牌局编号</th>
															<th width="5%">状态</th>
															<th width="10%">操作</th>
														</tr>
													</thead>
													<tbody>
													<?php foreach ($user_report_list as $v){ $t = explode('|', $v['table_users']); ?>
														<tr>
															<td><a href="<?php echo site_url('no3/infodetail').'?user_id='.$v['user_id']; ?>"><?php echo $v['user_id']; ?></a></td>
															<td><?php echo $v['jinbi']; ?></td>
															<td><a href="<?php echo site_url('no3/infodetail').'?user_id='.$t[0]; ?>"><?php echo $t[0]; ?></a>|<a href="<?php echo site_url('no3/infodetail').'?user_id='.$t[1]; ?>"><?php echo $t[1]; ?></a>|<a href="<?php echo site_url('no3/infodetail').'?user_id='.$t[2]; ?>"><?php echo $t[2]; ?></a></td>
															<td><?php echo date('Y-m-d H:i:s',$v['add_time']); ?></td>
															<!-- <td><?php echo $v['status'] ? '启用' : '关闭'; ?></td> -->
															<td><?php echo $v['discribe']; ?></td>
															<td><?php if($v['type'] == 1){echo '经典斗地主';}else if($v['type'] == 2){echo '欢乐斗地主';}else{echo '癞子斗地主';} ?></td>
															<td><?php echo $v['table_id']; ?></td>
															<td><?php if($v['status'] == 0){echo '未处理';}else{echo '已处理';} ?></td>
															<td>
																<a href="<?php echo site_url('no3/userReport/playback').'?game_number='.$v['table_id'].'&type='.$v['type'].'&user_id='.$v['user_id']; ?>">回放</a>
																&nbsp;|&nbsp;
																<a href="javascript:;" onclick="rep('<?php echo $v['id']; ?>')">回复</a>
															</td>
														</tr>
													<?php } ?>
													</tbody>
												</table>
												<div class="modal-footer no-margin-top">
													<?php echo $this->pagination->create_links();?>											
												</div>

												<div class="modal-body no-padding"></div>

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
			        <h4 class="modal-title" id="chatModalTitle">理由</h4>
			    </div>
			    <div class="modal-body">
					<div style="margin-top: 10px;width: 100%;">
						<textarea class="form-control" style="width: 100%;" id="content" name="content" rows="3"></textarea>	
						<button style="margin-top: 5px;float: right;" onclick="ref('<?php echo site_url('no3/userReport/cancelReport'); ?>');" id="reply_btn" class="btn btn-success">回复</button>
					</div>
				</div>
    		</div>
  		</div>
	</div>
	<script src="<?php echo base_url().'res/js/jquery-2.0.3.min.js'; ?>"></script>
	<script src="<?php echo base_url().'res/js/jquery-ui-1.10.3.custom.min.js'; ?>"></script>
	<script src="<?php echo base_url().'res/js/bootstrap.min.js'; ?>"></script>
	<script src="<?php echo base_url().'res/js/ace-elements.min.js'; ?>"></script>
	<script src="<?php echo base_url().'res/js/ace.min.js'; ?>"></script>	
	<script>
	var report_id = 0;
	var content = '';
	function rep(id){
		report_id = id;
		$('#content').val('');		
		$('#chat_modal').modal('show');
	}
	
	function ref(url){
		content = encodeURIComponent($('#content').val());
		if(report_id == 0 || content == ''){
			alert('信息错误');
			return false;
		}
		location.href = url + '?id='+report_id+'&discribe='+content;
		return true;
	}
	
	</script>
</body>
</html>