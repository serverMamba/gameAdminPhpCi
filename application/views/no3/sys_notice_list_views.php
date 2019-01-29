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
										<div class="widget-toolbox padding-8 clearfix">
											<select id="packagename" name="packagename" onchange="selectPacket('<?php echo site_url('no3/sysnotice'); ?>')">
												<option value="0">全部</option>
													<?php foreach ($taglist as $k=>$v){ ?>
													<option <?php if($select_tag == $k){ ?> selected="selected" <?php } ?> value="<?php echo $k; ?>" ><?php echo $v;?></option>
													<?php } ?>
											</select>
											
                                            <a href="<?php echo site_url('no3/sysnotice/toAdd'); ?>" class="btn btn-success">添加系统公告</a>
                                            <a onclick="batchDelete();" class="btn btn-danger" style="float:right">批量删除</a>
                                        </div>
										<div class="widget-body">
											<div class="widget-main" style="padding: 0;">
												<table id="sample-table-2"
													class="table table-striped table-bordered table-hover">
													<thead id="targethead">
														<tr>
															<th><input id="selectAll" type="checkbox"/>全选</th>
															<th class="center">ID</th>
															<th width="10%">标题 </th>
															<th width="10%">渠道</th>
															<th width="10%">Tag</th>
															<th width="60%">内容</th>
															<th>轮播</th>															
															<th>状态</th>
															<th>操作</th>
														</tr>
													</thead>
													<tbody>
													<?php foreach ($notice_list as $v){ ?>
														<tr>
															<td><input class="checkOne" id="<?php echo $v['id']?>" type="checkbox"/></td>
															<td><?php echo $v['id']; ?></td>
															<td><?php echo $v['title']; ?></td>
															<td><?php if($v['tag'] == 'all'){echo '所有';}else{ echo $taglist[$v['tag']]; } ?></td>
															<td><?php echo $v['tag']; ?></td>
															<td><?php echo $v['content']; ?></td>
															<td><?php echo $v['is_carousel'] ? '是' : '否'; ?></td>
															<td><?php echo $v['status'] ? '启用' : '关闭'; ?></td>
															<td>
																<a href="<?php echo site_url('no3/sysnotice/toEdit/'.$v['id']); ?>">修改</a>
																<a href="<?php echo site_url('no3/sysnotice/del/'.$v['id']); ?>">删除</a>
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
	<script src="<?php echo base_url().'res/js/jquery-2.0.3.min.js'; ?>"></script>
	<script src="<?php echo base_url().'res/js/jquery-ui-1.10.3.custom.min.js'; ?>"></script>
	<script src="<?php echo base_url().'res/js/bootstrap.min.js'; ?>"></script>
	<script src="<?php echo base_url().'res/js/ace-elements.min.js'; ?>"></script>
	<script src="<?php echo base_url().'res/js/ace.min.js'; ?>"></script>
	<script>
		function selectPacket(url){
			var packetname = $('#packagename').val();
			location.href = url + '?tag=' + packetname;
		}

		function batchDelete()
		{
			var selectedId = [];

			$('.checkOne').each(function()
				{
					if (this.checked)
					{
						selectedId.push($(this).attr('id'));
					}
				});

			if (selectedId.length == 0)
			{
				alert("请选择要删除的内容");
				return;
			}

			$.ajax({
	            type:"POST",
	            url:"<?php echo site_url('no3/sysnotice/batchDelete'); ?>",
	            data:{ids : JSON.stringify(selectedId)},
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
		               	window.location.href = "";
	               	}           
	            }          
	         });
		}

		$('#selectAll').change(function()
			{
				if (this.checked)
				{
					$('.checkOne').each(function()
						{
							$(this).prop("checked", true);
						});
				}
				else
				{
					$('.checkOne').each(function()
						{
							$(this).prop("checked", false);
						});
				}
			});
	</script>	
</body>
</html>