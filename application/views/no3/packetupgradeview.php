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
											<select id="packagename" name="packagename" onchange="selectPacket('<?php echo site_url('no3/packetupgrade'); ?>')">
												<option value="0">全部</option>
													<?php foreach ($taglist as $k=>$v){ ?>
													<option <?php if($select_tag == $k){ ?> selected="selected" <?php } ?> value="<?php echo $k; ?>" ><?php echo $v;?></option>
													<?php } ?>
											</select>
											
                                            <a href="<?php echo site_url('no3/packetupgrade/toAdd'); ?>" class="btn btn-success">添加游戏版本</a>
                                        </div>
										<div class="widget-body">
											<div class="widget-main" style="padding: 0;">
												<table id="sample-table-2"
													class="table table-striped table-bordered table-hover">
													<thead id="targethead">
														<tr>
														<!-- 
															<th class="center">id</th>
														 -->
															<th class="center">渠道号</th>
															<th class="center">游戏</th>
															<th>tag</th>
															<th>最新版本号</th>
															<th>过期版本号</th>
															<th>状态</th>
															<th>操作</th>
														</tr>
													</thead>
													<tbody>
													<?php foreach ($packageList as $v){ ?>
														<tr>
														<!-- 
															<td><?php echo $v['id'];?></td>
														 -->
															<td><?php echo $v['channelId']; ?></td>
															<td><?php if(isset($taglist[$v['packagename']])){ echo $taglist[$v['packagename']];}else{echo '--';} ?></td>
															<td><?php echo $v['packagename']; ?></td>
															<td><?php echo $v['latestVersion']; ?></td>
															<td><?php echo $v['expiredVersion']; ?></td>
															<td><?php echo $v['status'] ? '已经上线' : '审核中，等待上线'; ?></td>
															<td>
																<?php if($v['status'] == 1){ ?>
																<a href="<?php echo site_url('no3/packetupgrade/offLine/'.$v['id']); ?>" style="color:red;">下线</a>
																<?php }else{ ?>
																<a href="<?php echo site_url('no3/packetupgrade/onLine/'.$v['id']); ?>" style="color:green;">上线</a>
																<?php } ?>
																|
																<a onclick="onClickRefreshRedis(<?php echo $v['id']; ?>);" style="color:blue;">刷新Redis</a>
																|
																<a onclick="onClickRemove(<?php echo $v['id']; ?>);" style="color:darkorange;">删除</a>
															</td>
														</tr>
													<?php } ?>
													</tbody>
												</table>

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

		function onClickRefreshRedis(id)
		{
			if (confirm("确定要刷新Redis吗？"))
			{
				location.href = "<?php echo site_url('no3/packetupgrade/refreshRedis'); ?>" + "?id=" + id;
			}
		}

		function onClickRemove(id)
		{
			if (confirm("确定要删除此版本吗？"))
			{
				location.href = "<?php echo site_url('no3/packetupgrade/remove'); ?>" + "?id=" + id;
			}
		}
	</script>
</body>
</html>